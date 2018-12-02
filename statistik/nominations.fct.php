<?php

  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . "db/DB.class.php";
  require_once $TPL_PATHS->getServerRoot() . "domain/Color.class.php";
  require_once $TPL_PATHS->getServerRoot() . "statistik/ColorStatistics.class.php";

  /**
   * Gib die Totale anzahl von Nominationen zu einer Sprache:
   * Wie oft wurde auf "OK" geklickt.
   * @global Database $TPL_DB
   * @param string $lang soll nur zu einer Sprache gemacht werden.
   * @return int Anzahl den Nominationen zu einer Sprache.
   */
  function getTotalNominations($lang = "") {
    $selectNominationsCount = 'SELECT count( `ID` ) FROM `nomination` WHERE `F_Sprache`="#LANG#"';
    //    echo "DEBUG nominations.fct.php . getTotalNominatons Lang= " . $lang . "<br />\n";
    //echo "DEBUG nominations.fct.php . getTotalNominatons SQL = " . $selectNominationsCount . "<br />\n";

    global $TPL_DB;
    return $TPL_DB->getLangSelectValue($selectNominationsCount, $lang);
  }
  
  /**
   * Wie viele Farbenamen wurden in einer Sprache vergeben.
   * Dies sind natürlich viel weniger als die Nominationen, denn viele Namen werden mehrfach vergeben.
   * 
   * @global Database $TPL_DB
   * @param string $lang, "de", "en", ...
   * @return int Anzahl der Farbnamen zu einer Sprache
   */
  function getTotalOfNames($lang = "") {
    /*
    $selectNameCount        = 'SELECT COUNT(anzahl) FROM (SELECT COUNT(`farbnamen`.`Name`) as anzahl ' .
                            'FROM `farbnamen`, `nomination` ' .
                            'WHERE `farbnamen`.`ID` = `nomination`.`F_farbnamen` ' .
                              'AND `nomination`.`F_Sprache` = "#LANG#" '.
                            'GROUP BY `farbnamen`.`Name`) as summen;';
    */ 
    /* Ist folgendes schneller? */
    $selectNameCount = 'SELECT COUNT(Name) ' .
                       'FROM ' .
                       ' (SELECT DISTINCT Name ' . 
                       '  FROM `farbnamen`, `nomination` ' .
                       '  WHERE  `farbnamen`.`ID`=`nomination`.`F_farbnamen` ' .
                       '    AND  `nomination`.`F_Sprache`="#LANG#") ' .
                       '  AS sub'; 
    global $TPL_DB;
    return $TPL_DB->getLangSelectValue($selectNameCount, $lang);
  }
  
  
 
  
  
  /**
   * Nächste Farben zu gegebenem RGB Wert (und Sprache). 
   * Der Abstand wir mit Pythagoras (sqrt (dr^2, dg^2, db^2)) berechnet.
   * This function is very time consuming.
   * that the system can not easyly attacked by a DNS, a sleep of 3 seconds
   * is included.  
   * @param int $r
   * @param int $g
   * @param int $b
   * @param string $lang "de", "en" etc.
   * @return "mysql_resultset": Name, cnt, r, g, b, abstand
   */
  function getNearestColours($r, $g, $b, $lang="") {
    //sleep(3);

	  $sel = 'SELECT * FROM (SELECT `farbnamen`.`Name`, count(`farbnamen`.`Name`) as cnt,'.
		  'round(avg(`rgb`.`R`)) as r, round(avg(`rgb`.`G`)) as g, round(avg(`rgb`.`B`)) as b, '.
		  'avg(('.
		  '(cast(`rgb`.`R` as signed)-'.$r.')*(cast(`rgb`.`R` as signed)-'.$r.') + '.
		  '(cast(`rgb`.`G` as signed)-'.$g.')*(cast(`rgb`.`G` as signed)-'.$g.') + '.
		  '(cast(`rgb`.`B` as signed)-'.$b.')*(cast(`rgb`.`B` as signed)-'.$b.'))) as abstand '.
		  'FROM `farbnamen`, `rgb`, `nomination` '.
		  'WHERE `farbnamen`.`ID` = `nomination`.`F_farbnamen` AND `nomination`.`F_rgb` = `rgb`.`ID` AND '.
		  '`nomination`.`F_Sprache` = "'.$lang.'" '.
		  'GROUP BY Name ORDER BY `abstand` ASC) '.
		  'AS nahe WHERE cnt > 3 LIMIT 7';

	  global $TPL_DB;

     return $TPL_DB->getLangSelectResult($sel, $lang);
   }
   
   /**
    * Gib den durchschnittlichen rgb-Wert 
    * @global Database $TPL_DB
    * @param String $name Name der Sprache z. B. "de"
    * @param String $lang Sprache "de", "en", ...
    * @param INT (oder "%") $netzhaut %-> Alle, 1: Weiblich 2: männlich
    * @return mysql-resultset mit einer Zeile "anzahl: int; r, g, b (je float)"
    */
   function averageRGB($name, $lang = "", $netzhaut = '%') {
     $sel = 'SELECT count(`rgb`.R) as anzahl, avg(`rgb`.R) as r, avg(`rgb`.G) as g, avg(`rgb`.B) as b ' .
            'FROM `nomination`, `rgb`, `farbnamen` ' .
            'WHERE `nomination`.`F_farbnamen`=`farbnamen`.`ID` AND ' .
            '`farbnamen`.`Name`="'.$name.'" AND ' .
            '`nomination`.`F_rgb`=`rgb`.`ID` AND ' .
            '`nomination`.`F_Sprache` = "'.$lang.'" AND ' .
            '`nomination`.`F_Netzhaut` LIKE "'.$netzhaut.'"';
     
     global $TPL_DB;
     return $TPL_DB->select($sel);
   }
   
   function getTop20ResultSet($lang) {
     $sel = 'SELECT `farbnamen`.`Name` , `farbnamen`.`ID` AS id, count( `nomination`.`F_farbnamen` ) AS anzahl, round( avg( `rgb`.`R` ) ) AS r, round( avg( `rgb`.`G` ) ) AS g, round( avg( `rgb`.`B` ) ) AS b ' .
            'FROM `nomination` , `farbnamen` , `rgb` ' .
            'WHERE `farbnamen`.`ID` = `nomination`.`F_farbnamen` ' .
            'AND `nomination`.`F_Sprache` = "' .$lang. '" ' .
            'AND `nomination`.`F_rgb` = `rgb`.`ID` ' .
            'GROUP BY `farbnamen`.`Name`, `farbnamen`.`ID` '.
            'ORDER BY anzahl DESC LIMIT 0 , 20 ';
     global $TPL_DB;
//     echo $sel;
     return $TPL_DB->select($sel);
   }
   
   /**
    *Helper for "printTop20Raster
    * @param type $specialColor 
    */
   function echoColorBox($specialColor) {
     $cs = new ColorStatistics();
     $col = new Color();
     $col->setRed  ($specialColor['r']);
     $col->setGreen($specialColor['g']);
     $col->setBlue ($specialColor['b']);
    
     $cs->setColor($col);
     $cs->setDBIDOfName ($specialColor['id']);
     $cs->setName($specialColor['name']);
     $cs->setCount($specialColor['anzahl']);
     
     $cs->echoHTMLTableBox();
   }
   
   function printTop20Raster() {
     global $TPL_LANG;
     $lang      = $TPL_LANG->getLanguage();
     $resultSet = getTop20ResultSet($lang);
     $colArray  = array();
     $nr        = 0;
     while($row = mysqli_fetch_assoc($resultSet)) {
       $colArray[$nr]['name']   = $row['Name'];
       $colArray[$nr]['id']     = $row['id'];
       $colArray[$nr]['anzahl'] = $row['anzahl'];
       $colArray[$nr]['r']      = $row['r'];
       $colArray[$nr]['g']      = $row['g'];
       $colArray[$nr]['b']      = $row['b'];
       $nr = $nr + 1;
     }
     
     echo "<table>\n";
     for($id = 0; $id < 20; $id ++) {
       if(0  == ($id) % 4) {
         echo '  <tr>';
       }
       echo "<td>";
       echoColorBox($colArray[$id]);
       //echo $colArray[$id]['name'];
       echo "</td>";
       if(3  == ($id) % 4) {
         echo '</tr>' . "\n";
       }
     }
     echo "</table>";
   }
?>
