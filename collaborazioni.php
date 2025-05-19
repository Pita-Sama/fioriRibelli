<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborazioni - Fiori Ribelli</title>
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
            font-size: 0.95em; /* Testo leggermente più piccolo */
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

        #tidio-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
        

        .contact-info {
            display: flex;
            gap: 20px;
            color: #2c3e50;
            font-size: 0.9em; /* Testo leggermente più piccolo */
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
            font-size: 0.9em; /* Testo leggermente più piccolo */
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
            font-size: 0.95em; /* Testo leggermente più piccolo */
        }

        .project-header {
            text-align: center;
            padding: 40px 0 20px;
            border-bottom: 1px solid #eee;
        }

        .project-header h1 {
            color: #27ae60;
            margin-bottom: 15px;
            font-size: 1.8em; /* Mantiene dimensioni titolo */
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
            font-size: 1.4em; /* Mantiene dimensioni sottotitoli */
        }

        .project-content p {
            margin-bottom: 20px;
        }

        .collaboration-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin: 40px 0;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .collaboration-text {
            flex: 1;
            min-width: 300px;
            border-bottom: 1px solid #eee;
        }

        .collaboration-image {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }

        .collaboration-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .collaboration-image img:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .project-container {
                margin-top: 60px;
            }
            
            .collaboration-section {
                flex-direction: column;
                border-bottom: 1px solid #eee;
            }
            
            .collaboration-text, .collaboration-image {
                min-width: 100%;
            }
            
            .collaboration-image {
                order: -1;
                margin-bottom: 20px;
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
            font-size: 0.9em; /* Testo leggermente più piccolo */
        }
    </style>
    
