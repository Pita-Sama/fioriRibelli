<?php
session_start();
require_once 'collegamento_db.php';

// Verifica che l'utente sia loggato
if (!isset($_SESSION['user'])) {
    header('Location: login.php?redirect=checkout.php');
    exit();
}

$user_id = $_SESSION['user'];

// Recupera i dati del carrello
if (!isset($_SESSION['carrello']) || empty($_SESSION['carrello'])) {
    header('Location: cart.php');
    exit();
}

// Ottieni indirizzo dell'utente
$query = "SELECT i.* FROM indirizzi i 
          JOIN risiede r ON i.id = r.id_indirizzo 
          WHERE r.id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$indirizzi = $result->fetch_all(MYSQLI_ASSOC);

// Calcola il totale dell'ordine
$totale = 0;
foreach ($_SESSION['carrello'] as $prodotto_id => $quantita) {
    $query = "SELECT prezzo FROM prodotti WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prodotto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $prodotto = $result->fetch_assoc();
    
    $totale += $prodotto['prezzo'] * $quantita;
}

// Gestisci l'invio del form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indirizzo_id = $_POST['indirizzo_id'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    
    // Crea un nuovo ordine
    $stato = "in corso";
    $query = "INSERT INTO ordini (stato, id_user) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $stato, $user_id);
    $stmt->execute();
    $ordine_id = $conn->insert_id;
    
    // Aggiungi i prodotti all'ordine
    foreach ($_SESSION['carrello'] as $prodotto_id => $quantita) {
        for ($i = 0; $i < $quantita; $i++) {
            $query = "INSERT INTO dettagli (id_ordine, id_prodotto) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $ordine_id, $prodotto_id);
            $stmt->execute();
        }
    }
    
    // Memorizza l'ID dell'ordine nella sessione per la pagina di pagamento
    $_SESSION['ordine_id'] = $ordine_id;
    $_SESSION['importo_totale'] = $totale;
    header('Location: card_payment.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="container">
        <h1>Checkout</h1>
        
        <div class="riepilogo-ordine">
            <h2>Riepilogo Ordine</h2>
            <table>
                <thead>
                    <tr>
                        <th>Prodotto</th>
                        <th>Quantità</th>
                        <th>Prezzo</th>
                        <th>Totale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrello'] as $prodotto_id => $quantita): ?>
                        <?php
                        $query = "SELECT * FROM prodotti WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $prodotto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $prodotto = $result->fetch_assoc();
                        $subtotale = $prodotto['prezzo'] * $quantita;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($prodotto['nome']); ?></td>
                            <td><?php echo $quantita; ?></td>
                            <td>€<?php echo number_format($prodotto['prezzo'], 2); ?></td>
                            <td>€<?php echo number_format($subtotale, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Totale</td>
                        <td>€<?php echo number_format($totale, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <form action="checkout.php" method="post">
            <div class="indirizzo-spedizione">
                <h2>Indirizzo di Spedizione</h2>
                <?php if (empty($indirizzi)): ?>
                    <p>Non hai indirizzi salvati. <a href="aggiungi_indirizzo.php">Aggiungi un indirizzo</a></p>
                <?php else: ?>
                    <select name="indirizzo_id" required>
                        <?php foreach ($indirizzi as $indirizzo): ?>
                            <option value="<?php echo $indirizzo['id']; ?>">
                                <?php echo htmlspecialchars($indirizzo['via'] . ' ' . $indirizzo['numeroCivico'] . ', ' . $indirizzo['citta'] . ' ' . $indirizzo['cap']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <a href="aggiungi_indirizzo.php">Aggiungi un nuovo indirizzo</a>
                <?php endif; ?>
            </div>
            
            <div class="metodo-pagamento">
                <h2>Metodo di Pagamento</h2>
                <div>
                    <input type="radio" name="metodo_pagamento" id="paypal" value="paypal" required>
                    <label for="paypal">PayPal</label>
                </div>
                <div>
                    <input type="radio" name="metodo_pagamento" id="carta" value="carta">
                    <label for="carta">Carta di Credito</label>
                </div>
            </div>
            
            <button type="submit" class="btn-procedi">Procedi al Pagamento</button>
        </form>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>
