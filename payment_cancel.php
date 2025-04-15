<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Annullato - Fiori Ribelli</title>
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

        .cancel-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .cancel-icon {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .retry-button {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .retry-button:hover {
            background-color: #2ecc71;
        }

        .back-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 10px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
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
        <h1>Fiori Ribelli</h1>
    </header>

    <div class="cancel-container">
        <div class="cancel-icon">✕</div>
        <h2>Pagamento Annullato</h2>
        <p>Il tuo pagamento è stato annullato o si è verificato un problema durante l'elaborazione.</p>
        <p>Nessun addebito è stato effettuato sulla tua carta.</p>
        
        <a href="checkout.php" class="retry-button">Riprova</a>
        <a href="cart.php" class="back-button">Torna al carrello</a>
    </div>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>
</body>
</html>
