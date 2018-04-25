<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
area_riservata();
register('id_mod');
check($id_mod);
require_evento_exists($id_mod);

?>

<html lang="it" >
<head>
  <?= printHead('Modifica evento'); ?>
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
      $cercato = select("SELECT * FROM eventi WHERE id=$id_mod")[0];
      ?>

      <div class="title"><h2>Modifica evento <?php echo $cercato['nome']?> </h2></div>
    <div class="box">

      <form method="post" action="evento_mod_r.php">
        <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
        <label  for="nome_e">Nome</label> 
        <input tabindex=10 value="<?= $cercato['nome']?>" name="nome_e" id="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
        <label for="descrizione_e">Descrizione</label> 
        <textarea tabindex=20 name="descrizione_e" id="descrizione_e"><?= $cercato['descrizione']?></textarea>


        <fieldset>
        <legend>Durata</legend>
        <input tabindex=30 type="radio" name="durata_e" value="finita"  onchange="writeDurataWithValues(
          <?php echo get_ore($cercato['durata']); ?> , 
          <?php echo get_minuti($cercato['durata']); ?> )" 
        <?php if(!is_giornata_lavorativa(($cercato['durata']))) 
        echo "checked"; ?>/> Finita <br />
        <div id="durataFinita">
        <?php if(!is_giornata_lavorativa(($cercato['durata']))) : ?>
          <label for="ore_e">Ore</label>
        
          <input tabindex=40 id="ore_e" name="ore_e" placeholder="Ore" type="number" min="0"  value="<?php echo get_ore($cercato['durata']);?>" required/>
          <label for="minuti_e">Minuti</label>
          <input tabindex=50 id="minuti_e"name="minuti_e" placeholder="Minuti" type="number" min="0" max="59" value="<?php echo get_minuti($cercato['durata']);?>" required/>
        <?php endif ?>
        </div>
        <input tabindex=60 type="radio" name="durata_e" value="fullday" onclick="deleteDurata()" <?php if(is_giornata_lavorativa(($cercato['durata']))) 
        echo "checked"; ?> /> Tutto il giorno <br />
        
        </fieldset>
        
        <label for="categoria_e">Categoria</label>
          <select  tabindex=65 id="categoria_e" name="categoria_e" required>
            <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
            foreach($categorie as $c){
              echo "<option value=".$c['id']."";
              if($c['id'] == $cercato['categoria_id']) echo " selected ";
              echo ">".$c['nome']."</option>";
            }
            ?>
          </select>
          <div class="boxInline">
              <input tabindex=70 type="submit" value="Conferma">
              <input tabindex=80 id="buttonRight" type="reset" value="Annulla">
          </div>
      </form>
    </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
