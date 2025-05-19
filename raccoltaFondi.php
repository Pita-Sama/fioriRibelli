<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Una casa per Fiori Ribelli - Fiori Ribelli</title>
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

        .container {
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

        .content {
            padding: 30px 0;
            line-height: 1.8;
            color: #333;
        }

        .content h2 {
            color: #2c3e50;
            margin: 30px 0 15px;
            border-left: 4px solid #27ae60;
            padding-left: 10px;
        }

        .content p {
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        .highlight {
            font-weight: bold;
            color: #4a8f29;
            text-decoration: none;
        }

        .signature {
            font-weight: bold;
            margin-top: 30px;
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

        @media (max-width: 768px) {
            .container {
                margin-top: 60px;
            }
        }
    </style>
</head>
<body>
    <?php require_once 'menu.php'; ?>
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
    <div class="container">
        <div class="project-header">
            <h1>Ci siamo!!!</h1>
        </div>
        
        <div class="content">
            <p>Eccovi svelata la sorpresa: da oggi parte la campagna crowdfunding per</p>
            
            <h2>"Una casa per Fiori Ribelli"</h2>
            
            <p>Come sapete abbiamo finalmente aperto il nostro vivaio in pieno centro, in via Cecati all'interno di un luogo magico, il Parco del Legno, che stiamo cercando di rimettere in sesto insieme al Comune.</p>
            
            <p>Tutti i lavori effettuati per la preparazione del nostro spazio, l'urbanizzazione, le serre ecc. sono stati ovviamente a nostro carico, così come la casetta in legno che abbiamo costruito e regaliamo alla città: sarà infatti una casa ad uso gratuito per tutte le scuole e le associazioni del terzo settore per ogni lezione o laboratorio vogliano fare nel parco o nel vivaio.</p>
            
            <p>Ospiterà anche eventi, corsi e tanto altro..<br>
            Insomma una casa per tutti!</p>
            
            <p>Per questo abbiamo deciso di aprire un crowdfunding perché la cittadinanza possa aiutarci a sostenere almeno questa spesa essendo qualcosa che lasceremo alla città.<br>
            Se vi va di aiutarci e contribuire anche solo con una piccola donazione o acquistando una delle ricompense che abbiamo ideato ve ne saremmo molto grati.</p>
            
            <p>Si può già donare da oggi, è aperto ufficialmente. <a href="https://www.ideaginger.it/progetti/una-casa-per-fiori-ribelli.html" class="highlight">Dona ora</a></p>
            
            <p class="signature">Grazie di cuore,<br>
            "Siate Ribelli, seminate gentilezza"</p>
            
            <p class="signature">Gianluca e Sara</p>
            
            <p>Grazie a tutti coloro che in vari modi hanno donato, ci avete dato una grande mano, ma soprattutto ci avete fatto sentire che il nostro progetto vi piace e ci date il coraggio di perseverare!</p>
            
            <p>Se volete continuare a sostenerci, vi aspettiamo per farvi conoscere le nostre bellissime piante!</p>
        </div>
        
    </div>
    <footer>
            Fiori Ribelli - Via Cecati, Parco del Legno
    </footer>
</body>
</html>
