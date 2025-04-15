<?php
require_once("collegamento_db.php");

try {
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
    
    // Genera l'HTML dei prodotti
    if ($stmt !== false && $stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <div class="product-card">
                <img src="' . htmlspecialchars($row["immagine"]) . '" alt="' . htmlspecialchars($row["nome"]) . '" class="product-image">
                <div class="product-info">
                    <div class="product-name">' . htmlspecialchars($row["nome"]) . '</div>
                    <div class="product-description">' . htmlspecialchars($row["descrizione"]) . '</div>
                    <div class="product-price">€' . number_format($row["prezzo"], 2, ',', '.') . '</div>
                    <button class="add-to-cart-btn" onclick="addToCart(\'' . addslashes($row["nome"]) . '\', ' . $row["prezzo"] . ', \'' . addslashes($row["immagine"]) . '\')">Aggiungi al carrello</button>
                </div>
            </div>';
        }
    } else {
        echo '<p>Nessun prodotto trovato in questa categoria.</p>';
    }
} catch (PDOException $e) {
    echo '<p>Errore nel caricamento dei prodotti: ' . htmlspecialchars($e->getMessage()) . '</p>';
}

$pdo = null;
?>
