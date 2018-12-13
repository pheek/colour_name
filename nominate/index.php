<?php
	// Dies kann nicht erst nach "dir.php" geschehen, denn
	// das Layout benötigt diese Info bereits!
	global $HAS_TO_BE_GRAY;
	$HAS_TO_BE_GRAY = (isset($_POST['next_color']) || (! isset($_POST['color_name'])));

	global $TPL_CUSTOM_JS;
	$TPL_CUSTOM_JS[] = 'nominate/js/disableButtons.js';

	global $TPL_CUSTOM_BODY_ONLOAD;
	$TPL_CUSTOM_BODY_ONLOAD = 'disableButtons()';

	global $TPL_NO_LANG_FOLDER;
	$TPL_NO_LANG_FOLDER = true;
	include "dir.php";

	global $TPL_PATHS;
	require_once $TPL_PATHS->getServerRoot() . '/nominate/helper.fct.php';
	affenFormularSteuerung();

 ?>