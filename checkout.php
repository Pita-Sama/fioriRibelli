<?php
session_start();

// Verifica se il carrello è vuoto
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Se non c'è un carrello in sessione, crealo dai cookie
    $carrello = isset($_COOKIE['carrello']) ? explode('|', $_COOKIE['carrello']) : [];
    
    if (empty($carrello)) {
        header("Location: cart.php");
        exit;
    }
    
    // Converti il formato del carrello
    $_SESSION['cart'] = [];
    foreach ($carrello as $item) {
        $item_parts = explode(':', $item);
        if (count($item_parts) > 1) {
            $nome = $item_parts[0];
            $prezzo = (float)$item_parts[1];
            
            // Aggiungi al carrello di sessione nel formato corretto per Stripe
            $_SESSION['cart'][] = [
                'name' => $nome,
                'price' => $prezzo,
                'quantity' => 1
            ];
        }
    }
}

// Calcola il totale
$totale_prezzo = 0;
foreach ($_SESSION['cart'] as $item) {
    $totale_prezzo += $item['price'] * $item['quantity'];
}

// Gestione del form di checkout
$errore = '';
$success = '';
$nome = $email = $indirizzo = $citta = $cap = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validazione dei campi
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $indirizzo = trim($_POST['indirizzo']);
    $citta = trim($_POST['citta']);
    $cap = trim($_POST['cap']);
    
    if (empty($nome) || empty($email) || empty($indirizzo) || empty($citta) || empty($cap)) {
        $errore = 'Tutti i campi sono obbligatori';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errore = 'Email non valida';
    } else {
        // Salva i dati di spedizione in sessione
        $_SESSION['shipping'] = [
            'nome' => $nome,
            'email' => $email,
            'indirizzo' => $indirizzo,
            'citta' => $citta,
            'cap' => $cap
        ];
        
        // Reindirizza alla pagina di pagamento
        header("Location: payment_process.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Fiori Ribelli</title>
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
            position: relative;
            z-index: 100;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .checkout-form {
            flex: 1;
            min-width: 300px;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .order-summary {
            width: 350px;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            align-self: flex-start;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .error-message {
            color: #e74c3c;
            margin-top: 5px;
            font-size: 14px;
        }

        .success-message {
            color: #27ae60;
            margin-top: 5px;
            font-size: 14px;
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .cart-item-name {
            flex: 1;
        }

        .cart-item-price {
            font-weight: bold;
            color: #27ae60;
        }

        .order-total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .checkout-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #2ecc71;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .checkout-container {
                flex-direction: column;
            }
            
            .order-summary {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Fiori Ribelli</h1>
        <a href="cart.php" style="color: #27ae60; text-decoration: none;">Torna al carrello</a>
    </header>

    <div class="checkout-container">
        <div class="checkout-form">
            <h2>Dati di spedizione</h2>
            
            <?php if ($errore): ?>
                <div class="error-message"><?php echo $errore; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="post" action="checkout.php">
                <div class="form-group">
                    <label for="nome">Nome completo</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="indirizzo">Indirizzo</label>
                    <input type="text" id="indirizzo" name="indirizzo" value="<?php echo htmlspecialchars($indirizzo); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="citta">Città</label>
                    <input type="text" id="citta" name="citta" value="<?php echo htmlspecialchars($citta); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="cap">CAP</label>
                    <input type="text" id="cap" name="cap" value="<?php echo htmlspecialchars($cap); ?>" required>
                </div>
                
                <button type="submit" class="checkout-btn">Procedi al pagamento</button>
            </form>
        </div>
        
        <div class="order-summary">
            <h2>Riepilogo ordine</h2>
            
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-name">
                            <?php echo htmlspecialchars($item['name']); ?> 
                            <?php if ($item['quantity'] > 1): ?>
                                (x<?php echo $item['quantity']; ?>)
                            <?php endif; ?>
                        </div>
                        <div class="cart-item-price">
                            €<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="order-total">
                <span>Totale</span>
                <span>€<?php echo number_format($totale_prezzo, 2); ?></span>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>
</body>
</html>
