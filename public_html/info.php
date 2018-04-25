<!DOCTYPE html>
<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Informazioni'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar("info.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>
	<div id="corpo" onclick="menuOff()">
        <div class="title"><h2>Informazioni</h2></div>
            <div class="content">


				<h3>Chi siamo</h3>
					<p>Benvenuto nella Biglietteria <span lang="en">Online</span>. Qui potrai prenotare il tuo posto in un ampia fascia di <a title="Vai alle Categorie" href="categorie.php">categorie</a> di eventi, come biglietti per musei, fiere o cinema. </p>


				<h3>Cosa facciamo</h3>
					<p>La nostra missione è mettere in comunicazione gli organizzatori di eventi con le persone interessate. Vogliamo facilitare il processo di prenotazione di biglietti per migliorare il settore dell'intrattenimento e permettere a tutti di partecipare ad eventi sia di carattere culturale che di svago. Se sei interessato a prenotare un biglietto per un evento ti basterà ricercarlo nel nostro sito, prenotare un posto, stampare il codice che ti daremo e portarlo all'evento. Dopo aver pagato la tua quota potrai entrare e goderti lo spettacolo!</p>
	

					<h3>Come registrarti</h3>
					<p>
					Il primo passo per entrare a far parte del nostro sistema di prenotazione dei biglietti è creare un <span lang="en">account</span>. Per fare ciò ti basta cliccare sul <span lang="en">link</span> "<span lang="en">Login</span>/Registrazione" che puoi trovare in alto a destra, proprio sotto la barra di ricerca. Il <span lang="en">link</span> ti porterà ad una finestra in cui ti verranno chieste le credenziali di accesso. Tu clicca sul <span lang="en">link</span> "Registrati" in basso per arrivare alla schermata apposita, oppure clicca direttamente <a title="Vai alla registrazione" href="registrazione.php">qui</a>. In questa pagina ti verrà richiesto di inserire alcuni dati: <span lang="en">username</span>, <span lang="en">password</span>, nome, cognome e <span lang="en">email</span>. Inviando questo modulo il sistema controllerà che il nome utente scelto non sia già occupato, in caso tutto vada bene potrai da subito iniziare a prenotare biglietti per i tuoi eventi preferiti.</p>

					<img class="infoImg" src="img/info0.png" alt="Immagine che illustra come registrarsi e autentificarsi sul sito.">


				<h3>Sei registrato e non sai come entrare?</h3>
					<p>
					Se hai già completato la procedura di registrazione e vuoi entrare nel nostro sistema non devi fare altro che cliccare sul <span lang="en">link</span> "<span lang="en">Login</span>/Registrazione". Puoi anche cliccare <a title="Vai al login" href="login.php">qui</a> per arrivare direttamente alla pagina di <span lang="en">login</span>. Dopodichè dovrai inserire i tuoi dati ed entrerai nel sistema.</p>
					
					<img class="infoImg" src="img/info0.png" alt="Immagine che illustra come registrarsi e autentificarsi sul sito.">



				<h3>Come cercare uno spettacolo</h3>
					<p>
					Attraverso la barra di ricerca posta in alto a destra puoi ricercare tutti gli Spettacoli di una certa categoria digitando il nome della categoria (ad esempio: "Cinema"), oppure gli Spettacoli che si svolgeranno in un certo luogo digitando il nome del luogo (ad esempio: "Porto Astra"). Puoi anche ricercare uno spettacolo direttamente con il suo nome! Dopo aver effettuato la ricerca ti si presenteranno davanti i risultati, inseriti in delle tabelle.	Nella tabella puoi cliccare sui vari campi per ottenere ulteriori informazioni riguardo il determinato campo. Se ad esempio hai ricercato "Van Gogh" e vuoi ottenere ulteriori informazioni sulla <span lang="en">location</span> clicca sulla voce nella colonna "Luogo". Se invece ti interessano altri eventi in musei ti bastera cliccare sulla voce "Musei" nella colonna "Categoria". Se vuoi procedere ad effettuare una prenotazione per uno spettacolo, e questo spettacolo ha posti disponibili, clicca sul nome dell'evento. Se infine sei interessato a vedere tutti gli <a title="Vai agli Eventi" href="eventi.php">Eventi</a>, i <a title="Vai ai Luoghi" href="luoghi.php">Luoghi</a> e le <a title="Vai alle Categorie" href="categorie.php">Categorie</a> puoi cliccare sul <span lang="en">link</span> rispettivo proprio sotto il nostro logo nella barra dei menu.
					</p>
					<img class="infoImg" src="img/info1.png" alt="Immagine che illustra all'utente la pagina contenente i risultati.">


				<h3>Come prenotare un biglietto</h3>
					<p>
					Dopo aver effettuato una ricerca clicca sul nome dell'evento a cui vuoi partecipare per procedere alla prenotazione di un biglietto. Dopo aver cliccato ti si presenterà davanti una tabella contenente tutte le date disponibili. Clicca nel piccolo pulsante con scritto "Prenota" per assicurarti un posto. A questo punto, se non ti sei ancora loggato sul sito verrai reindirizzato alla pagina di <span lang="en">login</span>, mentre se ti sei già autenticato ti basterà segnare il codice che ti forniremo e presentarlo all'ingresso dello spettacolo. L'operatore alla cassa verificherà che tu abbia prenotato correttamente e ti chiederà di pagare l'importo dovuto. Dopo aver pagato non dovrai fare altro che goderti lo spettacolo!</p>
					<img class="infoImg" src="img/info2.png" alt="Immagine che illustra all'utente come si effettua la prenotazione.">


				<h3>Come vedere ed annullare le tue prenotazioni di biglietti</h3>
					<p>
					Clicca sul tuo <span lang="en">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere le tue prenotazioni. Se ne vuoi cancellare qualcuna ti basterà cliccare il pulsante "Annulla prenotazione" nella tabella.</p>
					<img class="infoImg" src="img/info3.png" alt="Immagine che illustra all'utente come annullare le proprie prenotazioni.">

				

				<h3>Come vedere e modificare i tuoi dati</h3>
					<p>
					Clicca sul tuo <span lang="en">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere i tuoi dati personali. Se vuoi cambiare alcuni dati ti basterà cliccare sul <span lang="en">link</span> "Modifica profilo", da qui potrai cambiare i tuoi dati inserendoli in un piccolo <span lang="en">form</span> e poi confermando le modifiche.</p>
					<img class="infoImg" src="img/info6.png" alt="Immagine che illustra all'utente come gestire le sue informazioni.">

				<h3>Vuoi utilizzare la nostra piattaforma per gestire le prenotazioni di spettacoli nel tuo luogo?</h3>
				<p>
					Se amministri un luogo e vuoi utilizzare la piattaforma devi soddisfare due requisiti:</p>
					<ul>
						<li>avere una connessione internet funzionante;</li>
						<li>avere Javascript abilitato sul tuo browser.</li>
					</ul>
				<p>Inoltre vi sono delle restrizioni sui browser che puoi utilizzare. Queste restrizioni riguardano solo gli utenti che vogliono amministrare. I seguenti browser non sono supportati:</p>
				<ul>
					<li><span lang="en">Internet Explorer</span>;</li>
					<li>Safari;</li>
					<li><span lang="en">Mozilla Firefox</span> fino alla versione 56;</li>
					<li><span lang="en">Google Chrome</span> fino alla versione 19.</li>
				</ul>

				<h3>Come registrarti come Amministratore di luogo</h3>
				<p>
					Se desideri utilizzare la nostra piattaforma per gestire le prenotazioni nel tuo luogo dovrai scrivere a <a href="mailto:biglietteria@biglietteria.it">biglietteria@biglietteria.it</a>oppure telefonare al numero +39 340 1234567 e dare al nostro operatore i tuoi dati personali e quello del luogo che intendi amministrare.
				</p>

				<h3>Come gestire gli spettacoli in quanto Amministratore di luogo</h3>
				<p>
					Dopo esserti registrato attraverso il nostro operatore ed esserti loggato clicca sul nome del tuo account in alto a destra. Verrai indirizzato alla tua pagina personale. Da qui, cliccando su "Amministra Luogo" sotto i tuoi dati personali, potrai gestire gli spettacoli che hai organizzato e le prenotazioni effettuate dai clienti. In questa pagina potrai vedere, nella tabella "Spettacoli", gli spettacoli presso il tuo luogo che sono presenti sulla nostra piattaforma. Se clicchi su "modifica" nella tabella in corrispondenza di un evento potrai cambiarne la data, l'orario di inizio, i posti disponibili e il costo. Per aggiungere un nuovo spettacolo ti basterà cliccare su "Crea nuovo spettacolo": ti basterà compilare un breve form per poter aggiungere un nuovo spettacolo.
				</p>
				<img class="infoImg" src="img/info4.png" alt="Immagine che illustra all'Admin di luogo come si gestisce la suastruttura">

				<h3>Come gestire le prenotazioni in quanto Amministratore di luogo</h3>
				<p>
					Dopo esserti registrato attraverso il nostro operatore ed esserti loggato clicca sul nome del tuo account in alto a destra. Verrai indirizzato alla tua pagina personale. Da qui, cliccando su "Amministra Luogo" sotto i tuoi dati personali, potrai gestire gli spettacoli che hai organizzato e le prenotazioni effettuate dai clienti. In questa pagina potrai vedere, nella tabella "Biglietti degli utenti", tutte le prenotazioni che sono state effettuate per i tuoi spettacoli. In particolare, il campo "Codice" della tabella contiene il codice che il cliente deve possedere per poter garantire di essere colui che ha effettuato la prenotazione. Dopo che il cliente avrà pagato dovrai, nel menù a tendina "Utilizzato" dell'ultima colonna, spuntare "Si".
				</p>
				<img class="infoImg" src="img/info5.png" alt="Immagine che mostra all'Admin come si gestisce la sua struttura">



				
				<a href="#" class="rightLink">Torna su &#9650;</a>

            </div>
	</div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
