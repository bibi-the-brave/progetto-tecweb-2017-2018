<?php
    require_once('php/config.php');
    register('idluogo');
    area_riservata(true,$idluogo);
    register('idbiglietto');
    register('stato');
    query("UPDATE biglietti SET utilizzato='$stato' WHERE id=$idbiglietto");
    echo "Il biglietto ".($stato == 'No' ? 'non ' : ' ')."è stato utilizzato";
?>