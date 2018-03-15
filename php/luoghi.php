<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  register('filter');
  if(isset($tutti) && isset($filter))
	  $filter='';
?>

<html lang="it" >
<head>
  <?= printHead('Luoghi'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar("luoghi.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
      <div class="title"><h2>Esplora Luoghi</h2></div>
      <div class="content">
          <p>
              Qui troverai una lista dei luoghi in cui si terranno gli spettacoli per i quali potrai prenotare un biglietto.
          </p>
          <?php
          filter_form($filter,'Cerca un luogo');
          $sql = "SELECT *
          FROM luoghi
          WHERE true ";

          if(isset($filter)) $sql.= " AND (nome LIKE '%$filter%' OR indirizzo LIKE '%$filter%') ";
          $sql.=" ORDER BY luoghi.nome ";
          

          $luoghi=select($sql);
          ?>

          <div class="tableResponsive">
            <table aria-label="Tabella contenente tutti i luoghi registrati sul nostro sito" title="La seguente tabella contiene tutti i luoghi registrati sul nostro sito presso cui sono organizzati spettacoli">
              <thead>
              <tr>
                  <th scope="col" >Luogo</th>
                  <th scope="col" >Indirizzo</th>
                  <th scope="col" >Telefono</th>
              </tr>
              </thead>
              <tbody>
              <?php
              no_result($luoghi,3);
              foreach($luoghi as $l){
                  echo "<tr>";

                  echo "<td><a title=\"Vai al luogo ".$l['nome']."\" href='luogo_scheda.php?luogo_id=".$l['id']."'>".$l['nome'];
                  echo "</a></td>";

                  echo "<td>".$l['indirizzo'];
                  echo "</td>";

                  echo "<td>".$l['telefono'];
                  echo "</td>";
              }
              ?>
              </tbody>
          </table> </div>
          <a href="#" class="rightLink">Torna su &#9650;</a>

      </div>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
