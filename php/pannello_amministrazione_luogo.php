<!DOCTYPE html>

<?php
require_once 'php/config.php';
require_once 'php/printTemplate.php';

register('luogo_id');
check($luogo_id);
require_luogo_exists($luogo_id);
area_riservata(true, $luogo_id);
register('filter');
register('ord');
$_SESSION['redirect_from_spettacolo'] = 'pannello_amministrazione_luogo.php?luogo_id=' . $luogo_id;
if (isset($tutti) && isset($filter)) {
    $filter = '';
}

$luogo = select("SELECT * FROM luoghi WHERE id=$luogo_id");

if (count($luogo) == 0) {
    message('Luogo non presente nel sistema', 2);
    redirect('home.php');
    die();
} else {
    $luogo = $luogo[0];
}
?>

<html lang="it" >
<head>
  <?=printHead('Amministra luogo');?>
</head>
<body>

  <header>
    <?=printHeader();?>
  </header>

  <nav id="nav" class="Off">
    <?=printNavBar();?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
  <div class="title"><h2>Amministrazione <?=$luogo['nome']?></h2></div>
  <div class="content">


    <div class="linkDestra">
        <a <?php echo "title=\"Modifica le informazioni del luogo ".get_nome_luogo($luogo_id)."\""; ?> href="luogo_mod.php?id_mod=<?=$luogo_id?>">Modifica informazioni luogo</a>
        <a title="Crea un nuovo spettacolo" href="spettacolo_crea.php">Crea nuovo spettacolo</a>
    </div>
        <h3>Spettacoli</h3><hr>
            <?php
$sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli
                JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id
                ORDER BY spettacoli.data_ora";
                #if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
                $spettacoli = select($sql);
            ?>
            <div class="tableResponsive"> <table title="<?php echo "La tabella contiene tutti gli spettacoli in programma presso ".get_nome_luogo($luogo_id)."\""?> aria-label="<?php echo "Tabella contenente gli spettacoli in programma presso ".get_nome_luogo($luogo_id)."\"" ?>   >
            <thead>
                <tr>
                    <th scope="col" >Evento</th>
                    <th scope="col" >Data</th>
                    <th scope="col" >Prezzo</th>
                    <th scope="col" >Posti disponibili</th>
                    <th scope="col" >Modifica</th>
                </tr>
                </thead>
                <tbody>
                <?php
no_result($spettacoli, 5);
foreach ($spettacoli as $s) {
    echo "<tr>";

    echo "<td><a title=\"Vai all'evento " . $s['nome'] . "\" href='evento_scheda.php?evt_id=" . $s['idevento'] . "'>" . $s['nome'];
    echo "</a></td>";

    echo "<td>" . format_data_ora($s['data_ora']);
    echo "</td>";

    echo "<td>" . $s['prezzo'] . "&euro;";
    echo "</td>";

    echo "<td>" . $s['posti_disponibili'] . "</td>";

    echo "<td>";
    echo "<div class='text-center'><a title=\"Modifica l'evento " . $s['nome'] . "\" href=\"spettacolo_mod.php?id_mod=" . $s['id'] . "\">Modifica</a></div>";
    echo "</td>";

    echo "</tr>";
}
?>
                </tbody>
            </table> </div>


        <h3>Biglietti degli utenti</h3><hr>
        <div id='messaggioAjax' class='message-success'></div>
        <?=filter_form($filter, 'Cerca un utente')?>
        <div class="tableResponsive">
        <table aria-label=<?php echo "\"Tabella contenente i dettagli dei biglietti prenotati per spettacoli in programma presso ".get_nome_luogo($luogo_id)."\"" ?> >  
        <thead>
            <tr>
                <th scope="col" >
                    <?php print_ordinable_th('Username', $ord, 'u', 'username')?></th>
                <th scope="col" >
                    <?php print_ordinable_th('Evento', $ord, 'e', 'evento')?></th>
                <th scope="col" >
                    <?php print_ordinable_th('Data', $ord, 'd', 'data')?></th>
                <th scope="col" >Prezzo</th>
                <th scope="col" >&#35;Posti</th>
                <th scope="col" >Codice</th>
                <th scope="col" >Utilizzato</th>
            </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT *,biglietti.id AS idbiglietto, biglietti.posti AS posti
                FROM (biglietti JOIN utenti ON biglietti.utente_id=utenti.id)
                JOIN spettacoli ON  biglietti.spettacolo_id=spettacoli.id
                JOIN eventi ON spettacoli.evento_id=eventi.id
                JOIN luoghi ON spettacoli.luogo_id=luoghi.id
                WHERE luoghi.id=$luogo_id";
if ($filter != null) {
    $sql .= " AND (utenti.username LIKE '%$filter%') ";
}

$sql .= " ORDER BY biglietti.utilizzato DESC, "; // metti prima quelli non utlizzati e poi quelli utilizzati, a priori
if ($ord != null) { //controllo se si vuole ordinare per qualche campo
    switch ($ord) {
        case 'u':$sql .= " utenti.username";
            break;
        case 'e':$sql .= "  eventi.nome";
            break;
        case 'd':$sql .= "  spettacoli.data_ora";
            break;
    }
} else {
    $sql .= "  spettacoli.data_ora";
}
$biglietti=select($sql);
no_result($biglietti,7);
foreach($biglietti as $b){
    echo "<tr>";
        echo "<td><a title=\"Vai all'utente ".get_nome_utente($b['utente_id'])."\" href='utente_scheda.php?id_u=".$b['utente_id']."'>".get_nome_utente($b['utente_id']);
        echo "</a></td>";
        
        
        $e=get_evento_from_spettacolo($b['spettacolo_id']);
        echo "<td><a title=\"Vai all'evento ".$e['nome']."\" href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
        echo "</a></td>";
        
        echo "<td>".format_data_ora($b['data_ora']);
        echo "</td>";
        
        echo "<td>".format_costo($b['prezzo']*$b['posti'])."&euro;";
        echo "</td>";

        echo "<td>".$b['posti'];
        echo "</td>";
        
        echo "<td>".$b['codice'];
        echo "</td>";
        
        echo "<td>";

        echo "<select aria-label=\"Biglietto di utente ".get_nome_utente($b['utente_id'])." per evento ".$e['nome']." in data ".format_data_ora($b['data_ora'])." con codice ".$b['codice']." è stato utilizzato?"."\"
          onchange=\"ajax('biglietto_modifica_stato_r.php?stato='+this.options[this.selectedIndex].value+'&idbiglietto='+".$b['idbiglietto']."+'&idluogo='+".$luogo_id.",'messaggioAjax')\">";
            echo "<option ";
            if($b['utilizzato']=='si') echo " selected ";
            echo">Si</option>";
            echo "<option ";
            if($b['utilizzato']=='no') echo " selected ";
            echo">No</option>";
        echo "</select>";
        
    echo "</tr>";
}
                
            ?>
            </tbody>
        </table> </div>


        </div>
  </div>

  <footer>
    <?=printFooter();?>
  </footer>
</body>
</html>
