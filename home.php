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
            padding: 30px;
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
            <button type="submit">Cerca</button>
        </div>
        <p>Suggerimenti: <span id="txtHint"></span></p>
    </div>

    <main>
        <h2>Benvenuti su Fiori Ribelli</h2>
        <p>Scopri la nostra collezione di fiori unici e creativi</p>
    </main>

    <footer>
        <p>&copy; 2023 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>

    <script>//TUTTO JS QUESTO
        function copyToClipboard(element) {
            const text = element.textContent;
            navigator.clipboard.writeText(text)//OPERAZIONE ASINCRONA PER COPIARE NEGLI UPPINTI IL NUMERO O L'EMAIL
                .then(() => { //VIENE ESEGUITO SOLO SE VA A BUON FINE LA VECCHIA OPERAZIONE
                    const originalColor = element.style.color;
                    element.style.color = "#a0a0a0";
                    setTimeout(() => {
                        element.style.color = originalColor;
                    }, 500); //DOPO 500 MILLISECONDI TORNA IL COLORE DI PRIMA
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