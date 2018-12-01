 
<form method="post"> <!-- no action due to "affenformular" -->
 <?php global $TPL_LANG; $TPL_LANG->echoText('statistik.stat.average.title');?>:
 <input id="txtFld"   type="text" 
        onfocus="disableButtons()"
        onkeyup="disableButtons()" name="col_by_name" size="50" />
 <input id="dButton1" type="submit" value="<?php $TPL_LANG->echoText('statistik.stat.average.quest'); ?>" />
</form>

<?php

  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . '/statistik/ColorStatistics.class.php';
  global $TPL_LANG;
  
  if(array_key_exists('col_by_name', $_POST)) {
    $colcol = $_POST['col_by_name'];
  } else {
    $colcol = $TPL_LANG->getText('red');
  }
  echo "<h2>". $TPL_LANG->getText('statistik.stat.average.overview') . " \"" .  $colcol . "\"</h2>\n";
  $name = $colcol; 
  $cs   = new ColorStatistics;
  $averageCS = $cs->fullTableByName($name); 
  $averageHEX = $averageCS->getColor()->getHEX();
?>

<?php 
  $TPL_LANG->echoText('statistik.stat.byName.tineye.images');
  echo ': <a target="_blank" href="http://labs.tineye.com/multicolr#colors=' . $averageHEX . ';weights=100;">' . $TPL_LANG->getText('statistik.stat.byname.tineye.TINEYE') . '</a>';
  ?>