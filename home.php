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

        /* Stili per il menu hamburger e sidebar */
        .menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            cursor: pointer;
            background: white;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .menu-toggle.active .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 999;
            overflow-y: auto;
            padding: 20px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .sidebar-categories {
            list-style: none;
        }

        .sidebar-category {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .sidebar-category:hover {
            color: #27ae60;
        }

        /* Overlay per quando il menu è aperto */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
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
    <!-- Hamburger Menu Toggle -->
    <div class="menu-toggle" onclick="toggleSidebar()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Menu</h3>
        </div>
        <ul class="sidebar-categories">
            <li class="sidebar-category" onclick="window.location.href='progetto.php'">Il Progetto</li>
            <li class="sidebar-category" onclick="window.location.href='collaborazioni.php'">Collaborazioni</li>
            <li class="sidebar-category" onclick="window.location.href='offertaFondi.php'">Offerta fondi</li>
            <li class="sidebar-category" onclick="window.location.href='offertePremi.php'">Offerte e premi</li>
        </ul>
    </div>

    <!-- Overlay per chiudere il menu -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

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
            <?php
            
            require_once("collegamento_db.php");
            
            // Connessione al database
            $pdo = pdoDB();
            
            // Query per ottenere le categorie uniche
            $sql_categorie = "SELECT DISTINCT nome FROM categorie";
            $result_categorie = $pdo->query($sql_categorie);
            
            if ($result_categorie->rowCount() > 0) {
                while($row = $result_categorie->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="category">' . htmlspecialchars($row["nome"]) . '</div>';
                }
            }
            ?>
        </div>

        <div class="products-grid">
            <?php
            // Query per ottenere tutti i prodotti
            $sql_prodotti = "SELECT * FROM prodotti";
            $result_prodotti = $pdo->query($sql_prodotti);
            
            if ($result_prodotti->rowCount() > 0) {
                while($row = $result_prodotti->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="product-card">
                        <img src="' . htmlspecialchars($row["immagine"]) . '" alt="' . htmlspecialchars($row["nome"]) . '" class="product-image">
                        <div class="product-info">
                            <div class="product-name">' . htmlspecialchars($row["nome"]) . '</div>
                            <div class="product-description">' . htmlspecialchars($row["descrizione"]) . '</div>
                            <div class="product-price">€' . number_format($row["prezzo"], 2, ',', '.') . '</div>
                            <button class="add-to-cart-btn" onclick="addToCart(\'' . addslashes($row["nome"]) . '\', ' . $row["prezzo"] . ', \'' . addslashes($row["immagine"]) . '\')">Aggiungi al carrello</button>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>Nessun prodotto disponibile al momento.</p>";
            }
            ?>
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
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>

    <script>
        // Variabile globale per il carrello
        let cart = [];
        let cartTotal = 0;

        // Funzione per aprire/chiudere il menu laterale
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('active');
            menuToggle.classList.toggle('active');
            overlay.classList.toggle('active');
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

        // Funzione per filtrare i prodotti per categoria
        function filterByCategory(category) {
            // Chiudi il menu laterale se aperto
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('active')) {
                toggleSidebar();
            }

            // Mostra loader durante il caricamento (opzionale)
            document.querySelector('.products-grid').innerHTML = '<p>Caricamento prodotti...</p>';

            // Crea una richiesta AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'filter_products.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    document.querySelector('.products-grid').innerHTML = this.responseText;
                } else {
                    document.querySelector('.products-grid').innerHTML = '<p>Errore nel caricamento dei prodotti</p>';
                }
            };

            // Invia la categoria selezionata
            xhr.send('category=' + encodeURIComponent(category));
        }

        // Aggiungi event listener alle categorie
        document.addEventListener('DOMContentLoaded', function() {
            const categories = document.querySelectorAll('.category');
            categories.forEach(category => {
                category.addEventListener('click', function() {
                    // Rimuovi la classe active da tutte le categorie
                    categories.forEach(c => c.classList.remove('active'));

                    // Aggiungi la classe active a quella selezionata
                    this.classList.add('active');

                    // Filtra i prodotti
                    filterByCategory(this.textContent);
                });
            });

            // Carica tutti i prodotti all'inizio
            filterByCategory('all');
        });
    </script>
</body>
</html>
