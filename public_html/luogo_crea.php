<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Crea nuovo luogo'); ?>
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
      <div class="title"><h2>Crea nuovo luogo</h2></div>
    <div class="box">

    <form name="creazioneluogo" action="luogo_crea_r.php" method="POST">
      <fieldset>
      <legend>Informazioni sul luogo</legend>
        <label for="nome_l">Nome</label>
        <input tabindex="10" type="text" placeholder="Inserisci il nome del luogo" maxlength=50 id="nome_l" name="nome_l" required/>

        <label for="via_l">Via</label>
        <input tabindex="20"  placeholder="Es: Via Marconi" type="text" id="via_l" name="via_l" required/>
        <label for="numero_l">Numero</label>
        <input tabindex="30" type="number" id="numero_l" name="numero_l" min="1" required>
        <label for="citta_l">Città</label>
        <input tabindex="40" placeholder="Es: Padova"  type="text" id="citta_l" name="citta_l" required/>
        <label for="provincia_l">Provincia</label>
        <select tabindex="50" id="provincia_l" name="provincia_l">
          <option value="ag">Agrigento</option>
          <option value="al">Alessandria</option>
          <option value="an">Ancona</option>
          <option value="ao">Aosta</option>
          <option value="ar">Arezzo</option>
          <option value="ap">Ascoli Piceno</option>
          <option value="at">Asti</option>
          <option value="av">Avellino</option>
          <option value="ba">Bari</option>
          <option value="bt">Barletta-Andria-Trani</option>
          <option value="bl">Belluno</option>
          <option value="bn">Benevento</option>
          <option value="bi">Biella</option>
          <option value="bo">Bologna</option>
          <option value="bz">Bolzano</option>
          <option value="bs">Brescia</option>
          <option value="br">Brindisi</option>
          <option value="ca">Cagliari</option>
          <option value="cl">Caltanissetta</option>
          <option value="cb">Campobasso</option>
          <option value="ci">Carbonia-Iglesias</option>
          <option value="ce">Caserta</option>
          <option value="ct">Catania</option>
          <option value="cz">Catanzaro</option>
          <option value="ch">Chieti</option>
          <option value="co">Como</option>
          <option value="cs">Cosenza</option>
          <option value="cr">Cremona</option>
          <option value="kr">Crotone</option>
          <option value="cn">Cuneo</option>
          <option value="en">Enna</option>
          <option value="fm">Fermo</option>
          <option value="fe">Ferrara</option>
          <option value="fi">Firenze</option>
          <option value="fg">Foggia</option>
          <option value="fc">Forl&igrave;-Cesena</option>
          <option value="fr">Frosinone</option>
          <option value="ge">Genova</option>
          <option value="go">Gorizia</option>
          <option value="gr">Grosseto</option>
          <option value="im">Imperia</option>
          <option value="is">Isernia</option>
          <option value="sp">La spezia</option>
          <option value="aq">L'aquila</option>
          <option value="lt">Latina</option>
          <option value="le">Lecce</option>
          <option value="lc">Lecco</option>
          <option value="li">Livorno</option>
          <option value="lo">Lodi</option>
          <option value="lu">Lucca</option>
          <option value="mc">Macerata</option>
          <option value="mn">Mantova</option>
          <option value="ms">Massa-Carrara</option>
          <option value="mt">Matera</option>
          <option value="vs">Medio Campidano</option>
          <option value="me">Messina</option>
          <option value="mi">Milano</option>
          <option value="mo">Modena</option>
          <option value="mb">Monza e della Brianza</option>
          <option value="na">Napoli</option>
          <option value="no">Novara</option>
          <option value="nu">Nuoro</option>
          <option value="og">Ogliastra</option>
          <option value="ot">Olbia-Tempio</option>
          <option value="or">Oristano</option>
          <option value="pd">Padova</option>
          <option value="pa">Palermo</option>
          <option value="pr">Parma</option>
          <option value="pv">Pavia</option>
          <option value="pg">Perugia</option>
          <option value="pu">Pesaro e Urbino</option>
          <option value="pe">Pescara</option>
          <option value="pc">Piacenza</option>
          <option value="pi">Pisa</option>
          <option value="pt">Pistoia</option>
          <option value="pn">Pordenone</option>
          <option value="pz">Potenza</option>
          <option value="po">Prato</option>
          <option value="rg">Ragusa</option>
          <option value="ra">Ravenna</option>
          <option value="rc">Reggio di Calabria</option>
          <option value="re">Reggio nell'Emilia</option>
          <option value="ri">Rieti</option>
          <option value="rn">Rimini</option>
          <option value="rm">Roma</option>
          <option value="ro">Rovigo</option>
          <option value="sa">Salerno</option>
          <option value="ss">Sassari</option>
          <option value="sv">Savona</option>
          <option value="si">Siena</option>
          <option value="sr">Siracusa</option>
          <option value="so">Sondrio</option>
          <option value="ta">Taranto</option>
          <option value="te">Teramo</option>
          <option value="tr">Terni</option>
          <option value="to">Torino</option>
          <option value="tp">Trapani</option>
          <option value="tn">Trento</option>
          <option value="tv">Treviso</option>
          <option value="ts">Trieste</option>
          <option value="ud">Udine</option>
          <option value="va">Varese</option>
          <option value="ve">Venezia</option>
          <option value="vb">Verbano-Cusio-Ossola</option>
          <option value="vc">Vercelli</option>
          <option value="vr">Verona</option>
          <option value="vv">Vibo valentia</option>
          <option value="vi">Vicenza</option>
          <option value="vt">Viterbo</option>
        </select>

        <label for="telefono_l">Telefono</label>
        <input placeholder="es: 320 123 4567" tabindex="60" type="tel" maxlength=40 id="telefono_l" name="telefono_l" required/>
      </fieldset>
      <fieldset>
        <legend>Profilo dell'amministratore del luogo</legend>
        <label for="username_r">Username</label>
        <input tabindex="70" type="text" id="username_r" name="username_r" REQUIRED>
        <label for="password_r">Password</label>
        <input tabindex="80"  type="password" id="password_r" name="password_r" REQUIRED>
        <label for="nome_r">Nome</label>
        <input tabindex="90" type="text" id="nome_r" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
        <label for="cognome_r">Cognome</label>
        <input tabindex="100" type="text" id="cognome_r" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>

        <label for="email_r">Email</label>
        <input tabindex="110" type="email" id="email_r" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
        <input type="hidden"  name="tipo_r" value="L">
      </fieldset>
        <div class="boxInline">
            <input tabindex="120" type="submit" value="Conferma" onclick="return phonenumber(document.creazioneluogo.telefono_l)">
            <input tabindex="130" id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
    </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
