<?php
//faccio partire la sessione
session_start();

/*
VARIABILI IN SESSIONE CON UTENTE LOGGATO

user_id
user_username
user_tipo

 */

//VARIABILI CONFIGURAZIONE GLOBALI
define('redirect', true); //attiva/disattiva i redirect

//CREDENZIALI DATABASE
//$user_db = 'anfavero';
//$pass_db = 'gietoomoeJohdai8';
//$dbnm = 'anfavero';
$host = '127.0.0.1';
$user_db = 'root';
$pass_db = 'root';
$dbnm = 'biglietteria';

$conn = null;

// REGISTRAZIONE VARIABILI DA FORM
// registra una variabile nella pagina che richiama questa funzione, la variabile arriva da una form
// se non è registrata la imposta a vuota
function register($varname)
{
    global $$varname;
    if (isset($_REQUEST[$varname])) {
        $$varname = addslashes(stripslashes($_REQUEST[$varname])); // previene SQL injection
    } else {
        $$varname = null;
    }
}

// FUNZIONI PER INTERFACCIARSI AL DATABASE
// si connette al database
function connect()
{
    global $conn, $host, $user_db, $pass_db, $dbnm;
    $conn = new mysqli($host, $user_db, $pass_db, $dbnm);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
}

//fa una query al database e ritorna il risultato
function query($sql)
{
    global $conn;
    if ($conn == null) {
        connect();
    }
    $res = mysqli_query($conn, $sql);
    //Esegue la query sul db.
    if (!$res) {
        echo "Query fallita: ";
        echo mysqli_error($conn);
        die();
    }
    return $res;
}

//fa una query, solamente che il risultato viene ritornato in una tabella
function select($sql)
{
    $res = query($sql);
    $table = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $table[] = $row;
    }
    return $table;
}

// FUNZIONI DI UTILITÀ GENERALE NEL DATABASE

//ritorna il nome di  un utente con un certo id
function get_nome_utente($id)
{
    $utente = select("SELECT * FROM utenti WHERE id=$id");
    return $utente[0]['username'];
}

//ritorna il nome della categoria con un certo id
function get_nome_categoria($id)
{
    $cat = select("SELECT nome FROM categorie WHERE id=$id");
    return $cat[0]['nome'];
}

//ritorna il nome dell'evento con un certo id
function get_nome_evento($id)
{
    $evt = select("SELECT nome FROM eventi WHERE id=$id");
    return $evt[0]['nome'];
}

//ritorna il nome del luogo con un certo id
function get_nome_luogo($id)
{
    $luogo = select("SELECT nome FROM luoghi WHERE id=$id");
    return $luogo[0]['nome'];
}

