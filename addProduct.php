<?php
	if(isset($_GET['name'])){
    	require_once('../collegamento_db.php');
        $nome_prodotto = $_GET["name"];
    	$pdo = pdoDB();
        
        $sql = "SELECT *
        		FROM prodotti
                WHERE nome=:nome";
       	$stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(":nome",$nome_prodotto);
        $stmt -> execute();
        if(isset($_COOKIE['items'])){
        	$cookie_data = stripslashes($_COOKIE['items']);
            $cart_data = json_decode($cookie_data,true);
        }
        else{
        	$cart_data = array();
        }
        if($stmt !== null && $stmt -> rowCount() > 0){
        	$item_id_list = array_column($cart_data, 'name');
        	if(in_array($_GET["name"], $item_id_list)){
            	foreach($cart_data as $id => $values)
                	if($cart_data[$id]['name'] == $nome_prodotto){
                    	$cart_data[$id]['quantita'] += 1;
                    
                }
            }
            else{
              $prodotto = $stmt -> fetch();
              $prodotto_array = array(
                  "id" => $prodotto['id'],
                  "name" => $prodotto['nome'],
                  "prezzo" => $prodotto['prezzo'],
                  "quantita" => 1
              );
              $cart_data[] = $prodotto_array;
              
            }
        	$json = json_encode($cart_data,true);
            setcookie('items', $json, time() + (86400 * 30));
        }
    }

?>

