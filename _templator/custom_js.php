<?php
	// Dieses Skript wird im htmlheader eingebunden.

	/**
	 * Damit im "head" ein zusätzliches Skript eingefügt werden kann, muss dieses mit
	 *
	 * global $TPL_CUSTOM_JS;
	 * $TPL_CUSTOM_JS[sizeof($TPL_CUSTOM_JS)] = "kontakt/js/abc.js";
	 *
	 * deklariert (genauer: hinzugefügt) werden.
	 * Der Pfad ist relativ zum Projektverzeichnis anzugeben (also immer volle
	 * Pfadangaben sind notwendig.
	 */
	global $TPL_CUSTOM_JS;
	if(isset($TPL_CUSTOM_JS)) {
		foreach($TPL_CUSTOM_JS as $jsFileName) {
			echo '		<script type="text/javascript" src="' .
			 $TPL_PATHS->getClientRoot() . "/" . $jsFileName . '"></script>' . "\n";
		}
	}
 ?>