<?php   
    global $TPL_CUSTOM_JS;
    $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)]        =  "kontakt/js/dom/domHelper.js";
    $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)]        =  "kontakt/js/handlers.js";
    $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)]        =  "kontakt/js/mail.js";
    
    global $TPL_CUSTOM_CSS;
    #add another CSS in the header by expanding the actual array by 1 (one) element.
    $TPL_CUSTOM_CSS[sizeof($TPL_CUSTOM_CSS)] = "kontakt/css/contact.css";
    global $STOER_FARBE;
    $STOER_FARBE = false;
    
    include "dir.php"; 
 ?>
