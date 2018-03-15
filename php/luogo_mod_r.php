<?php
    require_once("php/config.php");
    register('id_mod');
    area_riservata(true,$id_mod);
    register('nome_l');
    register('indirizzo_l');
    register('telefono_l');
    
    $sql="UPDATE luoghi SET 
    nome = '$nome_l', 
    indirizzo = '$indirizzo_l',
    telefono = '$telefono_l' 
    WHERE id=$id_mod";
    query($sql);
    message("Informazioni modificate correttamente",1);
    redirect("luogo_scheda.php?luogo_id=$id_mod");
?>