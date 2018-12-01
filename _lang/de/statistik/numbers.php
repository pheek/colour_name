<?php
  require_once $TPL_PATHS->getServerRoot() .  "statistik/nominations.fct.php";
 ?>

<?php
  echo $TPL_LANG->getText('statistik.totNumberOfNominations') . ": ";
  $tot = getTotalNominations();
  echo $tot;
  echo "<br />\n";
  echo $TPL_LANG->getText('statistik.totNumberOfColourNames') . ": ";
  $tot = getTotalOfNames();
  echo $tot;
?>
