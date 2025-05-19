<?php
session_start();
require_once('vendor/autoload.php');

// Verifica che sia presente l'ID del pagamento
if (!isset($_GET['payment_intent'])) {
    header("Location: index.php");
    exit;
}

$payment_intent_id = $_GET['payment_intent'];

// Chiave privata
\Stripe\Stripe::setApiKey('sk_test_51RQR0lRrDuxDKDzorVsUY8EDHiTXoCFatWVKBN2dkOPtyjYuBDcssan4NVC2s1N8YNogpdFMDcdnENtG6npWdlnH00gTiLyBz4');

try {
    // Recupera i dettagli del pagamento
    $intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
    
    // Verifica che il pagamento sia andato a buon fine
    if ($intent->status !== 'succeeded') {
        throw new Exception("Il pagamento non è stato completato con successo.");
    }
    
    // A questo punto possiamo registrare l'ordine nel database
    // Connessione al database
    require_once("collegamento_db.php");
    $pdo = pdoDB();
    
    // Ottieni i dati di spedizione
    $shipping = $_SESSION['shipping'];
    
    // Crea un nuovo ordine
    $stmt = $pdo->prepare("INSERT INTO ordini (stato, id_user) VALUES ('pagato', :user_id)");
    // Se l'utente è loggato, usa il suo ID, altrimenti metti NULL
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $stmt->execute(['user_id' => $user_id]);
    $ordine_id = $pdo->lastInsertId();
    
    // Registra il pagamento
    $stmt = $pdo->prepare("INSERT INTO pagamenti (data_pagamento, metodo_pagamento, stato_transazione, riferimento_transazione, id_ordine) 
                          VALUES (NOW(), 'carta', 'completato', :riferimento, :id_ordine)");
    $stmt->execute([
        'riferimento' => $payment_intent_id,
        'id_ordine' => $ordine_id
    ]);
    
    // Svuota il carrello
    $_SESSION['cart'] = [];
    setcookie("carrello", "", time() - 3600, "/");
    
} catch (Exception $e) {
    $_SESSION['payment_error'] = $e->getMessage();
    header("Location: checkout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Riuscito - Fiori Ribelli</title>
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

        .success-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success-icon {
            font-size: 80px;
            color: #27ae60;
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

        .order-details {
            margin: 20px 0;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
            text-align: left;
        }

        .order-id {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .continue-button {
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

        .continue-button:hover {
            background-color: #2ecc71;
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

    <div class="success-container">
        <div class="success-icon">✓</div>
        <h2>Pagamento completato con successo!</h2>
        <p>Grazie per il tuo ordine. La conferma è stata inviata al tuo indirizzo email.</p>
        
        <div class="order-details">
            <p class="order-id">Numero ordine: <?php echo $ordine_id; ?></p>
            <p>Metodo di pagamento: Carta di credito</p>
            <p>Stato: Pagato</p>
        </div>
        
        <p>La tua conferma d'ordine è stata inviata a: <?php echo htmlspecialchars($shipping['email']); ?></p>
        
        <a href="index.php" class="continue-button">Torna alla home</a>
    </div>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>
</body>
</html>
