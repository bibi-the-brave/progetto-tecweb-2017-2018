<!DOCTYPE html>

<?php
require_once 'php/config.php';
register('evt_id');
check($evt_id);
require_evento_exists($evt_id);
register('ord');
$_SESSION['redirect_from_spettacolo'] = 'evento_scheda.php?evt_id=' . $evt_id;
$evento = select("SELECT * FROM eventi WHERE id=$evt_id")[0];

?>
<?php
require_once 'php/printTemplate.php'
?>

<html lang="it" >
<head>
  <?=printHead(get_nome_evento($evt_id));?>
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
      <div class="title"><h2><?=$evento['nome']?></h2></div>
      <div class="content">
            <div class="borderDl">
              <dl>
                  <dt>Durata</dt><dd><?=format_durata($evento['durata'])?></dd>
                  <dt>Categoria</dt><dd><a <?php echo "title=\"Vai alla categoria " . get_nome_categoria($evento['categoria_id']) . "\"" ?>
                   href='categoria_scheda.php?cat_id=<?=$evento['categoria_id']?>'><?=get_nome_categoria($evento['categoria_id'])?></a></dd>
              </dl>
</div>

              <?php if (is_admin() || is_operatore()): ?>
                  <p class="linkDestra">
                      <a  <?php echo "title=\"Modifica l'evento " . $evento['nome'] . "\"" ?>  href="evento_mod.php?id_mod=<?=$evt_id?>">Modifica Evento</a>

                      <a <?php echo "title=\"Elimina l'evento " . $evento['nome'] . "\"" ?> onclick='return confirm("Confermi di voler eliminare questo evento?")' href ="evento_elimina.php?id=<?php echo $evt_id; ?>">Elimina evento</a>
                  </p>
              <?php endif?>


              <p><?=$evento['descrizione']?></p>


          <div class="tableResponsive">
          <table aria-label="<?php echo "Tabella contenente gli spettacoli in programma per l'evento " . $evento['nome'] . "" ?>" title="<?php echo "Tabella che contiene gli spettacoli in programma per l'evento " . $evento['nome'] . "" ?>">

              <thead>
              <tr>
                  <th scope="col">
                    <?php print_ordinable_th('Luogo', $ord, 'l', 'luogo')?></th>
                  <th scope="col">
                    <?php print_ordinable_th('Data', $ord, 'd', 'data')?></th>
                  <th scope="col">
                    <?php print_ordinable_th('Prezzo', $ord, 'n', 'prezzo')?></th>

                  <th scope="col" >Prenotazione</th>
                  <?php if (is_admin() || is_operatore()): ?>
                      <th scope="col" >Posti Disponibili</th>
                      <th scope="col" >Modifica</th>
                      <th scope="col" >Elimina</th>
                  <?php endif?>
              </tr>
              </thead>
              <tbody>
              <?php //leggo i vari spettacoli
//   $spettacoli_query = "SELECT *
//   FROM spettacoli JOIN eventi ON eventi.id=spettacoli.evento_id
//   JOIN luoghi ON luoghi.id=spettacoli.luogo_id
//   WHERE evento_id=".$evento['id']."
//   AND spettacoli.data_ora >= NOW() ";

$spettacoli_query = "SELECT
                spettacoli.id AS id,
                luoghi.id AS luogo_id,
                spettacoli.data_ora AS data_ora,
                spettacoli.prezzo AS prezzo,
                spettacoli.posti_disponibili AS posti_disponibili,
                eventi.nome AS nome_evento
              FROM spettacoli JOIN eventi ON eventi.id=spettacoli.evento_id
              JOIN luoghi ON luoghi.id=spettacoli.luogo_id
              WHERE evento_id=" . $evento['id'] . "
              AND spettacoli.data_ora >= NOW() ";

if (isset($ord)) {
    switch ($ord) {
        case 'l':$spettacoli_query .= "ORDER BY luoghi.nome";
            break;
        case 'c':$spettacoli_query .= "ORDER BY spettacoli.data_ora DESC";
            break;
        case 'p':$spettacoli_query .= "ORDER BY spettacoli.prezzo ASC";

    }
} else {
    $spettacoli_query .= " ORDER BY data_ora";
}
$spettacoli = select($spettacoli_query);
if (is_admin() || is_operatore()) {
    no_result($spettacoli, 7);
} else {
    no_result($spettacoli, 4);
}
foreach ($spettacoli as $s) {
    echo "<tr>";
    echo "<td><a  title=\"Vai al luogo " . get_nome_luogo($s['luogo_id']) . "\" href=\"luogo_scheda.php?luogo_id=" . $s['luogo_id'] . "\">" . get_nome_luogo($s['luogo_id']);
    echo "</a></td>";
    echo "<td>" . format_data_ora($s['data_ora']);
    echo "</td>";
    echo "<td>" . $s['prezzo'] . "&euro;";
    echo "</td>";

    print_form_prenotazione($s['id'], ((isset($_SESSION) && isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : null), $s['posti_disponibili'], $s['nome_evento'], $s['data_ora'],
        $s['luogo_id']);

    if (is_admin() || is_operatore()) {
        echo "<td>" . $s['posti_disponibili'] . "</td>";
        echo "<td>";
        echo "<a title=\"Modifica lo spettacolo " . $s['nome_evento'] . " in data " . format_data_ora($s['data_ora']) . " presso " . get_nome_luogo($s['luogo_id']) . "\" href=\"spettacolo_mod.php?id_mod=" . $s['id'] . "\">modifica</a>";
        echo "</td>";
        echo "<td>";
        echo "<a onclick='return confirm(\"Confermi di voler eliminare lo spettacolo del ".format_data_ora($s['data_ora'])." di ".$evento['nome']." a ".get_nome_luogo($s['luogo_id'])."?\")'title=\"Elimina lo spettacolo " . $s['nome_evento'] . " in data " . format_data_ora($s['data_ora']) . " presso " . get_nome_luogo($s['luogo_id']) . "\"  href=\"spettacolo_elimina.php?id_s=" . $s['id'] . "\">elimina</a>";
        echo "</td>";
    }

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
