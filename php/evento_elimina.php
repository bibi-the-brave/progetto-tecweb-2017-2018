<?php
require_once('php/config.php');
area_riservata();
register('id');
$nome = get_nome_evento($id);
query("DELETE FROM eventi WHERE id=$id");
message("Evento ".$nome." eliminato",1);
redirect('eventi.php');
?>