<?php
session_start();

if(isset($_SESSION['users'])) {
    header("Location: home.php");
    exit;
}

$error = '';
$success = '';

if(isset($_POST['submit'])){
    require_once 'collegamento_db.php';
    $pdo = pdoDB();
   
    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);
   
    if(empty($username) || empty($password)) {
        $error = 'Tutti i campi sono obbligatori!';
    } else {
        $query = "SELECT * FROM users WHERE username=:username";
        $stm = $pdo->prepare($query);
        $stm->bindParam(":username",$username);
        $stm->execute();
        
        if($stm->rowCount() > 0){
            $record = $stm->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password . $record["salt"], $record["pass"])){
                $_SESSION['users'] = $username; // Corretto da $user a $username
                $_SESSION['start_time'] = time();
                header("Location: home.php");
                exit();
            } else {
                $error = "Username o password errati";
            }
        } else {
            $error = 'Username o password errati';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fiori Ribelli</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form">
        <h1>Login</h1>
       
        <?php if($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
       
        <form action="login.php" method="POST" novalidate>
            <div class="input-group">
                <input type="text" name="user" placeholder="Username" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>">
            </div>
                   
            <div class="input-group">
                <input type="password" name="pass" id="passwordField" placeholder="Password" required minlength="8">
                <img src="eye-closed.png" class="toggle-password" id="togglePassword" alt="Mostra password">
            </div>
                   
            <button type="submit" name="submit">Accedi</button>
           
            <a id="reindirizza" href="register.php">Non hai un account? Registrati qui</a>
        </form>
    </div>

    <script src="login.js"></script>
</body>
</html>
