<?php
require_once("php/config.php");
area_riservata();

//registrazione attributi del luogo
register('nome_l');
// register('indirizzo_l');
register('via_l');
register('numero_l');
register('citta_l');
register('provincia_l');
register('telefono_l');

//registrazione degli attributi del profilo dell'amministratore del luogo
register('username_r');
register('password_r');
register('nome_r');
register('cognome_r');
register('tipo_r');
register('email_r');

//controllo che l' username non sia già preso
$usernames = select("SELECT username FROM utenti WHERE username LIKE '%$username_r%'");
if(isset($usernames[0]['username']) && $usernames[0]['username'] == $username_r){
  //non posso registrarmi perchè esite già un utente con lo stesso username
  message('L\'username inserito non è disponibile',3);
  redirect($_SERVER['HTTP_REFERER']);
  die(); // prevengo che venga eseguita la query
}

$indirizzo_l=$via_l." ".$numero_l.", ".$citta_l." (".strtoupper($provincia_l).")";
$sql="INSERT INTO luoghi (nome,indirizzo,telefono) VALUES ('$nome_l','$indirizzo_l','$telefono_l')";
query($sql);
$id_nuovo_luogo = last_inserted_id(); //ultimo id inserito dalla connessione creato da AUTOINCREMENT (id del luogo)
$sql = "INSERT INTO utenti (username,pass,nome,cognome,tipo,email,luogo_id)
VALUES ('$username_r',PASSWORD('$password_r'),'$nome_r','$cognome_r','$tipo_r','$email_r',$id_nuovo_luogo)";
query($sql);
message("Luogo creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>