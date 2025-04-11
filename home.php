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
        }

        .product-price {
            font-weight: bold;
            color: #27ae60;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
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
            <div class="product-card">
                <img src="" alt="Rosa Alba" class="product-image">
                <div class="product-info">
                    <div class="product-name">Alba</div>
                    <div class="product-description">Rose antiche bianche o rosa pallido, molto profumate e resistenti</div>
                    <div class="product-price">€18,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rosa Bourbon" class="product-image">
                <div class="product-info">
                    <div class="product-name">Bourbon</div>
                    <div class="product-description">Rose rifiorenti con fiori grandi e profumo intenso</div>
                    <div class="product-price">€20,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rosa Centifolia" class="product-image">
                <div class="product-info">
                    <div class="product-name">Centifolia</div>
                    <div class="product-description">Conosciute come "rose a cento petali", molto profumate</div>
                    <div class="product-price">€22,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rosa Centifolia Muscosa" class="product-image">
                <div class="product-info">
                    <div class="product-name">Centifolia Muscosa</div>
                    <div class="product-description">Varietà con calici muschiosi, profumo intenso e petali doppi</div>
                    <div class="product-price">€25,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rose Cinesi" class="product-image">
                <div class="product-info">
                    <div class="product-name">Cinesi</div>
                    <div class="product-description">Rose compatte con fioritura continua e colori vivaci</div>
                    <div class="product-price">€16,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rose David Austin" class="product-image">
                <div class="product-info">
                    <div class="product-name">Inglesi David Austin</div>
                    <div class="product-description">Ibridi moderni con forma antica e profumo eccezionale</div>
                    <div class="product-price">€28,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rosa Damascena" class="product-image">
                <div class="product-info">
                    <div class="product-name">Damascena</div>
                    <div class="product-description">Celebri per il profumo, utilizzate in profumeria</div>
                    <div class="product-price">€23,00</div>
                </div>
            </div>

            <div class="product-card">
                <img src="" alt="Rose Floribunda" class="product-image">
                <div class="product-info">
                    <div class="product-name">Floribunda</div>
                    <div class="product-description">Abbondanti fioriture a mazzi, ideali per bordure</div>
                    <div class="product-price">€19,00</div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>

    <script>
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
