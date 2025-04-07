<?php
// Recupera il carrello dai cookie
$carrello = isset($_COOKIE['carrello']) ? explode('|', $_COOKIE['carrello']) : [];

// Rimuovi un elemento dal carrello
if (isset($_POST['rimuovi']) && isset($carrello[$_POST['indice']])) {
    array_splice($carrello, $_POST['indice'], 1); // Rimuove l'elemento dall'array

    if (empty($carrello)) {
        setcookie("carrello", "", time() - 3600, "/"); // Elimina il cookie
    } else {
        setcookie("carrello", implode('|', $carrello), time() + 3600, "/"); // Aggiorna cookie
    }

    header("Location: cart.php");
    exit;
}

// Calcola il totale
$totale_prezzo = 0;
foreach ($carrello as $item) {
    $item_parts = explode(':', $item);
    if (count($item_parts) > 1) {
        $totale_prezzo += (float)$item_parts[1];
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Il tuo Carrello</h1>

    <div class="cart-container">
        <?php if (empty($carrello)) { ?>
            <p>Il tuo carrello è vuoto.</p>
        <?php } else { ?>
            <?php foreach ($carrello as $index => $item) { 
                $item_parts = explode(':', $item);
                $nome = $item_parts[0] ?? "Elemento sconosciuto";
                $prezzo = $item_parts[1] ?? 0;
            ?>
                <div class="cart-item">
                    <img src="uploaded_images/<?php echo htmlspecialchars($nome); ?>" alt="<?php echo htmlspecialchars($nome); ?>">
                    <div class="cart-item-details">
                        <p><?php echo htmlspecialchars($nome); ?></p>
                        <p class="cart-item-price">€<?php echo number_format((float)$prezzo, 2); ?></p>
                    </div>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="indice" value="<?php echo $index; ?>">
                        <button type="submit" name="rimuovi" class="remove-button">Rimuovi</button>
                    </form>
                </div>
            <?php } ?>
            <p class="total">Totale: €<?php echo number_format($totale_prezzo, 2); ?></p>
        <?php } ?>
        <a href="index.php" class="back-link">Torna alla Galleria</a>
    </div>
</body>
</html>
