<?php
session_start();
require_once("collegamento_db.php");
require_once("visualizzazione_prodotti.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiori Ribelli</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <header>
        <div class="contact-info">
            <span onclick="copyToClipboard(this)">info@fioriribelli.it</span>
            <span>contattaci</span>
            <span onclick="copyToClipboard(this)">333 2261466</span>
        </div>
    
        <?php if (isset($_SESSION['user'])): ?>
    		<!-- Menu a tendina se l'utente è loggato -->
            <div class="dropdown">
                <button class="dropdown-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></button>
                <div class="dropdown-content">
                    <a href="#" class="btn btn-primary">Profilo</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Se non c'è sessione, mostra login -->
            <a href="login.php" class="btn btn-primary">Log-In</a>
            <a href="register.php" class="btn btn-primary">Sign-In</a>

        <?php endif; ?>
        
    </header>

    <div class="search-container">
        <h3>Cerca tra i nostri prodotti:</h3>
        <div class="search-bar">
            <input type="text" id="txt1" placeholder="Cerca fiori, composizioni..." onkeyup="filter_byName(this.value)">
        </div>
    </div>

    <main>        
        <div class="categories">
            <?php
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

              $visualizzazione = visualizzazione_prodotti($result_prodotti);
              echo $visualizzazione;
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
        
        function toggleCart() {
             document.getElementById('cartSidebar').classList.toggle('active');
        }

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

            const xhttp = new XMLHttpRequest();
            const path = "php/addProduct.php";
            const parameter = "?name=" + name; 
            
            xhttp.open("GET", path + parameter);
            
            xhttp.onreadystatechange = function () {
              var DONE = 4; // stato 4 indica che la richiesta è stata effettuata.
              var OK = 200; // se la HTTP response ha stato 200 vuol dire che ha avuto successo.
              if (xhttp.readyState === DONE) {
                if (xhttp.status === OK) {
                  console.log(xhttp.responseText); // Questo è il corpo della risposta HTTP
                } else {
                  console.log('Error: ' + xhttp.status); // Lo stato della HTTP response.
                }
              }
            }
            
            xhttp.send();
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

            // Mostra loader durante il caricamento (opzionale)
            document.querySelector('.products-grid').innerHTML = '<p>Caricamento prodotti...</p>';

            // Crea una richiesta AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'filter_products_category.php', true);
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
        
        
        //funzione per cercare un prodotto attraverso la barra di ricerca
        function filter_byName(name){
        	const xhr = new XMLHttpRequest();
            xhr.open("POST","filter_byName.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.querySelector('.products-grid').innerHTML = this.responseText;
                } else {
                    document.querySelector('.products-grid').innerHTML = '<p>Errore nel caricamento dei prodotti</p>';
                }
            };
            
            xhr.send('name=' + encodeURIComponent(name));
        }
    </script>
</body>
</html>
