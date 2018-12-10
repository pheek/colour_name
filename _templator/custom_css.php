<?php 
  // Dieses Skript wird im htmlheader eingebunden.

  /**
   * Damit im "head" ein weiteres CSS eingefügt werden kann, muss dieses mit
   *
   * global $TPL_CUSTOM_CSS;
   * $TPL_CUSTOM_CSS[] = "kontakt/css/abc.css";
   *
   * deklariert (genauer: hinzugefügt) werden.
   */
  global $TPL_CUSTOM_CSS;
  if(isset($TPL_CUSTOM_CSS)) {
    echo "\n";
    foreach($TPL_CUSTOM_CSS as $cssFileName) {
        //TODO: add Client path.
        echo '		<link rel="stylesheet" type="text/css" href="' . 
              $TPL_PATHS->getClientRoot() . "/" . $cssFileName.'"/>' . "\n";
    }
  }  
?>