<?php
require_once('php/config.php');
require_login();
register('spettacolo_b');
register('user_b');
register('posti_b');

$ripeti=true;
$codice='';

while($ripeti){
    // crea un codice che non deve essere già presente nel db, normalmente basta una iterazione
    $codice = uniqid();
    $codice_estratto =
    select("SELECT * FROM biglietti WHERE codice='$codice'");
    if($codice_estratto != NULL)
    $codice = uniqid('',true); 
    else $ripeti=false;
}

$sql="INSERT INTO biglietti (utente_id,spettacolo_id,codice,posti)
VALUES ($user_b,$spettacolo_b,'$codice','$posti_b')"; //il db autonomamente  decrementa i posti disponibili
query($sql);
$evento = get_evento_from_spettacolo($spettacolo_b);
message("Biglietto per ". $evento['nome'] ." prenotato con successo",1);
redirect($_SERVER['HTTP_REFERER']);
?>