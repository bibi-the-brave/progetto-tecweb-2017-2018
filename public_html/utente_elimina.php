<?php
require_once('php/config.php');
register('id_u');
require_proprietario($id_u); // solo il proprietario può eliminare il suo stesso profilo
query("DELETE FROM utenti WHERE id=$id_u");
message("Profilo eliminato",1);
unset($_SESSION['user_id']);
unset($_SESSION['user_username']);
unset($_SESSION['user_tipo']);
redirect('home.php');
?>