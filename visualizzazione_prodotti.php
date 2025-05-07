<?php

function visualizzazione_prodotti($prodotti){
		if($prodotti -> rowCount() > 0){
          $tabella = "";

          while($row = $prodotti->fetch(PDO::FETCH_ASSOC)) {
              $tabella .= '
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
        }
        
        else
        	$tabella = "nessun prodotto trovato";
            
        return $tabella;
    }
?>