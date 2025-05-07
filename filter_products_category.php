<?php
require_once("collegamento_db.php");
require_once("visualizzazione_prodotti.php");
function prodottiPerCategoria(){
	$pdo = pdoDB();
    
    // Ottieni la categoria dalla richiesta POST
    $category = $_POST['category'] ?? 'all';
    // Prepara la query SQL
    if ($category === 'all') {
        $sql = "SELECT * FROM prodotti";
        $stmt = $pdo->query($sql);
    } else {
        $sql = "SELECT * 
        		FROM prodotti
                WHERE id_categoria = (SELECT id
                						FROM categorie 
                                        WHERE nome = :category)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":category", $category);
        $stmt -> execute();
    }
    
    $pdo = null;
    return $stmt;
}

try {
    
    $prodotticategoria = prodottiPerCategoria();
    $tabellaProdotti = visualizzazione_prodotti($prodotticategoria);
    echo $tabellaProdotti;
    
} catch (PDOException $e) {
    echo '<p>Errore nel caricamento dei prodotti: ' . htmlspecialchars($e->getMessage()) . '</p>';
}


?>