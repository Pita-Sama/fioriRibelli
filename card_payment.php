<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['ordine_id']) || !isset($_SESSION['importo_totale'])) {
    header('Location: carrello.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$ordine_id = $_SESSION['ordine_id'];
$importo = $_SESSION['importo_totale'];
$error = '';

// Simulazione pagamento con carta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $card_number = str_replace(' ', '', $_POST['card_number']);
    $card_name = trim($_POST['card_name']);
    $expiry = trim($_POST['expiry']);
    $cvv = trim($_POST['cvv']);
    
    // Validazione semplice
    if (strlen($card_number) != 16 || !ctype_digit($card_number)) {
        $error = 'Numero carta non valido';
    } elseif (empty($card_name)) {
        $error = 'Inserisci il nome sulla carta';
    } elseif (!preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/', $expiry)) {
        $error = 'Data di scadenza non valida';
    } elseif (strlen($cvv) != 3 || !ctype_digit($cvv)) {
        $error = 'CVV non valido';
    } else {
        // Simulazione pagamento riuscito
        
        // Aggiorna stato ordine
        $query = "UPDATE ordini SET stato = 'pagato' WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ordine_id);
        $stmt->execute();
        
        // Registra pagamento
        $query = "INSERT INTO pagamenti (id_ordine, data_pagamento, metodo) VALUES (?, NOW(), 'carta')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ordine_id);
        $stmt->execute();
        
        // Svuota carrello
        unset($_SESSION['carrello']);
        unset($_SESSION['ordine_id']);
        unset($_SESSION['importo_totale']);
        
        $_SESSION['success'] = 'Pagamento effettuato con successo!';
        header('Location: ordine_confermato.php?id='.$ordine_id);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento con Carta - Fiori Ribelli</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="container">
        <h1>Pagamento con Carta di Credito</h1>
        
        <div class="payment-summary">
            <h2>Riepilogo Ordine #<?php echo $ordine_id; ?></h2>
            <p>Importo totale: <strong>€<?php echo number_format($importo, 2); ?></strong></p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="card_payment.php" method="post" class="card-form">
            <div class="form-group">
                <label for="card_number">Numero Carta</label>
                <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" required>
            </div>
            
            <div class="form-group">
                <label for="card_name">Nome sulla Carta</label>
                <input type="text" name="card_name" id="card_name" required>
            </div>
            
            <div class="form-group-row">
                <div class="form-group">
                    <label for="expiry">Scadenza (MM/AA)</label>
                    <input type="text" name="expiry" id="expiry" placeholder="MM/AA" required>
                </div>
                
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" id="cvv" placeholder="123" required>
                </div>
            </div>
            
            <button type="submit" class="btn">Completa Pagamento</button>
            <a href="checkout.php" class="btn secondary">Torna indietro</a>
        </form>
    </div>
    
    <?php include('footer.php'); ?>
    
    <script>
    // Formattazione automatica numero carta
    document.getElementById('card_number').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s+/g, '');
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
        }
        e.target.value = value;
    });
    </script>
</body>
</html>
