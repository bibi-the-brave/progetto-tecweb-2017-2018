<?php
require_once('php/config.php');
unset($_SESSION['user_id']);
unset($_SESSION['user_username']);
unset($_SESSION['user_tipo']);
message('Logout effettuato con successo', 1);
redirect('home.php');
?>