</head>
<body>
    <?php require_once 'menu.php'; ?>

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
                <h1>Le Nostre Collaborazioni</h1>
                <p>La rete di realtà con cui lavoriamo per un impatto positivo</p>
            </div>
            
            <div class="project-content">
                <p>Come in un bosco, dove sotto alla terra radici e microrganismi sono in contatto per mantenere viva e vitale tutta la flora e la fauna di superficie, così Fiori Ribelli ha iniziato a <strong>creare una rete tra varie realtà del territorio</strong> che offrono possibilità di lavoro, di relazione, di interazione col tessuto sociale, a varie persone, che per condizioni di nascita o di accadimenti della vita, indipendenti dalla loro volontà, faticano a realizzare.</p>
                
                <p>Oltre a queste realtà abbiamo ad accompagnarci in questa avventura, chi sa avere uno sguardo nei confronti della natura di ammirazione, rispetto, giocosità, chi sa ancora sporcarsi, correre e sudare, chi raccoglie fiori nel rispetto delle piante. Perché con la natura abbiamo tutti una relazione, noi vorremmo che fosse sempre d'amore.</p>
                
                <!-- Sezione C.T.O LABOR -->
                <div class="collaboration-section">
                    <div class="collaboration-text">
                        <h2>C.T.O LABOR</h2>
                        <p>Labor è un <strong>Centro di Terapia Occupazionale</strong>, anzi, due per la precisione, ubicati nel nostro Appennino, a Castelnuovo Monti e Cavola di Toano.</p>
                        <p>Sono rivolti a <strong>persone con disabilità lieve o moderate</strong> in grado di seguire un <strong>percorso formativo-educativo e occupazionale</strong>, frequentando i quali seguono un percorso formativo, educativo e occupazionale, individuati ed in carico all'Area disabili adulti del distretto di Castelnuovo né Monti.</p>
                        <p>Labor pone al centro di ogni azione la persona e la sua storia, avendo cura di promuoverne e valorizzarne le capacità, le abilità e le risorse personali. Il lavoro di <strong>bottega</strong> è un mezzo per raggiungere obiettivi personali preziosi, per favorire le relazioni tra le persone e tra loro e il contesto sociale.</p>
                        <p>Questo approccio crea le condizioni per vivere da protagonisti il proprio territorio e ricevere da esso riconoscimento come cittadini.</p>
                        <p>Gli oggetti prodotti sono il frutto di una <strong>progettazione condivisa con le persone</strong>, di uno <strong>studio</strong> e del <strong>design</strong>, del rispetto dei tempi e delle specifiche attitudini di ciascun attore in gioco.</p>
                        <p>Siamo arrivati a conoscere Labor perché siamo amanti del nostro appennino, poter proporre questo tipo di artigianato così bello, ma soprattutto così denso di significato ci è parso subito l'occasione per poterci sentire più vicini ai nostri monti e per poter far conoscere a più persone questa bella realtà.</p>
                    </div>
                    <div class="collaboration-image">
                        <a href="https://www.facebook.com/cto.labor/" target="_blank">
                            <img src="https://via.placeholder.com/500x300?text=C.T.O+LABOR" alt="C.T.O LABOR">
                        </a>
                    </div>
                </div>
                
                <!-- Sezione NATURA MAESTRA -->
                <div class="collaboration-section">
                    <div class="collaboration-image">
                        <a href="https://www.instagram.com/natura.maestra/" target="_blank">
                            <img src="https://via.placeholder.com/500x300?text=NATURA+MAESTRA" alt="NATURA MAESTRA">
                        </a>
                    </div>
                    <div class="collaboration-text">
                        <h2>NATURA MAESTRA</h2>
                        <p>Natura Maestra è un grande <strong>atelier</strong>, un luogo fisico e metaforico del fare: con le mani, con la testa e con il cuore, dove ogni tassello esalta la propria unicità nella continua ricerca di obiettivi sfidanti.</p>
                        <p>Non c'è immobilità, non c'è staticità, è un calderone in continuo rimescolamento, ecco perché non possiamo far altro che raccontare questa esperienza attraverso l'ascolto dei materiali e degli strumenti che sostengono un pensiero progettuale ricettivo.</p>
                        <p>Nei nostri atelier <strong>bambini</strong>, <strong>ragazzi</strong> ed <strong>adulti</strong> devono:</p>
                        <ul>
                            <li>provare</li>
                            <li>sbagliare</li>
                            <li>riflettere sui fenomeni e sulle possibili strategie che entrano in campo</li>
                            <li>essere consapevoli delle loro conoscenze ed utilizzarle per porsi domande altre</li>
                            <li>essere curiosi</li>
                            <li>essere ragionevoli davanti ai rischi, co-costruire un approccio consapevole del pericolo</li>
                            <li>vivere le esperienze nella loro totalità</li>
                        </ul>
                        <p>Come i petali di un fiore o i rami di un grande albero, gli atelier di Natura Maestra aprono infinite <strong>possibilità di scoperta e di ricerca</strong>, in un ascolto che parte sempre dal bambino.</p>
                        <p>La più grande risorsa che non può venir meno per far sì che ogni atelier sia una porta che si apre verso nuove conoscenze sono lo studio, la ricerca, la curiosità e la professionalità degli atelieristi e di tutti coloro che desiderano essere parte di questo progetto.</p>
                        <p>E per fare la differenza crediamo sia necessario assumersi la responsabilità ogni giorno di essere noi per primi esploratori insaziabili, ricercatori consapevoli, di saperci spogliare di preconcetti e convenzioni per mantenere alta la filosofia che alimenta il nostro lavoro quotidiano.</p>
                        <p>Natura Maestra si alimenta di tutte le stagioni, di tutte le forme di Natura che la circondano, siano esse di campagna o della periferia, di collina o di fiume senza limiti alcuni eccetto quelli che decidiamo di porci ogni giorno.</p>
                        <p>O di abbattere.</p>
                        <p>Quando abbiamo conosciuto Natura Maestra, ci siamo accorti che è rivoluzione, è il far giocare i bambini nella terra, letteralmente, è vederli tornare a casa sporchi, sudati, bagnati, ricchi di esperienza vera. Sono mani che lavorano, che ritrovano quel saper fare che la nostra vita troppo spesso accantona. È vestirsi e circondarsi di Natura, è il mo(nd)o che ci piacerebbe vedere sempre di più e per più persone. Un oggetto prodotto da natura maestra riattiva tutti i sensi e crea grande emozione, noi non potevamo farceli scappare!</p>
                    </div>
                </div>
                
                <!-- Sezione INDOMITI -->
                <div class="collaboration-section">
                    <div class="collaboration-text">
                        <h2>INDOMITI</h2>
                        <p>Indomiti è un progetto editoriale nato all'interno <strong>dell'Associazione Onlus Il Giardino del Baobab</strong> di Reggio Emilia, associazione che si occupa di diffondere la <strong>Comunicazione Facilitata Alfabetica – Tecnica Alternativa del Linguaggio®</strong> che consente a ragazzi con disabilità di uscire dal silenzio ed esprimersi attraverso la scrittura.</p>
                        <p>Al centro del progetto Indomiti sono gli autori, ragazzi disabili, che con la loro voce vogliono proporre un'alternativa, un linguaggio che scardina le normali connessioni logiche, che diffonde un pensiero differente che valorizza l'unicità: "ognuno ha la sua verità, è questione di angolazione".</p>
                        <p>Indomiti pone contenuti e idee al servizio della società, valorizzando le competenze degli autori, per dare volume a pensieri che osservano la realtà da un altro punto di vista, mai banale, mai prevedibile.</p>
                        <p>Indomiti è come una porta che ti permette di entrare in una realtà totalmente sconosciuta, una realtà fatta di poesia, di suggestioni quasi oniriche, di storie incredibili.</p>
                        <p>È riflettere sul concetto di abilità e scoprire che gli diamo comunemente un orizzonte davvero ristretto.</p>
                        <p>È conoscere storie di vite difficili, piene di ostacoli e nonostante questo, o forse proprio per questo, diventano stra-ordinarie.</p>
                        <p>Conoscere le persone che fanno parte di questo progetto è un'esperienza forte, di quelle di cui ti senti davvero grato, perché spostano ogni paradigma e ogni limite che ti eri illuso la vita potesse avere.</p>
                    </div>
                    <div class="collaboration-image">
                        <a href="https://indomiti.org/" target="_blank">
                            <img src="https://via.placeholder.com/500x300?text=INDOMITI" alt="INDOMITI">
                        </a>
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
        
        document.addEventListener('DOMContentLoaded', function() {
            // Controlla se Tidio è caricato
            if(typeof TidioChatApi !== 'undefined') {
                // Mostra messaggio automatico quando la chat si apre
                TidioChatApi.on('chatOpen', function() {
                    TidioChatApi.sendMessage("Benvenuto da Fiori Ribelli! 🌸 Come possiamo aiutarti oggi? Puoi chiederci informazioni su:\n- Disponibilità fiori\n- Orari di apertura\n- Consigli per la cura delle piante");
                });
                
                // Mostra messaggio dopo 30 secondi
                setTimeout(function() {
                    if(TidioChatApi.isChatClosed()) {
                        TidioChatApi.messageFromOperator("Ciao! Hai domande sui nostri fiori? Siamo qui per aiutarti! 🌺");
                    }
                }, 30000);
            }
        });
    </script>
    <script src="//code.tidio.co/irmsdqwk2kh1zlsefyaukkjxrjmseocn.js" async></script>
</body>
</html>