//restituisce l'evento a cui è collegalo lo spettacolo con l'id passato
function get_evento_from_spettacolo($id_spettacolo)
{
    $ret = select("SELECT eventi.* FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id
    WHERE spettacoli.id=$id_spettacolo");
    $ritorno = $ret[0];
    return $ritorno;
}

//ritorna true se vi sono spettacoli istanziati di un certo evento, altrimenti false
function evento_has_spettacoli($eventoid)
{
    $spettacoli = select("SELECT * FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id WHERE eventi.id=$eventoid");
    if ($spettacoli == null) {
        return false;
    } else {
        return true;
    }

}

// true sse l'evento è presente nel database
function evento_exists($id_evento){
    if(!isset($id_evento))
        return false;
    $evento = select("SELECT * FROM eventi WHERE id=$id_evento");
    if (count($evento) == 0) {
        return false;
    } else {
        return true;
    }
}

// richiede che l'evento sia presente nel database, altrimenti reindirizza alla home    
function require_evento_exists($id_evento){
    if(!evento_exists($id_evento)){
        message("L'evento non è presente nel nostro sistema",2);
        redirect('home.php');
        die(); // previene che il resto della pagina sia caricata
    }
}

// true sse il luogo è presente nel database
function luogo_exists($id_luogo){
    if(!isset($id_luogo))
        return false;
    $luogo = select("SELECT * FROM luoghi WHERE id=$id_luogo");
    if (count($luogo) == 0) {
        return false;
    } else {
        return true;
    }
}

// richiede che il luogo sia presente nel database, altrimenti reindirizza alla home    
function require_luogo_exists($id_luogo){
    if(!luogo_exists($id_luogo)){
        message("Il luogo non è presente nel nostro sistema",2);
        redirect('home.php');
        die(); // previene che il resto della pagina sia caricata
    }
}

// true sse la categoria è presente nel database
function categoria_exists($id_categoria){
    if(!isset($id_categoria))
        return false;
    $categoria = select("SELECT * FROM categorie WHERE id=$id_categoria");
    if (count($categoria) == 0) {
        return false;
    } else {
        return true;
    }
}

// richiede che la categoria sia presente nel database, altrimenti reindirizza alla home    
function require_categoria_exists($id_categoria){
    if(!categoria_exists($id_categoria)){
        message("La categoria non è presente nel nostro sistema",2);
        redirect('home.php');
        die(); // previene che il resto della pagina sia caricata
    }
}



// true sse l'utente è presente nel database
function utente_exists($id_utente){
    if(!isset($id_utente))
        return false;
    $utente = select("SELECT * FROM utenti WHERE id=$id_utente");
    if (count($utente) == 0) {
        return false;
    } else {
        return true;
    }
}

// richiede che l'utente sia presente nel database, altrimenti reindirizza alla home    
function require_utente_exists($id_utente){
    if(!utente_exists($id_utente)){
        message("L'utente non è presente nel nostro sistema",2);
        redirect('home.php');
        die(); // previene che il resto della pagina sia caricata
    }
}

// true sse l'utente è presente nel database
function spettacolo_exists($id_spettacolo){
    if(!isset($id_spettacolo))
        return false;
    $spettacolo = select("SELECT * FROM spettacoli WHERE id=$id_spettacolo");
    if (count($spettacolo) == 0) {
        return false;
    } else {
        return true;
    }
}

// richiede che l'evento sia presente nel database, altrimenti reindirizza alla home    
function require_spettacolo_exists($id_spettacolo){
    if(!spettacolo_exists($id_spettacolo)){
        message("Lo spettacolo non è presente nel nostro sistema",2);
        redirect('home.php');
        die(); // previene che il resto della pagina sia caricata
    }
}


// ritorna l'ultimo id inserito nel db
function last_inserted_id()
{
    global $conn;
    if ($conn == null) {
        return null;
    }

    return $conn->insert_id;
}

// FUNZIONE DI REDIRECT
function redirect($url)
{
    if (redirect) {
        header('location: ' . $url);
    } else {
        echo "<a href='$url'> should go to $url </a>";
    }
}

// IMPOSTA MESSAGGIO
// imposta un messaggio con relativo codice (per nostra convenzione) che idealmente
// dovrà essere visualizzato dalla pagina a successiva ad un redirect:
// 1 - successo
// 2 - warning
// 3 - fail
function message($msg, $type)
{
    if ($msg != '') {
        $_SESSION['message'] = $msg;
        $_SESSION['msg_type'] = $type;
    }
}

// CONSUMA MESSAGGIO
// se è stato impostato in sessione una variabile message (dalla funzione precedente)
// ritorna una stringa che contiene il div di classe appropriata (così da poterla mostrare), con MESSAGGIO
// ed elimina dalla sessione (con unset) la variabile message
function consumeMessage()
{
    if (isset($_SESSION['message'])) {
        $tipo_messaggio = 'warning';
        if (isset($_SESSION['msg_type']) && $_SESSION['msg_type'] != '') {
            //valori da 1 a 3: 1 verde 2 giallo 3 rosso
            switch ($_SESSION['msg_type']) {
                case 1:$tipo_messaggio = 'message-success';
                    break;
                case 2:$tipo_messaggio = 'message-warning';
                    break;
                case 3:$tipo_messaggio = 'message-fail';
                    break;
                default:$tipo_messaggio = 'message-warning'; //se mal settato il tipo è warning
            }
        }
        // <input id="cookie-hide" class="cookie-hide" onclick="this.parentNode.parentNode.style.display = 'none'" value="I understand" type="button">

        $return = "<div id='topMessage' class='$tipo_messaggio'> " . $_SESSION['message'] . " </div>";
        unset($_SESSION['message']);
        unset($_SESSION['msg_type']);
        return $return;
    }
}

// CONTROLLARE CHE UN UTENTE SIA LOGGATO
function is_logged()
{

    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }

}

// CONTROLLA CHE L'UTENTE LOGGATO SIA PROPRIETARIO DELL'ID PASSATO COME ARGOMENTO: true sse l'utente loggato ha id uguale a quello passato
function proprietario($id_user)
{
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id_user) {
        return true;
    } else {
        return false;
    }

}

