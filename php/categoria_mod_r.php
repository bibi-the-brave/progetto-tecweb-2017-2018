<?php
    require_once("php/config.php");
    area_riservata();
    register('id_mod');
    register('nome_c');
    register('descrizione_c');
    register('immagine_c');

    $sql="UPDATE categorie SET 
    nome = '$nome_c', 
    descrizione = '$descrizione_c'
    WHERE id=$id_mod";
    

    /*l'utente ha inserito una nuova immagine,
    il path nel DB rimane immutato ma viene sovrascritta
    l'immagine nel server*/
    if( !empty($_FILES['immagine_c']['name']) ) {
        $percorso_img = select("SELECT immagine FROM categorie WHERE id=$id_mod");
        //Memorizza qualsiasi errore riguardante l'upload
        $img_error = $_FILES['immagine_c']['error'];
        //Nome temporaneo dall'host durante il caricamento.
        $img_temp = $_FILES['immagine_c']['tmp_name'];
        
        if(is_uploaded_file($img_temp)) {
            unlink($percorso_img[0]['immagine']);
            if(move_uploaded_file($img_temp, $percorso_img[0]['immagine'])) {
                //immagine modificata con successo
                message("Categoria modificata correttamente",1);
                redirect("categoria_scheda.php?cat_id=$id_mod");
            } else {
                //non si riesce a spostare l'immagine nella cartella desiderata
                echo "Failed to move your image.";
                //message("Categoria non modificata",1);
                phpinfo();
            }
        }  else {
            //non si riesce a caricare l'immagine nel server
            phpinfo();
            echo "Failed to upload your image.";
            message("Categoria non modificata",1);
        }
        
    }

    query($sql);
    message("Categoria modificata correttamente",1);
    redirect("categoria_scheda.php?cat_id=$id_mod");
?>  