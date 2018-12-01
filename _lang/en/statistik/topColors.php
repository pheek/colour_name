<?php  $TPL_PAGE_TITLE='Top 20';
  include_once "../wie/ColorGuess.class.php";
  include_once "../wie/DB.class.php";
  include_once "../wie/wie.fct.php";
 ?>
<?php include 'dir.php' ?>
<h2>Die 20 häufigsten Nennungen</h2>
<p>Die folgenden Namen wurden von den Anwendern am
häufigsten eingegeben. 
Für diese Farben kennen wir entweder keine differenzierenden Namen
oder unsere Augen (bzw. Monitore) können dieses Farben nicht
genügend Unterscheiden.</p>
<p>Die Farben sind nach Häufigkeit ihrer Nennungen
sortiert.</p>

<?php
  $db = new DB();
  $topRS = $db->getTop(20);
  $cg = new ColorGuess();
  $actNr = 0;
  echo "<table><tr>";
  while($row = mysql_fetch_assoc($topRS)) {
	if($actNr % 4 == 0) {
		echo "</tr>\n<tr>";
	}
	echo "<td>";
	$cg = $cg->resultToColor($row);
	$cg->dbCount = $row['cnt'];
	$cg->toHTML(true);
	echo "</td>";
	
	$actNr ++;
  }
  echo "</tr></table>\n";
?>

  <p>Selbst aktiv werden: <a href="../wie">Hier klicken</a>.</p>
<p>Interesse an weiteren Auswertungen? Nehmen Sie <a href="../kontakt">hier Kontakt</a> auf.</p>
 