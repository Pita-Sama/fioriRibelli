function copyToClipboard(element) {
    const text = element.textContent;
    navigator.clipboard.writeText(text)
        .then(() => {
            const originalColor = element.style.color;
            element.style.color = "#a0a0a0";
            setTimeout(() => {
                element.style.color = originalColor;
            }, 500);
        });
}

function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("txtHint").innerHTML = this.responseText;
    }
    xhttp.open("GET", "" + str); // MANCA IL COLLEGAMENTO AL DB
    xhttp.send();
}
