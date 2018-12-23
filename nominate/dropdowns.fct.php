<?php
/**
 * Diese Funktionen erzeugen (via SQL) die Texte (inkl. IDs) für die Dropdowns.
 * (c) 2008-2018 phi@gress.ly
 */

//echo "dropdowns included";
	global $TPL_PATHS;
	require_once $TPL_PATHS->getServerRoot() . "db/DB.class.php";

	require_once $TPL_PATHS->getServerRoot() . '_lang/LangBundle.class.php';
	//global $TPL_LANG;


	function getDropDown($sql, $name, $selectedID) {
		//echo "debug: selectedID" . $selectedID;
		global $TPL_LANG;

		if("medium_dd" == $name && ($selectedID < 1 || "none" == $selectedID)) {
			$selectedID = 1;
		}

		$pleaseSelect = $TPL_LANG->getText('nominate.dropdown.pleaseselect');

		$drdo  = '<select onchange="disableButtons();" id="'.$name.'" name="' . $name . '">'. "\n" . 
		         '<option value="none">' . $pleaseSelect . '</option>';
		global $TPL_DB;

		$result = $TPL_DB->getLangSelectResult($sql);

		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			if($selectedID == $row[0]) {
				$drdo .= '<option selected="selected" value="' . $row[0] . '">' . $row[1] . '</option>' . "\n"; 
			} else {
				$drdo .= '<option value="' . $row[0] . '">' . $row[1] . '</option>' . "\n"; 
			}
		}
		$drdo .= "</select>\n";
		return $drdo;
	}

	function getNetzhautDropDown() {
		$nomination = getBean('Nomination');
		$sql = 'SELECT `netzhaut`.`ID`, `Text` FROM `netzhaut`, `text` ' .
		       'WHERE  `netzhaut`.`F_Begriff` = `text`.`F_Begriff` AND ' .
		       '`F_sprache` = \'#LANG#\' ORDER BY `sortOrder`';
		return getDropDown($sql, "netzhaut_dd", $nomination->getNetzhaut());
	}

	function getMediumDropDown() {
		$nomination = getBean('Nomination');
		$sql = 'SELECT `medium`.`ID`, `Text` FROM `medium`, `text` ' .
		       'WHERE  `medium`.`F_Begriff` = `text`.`F_Begriff` AND ' .
		       '`F_sprache` = \'#LANG#\' ORDER BY `sortOrder`';
		return getDropDown($sql, "medium_dd", $nomination->getMedium());
	}

?>