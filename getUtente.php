<?php
	function getUtente($pdo,$username,$email){
    	$sql = "SELECT * 
        		FROM users 
                WHERE username=:username || email=:email";
        
        $stm = $pdo -> prepare($sql);
        $stm -> bindParam(":username",$username);
        $stm -> bindParam(":email",$email);
        $stm -> execute();
        return $stm;
    }

?>