<!DOCTYPE html>
<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
/*
invia in post:
username_r
password_r
nome_r
cognome_r
tipo_r
*/
?>

<html lang="it" >
<head>
  <?= printHead('Registrazione'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>


  <nav id="nav" class="Off">
      <?= printNavBar("registrazione.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()" >
      <div class="title"><h2>Registrazione</h2></div>
      <div class="box">
        <form action="registrazione_r.php" method="POST" name="form">
          <label lang="en" for="username">Username</label>
          <input tabindex="10" id="username" type="text" name="username_r" REQUIRED />
          
          <label lang="en" for="password">Password</label>
          <input tabindex="20" id="password" type="password" name="password_r" REQUIRED />

          <label for="nome">Nome</label>
          <input tabindex="30" id="nome" type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>

          <label for="cognome">Cognome</label>
          <input tabindex="40" id="cognome" type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>

          <label lang="en" for="email">Email</label>
          <input tabindex="50" id="email" type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>

          <input type="hidden" name="tipo_r" value="U"><hr>
          <div class="boxInline">
            <input tabindex="60" type="submit" value="Completa registrazione">
            <input tabindex="70" id="buttonRight" type="reset" value="Azzera campi">
          </div>
        </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
