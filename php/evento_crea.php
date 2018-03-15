<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Crea nuovo evento'); ?>
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
      <div class="title"><h2>Crea nuovo evento</h2></div>
      <div class="box">

    <form action="evento_crea_r.php" method="POST">

        <label for="nome_e">Nome</label>
        <input tabindex=10 name="nome_e" id="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
        <label for="descrizione_e">Descrizione</label>
        <textarea tabindex=20 id="descrizione_e" name="descrizione_e"></textarea>
        
        <fieldset>
        <legend>Durata</legend>
        <input tabindex=30 type="radio" aria-label="Durata evento" name="durata_e" value="finita"  onchange="writeDurata()" checked/> Finita <br />
        <div id="durataFinita">
          <label for="ore_e">Ore</label>
          <input tabindex="40" id="ore_e" name="ore_e" placeholder="Ore" type="number" min="0" required/>
          <label for="minuti_e">Minuti</label>
          <input tabindex="50" id="minuti_e" name="minuti_e" placeholder="Minuti" type="number" min="0" max="59" required/>
        </div>
        <input tabindex="60" type="radio" aria-label="Durata evetno" name="durata_e" value="fullday" onclick="deleteDurata()" /> Tutto il giorno <br />

        </fieldset>

        <label for="categoria_e">Categoria</label>
        <select tabindex=70 id="categoria_e" name="categoria_e" required>
            <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
            echo "<option value=\"\">Scegli categoria</option>";

            foreach($categorie as $c){
                echo "<option value=".$c['id'].">".$c['nome']."</option>";
            }
            ?>
        </select>
        <div class="boxInline">
            <input tabindex=80  type="submit" value="Conferma">
            <input tabindex=90 id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
