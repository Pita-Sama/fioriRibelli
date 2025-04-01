<?php
// Directory delle immagini caricate
$uploadDir = 'uploaded_images/';

// Recupera il carrello dai cookie
$carrello = isset($_COOKIE['carrello']) ? explode('|', $_COOKIE['carrello']) : [];
$conta_elementi_carrello = count(array_filter($carrello)); // Conta gli elementi nel carrello

// Gestione dei cookie per accettazione o rifiuto
if (isset($_POST['accetta_cookie'])) {
    setcookie("cookies_accettati", "true", "/"); // Valido per 30 giorni
    header("Location: index.php"); // Reindirizza alla stessa pagina
}

if (isset($_POST['rifiuta_cookie'])) {
    setcookie("cookies_accettati", "false", "/"); // Valido per 30 giorni
    header("Location: index.php"); // Reindirizza alla stessa pagina
}

// Aggiungi immagine al carrello
if (isset($_POST['aggiungi_al_carrello']) && isset($_COOKIE['cookies_accettati']) && $_COOKIE['cookies_accettati'] === "true") {
    $elemento = $_POST['elemento'];
    $prezzo = $_POST['prezzo'];

    $nuovo_elemento_carrello = $elemento . ':' . $prezzo;
    $carrello[] = $nuovo_elemento_carrello;

    setcookie("carrello", implode('|', $carrello), "/"); // Valido per 30 giorni
    header("Location: index.php"); // Reindirizza per aggiornare il carrello
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria Immagini con Carrello</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #555;
        }

        .galleria {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .elemento-galleria {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f8f8f8;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .galleria img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .prezzo {
            font-weight: bold;
            color: #555;
        }

        .aggiungi-al-carrello {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .aggiungi-al-carrello:hover {
            background: #0056b3;
        }

        .link-carrello {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .link-carrello:hover {
            background: #218838;
        }

        #cookie-popup {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        #cookie-popup button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php if (!isset($_COOKIE['cookies_accettati'])) { ?>
        <div id="cookie-popup">
            Questo sito utilizza cookie per migliorare l'esperienza utente. Continuando, accetti i cookie.
            <form method="post" style="display: inline;">
                <button type="submit" name="accetta_cookie">Accetta</button>
                <button type="submit" name="rifiuta_cookie">Rifiuta</button>
            </form>
        </div>
    <?php } ?>

    <!-- Link al carrello con contatore -->
    <a href="cart.php" class="link-carrello">Vai al Carrello (<?php echo $conta_elementi_carrello; ?>)</a>

    <div class="container">
        <h1>Galleria Immagini</h1>

        <div class="galleria">
            <?php
            if (is_dir($uploadDir)) {
                if ($dh = opendir($uploadDir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file != "." && $file != "..") {
                            $prezzo = rand(300,1000); // Prezzo per ogni immagine
                            ?>
                            <div class="elemento-galleria">
                                <img src="<?php echo $uploadDir . $file; ?>" alt="<?php echo $file; ?>">
                                <p class="prezzo">€<?php echo $prezzo; ?></p>
                                <form method="post" action="index.php">
                                    <input type="hidden" name="elemento" value="<?php echo $file; ?>">
                                    <input type="hidden" name="prezzo" value="<?php echo $prezzo; ?>">
                                    <button type="submit" name="aggiungi_al_carrello" class="aggiungi-al-carrello">Aggiungi al carrello</button>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    closedir($dh);
                }
            }
            ?>
        </div>
    </div>
</body>
</html>