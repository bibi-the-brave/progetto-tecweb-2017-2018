<?php
require_once('php/config.php');
register('username');
register('pass');

$utente_trovato = select("
SELECT * FROM utenti
WHERE username='$username'
AND pass=PASSWORD('$pass');
");

if(count($utente_trovato) > 0){
  //qualcuno è stato trovato
  // imposto i parametri nella sessione
  $_SESSION['user_id'] = $utente_trovato[0]['id'];
  $_SESSION['user_username'] = $utente_trovato[0]['username'];
  $_SESSION['user_tipo'] = $utente_trovato[0]['tipo'];

  message('Login avvenuto con successo', 1);
  //echo $utente_trovato[0]['id']." - ".$utente_trovato[0]['username']." - ".$utente_trovato[0]['pass'];
  if(isset($_SESSION['redirect'])){
    $to=$_SESSION['redirect'];
    unset($_SESSION['redirect']);
    redirect($to);
  } else{
    redirect('home.php');
  }
}
else { // utente non trovato nel database
  message('Login fallito',3);
  redirect($_SERVER['HTTP_REFERER']);
}
?>
