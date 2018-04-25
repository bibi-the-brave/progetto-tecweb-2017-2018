<?php

require_once('php/config.php');
register('id_u');
register('nome_u');
register('cognome_u');
register('email_u');

$sql ="
UPDATE utenti
SET nome = '$nome_u', cognome='$cognome_u', email = '$email_u'
WHERE id = $id_u
";

query($sql);
message('Dati aggiornati correttamente',1);
redirect('utente_scheda.php?id_u='.$id_u);
?>
