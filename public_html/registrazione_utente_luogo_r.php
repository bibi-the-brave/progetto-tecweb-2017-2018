<?php
require_once('php/config.php');
area_riservata();
register('username_r');
register('password_r');
register('nome_r');
register('cognome_r');
register('tipo_r');
register('email_r');
register('luogo_r');
//controllo che l' username non sia già preso
$usernames = select("SELECT username FROM utenti WHERE username LIKE '%$username_r%'");
if(isset($usernames[0]['username']) && $usernames[0]['username'] == $username_r){
    //non posso registrarmi perchè ho già uno che si chiama così!
    message('Username non disponibile',3);
    redirect('registrazione_utente_luogo.php');
    die();  // prevengo che il resto della pagina sia caricato
}
$sql = "INSERT INTO utenti (username,pass,nome,cognome,tipo,email,luogo_id)
VALUES ('$username_r',PASSWORD('$password_r'),'$nome_r','$cognome_r','$tipo_r','$email_r',$luogo_r)";
query($sql);
message('Amministratore di '.get_nome_luogo($luogo_r).' aggiunto correttamente',1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>