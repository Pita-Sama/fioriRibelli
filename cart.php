<?php
// Recupera il carrello dai cookie
$carrello = isset($_COOKIE['carrello']) ? explode('|', $_COOKIE['carrello']) : [];

// Rimuovi un elemento dal carrello
if (isset($_POST['rimuovi']) && isset($carrello[$_POST['indice']])) {
    array_splice($carrello, $_POST['indice'], 1); // Rimuove l'elemento dall'array

    if (empty($carrello)) {
        // Se il carrello è vuoto, elimina il cookie
        setcookie("carrello", "", "/");
    } else {
        // Aggiorna il cookie con i nuovi elementi
        setcookie("carrello", implode('|', $carrello), "/");
    }

    header("Location: cart.php");
}

// Calcola il totale
$totale_prezzo = 0;
foreach ($carrello as $item) {
    $item_parts = explode(':', $item);
    if (count($item_parts) > 1) { // Verifica che ci siano almeno due elementi
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #555;
        }

        .cart-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .cart-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }

        .remove-button {
            background: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-button:hover {
            background: #c9302c;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Il tuo Carrello</h1>

    <div class="cart-container">
        <?php if (empty($carrello)) { ?>
            <p>Il tuo carrello è vuoto.</p>
        <?php } else { ?>
            <?php foreach ($carrello as $index => $item) { ?>
                <?php
                $item_parts = explode(':', $item);
                $nome = count($item_parts) > 0 ? $item_parts[0] : "Elemento sconosciuto"; // Controlla se esiste almeno un elemento
                $prezzo = count($item_parts) > 1 ? $item_parts[1] : 0; // Controlla se esiste il prezzo
                ?>
                <div class="cart-item">
                    <img src="uploaded_images/<?php echo $nome; ?>" alt="<?php echo $nome; ?>">
                    <div class="cart-item-details">
                        <p><?php echo $nome; ?></p>
                        <p class="cart-item-price">€<?php echo $prezzo; ?></p>
                    </div>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="indice" value="<?php echo $index; ?>">
                        <button type="submit" name="rimuovi" class="remove-button">Rimuovi</button>
                    </form>
                </div>
            <?php } ?>
            <p class="total">Totale: €<?php echo $totale_prezzo; ?></p>
        <?php } ?>
        <a href="index.php" class="back-link">Torna alla Galleria</a>
    </div>
</body>
</html>