<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('luogo_id');
check($luogo_id);
require_luogo_exists($luogo_id);
register('filter');
register('ord');
register('user_id');
$_SESSION['redirect_from_spettacolo'] = 'luogo_scheda.php?luogo_id='.$luogo_id; // quando modificherà uno spettacolo verrà rimandato alla pagina del luogo da cui proviene
if(isset($tutti) && isset($filter))
    $filter='';

$luogo = select("SELECT * FROM luoghi WHERE id=$luogo_id")[0];
?>

<html lang="it" >
<head>
  <?= printHead(get_nome_luogo($luogo_id)) ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">

    <div class="title"><h2><?= $luogo['nome'] ?></h2> </div>
      <div class="content">
          <aside>
          <div class="borderDl">
              <dl>
                  <dt>Indirizzo</dt><dd><?= $luogo['indirizzo'] ?></dd>
                  <dt>Telefono</dt><dd><?= $luogo['telefono'] ?></dd>
              </dl>
</div>

              <?php if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)): ?>
                  <p class="linkDestra">
                  <a <?php echo "title=\"Modifica il luogo ".$luogo['nome']."\"" ?>  href="luogo_mod.php?id_mod=<?= $luogo_id ?>">Modifica Luogo</a>  
                      <?php if(is_admin() || is_operatore()): ?>
                          <!-- metto questo solo ad admin e operatori in quanto un amministratore di luogo non dovrebbe essere in grado di eliminare il suo luogo -->
                          <a <?php echo "title=\"Elimina il luogo ".$luogo['nome']."\"" ?>  onclick='return confirm("Confermi di voler eliminare questo luogo?")' href ="luogo_elimina.php?id=<?php echo $luogo_id;?>">Elimina luogo</a>
                      <?php endif ?>
                  </p>
              <?php endif ?>
          </aside>
          <?php filter_form($filter,'Cerca un evento'); ?>
          
          
          <div class="tableResponsive">
            <table  aria-label="<?php echo "Tabella contenente gli spettacoli organizzati nel luogo ".$luogo['nome']."\""?> title="<?php echo "La tabella contiene tutti gli spettacoli presenti sul nostro sito che sono organizzati nel luogo ".$luogo['nome']."\""?>>

              <thead>
              <tr>
                  <th scope="col" >
                    <?php print_ordinable_th('Evento',$ord,'e','evento')?></th>
                  <th scope="col" >
                    <?php print_ordinable_th('Data',$ord,'d','data')?></th>
                  <th scope="col" >
                    <?php print_ordinable_th('Prezzo',$ord,'p','prezzo')?></th>
                  
                  <th scope="col">Prenotazione</th>
                  
                  <?php if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)) : ?>
                      <th scope="col">Posti Disponibili</th>
                      <th scope="col">Modifica</th>
                      <th scope="col">Elimina</th>
                  <?php endif ?>
              </tr>
              </thead>
              <tbody>

              <?php //qui carico i varispettacoli
              $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id AND spettacoli.data_ora >= NOW() ";
              if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
              if(isset($ord)){
                  switch($ord){
                      case 'e': $sql.= "ORDER BY eventi.nome";
                          break;
                      case 'd': $sql.= "ORDER BY spettacoli.data_ora ASC";
                          break;
                      case 'p':  $sql.= "ORDER BY spettacoli.prezzo";
                  }
              } else {
                    $sql.=" ORDER BY eventi.nome";
              }
              $spettacoli = select($sql);


              if ( is_admin() || is_operatore() || user_linked_to_luogo($luogo_id))	{
                  no_result($spettacoli,7);
              } else {
                  no_result($spettacoli,4);
              }
              foreach($spettacoli as $s){
                  echo "<tr>";

                  echo "<td><a title=\"Vai all'evento\" href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                  echo "</a></td>";

                  echo "<td>".format_data_ora($s['data_ora']);
                  echo "</td>";

                  echo "<td>".$s['prezzo']."&euro;";
                  echo "</td>";

                  
                  print_form_prenotazione($s['id'], ((isset($_SESSION) && isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : null),$s['posti_disponibili'],get_evento_from_spettacolo($s['id'])['nome'], $s['data_ora'] ,$luogo_id);
                  
                  if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)){
                      echo "<td>".$s['posti_disponibili']."</td>";
                      echo "<td><a title=\"Modifica lo spettacolo ".get_evento_from_spettacolo($s['id'])['nome']."\" href=\"spettacolo_mod.php?id_mod=".$s['id']."\">modifica</a></td>";
                      echo "<td><a onclick=' return confirm(\"Confermi di voler eliminare lo spettacolo del ".format_data_ora($s['data_ora'])." di ".get_evento_from_spettacolo($s['id'])['nome']." in questo luogo?\")' title=\"Elimina lo spettacolo ".get_evento_from_spettacolo($s['id'])['nome']."\" href=\"spettacolo_elimina.php?id_s=".$s['id']."\" >elimina</a></td>";
                  }

                  echo "</tr>";
              }
              ?>
              <tbody>

          </table> </div>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
