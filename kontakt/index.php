<?php
	global $TPL_CUSTOM_JS ;
	$TPL_CUSTOM_JS[]  =  "kontakt/js/dom/domHelper.js";
	$TPL_CUSTOM_JS[]  =  "kontakt/js/handlers.js"     ;
	$TPL_CUSTOM_JS[]  =  "kontakt/js/mail.js"         ;

	global $TPL_CUSTOM_CSS;
	$TPL_CUSTOM_CSS[] = "kontakt/css/contact.css"     ;

	global $STOER_FARBE;
	$STOER_FARBE = false;


	global $TPL_NO_LANG_FOLDER;
	$TPL_NO_LANG_FOLDER = true;

	include_once "dir.php";
 ?>


<?php

	include_once "mailchecker.php";


include_once "mail_functions.php";

mail_steuerung();

?>