<?php
require_once('php/config.php');
register('id_s');
$id_luogo_spettacolo =select("SELECT luogo_id FROM spettacoli WHERE id=$id_s")[0]['luogo_id']; # è la varabile che indica l'id del luogo in cui sarà ospitato lo spettacolo
area_riservata(true,$id_luogo_spettacolo);
query("DELETE FROM spettacoli WHERE id=$id_s");
message("Spettacolo eliminato",1);
redirect($_SERVER['HTTP_REFERER']);
?>