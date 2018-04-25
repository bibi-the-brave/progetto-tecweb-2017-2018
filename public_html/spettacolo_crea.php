<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
if(!is_admin() && !is_operatore() && !is_gestore_luogo()){
    message('Area riservata',2);
    redirect('home.php');
    die();  // prevengo che il resto della pagina sia caricato
}
?>

<html lang="it" >
<head>
  <?= printHead('Crea nuovo spettacolo'); ?>
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
      <div class="title"><h2>Crea nuovo spettacolo</h2></div>
      <div class="box">

    <form action="spettacolo_crea_r.php" method="POST">
        <label for="evento_s">Evento</label> 
        <select tabindex=10 id="evento_s" name="evento_s" required>
            <?php $eventi = select("SELECT * FROM eventi ORDER BY nome ASC");
            echo "<option value=\"\">Scegli evento</option>";
            foreach($eventi as $e){
                echo "<option value=".$e['id'].">".$e['nome']."</option>";
            }
            ?>
        </select>
        
        <?php if(is_admin() || is_operatore()): ?>
        <!-- se sei admin o operatore puoi scegliere dove mettere lo spettacolo -->
            <label for="luogo_s">Luogo</label>
            <select tabindex=20  id="luogo_s" name="luogo_s" required>
                <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                echo "<option value=\"\">Scegli luogo</option>";
                foreach($luoghi as $l){
                    echo "<option value=".$l['id'].">".$l['nome']."</option>";
                }
                ?>
            </select>
        <?php else: ?>
                <!-- sei la'mministratore del luogo e dunque non puoi decidere dove metterlo -->
                <?php
                    $id_luogo_amministrato = id_luogo_amministrato($_SESSION['user_id']);
                ?>
                <input tabindex=30 type="hidden" id="luogo_s" name="luogo_s" value=<?php echo $id_luogo_amministrato; ?> />
        <?php endif ?>

        <label for="data_s">Data</label>
        <input tabindex=40 type="date" id="data_s" name="data_s" required/>
        <label for="ora_s">Orario di inizio</label>
        <input tabindex=50 type="time" id="ora_s" name="ora_s" required/>
        <label for="posti_s">Posti disponibili</label>
        <input tabindex=60 type="number" id="posti_s" name="posti_s" value=0 min="0" required/>
        <label for="costo_s">Costo spettacolo</label>
        <input tabindex=70 type="number" step="0.01" id="costo_s" name="costo_s" value="0.0" required/>
        <div class="boxInline">
            <input tabindex=80 type="submit" value="Conferma">
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
