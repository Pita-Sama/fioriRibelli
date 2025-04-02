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
        $stm = $pdo -> prepare($query);
        $stm -> bindParam(":username",$username);
        $stm -> execute();
        if($stm -> rowCount() > 0){
        	$record = $stm -> fetch();
            if(password_verify($password . $record["salt"], $record["pass"])){
            	$_SESSION['users'] = $user;
                $_SESSION['start_time'] = time();
                header("Location: home.php");
                exit();
            }
            else{
            	$error= "username o password inesistente2";
            }
        }
        
        else {
        	$error = 'username o password inesistente';
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
    <style>
        :root {
            --primary-color: #27ae60;
            --primary-hover: #2ecc71;
            --error-color: #e74c3c;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --border-color: #ddd;
        }
       
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-image: url('sfondo-fiori.jpg');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }
       
        .form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
            backdrop-filter: blur(5px);
        }
       
        .form:hover {
            transform: translateY(-5px);
        }
       
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            font-weight: 600;
        }
       
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
       
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }
       
        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.2);
        }
       
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            height: 20px;
        }
       
        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }
       
        button[type="submit"]:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
       
        #reindirizza {
            display: block;
            text-align: center;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            transition: color 0.3s;
        }
       
        #reindirizza:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
       
        .error {
            color: var(--error-color);
            margin-bottom: 1.5rem;
            text-align: center;
            padding: 0.8rem;
            background-color: rgba(231, 76, 60, 0.1);
            border-radius: 6px;
            font-size: 0.9rem;
        }
       
        @media (max-width: 576px) {
            .form {
                padding: 1.8rem;
            }
           
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="form">
        <h1>Login</h1>
       
        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
       
        <form action="login.php" method="POST" novalidate>
            <div class="input-group">
                <input type="text" name="user" placeholder="Username">
            </div>
                   
            <div class="input-group">
                <input type="password" name="pass" id="passwordField" placeholder="Password" required minlength="8">
                <img src="eye-closed.png" class="toggle-password" id="togglePassword" alt="Mostra password">
            </div>
                   
            <button type="submit" name="submit">Accedi</button>
           
            <a id="reindirizza" href="register.php">Non hai un account? Registrati qui</a>
        </form>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('passwordField');
            const toggleIcon = this;
           
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.src = 'eye-open.jpg';
            } else {
                passwordField.type = 'password';
                toggleIcon.src = 'eye-closed.png';
            }
        });
    </script>
</body>
</html>
