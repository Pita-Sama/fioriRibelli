<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiori Ribelli</title>
    <link rel="stylesheet" href="home.css">
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
            <?php
            $products = [
                [
                    "name" => "Alba",
                    "desc" => "Rose antiche bianche o rosa pallido, molto profumate e resistenti",
                    "price" => "€18,00",
                    "img" => "alba.jpg"
                ],
                [
                    "name" => "Bourbon",
                    "desc" => "Rose rifiorenti con fiori grandi e profumo intenso",
                    "price" => "€20,00",
                    "img" => "bourbon.jpg"
                ],
                [
                    "name" => "Centifolia",
                    "desc" => "Conosciute come \"rose a cento petali\", molto profumate",
                    "price" => "€22,00",
                    "img" => "centifolia.jpg"
                ],
                [
                    "name" => "Centifolia Muscosa",
                    "desc" => "Varietà con calici muschiosi, profumo intenso e petali doppi",
                    "price" => "€25,00",
                    "img" => "centifolia-muscosa.jpg"
                ],
                [
                    "name" => "Cinesi",
                    "desc" => "Rose compatte con fioritura continua e colori vivaci",
                    "price" => "€16,00",
                    "img" => "cinesi.jpg"
                ],
                [
                    "name" => "Inglesi David Austin",
                    "desc" => "Ibridi moderni con forma antica e profumo eccezionale",
                    "price" => "€28,00",
                    "img" => "david-austin.jpg"
                ],
                [
                    "name" => "Damascena",
                    "desc" => "Celebri per il profumo, utilizzate in profumeria",
                    "price" => "€23,00",
                    "img" => "damascena.jpg"
                ],
                [
                    "name" => "Floribunda",
                    "desc" => "Abbondanti fioriture a mazzi, ideali per bordure",
                    "price" => "€19,00",
                    "img" => "floribunda.jpg"
                ]
            ];

            foreach ($products as $product) {
                echo '<div class="product-card">';
                echo '<img src="img/' . $product["img"] . '" alt="' . htmlspecialchars($product["name"]) . '" class="product-image">';
                echo '<div class="product-info">';
                echo '<div class="product-name">' . htmlspecialchars($product["name"]) . '</div>';
                echo '<div class="product-description">' . htmlspecialchars($product["desc"]) . '</div>';
                echo '<div class="product-price">' . $product["price"] . '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>

    <script src="home.js"></script>
</body>
</html>
