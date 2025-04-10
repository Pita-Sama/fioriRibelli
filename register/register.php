<?php
session_start();

if(isset($_SESSION['users'])) {
    header("Location: home.php");
    exit;
}

$error = '';
$success = '';

if(isset($_POST['Submit'])){
    require_once 'collegamento_db.php';
    $pdo = pdoDB();
   
    $username = trim($_POST['user']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);
   
    if(empty($username) || empty($email) || empty($password)) {
        $error = 'Tutti i campi sono obbligatori!';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Inserisci un indirizzo email valido!';
    } else {
        $random_salt = bin2hex(random_bytes(16));
        $password = password_hash($password . $random_salt, PASSWORD_DEFAULT);

        $query = "INSERT INTO users(username, email, pass, salt) VALUES(:username, :email, :password, :random_salt)";
        $stm = $pdo->prepare($query);
        $stm->bindParam(':username', $username);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':random_salt', $random_salt);
       
        if($stm->execute()){
            header("Location: login.php");
            exit;
        } else {
            $error = 'Errore durante la registrazione. Riprova più tardi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Fiori Ribelli</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="form">
        <h1>Registrazione</h1>
       
        <?php if($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
       
        <form action="register.php" method="POST" novalidate>
            <div class="input-group">
                <input type="text" name="user" placeholder="Username" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>">
            </div>
                   
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
                   
            <div class="input-group">
                <input type="password" name="pass" id="passwordField" placeholder="Password" required minlength="8">
                <img src="eye-closed.png" class="toggle-password" id="togglePassword" alt="Mostra password">
            </div>
                   
            <button type="submit" name="Submit">Registrati</button>
           
            <a id="reindirizza" href="login.php">Hai già un account? Accedi qui</a>
        </form>
    </div>

    <script src="register.js"></script>
</body>
</html>
