<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiori Ribelli</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        header {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 100;
        }

        .contact-info {
            display: flex;
            gap: 20px;
            color: #2c3e50;
            font-size: 14px;
        }

        .contact-info span {
            cursor: pointer;
            transition: color 0.2s;
        }

        .contact-info span:hover {
            color: #a0a0a0;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            border: none;
        }

        .login-btn {
            background-color: #27ae60;
            color: white;
        }

        .login-btn:hover {
            background-color: #2ecc71;
        }

        .signup-btn {
            background-color: #3498db;
            color: white;
        }

        .signup-btn:hover {
            background-color: #2980b9;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f1f1f1;
            position: relative;
            z-index: 100;
        }

        .search-bar {
            width: 60%;
            max-width: 600px;
            display: flex;
            margin-bottom: 10px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        .search-bar button {
            padding: 12px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #2ecc71;
        }

        #txtHint {
            color: #27ae60;
            font-weight: bold;
        }

        main {
            flex: 1;
            padding: 10px;
            position: relative;
            z-index: 1;
        }

        .categories {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px 0;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category {
            padding: 10px 20px;
            margin: 8px;
            background-color: #f1f1f1;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            min-width: 200px;
        }

        .category:hover {
            background-color: #27ae60;
            color: white;
            transform: translateY(-3px);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .product-description {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 10px;
            flex: 1;
        }

        .product-price {
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .add-to-cart-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: auto;
        }

        .add-to-cart-btn:hover {
            background-color: #2980b9;
        }

        /* Sidebar Carrello */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding: 20px;
            overflow-y: auto;
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .close-cart {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #7f8c8d;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 25px;
            height: 25px;
            background-color: #f1f1f1;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px;
        }

        .remove-item {
            color: #e74c3c;
            font-size: 12px;
            cursor: pointer;
            margin-top: 5px;
            display: inline-block;
        }

        .cart-total {
            padding: 15px 0;
            border-top: 1px solid #eee;
            font-weight: bold;
            font-size: 18px;
            text-align: right;
        }

        .checkout-btn {
            background-color: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #2ecc71;
        }

        /* Icona carrello in basso a destra */
        .cart-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #27ae60;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #e74c3c;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
            position: relative;
            z-index: 100;
        }

        /* Stile per il feedback quando si aggiunge al carrello */
        .add-to-cart-feedback {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            bottom: 100px;
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1002;
        }
    </style>
</head>
<body>
    <header>
        <div class="contact-info">
            <span onclick="copyToClipboard(this)">info@fioriribelli.it</span>
            <span>contattaci</span>
            <span onclick="copyToClipboard(this)">333 2261466</span>
        </div>
        <div class="auth-buttons">
            <button class="btn login-btn">Log In</button>
            <button class="btn signup-btn">Registrati</button>
        </div>
    </header>

    <div class="search-container">
        <h3>Cerca tra i nostri prodotti:</h3>
        <div class="search-bar">
            <input type="text" id="txt1" placeholder="Cerca fiori, composizioni..." onkeyup="showHint(this.value)">
            <button type="submit">Cerca</button>
        </div>
    </div>

    <main>        
        <div class="categories">
            <div class="category">Rose</div>
            <div class="category">Erbacee Perenni</div>
            <div class="category">Prodotti per la cura delle piante</div>
            <div class="category">Oggettistica solidale</div>
        </div>

        <div class="products-grid">
            <!-- Prodotto 1 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rosa+Alba" alt="Rosa Alba" class="product-image">
                <div class="product-info">
                    <div class="product-name">Alba</div>
                    <div class="product-description">Rose antiche bianche o rosa pallido, molto profumate e resistenti</div>
                    <div class="product-price">€18,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Alba', 18, 'https://via.placeholder.com/250x180?text=Rosa+Alba')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 2 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rosa+Bourbon" alt="Rosa Bourbon" class="product-image">
                <div class="product-info">
                    <div class="product-name">Bourbon</div>
                    <div class="product-description">Rose rifiorenti con fiori grandi e profumo intenso</div>
                    <div class="product-price">€20,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Bourbon', 20, 'https://via.placeholder.com/250x180?text=Rosa+Bourbon')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 3 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rosa+Centifolia" alt="Rosa Centifolia" class="product-image">
                <div class="product-info">
                    <div class="product-name">Centifolia</div>
                    <div class="product-description">Conosciute come "rose a cento petali", molto profumate</div>
                    <div class="product-price">€22,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Centifolia', 22, 'https://via.placeholder.com/250x180?text=Rosa+Centifolia')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 4 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Centifolia+Muscosa" alt="Centifolia Muscosa" class="product-image">
                <div class="product-info">
                    <div class="product-name">Centifolia Muscosa</div>
                    <div class="product-description">Varietà con calici muschiosi, profumo intenso e petali doppi</div>
                    <div class="product-price">€25,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Centifolia Muscosa', 25, 'https://via.placeholder.com/250x180?text=Centifolia+Muscosa')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 5 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rose+Cinesi" alt="Rose Cinesi" class="product-image">
                <div class="product-info">
                    <div class="product-name">Cinesi</div>
                    <div class="product-description">Rose compatte con fioritura continua e colori vivaci</div>
                    <div class="product-price">€16,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Cinesi', 16, 'https://via.placeholder.com/250x180?text=Rose+Cinesi')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 6 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rose+David+Austin" alt="Rose David Austin" class="product-image">
                <div class="product-info">
                    <div class="product-name">Inglesi David Austin</div>
                    <div class="product-description">Ibridi moderni con forma antica e profumo eccezionale</div>
                    <div class="product-price">€28,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Inglesi David Austin', 28, 'https://via.placeholder.com/250x180?text=Rose+David+Austin')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 7 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rosa+Damascena" alt="Rosa Damascena" class="product-image">
                <div class="product-info">
                    <div class="product-name">Damascena</div>
                    <div class="product-description">Celebri per il profumo, utilizzate in profumeria</div>
                    <div class="product-price">€23,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Damascena', 23, 'https://via.placeholder.com/250x180?text=Rosa+Damascena')">Aggiungi al carrello</button>
                </div>
            </div>

            <!-- Prodotto 8 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/250x180?text=Rose+Floribunda" alt="Rose Floribunda" class="product-image">
                <div class="product-info">
                    <div class="product-name">Floribunda</div>
                    <div class="product-description">Abbondanti fioriture a mazzi, ideali per bordure</div>
                    <div class="product-price">€19,00</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Floribunda', 19, 'https://via.placeholder.com/250x180?text=Rose+Floribunda')">Aggiungi al carrello</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Icona Carrello con contatore - Ora in basso a destra -->
    <div class="cart-icon" onclick="toggleCart()">
        🛒
        <span class="cart-count" id="cartCount">0</span>
    </div>

    <!-- Sidebar Carrello -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h2>Il tuo carrello</h2>
            <button class="close-cart" onclick="toggleCart()">×</button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Gli elementi del carrello verranno aggiunti qui dinamicamente -->
        </div>
        <div class="cart-total">
            Totale: <span id="cartTotal">€0,00</span>
        </div>
        <button class="checkout-btn" onclick="goToCheckout()">Vai al pagamento</button>
    </div>

    <footer>
        <p>&copy; 2023 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>

    <script>
        // Variabile globale per il carrello
        let cart = [];
        let cartTotal = 0;

        // Funzione per aprire/chiudere il carrello
        function toggleCart() {
            document.getElementById('cartSidebar').classList.toggle('active');
        }

        // Funzione per aggiungere un prodotto al carrello
        function addToCart(name, price, image) {
            // Controlla se il prodotto è già nel carrello
            const existingItem = cart.find(item => item.name === name);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    name: name,
                    price: price,
                    image: image,
                    quantity: 1
                });
            }
            
            // Aggiorna il totale
            cartTotal += price;
            
            // Aggiorna la visualizzazione del carrello
            updateCartDisplay();
            
            // Mostra il contatore del carrello
            updateCartCount();
            
            // Mostra feedback visivo
            showAddToCartFeedback(name);
        }

        // Funzione per mostrare feedback quando si aggiunge un prodotto
        function showAddToCartFeedback(productName) {
            const feedback = document.createElement('div');
            feedback.className = 'add-to-cart-feedback';
            feedback.textContent = `${productName} aggiunto al carrello!`;
            document.body.appendChild(feedback);
            
            // Animazione
            setTimeout(() => {
                feedback.style.opacity = '1';
                feedback.style.bottom = '100px';
            }, 10);
            
            // Rimuovi dopo 3 secondi
            setTimeout(() => {
                feedback.style.opacity = '0';
                feedback.style.bottom = '80px';
                setTimeout(() => {
                    document.body.removeChild(feedback);
                }, 300);
            }, 3000);
        }

        // Funzione per aggiornare la visualizzazione del carrello
        function updateCartDisplay() {
            const cartItemsContainer = document.getElementById('cartItems');
            const cartTotalElement = document.getElementById('cartTotal');
            
            // Svuota il contenitore
            cartItemsContainer.innerHTML = '';
            
            // Aggiungi ogni elemento del carrello
            cart.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">€${item.price.toFixed(2)}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="changeQuantity(${index}, -1)">-</button>
                            <input type="text" class="quantity-input" value="${item.quantity}" readonly>
                            <button class="quantity-btn" onclick="changeQuantity(${index}, 1)">+</button>
                        </div>
                        <span class="remove-item" onclick="removeItem(${index})">Rimuovi</span>
                    </div>
                `;
                cartItemsContainer.appendChild(itemElement);
            });
            
            // Aggiorna il totale
            cartTotalElement.textContent = `€${cartTotal.toFixed(2)}`;
        }

        // Funzione per aggiornare il contatore del carrello
        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCountElement = document.getElementById('cartCount');
            
            cartCountElement.textContent = count;
            cartCountElement.style.display = count > 0 ? 'flex' : 'none';
        }

        // Funzione per cambiare la quantità di un prodotto
        function changeQuantity(index, change) {
            const item = cart[index];
            const newQuantity = item.quantity + change;
            
            if (newQuantity < 1) {
                removeItem(index);
                return;
            }
            
            // Aggiorna il totale
            cartTotal += change * item.price;
            
            // Aggiorna la quantità
            item.quantity = newQuantity;
            
            // Aggiorna la visualizzazione
            updateCartDisplay();
            updateCartCount();
        }

        // Funzione per rimuovere un prodotto dal carrello
        function removeItem(index) {
            const item = cart[index];
            
            // Aggiorna il totale
            cartTotal -= item.price * item.quantity;
            
            // Rimuovi l'elemento dall'array
            cart.splice(index, 1);
            
            // Aggiorna la visualizzazione
            updateCartDisplay();
            updateCartCount();
            
            // Se il carrello è vuoto, chiudilo
            if (cart.length === 0) {
                toggleCart();
            }
        }

        // Funzione per andare alla pagina di pagamento
        function goToCheckout() {
            if (cart.length === 0) {
                alert('Il carrello è vuoto!');
                return;
            }
            
            // Qui dovresti reindirizzare alla pagina di pagamento
            // Per ora mostriamo solo un alert
            alert('Reindirizzamento alla pagina di pagamento...');
            console.log('Prodotti nel carrello:', cart);
            console.log('Totale:', cartTotal);
        }

        // Funzione per copiare il testo negli appunti
        function copyToClipboard(element) {
            const text = element.textContent;
            navigator.clipboard.writeText(text)
                .then(() => {
                    const originalColor = element.style.color;
                    element.style.color = "#a0a0a0";
                    setTimeout(() => {
                        element.style.color = originalColor;
                    }, 500);
                })
        }

        // Funzione per la ricerca (da implementare)
        function showHint(str) {
            if (str.length == 0) { 
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
            xhttp.open("GET", ""+str);//MANCA IL COLLEGAMENTO AL DB
            xhttp.send();   
        }
    </script>
</body>
</html>
