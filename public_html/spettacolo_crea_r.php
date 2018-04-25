<?php
//devo controllare che la data non sia passata e che il formato dell'input del prezzo sia giusto
require_once("php/config.php");
if(!is_admin() && !is_operatore() && !is_gestore_luogo()){
    message('Area riservata',2);
    redirect('home.php');
    die();  // prevengo che il resto della pagina sia caricato
}
register('evento_s');
register('luogo_s');
register('data_s');
register('ora_s');
register('posti_s');
register('costo_s');

//controllo la data non sia passata

if(is_data_passata($data_s)){
    message('Non puoi creare spettacoli in date passate',2);
    redirect('spettacolo_crea.php');
    die();  // prevengo che la query venga eseguita
}

//formatto il costo in modo corretto
$costo_s = format_costo($costo_s);

$sql="INSERT INTO spettacoli (evento_id,luogo_id,data_ora,posti_disponibili,prezzo)
VALUES ($evento_s,$luogo_s,'$data_s $ora_s:00',$posti_s,$costo_s)";
query($sql);
message("Spettacolo creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>