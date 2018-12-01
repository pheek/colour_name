<?php

class InsertNomination {

  private $tpl_db;

  function __construct() {
    global $TPL_DB;
    if(! isset($TPL_DB)) {
        require_once '../db/DB.class.php';
    }
    //echo "DEBUG ". $TPL_DB->toString();
    $this->tpl_db = $TPL_DB;
  }

  // Funktionen zum Einfügen einer Nomination in die DB.
    // should be called form InsertNomination($nomination)
    // There, all the values have to be calculated first.
  private function insertNominationValues($rgbID, $nameID, $netzhautID, $mediumID, $ipV4ID, $sqlZeitString, $lang) {
     $sql = 'INSERT INTO nomination ' .
           '(F_rgb,             F_farbnamen,     F_netzhaut,       F_medium,         F_ipV4,       Zeit, F_sprache)' .
           ' VALUES ' .
           '(' . $rgbID . ',' . $nameID . ',' .  $netzhautID .','. $mediumID . ',' . $ipV4ID .',"'. $sqlZeitString . '","' . $lang . '")';

     $this->tpl_db->insert($sql);
 }

  public function insertNomination($nomination) {
    $col = $nomination->getColour();
    $r = $col->getRed();
    $g = $col->getGreen();
    $b = $col->getBlue();
    $rgbID = $this->getRGBID($r, $g, $b);
    
    $nameID = $this->getNameID($nomination->getName());

    $ipV4 = $this->getIPV4ID($nomination->getIP());

    $sqlTime = $nomination->getSQLTimestamp();

    $this->insertNominationValues($rgbID, $nameID, $nomination->getNetzhaut(), 
                                  $nomination->getMedium(), $ipV4, $sqlTime, $nomination->getLang());
  }
 
  function getRgbID($r, $g, $b) {
    $sql = 'SELECT `ID` FROM `rgb` WHERE R = "' . $r . '" AND G = "' . $g . '" AND B = "' . $b . '"';

    $id = $this->tpl_db->getSelectValue($sql);
    if($id >= 1) return $id;

    $sqli = 'INSERT INTO `rgb` (`R`, `G`, `B`) VALUES (' . $r . ', ' . $g . ', ' . $b . ')';

    $id = $this->tpl_db->insertAndGetInsertedID($sqli, "rgb");
    return $id;
 }

 function getIPV4ID($ipV4String) {
		$iparr   = explode(".", $ipV4String);
    //DEBUG: echo "getIPV4ID: iparr = "; var_dump($iparr);
		// convert to 32 bit int.
		$ipNr  = (((($iparr[0] * 256) + $iparr[1]) * 256) + $iparr[2]) * 256 + $iparr[3];

    $sql = 'SELECT `ID` FROM `ipV4` WHERE v4Int = "' . $ipNr . '"';

    $id = $this->tpl_db->getSelectValue($sql);
    if($id >= 1) return $id;

    $sqli = 'INSERT INTO `ipV4` (`v4Int`) VALUES (' . $ipNr . ')';

    $id = $this->tpl_db->insertAndGetInsertedID($sqli, "ipV4");
    return $id;
 }

 // Name must already be "quoted" or removed by any quotes.
 function getNameID($name) {
    $sql = 'SELECT `ID` FROM `farbnamen` WHERE Name = "' . $name . '"';

    $id = $this->tpl_db->getSelectValue($sql);
    if($id >= 1) return $id;

    
    $sqli = 'INSERT INTO `farbnamen` (`Name`) VALUES ("' . $name . '")';

    
    if(strstr($name, '\'')) {
    //  $name = ereg_replace("/\'/\\\\'/", $name);
      $name = addslashes($name);
      //echo "DEBUG: quoted name: (" . $name . ")<br/>\n";
      $sqli = 'INSERT INTO `farbnamen` (`Name`) VALUES ("' . $name . '")';
      //echo "quoted SLQ: " . $sqli . "<br />\n";  
    }
    
    $id = $this->tpl_db->insertAndGetInsertedID($sqli, "farbnamen");
    return $id;
 }

 
} // end class InsertNomination
?>