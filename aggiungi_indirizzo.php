<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=aggiungi_indirizzo.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $via = trim($_POST['via']);
    $numeroCivico = trim($_POST['numeroCivico']);
    $citta = trim($_POST['citta']);
    $cap = trim($_POST['cap']);
    
    // Validazione
    if (empty($via) || empty($numeroCivico) || empty($citta) || empty($cap)) {
        $error = 'Tutti i campi sono obbligatori';
    } else {
        // Inserisci indirizzo
        $conn->begin_transaction();
        
        try {
            // Inserisci indirizzo
            $query = "INSERT INTO indirizzi (via, numeroCivico, citta, cap) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $via, $numeroCivico, $citta, $cap);
            $stmt->execute();
            $indirizzo_id = $conn->insert_id;
            
            // Collega indirizzo a utente
            $query = "INSERT INTO risiede (id_user, id_indirizzo) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $user_id, $indirizzo_id);
            $stmt->execute();
            
            $conn->commit();
            $_SESSION['success'] = 'Indirizzo aggiunto con successo!';
            header('Location: checkout.php');
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            $error = 'Errore durante il salvataggio: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Indirizzo - Fiori Ribelli</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="container">
        <h1>Aggiungi Indirizzo</h1>
        
        <?php if ($error): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="aggiungi_indirizzo.php" method="post">
            <div class="form-group">
                <label for="via">Via</label>
                <input type="text" name="via" id="via" required>
            </div>
            
            <div class="form-group">
                <label for="numeroCivico">Numero Civico</label>
                <input type="text" name="numeroCivico" id="numeroCivico" required>
            </div>
            
            <div class="form-group">
                <label for="citta">Città</label>
                <input type="text" name="citta" id="citta" required>
            </div>
            
            <div class="form-group">
                <label for="cap">CAP</label>
                <input type="text" name="cap" id="cap" required>
            </div>
            
            <button type="submit" class="btn">Salva Indirizzo</button>
            <a href="checkout.php" class="btn secondary">Torna al Checkout</a>
        </form>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>
