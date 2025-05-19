<?php
	function getUtenteById($pdo,$id){
    	$sql = "SELECT * 
        		FROM users 
                WHERE id=:id";
        
        $stm = $pdo -> prepare($sql);
        $stm -> bindParam(":id",$id);
        $stm -> execute();
        return $stm;
    }

?>