<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_mod');
check($id_mod);
require_luogo_exists($id_mod);
area_riservata(true,$id_mod);
?>

<html lang="it" >
<head>
  <?= printHead('Modifica luogo'); ?>
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
      $cercato = select("SELECT * FROM luoghi WHERE id=$id_mod")[0];
      ?>
      <div class="title"><h2>Modifica informazioni <?=  $cercato['nome']?></h2></div>


      <div class="box">
    <form name="modificaluogo" method="post" action="luogo_mod_r.php">
      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <label for="nome_l">Nome</label>
      <input tabindex=10 type="text" value="<?= $cercato['nome'] ?>" maxlength=50 name="nome_l" id="nome_l" required/>
      <label for="indirizzo_l">Indirizzo</label>
      <input tabindex=20 value="<?= $cercato['indirizzo']?>" type="text" name="indirizzo_l" id="indirizzo_l" required/>
      <label for="telefono_l">Telefono</label>
      <input placeholder="es: 320 123 4567" tabindex=30 value="<?= $cercato['telefono']?>" type="text" maxlength=40 name="telefono_l" id="telefono_l" required/>
      <div class="boxInline">
          <input tabindex=40 type="submit" onclick=" return phonenumber(document.modificaluogo.telefono_l)" value="Conferma">
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
