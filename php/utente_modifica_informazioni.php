<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');
check($id_u);
require_utente_exists($id_u);

//non solo devi essere loggato ma l'id della pagina deve essere il tuo
require_proprietario($id_u);
?>

<html lang="it" >
<head>
  <?= printHead('Modifica le tue informazioni'); ?>
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
      $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
      ?>
      <div class="title"><h2>Modifica le tue informazioni, <?php echo $user['username']; ?></h2></div>
      <div class="box">

    <form method='POST' action='utente_modifica_informazioni_r.php'>
        <label for="nome">Nome:</label>
        <input tabindex=10 id="nome" type='text' value="<?php echo $user['nome']; ?>" name='nome_u'>

        <label for="cognome">Cognome</label>
        <input tabindex=20 id="cognome" type='text' value="<?php echo $user['cognome']; ?>" name='cognome_u'>

        <label for="email" lang="en">Email</label>
        <input tabindex=30 id="email" type='email' value="<?php echo $user['email']; ?>" name='email_u'>

        <input type="hidden" value="<?php echo $user['id']; ?>" name='id_u'>
        <div class="boxInline">
          <input tabindex=40  type='submit' value='Conferma'>
          <input tabindex=50 id="buttonRight" type='reset' value='Annulla'>
        </div>
    </form>


  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
