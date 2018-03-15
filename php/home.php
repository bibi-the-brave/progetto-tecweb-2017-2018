<!DOCTYPE html>

<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Home'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar("home.php"); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
    <div class="title"><h2>Home</h2></div>
      <div class="content">
      <h3>Informazioni</h3>
      <p>Benvenuto su BiglietteriaOnline, il portale che ti permette di prenotare online biglietti per <a title="Vai alla sezione eventi" href="eventi.php">eventi</a> di varie <a title="Vai alla sezione categorie" href="categorie.php">categorie</a>. Per maggiori informazioni consulta la sezione <a title="Vai alla sezione Informazioni" href="info.php"><abbr title="Informazioni">info</abbr></a>
      </p>

      <h3>Prossimi eventi in programma</h3>
<?php 
$sql = "
		SELECT eventi.nome AS nome_evento, eventi.id AS id_evento,
			spettacoli.id AS id_spettacolo,
			spettacoli.posti_disponibili AS posti_spettacolo,
	    spettacoli.data_ora AS data_ora,
	    luoghi.nome AS nome_luogo, luoghi.id AS id_luogo
	  FROM eventi JOIN spettacoli ON eventi.id = spettacoli.evento_id
		      JOIN luoghi ON luoghi.id = spettacoli.luogo_id
	  WHERE spettacoli.data_ora >= NOW() 
	    AND spettacoli.posti_disponibili > 0 
	  ORDER BY spettacoli.data_ora ASC
	  LIMIT 6";
$prossimi_eventi = select($sql); //seleziona solamente eventi che hanno spettacoli, 6 al più e li ordina sulla data in modo descrescente
?>

  <div class="tableResponsive">
		<table aria-label="Prossimi eventi programmati prenotabili sul nostro sito" title="La tabella contiene i prossimi sei eventi programmati, in ordine cronologico, prenotabili attraverso il nostro sito">
		<thead>
			<tr>
				<th scope="col">Evento</th>
				<th scope="col">Luogo</th>
				<th scope="col">Data</th>
				<th scope="col">Prenota</th>
			</tr>
		</thead>
		<tbody>
				<?php 
				no_result($prossimi_eventi, 4);
				foreach($prossimi_eventi as $e) {
					echo "<tr>
								<td><a title=\"Vai all'evento ".$e['nome_evento']."\" href=\"evento_scheda.php?evt_id=".$e['id_evento']."\">".$e['nome_evento']."</a></td>
								<td><a title=\"Vai al luogo ".$e['nome_luogo']."\" href=\"luogo_scheda.php?luogo_id=".$e['id_luogo']."\">".$e['nome_luogo']."</a></td>
								<td>".format_data_ora($e['data_ora'])."</td>
								";	
						print_form_prenotazione($e['id_spettacolo'],((isset($_SESSION) && isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : null),$e['posti_spettacolo'],$e['nome_evento'],$e['data_ora'], $e['nome_luogo']);
					
					echo"</tr>";
				}
			?>
		</tbody>
  </table> </div>

			<h3>Categorie disponibili</h3>
			<div class="borderDl">
      <dl>
			
<?php $categorie = select("
	SELECT *
	FROM categorie
	ORDER BY nome
	");
	foreach($categorie as $c){
		echo "<dt><a title=\"Vai alla categoria ".$c['nome']."\"  href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> 
					<dd>".$c['descrizione']."</dd>";
	}
	?>
			</dl>
</div>

<a href="#" class="rightLink">Torna su &#9650;</a>

    </div>
  </div>

	
<footer>
  <?= printFooter(); ?>
</footer>
</body>
</html>
