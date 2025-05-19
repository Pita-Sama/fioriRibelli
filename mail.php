<?php
function invioMail($mailDest, $name, $verificationCode) {
    $nomeMittente = "Fiori Ribelli";  
    $mailMitt = "info@fioriribelli.it";  
    
    $mailOgg = "Conferma il tuo indirizzo email";  
    $mailMess = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .code { font-size: 24px; font-weight: bold; color: #0066cc; margin: 15px 0; }
                .footer { margin-top: 20px; font-size: 12px; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Ciao $name,</h2>
                <p>Grazie per esserti registrato su <strong>Fiori Ribelli</strong>!</p>
                <p>Per completare la verifica del tuo account, utilizza il seguente codice:</p>
                <div class='code'>$verificationCode</div>
                <p>Se non hai richiesto questo codice, ignora questa email.</p>
                <div class='footer'>
                    <p>Grazie,<br>Il team di Fiori Ribelli</p>
                </div>
            </div>
        </body>
        </html>
    ";
    
    $mailHeaders = "From: " . $nomeMittente . " <" . $mailMitt . ">\r\n";
    $mailHeaders .= "Reply-To: info@fioriribelli.it\r\n";  
    $mailHeaders .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $mailHeaders .= "MIME-Version: 1.0\r\n";
    $mailHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($mailDest, $mailOgg, $mailMess, $mailHeaders)) {
        session_start();
        $_SESSION['pending_email'] = $mailDest;
        header("Location: verifica.php");
        exit;
    } else {
        error_log("Invio email fallito per: $mailDest");  // Log dell'errore
        return false;
    }
}
?>
