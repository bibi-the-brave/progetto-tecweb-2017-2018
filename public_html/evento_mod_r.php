<?php
    require_once("php/config.php");
    area_riservata();
    register('nome_e');
    register('descrizione_e');
    register('durata_e');
    register('ore_e');
    register('minuti_e');
    register('categoria_e');
    register('id_mod');
    
    $durata_formattata;
    if($durata_e == "finita"){
        //l'evento ha una durata prestabilita(di qualche ora)
        $durata_formattata = $ore_e.":".$minuti_e;
    } else {
        //l'evento dura tutto il giorno
        $durata_formattata = "00:00";
    }
    

    $sql="UPDATE eventi SET 
    nome = '$nome_e', 
    descrizione = '$descrizione_e',
    durata = '$durata_formattata',
    categoria_id = $categoria_e 
    WHERE id=$id_mod";

    query($sql);
    message("Evento modificato correttamente",1);
    redirect("evento_scheda.php?evt_id=$id_mod");
?>