//RICHIEDE CHE UN UTENTE SIA LOGGATO, ALTRIMENTI RIMANDA ALLA HOME
function require_login($messaggio = '')
{
    if (!is_logged()) {
        //utente non loggato
        message('Ti devi autenticare per la sezione', 2);
        redirect('home.php');
        die(); // prevengo che il resto della pagina sia cariata
    }
}

//funzione che lascia proseguire solamente se l'utente passato è quello correntemente loggato
function require_proprietario($id_u)
{
    if (!proprietario($id_u)) {
        message('Sezione privata', 2);
        redirect('home.php');
        die(); // prevengo che il resto della pagina sia caricato
    }
}

// FUNZIONI CHE CONTROLLANO CHE L UTENTE SIA AMMINISTRATORE O OPERATORE. se non vengono passati parametri si assume che si intenda l'utente loggato, per avere informazioni su altri usare il parametro

//ritorna true se l'id passato appartiene ad un utente di tipologia admin, altirmenti false
//se non viene passato alcun valore il controllo viene effettuato sull'utente correntemente loggato
function is_admin($id_a = null)
{
    //l' inizializzazione serve perchè se non si passano parametri si da per scontato che l' utente richiesto sia quello loggato
    if ($id_a == null) {
        if (isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'A') {
            return true;
        } else {
            return false;
        }
    } else {
        $utente = select("SELECT * FROM utenti WHERE id=$id_a");
    }

    if ($utente[0]['tipo'] == 'A') {
        return true;
    } else {
        return false;
    }

}

//ritorna true se l'id passato appartiene ad un utente di tipologia gestore luogo, altirmenti false
//se non viene passato alcun valore il controllo viene effettuato sull'utente correntemente loggato
function is_gestore_luogo($id_a = null)
{
    //l' inizializzazione serve perchè se non si passano parametri si da per scontato che l' utente richiesto sia quello loggato
    if ($id_a == null) {
        if (isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'L') {
            return true;
        } else {
            return false;
        }
    } else {
        $utente = select("SELECT * FROM utenti WHERE id=$id_a");
    }

    if ($utente[0]['tipo'] == 'L') {
        return true;
    } else {
        return false;
    }

}

//ritorna true se l'id passato appartiene ad un utente di tipologia operatore, altirmenti false
//se non viene passato alcun valore il controllo viene effettuato sull'utente correntemente loggato
function is_operatore($id_o = null)
{
    if ($id_o == null) {
        if (isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'O') {
            return true;
        } else {
            return false;
        }
    } else {
        $utente = select("SELECT * FROM utenti WHERE id=$id_o");
    }

    if ($utente[0]['tipo'] == 'O') {
        return true;
    } else {
        return false;
    }

}

