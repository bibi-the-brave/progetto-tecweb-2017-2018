<?php

function printHead($title){
  echo("
  <title>".$title." - Biglietteria</title>
  <meta charset=\"UTF-8\">
  <meta name=\"description\" content=\"Servizio di prenotazione biglietti per eventi di vario genere\">
  <meta name=\"keywords\" content=\"eventi, spettacoli, cinema, teatro, cultura, fiere, musei, musica\">
  <meta name=\"author\" content=\"Gruppo di progetto Tecnologie Web\">
  <script type=\"text/javascript\" src=\"js/functions.js\"></script>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/screen.css\" >
  <link rel=\"stylesheet\" type=\"text/css\" media=\"(max-width: 768px)\" href=\"css/mobile.css\">
  <link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"css/print.css\">
  <link rel=\"icon\" href=\"img/pass.png\">
  ");
}

function printHeader(){
  echo("
  <div id='logoTitle'>
  <a href=\"home.php\"><img src=\"img/pass.svg\" alt=\"Logo della biglietteria online\" title=\"Logo\" ></a>
  <h1>Biglietteria</h1>
  </div>

  <h1 id='hamburgerMenu' title='Mostra barra di navigazione' onclick=\"menuResponsive()\"><a>&#9776;</a></h1>
  <div id='findAll'>
  <form  method=\"GET\" action=\"cerca.php\">
   <input title=\"Campo testuale per ricercare\" type=\"text\" name=\"filtro\" placeholder='Cerca'>
   <input title=\"Premi per ricercare\" type=\"submit\" value=\"Ricerca\"/>
  </form>
  </div>
  
  <a href=\"#corpo\" id=\"linkToCorpo\">Salta la navigazione</a>
  "); //il link che si chiama linkToCorpo permette ad utenti che utilizzano uno screen reader di saltare velocemente al contenuto della pagina senza dover scorrere ogni volta tutta la barra di navigazione
}

function printNavBar($current_page_name=""){
  echo"<ul><li lang=\"en\">";

  if($current_page_name != "home.php") 
    echo "<a aria-label=\"Vai alla home\" title=\"Vai alla Home\" href=\"home.php\">";
    echo "Home";
    if($current_page_name != "home.php") 
    echo "</a>";
    echo "</li><li>";

  if($current_page_name != "categorie.php")
  echo "<a  aria-label=\"Vai alle categorie\" title=\"Vai alle Categorie\" href=\"categorie.php\">";
  echo "Categorie";
  if($current_page_name != "categorie.php") 
    echo "</a>";
  echo "</li><li>";

  if($current_page_name != "eventi.php") 
  echo "<a  aria-label=\"Vai agli eventi\" title=\"Vai agli Eventi\" href=\"eventi.php\">";
  echo "Eventi";
  if($current_page_name != "eventi.php")
    echo "</a>";
    echo "</li><li>";

  if($current_page_name != "luoghi.php")
  echo "<a  aria-label=\"Vai ai luoghi\" title=\"Vai ai Luoghi\" href=\"luoghi.php\">";
  echo "Luoghi";
  if($current_page_name != "luoghi.php") 
    echo "</a>";
  echo "</li><li>";

  if($current_page_name != "info.php") 
  echo "<a  aria-label=\"Vai alle informazioni\" title=\"Vai alle Informazioni\" href=\"info.php\">";
    echo "<abbr title=\"Informazioni\">Info</abbr>";
  if($current_page_name != "info.php") 
    echo "</a>";
    echo "</li>";

  echo "</ul>";
  if(!is_logged()){
    //utente non loggato: mostriamo la pagina di login
    echo"<div id='navLog'>";
    echo"<ul>
            <li>";
    if($current_page_name != "login.php") 
      echo "<a title=\"Vai al Login\" href=\"login.php\">";
    echo "<span lang=\"en\">Login</span>";
    if($current_page_name != "login.php") 
      echo "</a>";
    echo "</li>
          <li>";
    if($current_page_name != "registrazione.php")
        echo "<a title=\"Vai alla Registrazione\" href=\"registrazione.php\">";
    echo "Registrazione";
    if($current_page_name != "registrazione.php")
        echo "</a>";
    echo "    </li>
            </ul>
          </div>";
  } else {
    //utente loggato: mostriamo pagina del profilo
    echo
    "<div id='navLog'>
    <ul>
    <li>";
    if($current_page_name != "utente_scheda.php")
      echo "<a title=\"Vai alla tua pagina personale\" href=\"utente_scheda.php?id_u=".$_SESSION['user_id']."\">"; 
    echo $_SESSION['user_username'];
    if($current_page_name != "utente_scheda.php")
      echo "</a>";
    echo "</li><li><a title=\"Effettua Logout\" href=logout_r.php ><span lang=\"en\">Logout</span></a> </li>
    </ul>
    </div>";
  }
}

function printFooter(){

  global $conn;
  if(isset($conn)){
    if(mysqli_ping($conn)){ // se la connessione al database è aperta la chiude prima di stampare il footer
     $conn->close();
    }
  }
  echo("
  
<div class='footerContent'>

  <img src=\"img/html2.png\" alt=\"HTML5 Powered with CSS3 / Styling\" title=\"HTML5 Powered with CSS3 / Styling\">

  <address>
  BigliettiOnline <br />
  +39 340 1234567 <br />
  Via Garibaldi n.2, Padova PD <br />
  <a href=\"mailto:biglietteria@biglietteria.it\">biglietteria@biglietteria.it</a>
  </address>
</div>

  ");
}

?>
