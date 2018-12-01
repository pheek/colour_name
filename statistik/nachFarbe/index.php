<?php  
  
  global $TPL_CUSTOM_JS;
  $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)] = 'statistik/js/jq.js';
  $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)] = 'statistik/js/farbtastic/farbtastic.js';
  $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)] = 'statistik/js/ids.js';
  
  global $TPL_CUSTOM_CSS;
  $TPL_CUSTOM_CSS[sizeof($TPL_CUSTOM_CSS)] = 'statistik/js/farbtastic/farbtastic.css';

  include "dir.php"; 
?>
