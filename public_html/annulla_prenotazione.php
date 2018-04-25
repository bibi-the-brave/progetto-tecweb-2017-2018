<?php
require_once('php/config.php');
require_login();
register('id_b');

$biglietto = select("
    SELECT * 
    FROM biglietti 
    WHERE id=$id_b
")[0];

if($biglietto['utente_id'] != $_SESSION['user_id']){
    message('Area riservata',2);
    redirect($_SERVER['HTTP_REFERER']);
    die();
}

$sql="DELETE FROM biglietti WHERE id=$id_b "; //il db autonomamente aumenta i posti disponibili
query($sql);
$evento = get_evento_from_spettacolo($biglietto['spettacolo_id']);
message("Annullata prenotazione per ". $evento['nome'] ,1);
redirect($_SERVER['HTTP_REFERER']);
?>
