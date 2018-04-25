<?php

require_once('php/config.php');
register('username_r');
register('password_r');
register('nome_r');
register('cognome_r');
register('tipo_r');
register('email_r');

//controllo che l' username non sia già preso
$usernames = select("SELECT username FROM utenti WHERE username LIKE '%$username_r%'");
if(isset($usernames[0]['username']) && $usernames[0]['username'] == $username_r){
  //non posso registrarmi perchè esiste già un utente con un username uguale
  message('L\'username inserito non è disponibile',3);
  redirect($_SERVER['HTTP_REFERER']);
  die();  // prevengo che il resto della pagina sia caricato
}

$sql = "INSERT INTO utenti (username,pass,nome,cognome,tipo,email)
VALUES ('$username_r',PASSWORD('$password_r'),'$nome_r','$cognome_r','$tipo_r','$email_r')";
query($sql);
$neo_registrato = select("SELECT id FROM utenti WHERE username='$username_r'");


// leggo dalla sessione che tipo di comportamento devo avere dopo la registrazione: per registrazione di utente dovrò comportarmi in un certo modo, per la registrazione di un operatore in un altro per esempio
if(isset($_SESSION['messaggio_registrazione']) && isset($_SESSION['redirect_registrazione'])){
  $messaggio_registrazione = $_SESSION['messaggio_registrazione'];
  unset($_SESSION['messaggio_registrazione']);
  $redirect_registrazione = $_SESSION['redirect_registrazione'];
  unset($_SESSION['redirect_registrazione']);
  message($messaggio_registrazione,1);
  redirect($redirect_registrazione);
  } else {
  // se non sono stati settati messaggio registrazione e redirect registrazione è un tipo di registrazione base
  $_SESSION['user_id'] = $neo_registrato[0]['id'];
  $_SESSION['user_username'] = $username_r;
  $_SESSION['user_tipo'] = $tipo_r;
  message('Ti sei registrato con successo, benvenuto!',1);
  redirect('home.php');
}
?>
