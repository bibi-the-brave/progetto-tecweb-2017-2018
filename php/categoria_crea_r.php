<?php
require_once("php/config.php");
area_riservata();
register('nome_c');
register('descrizione_c');
register('immagine_c');

$cartella_img = 'immagini/';

//Memorizza il nome dell'immagine memorizzato nel PC di chi l'ha caricata
$nome_img = $_FILES['immagine_c']['name'];
//Memorizza qualsiasi errore riguardante l'upload
$img_error = $_FILES['immagine_c']['error'];
//Memorizza il nome temporaneo come viene fornito dall'host durante il caricamento.
$img_temp = $_FILES['immagine_c']['tmp_name'];

$percorso_img = $cartella_img . $nome_img;

if(is_uploaded_file($img_temp)) {
    if(move_uploaded_file($img_temp, $percorso_img)) {
    	//immagine caricata nel server con successo. Inserimento categoria nel DB
    	$sql="INSERT INTO categorie (nome,descrizione,immagine) VALUES ('$nome_c','$descrizione_c', '$percorso_img')";
		query($sql);
		message("Categoria creata correttamente",1);
		redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
    } else {
        echo "Failed to move your image.";
    }
} else {
    echo "Failed to upload your image.";
}

?>