//ritorna true se l'utente correntemente loggato è collegato al luogo con l'id passato.
//con collegato si intende se l'utente è amminsitratore del tale luogo
function user_linked_to_luogo($idluogo)
{
    if (!is_logged()) {
        return false;
    }

    if ($_SESSION != null && $_SESSION['user_id'] != null) {
        $user_link = select("SELECT luogo_id FROM utenti WHERE id=" . $_SESSION['user_id']);
        if ($user_link[0]['luogo_id'] == $idluogo) {
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }

}

//se è un amministratore di luogo ritorna l 'id del luogo amministrato, altrimentin NULL
function id_luogo_amministrato($id_user)
{
    if (!is_gestore_luogo($id_user)) {
        return null;
    }

    //è un amministratore di luogo
    $id_l = select(
        "SELECT *
    FROM utenti
    WHERE id=" . $id_user
    )[0]['luogo_id'];
    return $id_l;
}

// STAMPA UNA FORM DI RICERCA CHE IN GET AGGIORNA LA PAGINA SU CUI VIENE RICHIAMATA
// stampa un form di filtro: esso se cliccato su submit aggionge alla pagina
// che l'ha richiamato un attributo (filter) con GET per permettere di filtrare
// ciè fatto usando una funzione javascript
function filter_form($filter, $placeholder = '')
{
    echo "<form  id=\"filterform\" method=\"GET\"";

    echo " action=".$_SERVER['PHP_SELF'].">";
    if (isset($_GET)) {
        // non cancello i precedenti parametri nella location
        foreach ($_GET as $param => $value) {
            if ($param != 'filter' && $param != 'tutti') {
                //stampo per ognugno di essi un input hidden
                echo "<input type=\"hidden\" name=\"$param\" value=\"$value\" />";
            }
        }
    }

    echo "
  <label for=\"cercaText\" id=\"cercaTextLabel\" >Filtra risultati</label>
  <input id=\"cercaText\" type=\"text\" name=\"filter\" value=\"$filter\" placeholder='$placeholder'>
  <input id=\"cercaButton\" type=\"submit\" value=\"Cerca\" class=\"postfix button\">
  <input  id=\"tuttiButton\" type=\"submit\" name=\"tutti\" value=\"Tutti\" class=\"prefix button secondary\">
  </form>";
}

// FUNZIONI PER FORMATTARE DATI PARTICOLARI

// data una durata grezza dal database la formatta a dovere, nel caso sia nulla
// restituisce 'Giornata lavorativa', che è così per convenzione
function format_durata($durata)
{
    if ($durata == null || $durata == "00:00:00") {
        return "Giornata lavorativa";
    } else {
        $ret = substr($durata, 0, 5);
        $ret = str_replace(':', 'h ', $ret);
        if (substr($ret, 0, 1) == '0') {
            $ret = substr($ret, 1, 5);
        }

        $ret = $ret . "min";
        return $ret;
    }
}

//formatta un datetime in modo che sia leggibile in italia
function format_data_ora($data)
{
    $ret = new DateTime($data);
    return $ret->format('j/m/Y, H:i');
}

//in input accetta una stringa così come viene restitutita dal databse
//in output restituisce le ore
function get_ore($time_from_db)
{
    if ($time_from_db == null) {
        return null;
    } else {
        return (int) substr($time_from_db, 0, 2);
    }
}

//ritorna true sse la durata dell'evento e' dell'intera giornata lavorativa
function is_giornata_lavorativa($time_from_db)
{
    return get_ore($time_from_db) == 0 && get_minuti($time_from_db) == 0;
}

//in input accetta una stringa così come viene restitutita dal databse
//in output restituisce i minuti
function get_minuti($time_from_db)
{
    if ($time_from_db == null) {
        return null;
    } else {
        return (int) substr($time_from_db, 3, 2);
    }
}

//ritorna true se la data passatagli risulta essere del passato.
function is_data_passata($data)
{
    //creo un oggetto con la data di oggi
    $stringa_oggi = date('Y-m-d');

    //trasformo in oggetto la stringa passata
    $data_oggetto = new DateTime($data);

    $data_formattata = $data_oggetto->format('Y-m-d');

    if ($data_formattata < $stringa_oggi) {
        return true;
    }
    #data non disponibile
    else {
        return false;
    }
    #data disponibile
}

//formatta il costo di un biglietto
function format_costo($costo)
{
    $ret = str_replace(',', '.', $costo);
    //controllo che sia stato inserito il valore decimale
    if (strpos($ret, '.') == false) {
        $ret = $ret . '.00';
    }

    //controllo che non abbia un solo decimale
    if (substr($ret, strlen($ret) - 2, 1) == '.') {
        //ha un solo decimale
        $ret = $ret . '0';
    }
    return $ret;
}

// FUNZIONE PER STAMPARE UN MESSAGGIO DI TABELLA VUOTA QUANDO LA TABELLA È VUOTA
function no_result($array, $colonne)
{
    if ($array == null) {
        echo "<tr><td colspan=$colonne >Nessun risultato</td>";
    }
}

// funzione per stampare il contenuto di un th di una colonna per cui è possibile riordinare la tabella secondo il campo contenuto nel th:
// per evitare link circolari è necessario rendere non cliccabile tale link: controllando se la tabella è già ordinata secondo il capo che stampiamo
// andiamo a decidere se stampare il link o meno
// $thtext: il contenuto della cella
// $ord: ordine che segue la tabella attualmente
// $char: carattere che identifica l'ordine che impone il th che stiamo stampando(e.g. data='d')
// $a_title: il testo da stampare nel titolo del link che segue la stringa 'Ordina per '
function print_ordinable_th($thtext, $ord, $char, $a_title)
{

    if (!is_ordered_by_char($ord, $char)) {
        $newRequest = $_SERVER['PHP_SELF'] . '?';
        if (isset($_GET)) {
            // non cancello i precedenti parametri nella location
            foreach ($_GET as $param => $value) {
                if ($param != 'ord') {
                    $newRequest .= "$param=$value&";
                }
            }
        }
        $newRequest .= "ord=" . $char;
        echo "<a href=\"$newRequest\"  title=\"Ordina per $a_title\">";
    }

    echo "$thtext";
    if (!is_ordered_by_char($ord, $char)) {
        echo "</a>";
    } else {
        echo "&#11206;";
    }

}

function is_ordered_by_char($ord, $char)
{
    if (isset($ord)) {

        if ($ord == $char) {
            return true;
        }
    }
    return false;
}

//la variabile deve essere impostata a a valore true se si vuole che l'admin di un luogo possa accadere a un' area riservata.
//in tal caso deve essere impostata anche la variabile che indica l' id del luogo a cui si deve accedere
function area_riservata($allow_admin_luogo = false, $id_luogo = null)
{
    require_login();
    if ($allow_admin_luogo) {
        if (!user_linked_to_luogo($id_luogo)
            && !is_admin() && !is_operatore()) {
            message('Area riservata', 2);
            redirect('home.php');
            die(); // prevengo che il resto della pagina sia caricato
        }
    } else if (!is_admin() && !is_operatore()) {
        message('Area riservata', 2);
        redirect('home.php');
        die(); // prevengo che il resto della pagina sia caricato
    }
}

// STAMPA IL FORM PER LA PRENOTAZIONE DI UN BIGLIETTO, DENTRO UN TD, PER UTENTI NON LOGGATI RIMANDA ALLA PAGINA DI LOGIN
function print_form_prenotazione($id_spettacolo, $id_user, $posti_disponibili, $nome_spettacolo, $data_ora, $luogo)
{
    $nome_spettacolo = addslashes($nome_spettacolo);

    
    if ($posti_disponibili > 0) {
        echo "<td>
        <form ";

        if (is_logged()) {
            echo "method=\"POST\" action=\"prenota.php\" onsubmit=\"return confirm('Confermi di voler eseguire una prenotazione per $nome_spettacolo?');\"";
        } else {
            echo "action=\"login.php\"";
        }

        echo " class=\"singleFieldForm\"  >
        <label class=\"invisibleLabel\" for=\"$id_spettacolo\">Scegli numero biglietti per $nome_spettacolo in data $data_ora presso $luogo </label>
        <select id=\"$id_spettacolo\"  title=\"Numero di posti\" ";
        if (is_logged()) //solo se loggato invia i dati
        {
            echo " name=\"posti_b\"";
        }

        //le opzioni per i posti disponibili, limitandole a 4
        echo ">";
        if ($posti_disponibili >= 4) {
            for ($x = 1; $x <= 4; $x++) {
                echo "<option value=\"$x\">$x</option>";
            }

        } else {
            for ($x = 1; $x <= $posti_disponibili; $x++) {
                echo "<option value=\"$x\">$x</option>";
            }

        }
        echo "</select>
        <input type=\"hidden\"";
        if (is_logged()) {
            echo " name=\"spettacolo_b\"";
        }

        echo " value=\"" . $id_spettacolo . "\">";
        if (is_logged()) {
            echo "<input type=\"hidden\" name=\"user_b\" value=\"" . $id_user . "\">";
        }
        echo "<input type=\"submit\" title=\"Prenota biglietto per ".$nome_spettacolo." presso ".$luogo." in data ".$data_ora."\"  value=\"Prenota\" class=\"singleButton\" > 
    </form>
    </td>";
    } else {
        echo "<td>Non ci sono posti disponibili</td>";
    }

}

//STAMPA IL FORM PER L'ANNULLAMENTO DELLA PRENOTAZIONE DI UN BIGLIETTO
function print_form_anullamento($id_biglietto, $nome_spettacolo)
{
    $nome_spettacolo = addslashes($nome_spettacolo);
    echo "<td>

  <form method=\"POST\" action=\"annulla_prenotazione.php\" onsubmit=\"return confirm('Confermi di voler annullare la prenotazione per $nome_spettacolo?');\" >
    <input type=\"hidden\"  name=\"id_b\" value=\"" . $id_biglietto . "\">
    <label class=\"invisibleLabel\" for=\"" . $id_biglietto . "\">Annulla prenotazione per biglietto ".$id_biglietto."</label>
    <input id=\"".$id_biglietto."\" type=\"submit\"  title=\"Annulla prenotazione per ".$nome_spettacolo."\" value=\"Annulla prenotazione\">
  </form>
  </td>";
}

//utile per generare degli 'hash' usati per impedire al browswer di visualizzare
//le immagini dalla cache, evitando così delle discrepanze tra l'immagine visualizzata
//e quella veramente salvata sul server.
function time_stamp()
{
    return time() - strtotime("today");
}

// controlla che la variabile passata sia settata (in quanto servirà per qualche calcolo), in caso contrario reindirizza alla home
function check($var){
    if(!isset($var) || ($var==null)){
        redirect('home.php');
        die(); //prevengo il caricamento del resto della pagina
    }
}