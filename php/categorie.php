<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
?>

<html lang="it" >
<head>
  <?= printHead('Categorie'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar("categorie.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
  <div class="title"><h2>Esplora le categorie</h2></div>
  <div class="content">
        <?php $categorie = select("
        SELECT *
        FROM categorie
        ORDER BY nome
        ");
        foreach($categorie as $c){
          echo "<div class=\"categoryBox\">";
          echo '<div class="categoryImg">';
          /*
            scrivo ?hash=$hash perchè potrebbero esserci problemi con la cache
            del browser che, potrebbe visualizzare una immagine vecchia.
            Mettendo tale stringa dopo il nome dell'immagine ci si assicura che
            il browser non faccia caching perchè la stringa è sempre diversa.
            É una cosa portabile, quindi ottima.
            
            https://stackoverflow.com/questions/30857752/newly-overwritten-image-not-shown-on-web-page-yii2

            https://stackoverflow.com/questions/728616/disable-cache-for-some-images
          */
          $hash = time_stamp();
          echo "<img src=\"" . $c['immagine'] . "?hash=$hash\" alt=\"" . $c['nome'] . "\">";
          echo '</div>';
          echo "<div class=\"categoryText\">
          <h3><a title=\"Vai alla categoria ".$c ['nome']."\" href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></h3> <p>".$c['descrizione']."</p>
          </div>";
          
          echo "</div>";

        }
        ?>
    <a href="#" class="rightLink">Torna su &#9650;</a>
      
    </div>
  </div>

  
  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
