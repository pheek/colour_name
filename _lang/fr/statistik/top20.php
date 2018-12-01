<?php
  require_once $TPL_PATHS->getServerRoot() .  "statistik/nominations.fct.php";
 ?>

<p><?php global $TPL_LANG; $TPL_LANG->echoText('statistik.stat.top20.desc'); ?></p>
<?php
  printTop20Raster();
?>
