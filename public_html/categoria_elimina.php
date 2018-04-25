<?php
require_once('php/config.php');
area_riservata();
register('id');
$nome = get_nome_categoria($id);
query("DELETE FROM categorie WHERE id=$id");
message("Categoria ".$nome." eliminata",1);
redirect('home.php');
?>