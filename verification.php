<?php
	if(isset($_GET['id'])){
    	require_once('collegamento_db.php');
    	require_once('getUtenteById.php');
        require_once('verificationById.php');
        
        $pdo = pdoDB();
        $id = $_GET['id'];
        $utente = getUtenteById($pdo,$id);
        
        if($utente -> rowCount() > 0){
        	if(verificationById($pdo,$id))
            	echo 'Email verificata!';
     		else
            	echo "Errore durante la verifica";
        }
        else
        	echo "Email o username inesistente";
    }


?>