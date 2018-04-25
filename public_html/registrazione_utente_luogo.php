<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Nuovo amministratore di luogo'); ?>
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
      <div class="title"><h2>Aggiungi nuovo utente amministratore di luogo</h2></div>
      <div class="box">
          <form action="registrazione_utente_luogo_r.php" method="POST" name="form">
                <label for="username_r">Username</label>
                <input tabindex=10 type="text" id="username_r" name="username_r" REQUIRED>
                <label for="password_r">Password</label>
                <input tabindex=20 type="password" id="password_r" name="password_r" REQUIRED>
                <label for="nome_r">Nome</label>
                <input tabindex=30 type="text"  id="nome_r" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
                <label for="cognome_r">Cognome</label>
                <input tabindex=40 type="text"  id="cognome_r" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>
                <label for="email_r">Email</label>
                <input tabindex=50 type="email"  id="email_r" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
                <label for="luogo_r">Luogo</label>
                <select tabindex=60  id="luogo_r" name="luogo_r" required>
                    <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                    echo "<option value=\"\">Scegli luogo</option>";


                    foreach($luoghi as $l){
                        echo "<option value=\"".$l['id']."\">".$l['nome']."</option>";
                    }
                    ?>
                    <?php
                        $_SESSION['messaggio_registrazione'] = "Amministratore di luogo aggiunto correttamente";
                        $_SESSION['redirect_registrazione'] = "utente_scheda.php?id_u=".$_SESSION['user_id'];
                    ?>
                  </select>
                <input type="hidden" name="tipo_r" value="L">
              <div class="boxInline">
                <input tabindex=70 type="submit" value="Completa registrazione">
                <input tabindex=80 id="buttonRight" type="reset" value="Azzera campi">
              </div>
          </form>
      </div>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
