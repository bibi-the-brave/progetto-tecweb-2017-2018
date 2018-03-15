<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  register('filtro');
?>

<html lang="it" >
<head>
  <?= printHead('Cerca'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" onclick="menuOff()">
  <div class="title"><h2>Risultati ricerca</h2></div>
            <div class="content">
  <div class="content">
  <?php $non_trovati_testo =array(); // conterrà i tipi di ricerca che non sono state trovate. es: eventi e luoghi
   ?>
  <h2>Risultati ricerca per '<?php echo $filtro ?>'</h2> <hr/>

    <?php
        $sql="  SELECT eventi.*,categorie.nome AS nome_categoria,categorie.id AS id_categoria
                FROM eventi JOIN categorie ON eventi.categoria_id=categorie.id
                WHERE eventi.nome LIKE '%$filtro%'
        ";
        $eventi=select($sql);
    ?>
    <?php if(sizeof($eventi) > 0): ?>
        <h3>Eventi</h3>
        <div class="tableResponsive"> <table aria-label="<?php echo "Lista degli eventi risultanti dalla ricerca di ".$filtro."\""?> " >
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Durata</th>
                <th scope="col">Spettacoli disponibili</th>
            </tr>
            </thead>
            <tbody>
            <?php //riempimento della tabella
            no_result($eventi,4);
            foreach($eventi as $e){
                echo "<tr>";

                echo "<td scope=\"col\"><a title=\"Vai all'evento\" href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
                echo "</a></td>";

                echo "<td><a title=\"Vai alla categoria\" href=categoria_scheda.php?cat_id=".$e['id_categoria'].">".get_nome_categoria($e['categoria_id']);
                echo "</a></td>";

                echo "<td>".format_durata($e['durata']);
                echo "</td>";

                echo "<td>";
                if(!evento_has_spettacoli($e['id'])) echo "No";
                else echo "Si";
                echo "</td>";
            }
            ?>
            </tbody>
        </table> </div>
        <!-- fine ricerca degli eventi -->
    <?php else: ?>
            <?php array_push($non_trovati_testo,"eventi")?>
    <?php endif ?> 

    
    <?php
        $sql="  SELECT *
                FROM luoghi
                WHERE luoghi.nome LIKE '%$filtro%' OR luoghi.indirizzo LIKE '%$filtro%'
        ";
        $luoghi=select($sql);
    ?>
    <?php if(sizeof($luoghi) > 0): ?>
    <h3>Luoghi</h3>
    <div class="tableResponsive"> <table aria-label=" <?php echo "Lista dei luoghi risultanti dalla ricerca di ".$filtro."\""?> ">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Indirizzo</th>
            <th scope="col">Telefono</th>
        <tr>
        </thead>
        <tbody>
        <?php
        no_result($luoghi,3);
        foreach($luoghi as $l){
            echo "<tr>";

            echo "<td><a title=\"Vai al luogo\" href='luogo_scheda.php?luogo_id=".$l['id']."'>".$l['nome'];
            echo "</a></td>";

            echo "<td>".$l['indirizzo'];
            echo "</a></td>";

            echo "<td>".$l['telefono'];
            echo "</td>";
        }
        ?>
        </tbody>
    </table> </div>
    <?php else: ?>
            <?php array_push($non_trovati_testo,"luoghi")?>
    <?php endif ?>

    <?php
        $sql="  SELECT *
                FROM categorie
                WHERE categorie.nome LIKE '%$filtro%'
        ";
        $categorie=select($sql);
    ?>
    <?php if(sizeof($categorie) > 0): ?>
    <h3>Categorie</h3>
    <div class="borderDl">
    <dl>
        <?php 
        foreach($categorie as $c){
          echo "<dt><a title=\"Vai alla categoria\"  href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> <dd>".$c['descrizione']."</dd>";
        }
        ?>
    </dl>
    </div>
    <?php else: ?>
            <?php array_push($non_trovati_testo,"categorie")?>
    <?php endif ?>
    
    <?php if(sizeof($non_trovati_testo) > 0): ?>
        <p class="searchResult">Nessun risultato in 
        <?php
            if(sizeof($non_trovati_testo) == 1)
                echo $non_trovati_testo[0];
            else{
                echo $non_trovati_testo[0];
                for($i = 1; $i < sizeof($non_trovati_testo)-1; $i++)
                    echo ", ".$non_trovati_testo[$i];
                echo " e ".$non_trovati_testo[sizeof($non_trovati_testo)-1];
            }
        ?>
        che corrisponda a '<?php echo "$filtro"; ?>' è stato trovato</p>
    <?php endif ?>
  
  <!-- fine nel div con class content -->
  </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
