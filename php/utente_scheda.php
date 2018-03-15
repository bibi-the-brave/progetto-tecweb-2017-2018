<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');
check($id_u);
require_utente_exists($id_u);
$user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
?>

<html lang="it" >

<head>
  <?= printHead('Profilo '.$user['username']); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar("utente_scheda.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
      <div class="title"><h2>Profilo di <?php echo $user['username']?></h2></div>
      <div class="content">
          <?php
          echo
              "<div class=\"borderDl\"><dl>
      <dt>Nome</dt><dd>".$user['nome']."</dd>
      <dt>Cognome</dt><dd>".$user['cognome']."</dd>
      <dt><span lang=\"en\">Email</span></dt><dd>".$user['email']."</dd>
      </dl></div>";
          ?>
            <?php if(is_logged() && proprietario($user['id'])): ?>
          <div class="linkDestra">
          <a title="Modifica le tue informazioni" href="utente_modifica_informazioni.php?id_u=<?=$id_u?>">Modifica profilo</a>
          <a title="Elimina il tuo profilo" href="utente_elimina.php?id_u=<?=$id_u?>" onclick="return confirm('Sicuro di voler eliminare il tuo profilo? Non sarà possibile recuperarlo in futuro');">Elimina profilo</a>
          <?php if(is_gestore_luogo()): ?>
                           <a title="Vai ad opzioni di ammistrazione luogo" href="pannello_amministrazione_luogo.php?luogo_id=<?php echo id_luogo_amministrato($_SESSION['user_id']); ?>" >Amministra luogo</a>
                        <?php endif ?>
          </div>
          <?php endif ?>

          <?php if((is_admin() || is_operatore()) && proprietario($user['id'])): ?>
                <div id="amministrazione">
                    <div class="title"><h3 id="titlePan">Pannello Amministazione</h3></div>
                    <div id="panAmm">
                            <ul>
                                <li><a title="Crea categoria" href="categoria_crea.php">Crea categoria</a></li>
                                <li><a title="Crea evento" href="evento_crea.php">Crea evento</a></li>
                                <li><a title="Crea luogo" href="luogo_crea.php">Crea luogo</a></li>
                                <li><a title="Crea spettacolo" href="spettacolo_crea.php">Crea spettacolo</a></li>
                                <li><a title="Crea amministratore di luogo" href="registrazione_utente_luogo.php">Crea amministratore di luogo</a></li>
                                <?php if(is_admin()): ?>
                                    <li><a title="Crea operatore" href="operatore_crea.php">Crea operatore</a></li>
                                <?php endif ?>
                            </ul>
                    </div>
                </div>
          <?php endif ?>

          <?php if(is_logged() && proprietario($user['id'])): ?>
              <hr><h3>Prenotazioni</h3>
              <div class="tableResponsive"> <table aria-label=<?php echo "\"Tabella contentente le prenotazioni effettuate dall'utente ".$user['nome']."\"" ?> >
                  <thead>
                  <tr>
                      <th scope="col">Evento</th>
                      <th scope="col">Luogo</th>
                      <th scope="col">Data</th>
                      <th scope="col">Prezzo</th>
                      <th scope="col">&#35;Posti</th>
                      <th scope="col">Codice</th>
                      <th scope="col">Annulla prenotazione</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = "SELECT biglietti.posti AS posti, biglietti.codice AS codice,spettacoli.id AS idspettacolo,spettacoli.evento_id AS idevento,spettacoli.data_ora,spettacoli.prezzo,spettacoli.luogo_id AS idluogo, biglietti.id AS idbiglietto
                    FROM biglietti JOIN spettacoli ON biglietti.spettacolo_id=spettacoli.id
                    WHERE utente_id=".$_SESSION['user_id'].
                    " ORDER BY spettacoli.data_ora";
                  $biglietti=select($sql);
                  no_result($biglietti,7);
                  foreach($biglietti as $b){
                      echo "<tr>";

                      echo "<td><a title=\"Vai all'evento " . get_nome_evento($b['idevento']) . 
                        "\" href=\"evento_scheda.php?evt_id=" . $b['idevento'] . "\">" .
                        get_nome_evento($b['idevento']);
                      echo "</a></td>";

                      echo "<td><a title=\"Vai al luogo " . get_nome_luogo($b['idluogo']) . 
                        "\" href=\"luogo_scheda.php?luogo_id=" . $b['idluogo'] . "\">" .
                        get_nome_luogo($b['idluogo']);
                      echo "</a></td>";

                      echo "<td>".format_data_ora($b['data_ora']);
                      echo "</td>";

                      echo "<td>".format_costo((float)$b['prezzo']*$b['posti'])."&euro;";
                      echo "</td>";

                      echo "<td>".$b['posti'];
                      echo "</td>";


                      echo "<td>".$b['codice'];
                      echo "</td>";

                      print_form_anullamento($b['idbiglietto'],get_nome_evento($b['idevento']));
                  }
                  ?>
                  </tbody>
              </table> </div>
              <div class="marginTopBottom"><em>Segna il codice e il tuo nome utente (<?= $user['username'] ?>) per poter entrare allo spettacolo</em></div>
              <?php endif ?>
            

      </div>

    </div>
    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
