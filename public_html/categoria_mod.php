<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
area_riservata();
register('id_mod');
check($id_mod);
require_categoria_exists($id_mod);

?>

<html lang="it" >
<head>
  <?= printHead('Modifica categoria'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()" >
      <?php
      $cercato = select("SELECT * FROM categorie WHERE id=$id_mod")[0];
      ?>
      <div class="title"><h2>Modifica categoria <?=  $cercato['nome']?></h2></div>
      <div class="box">
      <form enctype="multipart/form-data" method="post" action="categoria_mod_r.php">
        <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
        <label for="nome_c">Nome</label>
        <input tabindex=10 value="<?= $cercato['nome'] ?>" placeholder="Inserire il nome della categoria" type="text" maxlength=50 id="nome_c" name="nome_c" required/>
        <label for="descrizione_c">Descrizione</label>
        <textarea tabindex=20 id="descrizione_c" name="descrizione_c"><?= $cercato['descrizione'] ?></textarea>
        <label for="immagine_c_attuale">Immagine categoria</label>
        <div id="modifyCategoryBox">
          <div id="modifyImg">
            <?php
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
            echo "<img src=\"" . $cercato['immagine'] . "?hash=$hash\" alt=\"" . $cercato['nome'] . "\">"; ?>
          </div>
        </div>

        <label for="immagine_c">Nuova immagine</label>
        <input tabindex=30 type="file" name="immagine_c" id="immagine_c" accept="image/*"/>
        
        <div class="boxInline">
            <input tabindex=40 type="submit" value="Conferma">
            <input tabindex=50 id="buttonRight" type="reset" value="Annulla">
        </div>
      </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
