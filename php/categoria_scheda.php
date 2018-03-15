<!DOCTYPE html>
<?php
require_once 'php/config.php';
require_once 'php/printTemplate.php';
register('cat_id');
check($cat_id);
require_categoria_exists($cat_id);
register('filter');
if (isset($tutti) && isset($filter)) {
    $filter = '';
}
$categoria = select(" SELECT * FROM categorie WHERE id = $cat_id ")[0];
?>

<html lang="it" >
  <head>
    <?=printHead(get_nome_categoria($cat_id));?>
  </head>
  <body>

    <header>
      <?=printHeader();?>
    </header>

    <nav id="nav" class="Off">
      <?=printNavBar();?>
    </nav>

    <?php echo consumeMessage(); ?>


    <div id="corpo" onclick="menuOff()">
        <div class="title"><h2><?=$categoria['nome']?></h2></div>
        <div class="content">
        <?php if (is_admin() || is_operatore()): ?>
                <div class="linkDestra">
                    <a <?php echo "title=\"Modifica la categoria " . get_nome_categoria($cat_id) . "\"" ?>

                    href="categoria_mod.php?id_mod=<?php echo $cat_id ?>" >Modifica Categoria</a>
                    <a <?php echo "title=\"Elimina la categoria " . get_nome_categoria($cat_id) . "\"" ?> onclick=' return confirm("Confermi di voler eliminare ?")' href ="categoria_elimina.php?id=<?php echo $cat_id ?>">Elimina Categoria</a>
                </div>
              <?php endif?>
            <p> <?php echo $categoria['descrizione']; ?></p>

            <?=filter_form($filter, 'Cerca un evento')?>

            <?php $sql = "SELECT * FROM eventi WHERE categoria_id=$cat_id ";
if (isset($filter) && $filter != null) {
    $sql .= " AND nome LIKE '%$filter%'";
}

$sql .= " ORDER BY nome";
$eventi = select($sql);
echo "<div style=\"overflow-x:auto;\"> <table aria-label=\"Eventi disponibili per la categoria " . get_nome_categoria($cat_id) . "\"  title=\"Tabella contenente gli disponibili per la categoria " . get_nome_categoria($cat_id) . "\" >";
echo "<thead>";
echo "<tr>";
echo "<th scope=\"col\" class=\"text-center\" >Nome";
echo "</th>";
echo "<th scope=\"col\" class=\"text-center\"   >Durata";
echo "</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
no_result($eventi, 2);
foreach ($eventi as $e) {
    echo "<tr>";
    echo "<td><a  title=\"Vai all'evento " . $e['nome'] . "\" href='evento_scheda.php?evt_id=" . $e['id'] . "'>" . $e['nome'];
    echo "</a></td>";

    echo "<td>" . format_durata($e['durata']);
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table> </div>";
?>

        </div>
    </div>

    <footer>
      <?=printFooter();?>
    </footer>
  </body>
</html>
