<?php
  session_start();

  require_once 'collegamento_db.php';

  $errore = '';
  $successo = '';

  // Verifica se l'utente è loggato
  if(!isset($_SESSION['users'])){
      header("Location: login.php");
      exit;
  }

  // Recupera l'ID dell'utente dalla sessione
  $id_utente = $_SESSION['users']['id'];

  if(isset($_POST['cambia_password'])){
      $pdo = pdoDB();

      $password_corrente = trim($_POST['password_corrente']);
      $nuova_password = trim($_POST['nuova_password']);
      $conferma_password = trim($_POST['conferma_password']);

      // Validazione
      if(empty($password_corrente)){
          $errore = 'Inserisci la password corrente';
      }else if(empty($nuova_password)){
          $errore = 'Inserisci la nuova password';
      }else if(empty($conferma_password)){
          $errore = 'Conferma la nuova password';
      }else if($nuova_password !== $conferma_password){
          $errore = 'Le nuove password non coincidono';
      }else if(strlen($nuova_password)<8){
          $errore = 'La password deve essere lunga almeno 8 caratteri';
      }else{
          // Recupera i dati dell'utente
          $query = $pdo->prepare("SELECT pass, salt FROM users WHERE id = :id");
          $query->bindParam(':id', $id_utente, PDO::PARAM_INT);
          $query->execute();
          $utente = $query->fetch(PDO::FETCH_ASSOC);

          if($utente){
              // Verifica la password corrente
              if(password_verify($password_corrente . $utente['salt'], $utente['pass'])){
                  // Genera nuovo salt e password hashata
                  $nuovo_salt = bin2hex(random_bytes(16));
                  $nuova_password_hashata = password_hash($nuova_password . $nuovo_salt, PASSWORD_DEFAULT);

                  // Aggiorna il database
                  $update_query = $pdo->prepare("UPDATE users SET pass = :nuova_pass, salt = :nuovo_salt WHERE id = :id");
                  $update_query->bindParam(':nuova_pass', $nuova_password_hashata, PDO::PARAM_STR);
                  $update_query->bindParam(':nuovo_salt', $nuovo_salt, PDO::PARAM_STR);
                  $update_query->bindParam(':id', $id_utente, PDO::PARAM_INT);

                  if($update_query->execute()){
                      $successo = 'Password cambiata con successo!';
                  }else{
                      $errore = 'Errore durante l\'aggiornamento della password. Riprova.';
                  }
              }else{
                  $errore = 'Password corrente errata';
              }
          }else{
              $errore = 'Utente non trovato';
          }
      }
  }
?>

<!DOCTYPE html>
<html lang="it">
  <head>
      <meta charset="UTF-8">
      <title>Cambio Password - Fiori Ribelli</title>
      <link rel="stylesheet" href="cambiaPW.css">
  </head>
  <body>
      <div class="form-container">
          <h1>Cambio Password</h1>

          <?php if($errore): ?>
              <div class="messaggio-errore"><?php echo htmlspecialchars($errore); ?></div>
          <?php endif; ?>

          <?php if($successo): ?>
              <div class="messaggio-successo"><?php echo htmlspecialchars($successo); ?></div>
          <?php endif; ?>

          <form method="POST" novalidate>
              <div class="gruppo-input">
                  <input type="password" name="password_corrente" id="passwordCorrente" placeholder="Password corrente" required>
                  <img src="eye-closed.png" class="toggle-password" data-target="passwordCorrente" alt="Mostra password">
              </div>

              <div class="gruppo-input">
                  <input type="password" name="nuova_password" id="nuovaPassword" placeholder="Nuova password" required minlength="8">
                  <img src="eye-closed.png" class="toggle-password" data-target="nuovaPassword" alt="Mostra password">
              </div>

              <div class="gruppo-input">
                  <input type="password" name="conferma_password" id="confermaPassword" placeholder="Conferma nuova password" required minlength="8">
                  <img src="eye-closed.png" class="toggle-password" data-target="confermaPassword" alt="Mostra password">
              </div>

              <button type="submit" name="cambia_password">Cambia Password</button>
              <a class="link-indietro" href="home.php">Torna alla Home</a>
          </form>
      </div>

      <script src="cambiaPW.js"></script>
  </body>
</html>
