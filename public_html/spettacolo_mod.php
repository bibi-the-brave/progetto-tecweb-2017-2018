    <!DOCTYPE html>



<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_mod');
check($id_mod);
require_spettacolo_exists($id_mod);

$id_luogo_spettacolo =select("SELECT luogo_id FROM spettacoli WHERE id=$id_mod")[0]['luogo_id']; # è la varabile che indica l'id del luogo in cui sarà ospitato lo spettacolo
area_riservata(true,$id_luogo_spettacolo);
?>

<html lang="it" >
<head>
  <?= printHead("Modifica spettacolo"); ?>

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
      $cercato = select("SELECT * FROM spettacoli WHERE id=$id_mod")[0];

      $data = substr($cercato['data_ora'],0,10);
      $ora = substr($cercato['data_ora'],11,5);
      ?>
      <div class="title"> <h2>Modifica spettacolo per  <?=get_evento_from_spettacolo($cercato['id'])['nome']?></h2></div>
      <div class="box">

    <form method="post" action="spettacolo_mod_r.php">
      
      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <?php
      if($_SESSION['user_tipo'] != 'L'): ?> <!-- controllo che sia un utente admin o operatore, altrimenti non può modificare il luogo -->

      <label for="luogo_s" >Luogo</label>

        <select tabindex=10 id="luogo_s" name="luogo_s" required>

          <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
          foreach($luoghi as $l){
            echo "<option value=".$l['id']."";
            if($l['id'] == $cercato['luogo_id']){
              echo " selected ";
            }
            echo ">".$l['nome']."</option>";
          }
          ?>
        <?php else: ?>
          <!-- se un amministratore di luogo richiede di modificare uno spettacolo non potrà modificare il luogo in cui si svolge -->
          <input type="hidden" name="luogo_s" value="<?= $cercato['luogo_id']?>" />
        <?php endif ?>
      </select>

      <label for="data_s">Data</label>
      <input tabindex=20 id="data_s" value="<?php echo"$data" ?>" type="date" name="data_s" required/>

      <label for="ora_s">Orario di inizio</label>
      <input tabindex=30 if="ora_s" value="<?php echo"$ora" ?>" type="time" name="ora_s" required/>

      <label for="posti_s">Posti disponibili</label>
      <input tabindex=40 id="posti_s" value="<?php echo($cercato['posti_disponibili']); ?>" type="number" name="posti_s" min="0" value=0 required/>

      <label for="costo_s">Costo spettacolo</label>
      <input tabindex=50 id="costo_s" value="<?php echo($cercato['prezzo']); ?>" type="number" step="0.01" name="costo_s" value="0.0" required/>
        <div class="boxInline">
            <input tabindex=60 type="submit" value="Conferma">
            <input tabindex=70  id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
      </div>
  </div>


  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
