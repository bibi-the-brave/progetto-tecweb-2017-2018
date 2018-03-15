<?php
require_once("php/config.php");
area_riservata();
register('nome_e');
register('descrizione_e');
register('ore_e');
register('minuti_e');
register('durata_e');
register('categoria_e');

$durata_formattata;
if($durata_e == "finita"){
    //l'evento ha una durata prestabilita(di qualche ora)
    $durata_formattata = $ore_e.":".$minuti_e;
} else {
    //l'evento dura tutto il giorno
    $durata_formattata = "00:00";
}

$sql="INSERT INTO eventi (nome,descrizione,durata,categoria_id) VALUES ('$nome_e','$descrizione_e','$durata_formattata:00',$categoria_e)";

query($sql);
message("Evento creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>