<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Nostro Progetto - Fiori Ribelli</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        header {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 100;
        }


        .menu-toggle {
            position: fixed;
            top: 6px;
            left: 20px;
            z-index: 1000;
            cursor: pointer;
            background: white;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .menu-toggle.active .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 999;
            overflow-y: auto;
            padding: 20px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .sidebar-categories {
            list-style: none;
            margin-top: 10px; /* Aggiunto per spostare il menu più in basso */
        }

        .sidebar-category {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .sidebar-category:hover {
            color: #27ae60;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

      .contact-info {
            display: flex;
            gap: 20px;
            color: #2c3e50;
            font-size: 14px;
            margin-left: 50px;
        }

        .contact-info span {
            cursor: pointer;
            transition: color 0.2s;
        }

        .contact-info span:hover {
            color: #a0a0a0;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            border: none;
        }

        .login-btn {
            background-color: #27ae60;
            color: white;
        }

        .login-btn:hover {
            background-color: #2ecc71;
        }

        .signup-btn {
            background-color: #3498db;
            color: white;
        }

        .signup-btn:hover {
            background-color: #2980b9;
        }

        .project-container {
            max-width: 1000px;
            margin: 80px auto 40px;
            padding: 0 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .project-header {
            text-align: center;
            padding: 40px 0 20px;
            border-bottom: 1px solid #eee;
        }

        .project-header h1 {
            color: #27ae60;
            margin-bottom: 15px;
        }

        .project-content {
            padding: 30px 0;
            line-height: 1.8;
            color: #333;
        }

        .project-content h2 {
            color: #2c3e50;
            margin: 30px 0 15px;
            border-left: 4px solid #27ae60;
            padding-left: 10px;
        }

        .project-content p {
            margin-bottom: 20px;
        }

        .team-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin: 40px 0;
        }

        .team-member {
            flex: 1;
            min-width: 250px;
            background: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .project-container {
                margin-top: 60px;
            }
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
            position: relative;
            z-index: 100;
        }
    </style>
</head>
<body>

    <div class="menu-toggle" onclick="toggleSidebar()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        </div>
        <ul class="sidebar-categories">
            <li class="sidebar-category" onclick="window.location.href='progetto.php'">Il Progetto</li>
            <li class="sidebar-category" onclick="window.location.href='collaborazioni.php'">Collaborazioni</li>
            <li class="sidebar-category" onclick="window.location.href='offertaFondi.php'">Offerta fondi</li>
            <li class="sidebar-category" onclick="window.location.href='offertePremi.php'">Offerte e premi</li>
        </ul>
    </div>

    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <header>
        <div class="contact-info">
            <span onclick="copyToClipboard(this)">info@fioriribelli.it</span>
            <span>contattaci</span>
            <span onclick="copyToClipboard(this)">333 2261466</span>
        </div>
        <div class="auth-buttons">
            <button class="btn login-btn">Log In</button>
            <button class="btn signup-btn">Registrati</button>
        </div>
    </header>

    <main>
        <div class="project-container">
            <div class="project-header">
                <h1>Il Nostro Progetto</h1>
                <p>La storia di Fiori Ribelli e la nostra missione</p>
            </div>
            
            <div class="project-content">
                <h2>Le Origini</h2>
                <p>Nel momento in cui il mondo era fermo, il tempo sospeso, è nata l'idea di dare vita ad un luogo di fiori, profumi, colori, un luogo nella natura, in cui le persone di ogni età potessero venire a rilassarsi, a rigenerarsi. Una seconda vita per noi, che abbiamo scelto di lasciare due lavori a tempo indeterminato che avevamo portato avanti per tanti anni, ma che iniziavano a starci un po' stretti, per provare a vivere nuovi sogni.</p>
                
                <p>Un vivaio in cui coltivare in modo naturale e rispettoso per l'ambiente, le regine indiscusse dei giardini, le Rose, e fiori insoliti, particolari, con fioriture lunghe, profumate, che attirano farfalle, api, coccinelle, e proporle alle persone per trasformare i propri giardini e terrazzi in oasi fiorite.</p>
                
                <p>Un luogo dove si potesse vivere anche esperienze, partecipare a laboratori creativi e incontrare nuove persone, e tutto questo tra la natura.</p>
                
                <h2>Il Negozio</h2>
                <p>Per creare tutto ciò che avevamo immaginato, ci voleva tempo, il tempo che tutti gli incastri andassero al loro posto.</p>
                
                <p>Abbiamo quindi deciso di iniziare da un piccolo negozio nel centro storico della nostra città, dove poter cominciare a fare conoscere Fiori Ribelli, creare rete con realtà amiche, proporre le nostre piante, raccontare il nostro progetto, far conoscere artigianato solidale, prodotti per la casa zero waste.</p>
                
                <p>A settembre 2021 pur con tutte le difficoltà che le regole anti Covid portavano, Fiori Ribelli ha aperto ed è stato in via Farini fino al 31 dicembre 2022 e dal gennaio a fine maggio 2023 in via dei Due Gobbi.</p>
                
                <h2>Il Parco</h2>
                <p>A marzo 2023 dopo varie vicissitudini e un tempo più lungo di quello che ci aspettavamo, iniziano finalmente i lavori del nostro vivaio!</p>
                
                <p>C'era un posto nella nostra città, un parco di proprietà del comune, che era chiuso da tantissimi anni, a due passi dal centro storico, con alberi decennali, mura in pietra e altri in cemento, frutto di architettura urbana costruita nel passato, un luogo magico, un oasi verde e naturale a due passi dal centro storico.</p>
                
                <p>In passato aveva ospitato il vivaio comunale, creato e portato avanti per due decenni, da Paride Allegri, un uomo visionario, che difendeva l'ambiente già decenni fa, quando nessuno aveva ancora intuito il pericolo dell'azione così spregiudicata dell'uomo sulla natura.</p>
                
                <p>Negli anni duemila questo spazio ha ospitato Legnolandia, un parco aperto a tutti dove poter giocare fare iniziative, feste, letture, spettacoli, nella natura.</p>
                
                <p>Poi, per quasi un decennio, il parco è rimasto chiuso e inaccessibile.</p>
                
                <p>A maggio 2022 il Comune di Reggio Emilia ha emesso un bando per l'assegnazione di una porzione del parco per l'apertura di una attività florovivaistica, che avesse però anche nella sua mission una attenzione particolare al rispetto dell'ambiente e che organizzasse attività di interesse per tutta la città.</p>
                
                <p>Abbiamo partecipato al bando, lo abbiamo vinto e abbiamo iniziato a organizzare tutti gli step necessari per allestire il nostro vivaio. A marzo 2023 sono iniziati i lavori e ad aprile 2023 abbiamo aperto, i cancelli, anche se imperfetti, ma l'importante era esserci!</p>
                
                <p>L'ubicazione del parco, un oasi di verde a due passi dal centro storico, per noi era il posto perfetto per il nostro desiderio di incentivare le persone che abitano in zone urbane a mettere fiori anche se si possiede un posto piccolo, una aiuola, un terrazzo, per poter offrire bellezza, colore, profumo a tutti e cibo, riparo, un corridoio per la vita a tutti gli insetti impollinatori, fondamentali per la sopravvivenza di tutti.</p>
                
                <h2>Vivaio Urbano</h2>
                <p>Nel nostro vivaio abbiamo deciso di coltivare in modo naturale, all'aperto o in serre fredde e non illuminate artificialmente, rispettando il tempo della natura, senza forzare nessuna pianta a fiorire prima del suo tempo.</p>
                
                <p>Non utilizziamo sostanze che possano essere dannose per la natura circostante, che possano impedire la vita degli insetti impollinatori, siamo anche orgogliosi ospitanti di un arnia che ci è stata regalata dall'azienda agricola Giovanardi che coltiva grani antichi nella nostra provincia.</p>
                
                <h2>Cosa coltiviamo?</h2>
                <p>Le regine del giardino per eccellenza, le Rose, il fiore per antonomasia, che accompagna la storia dell'umanità da sempre.</p>
                
                <p>Abbiamo un assortimento di rose antiche, botaniche, da collezione, inglesi e moderne rifiorenti belle, profumate, adatte sia al giardino che alla coltivazione in vaso.</p>
                
                <p>Le nostre rose sono da innesto, coltivate, curate e innestate in campo, all'aperto, in provincia di Padova dalle sapienti mani di Cristina proprietaria del vivaio Fior di Rosa, con esperienza decennale con queste meravigliose piante. Scegliere rose da innesto e coltivate in questo modo, è garanzia di piante sane, forti, robuste.</p>
                
                <p>Oltre alle rose abbiamo scelto di coltivare le più magiche tra le fioriture, quelle regalate dalle piante erbacee perenni. Le erbacee sono piante che a differenza degli arbusti, non hanno in genere uno fusto legnoso, ma steli che si caricano di fiori che fioriscono per mesi interi, dando anche cibo e riparo a tutti gli insetti impollinatori.</p>
                
                <p>Scegliere le erbacee perenni nei propri giardini e terrazzi vuol dire vederli riempirsi di colori, profumi, farfalle, api, coccinelle, creare corridoi per la vita.</p>
                
                <p>Una volta piantumate, di anno in anno le vedremo rispuntare, seguire il ciclo della vita e delle stagioni, vedremo i germogli fare capolino dalla terra alla fine dell'inverno, gli steli allungarsi di giorno in giorno, le foglie di tutte le sfumature riempire gli steli e poi l'esplosione dei fiori, dalla primavera all'inverno.</p>
                
                <p>In autunno molte di loro seccano, vestendo il nostro spazio di una nuova gamma di colori, oro, rosso, arancione, giallo, col vento dell'inverno che li fa frusciare e il gelo che li copre di trine.</p>
                
                <div class="team-section">
                    <div class="team-member">
                        <h3>Sara</h3>
                        <p>Ex maestra d'asilo ed educatrice di bambini speciali, che è felice quando sta con le mani nella terra, quando fa cose con le mani, incontra persone e crea reti, ha un innato amore per la natura e la vita oltre ad avere sempre mille idee.</p>
                    </div>
                    
                    <div class="team-member">
                        <h3>Gianluca</h3>
                        <p>Ex impiegato commerciale informatico, allenatore di pallavolo con tanta passione, marito di Sara, che sa gestire, programmare e trovare soluzioni, ama relazionarsi con le persone oltre a concretizzare le idee di Sara.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Fiori Ribelli - Tutti i diritti riservati</p>
    </footer>
  
    <script>
        // Funzione per aprire/chiudere il menu laterale
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('active');
            menuToggle.classList.toggle('active');
            overlay.classList.toggle('active');
        }
       // Funzione per copiare testo
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
    </script>
</body>
</html>
