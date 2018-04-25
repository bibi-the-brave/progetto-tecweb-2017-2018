<?php
require_once('php/config.php');
area_riservata();
register('id');
$nome = get_nome_luogo($id);
query("DELETE FROM luoghi WHERE id=$id");
message("Luogo ".$nome." eliminato",1);
redirect('luoghi.php');
?>