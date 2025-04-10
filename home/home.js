function copyToClipboard(element) {
    const text = element.textContent;
    navigator.clipboard.writeText(text)
        .then(() => {
            const originalColor = element.style.color;
            element.style.color = "#a0a0a0";
            setTimeout(() => {
                element.style.color = originalColor;
            }, 500);
        })
        .catch(err => {
            console.error('Errore durante la copia: ', err);
        });
}

function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    
    // Esempio di suggerimenti (da sostituire con chiamata AJAX reale)
    const suggestions = {
        "ro": "Rose, Rosmarino",
        "ros": "Rose, Rosmarino",
        "rose": "Rose antiche, Rose moderne",
        "bou": "Bourbon, Bouganville"
    };
    
    const hint = suggestions[str.toLowerCase()] || "Nessun suggerimento disponibile";
    document.getElementById("txtHint").innerHTML = hint;
    
    /* 
    // Codice originale per chiamata AJAX (da implementare con endpoint reale)
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("txtHint").innerHTML = this.responseText;
    }
    xhttp.open("GET", "suggerimenti.php?q="+str);
    xhttp.send();
    */
}
