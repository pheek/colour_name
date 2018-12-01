<?php
  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . '/domain/Color.class.php';
  require_once $TPL_PATHS->getServerRoot() . '/domain/ColorNomination.class.php';
  require_once 'nominations.fct.php';
/**
 * RGB relevant stuff
 *
 * @author phi
 */
class ColorStatistics {
  // je 0..255
  private $col; // Color
  
  private $count; // how many times in the DB. 0 = not yet selected in DB
  private $name;  // Name
  private $dbIDOfName; // DB ID des Namens
  private $diff = -1;  // Abstand zur gesuchten, bzw. zur Durchschnittsfarbe (wenn möglich, sonst -1)

  public function setColor($col) {
    $this->col = $col;
  }
  public function getColor() {
    return $this->col;
  }
  public function setCount($cnt) {
    $this->count = $cnt;
  }
  public function getCount() {
    return $this->count;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function getName() {
    return $this->name;
  }
  public function setDiff($difference) {
    $this->diff = $difference;
  }
  public function getDiff() {
    return $this->diff;
  }

  public function setDBIDOfName($dbIdOfName) {
    $this->dbIDOfName = $dbIdOfName;
  }
  public function getDBIDOfName() {
    return $this->dbIDOfName;
  }
  public function setValuesFromNomination($nomination) {
    $this->name  = $nomination->getName();
    $this->col   = $nomination->getColour();
    $this->count = 0; // not yet searched in DB
  }
  
  public static function getAverage($name, $lang, $netzhaut = "%") {
    $resultSet = averageRGB($name, $lang, $netzhaut);
    $row = mysql_fetch_array($resultSet);
    $cs = new ColorStatistics;
    $this->count = $row[0];
    $this->name = $name;
    $this->col = new Color;
    $this->col->setRed($row[1]);
    $this->col->setGreen($row[2]);
    $this->col->setBlue($row[3]);
    return $cs;
  }
  
  public function enwiden($size) {
    $size = trim($size);
    preg_match('/([0-9\.]+)([A-Za-z]+)/', $size, $matches);
    return "" . ($matches[1] * 3) . $matches[2];
  }
  
  /**
   * Draw a square containing the mentioned colour.
   * @param type $hex  eg. 45F322 (without leading css #)
   * @param type $edge css length licke "3cm", "20px", ...
   * @return html-table
   */
  public function colorSquareTable($hex, $edge, $wide) {
    if($wide) {
      $w = $this->enwiden($edge);
    } else {
      $w = $edge;
    }
    return '<table style="border-style: solid; border-color:gray;  width: '. $w .';  height: '.$edge.'; '.
                          'background-color: #'. $hex .';">'.
             '<tr><td>&#160;</td></tr></table>';
  }
  
  public function describingTable($descArray, $fontSizePt=24) {
    $cnt = '<table>' . "\n";
    foreach ($descArray as $value) {
      $cnt .= '  <tr><td><span style="font-size: '.$fontSizePt.'pt;">' . $value . '</span></td></tr>' . "\n";
    }
    return $cnt . '</table>' . "\n";
  }
  
  /**
   * Draw a described HTML Table as in the old "farbnamen.ch"
   * @param type $hex    eg 34F32c (without leading css #)
   * @param type $edge   css width (eg "3cm" "2px", ...)
   * @param type $descArray Array of Strings to desribe the colour
   * @param type $textPos "left", "right", "bottom", "top"
   * @param bool $wide if so, the box is 3 times wider than high
   */
  public function describedHtmlTableBox($hex, $edge, $descArray, $textPos, $fontSizePt=12, $wide=false) {
    $colBox  = $this->colorSquareTable($hex, $edge, $wide);
    $descBox = $this->describingTable($descArray, $fontSizePt);
    $cnt = '<table><tr><td>';
    switch ($textPos) {
      case 'left':
        $cnt .= $descBox . '</td><td>' . $colBox;
        break;
      case 'top':
        $cnt .= $descBox . '</td></tr><tr><td>' . $colBox;
        break;
      case 'right':
        $cnt .= $colBox . '</td><td>' . $descBox;
        break;
      case 'bottom':
        $cnt .= $colBox . '</td></tr><tr><td>' . $descBox;
        break;
      default:
        echo "ERROR in describedHtmTableBox. textPos not defined : " . $textPos . ' (must be one of left, right, bottom, top)';
        break;
    }
    $cnt .= '</td></tr></table>' . "\n";
    return $cnt;
  }
  
  public function echoHTMLTableBox($textPos = "right") {
    global $TPL_LANG;
    
    $descArray = array();
    $descArray[] = $this->name;
    $descArray[] = $this->count. '&#160;' . $TPL_LANG->getText('nominate.nominations');
    $descArray[] = "hex:&#160;#" . $this->col->getHex();
    echo $this->describedHtmlTableBox($this->col->getHex(), "3cm", $descArray, $textPos);
  }

  public function simpleHtmlOutputBox() {
    global $TPL_LANG;
    $hex = $this->col->getHex();
    $fontSize = intval($this->count/3 + 10);
    if($fontSize > 24) {
      $fontSize = 24;
    }
    if($fontSize < 8) { 
      $fontSize = 8;
    }
    
    if($this->count < 1) { // your selected colour?
     $a = 100 ;
     echo $this->describedHtmlTableBox($hex, $a."px", array(), 'bottom', $fontSize, true);
    } else {
     $a = intval($this->count / 0.5 + 80) ;
     if($a > 250) {
       $a = 250;
     }
     $descArray = array();
     $descArray[] = $this->name . ' (' . $this->count . '&#160;' . $TPL_LANG->getText('statistik.nominations') .')';
     $descArray[] = "hex:&#160;#" . $hex;
     echo $this->describedHtmlTableBox($hex, $a."px", $descArray, 'right', $fontSize, false);
    }
    if($this->diff >= 0) {
      echo '<!-- diff: ' . $this->diff . '-->' . "\n";
    }
  }
  
  
  public function averageColourBox($name, $lang, $netzhaut, $width, $titleKey) {
    global $TPL_LANG;
    $resultSet = averageRGB($name, $lang, $netzhaut);
    $row = mysqli_fetch_assoc($resultSet);
    $c = $row['anzahl'];
    if($c > 0) {
      $r = $row['r'];
      $g = $row['g'];
      $b = $row['b'];
      echo '<h3>'.$TPL_LANG->getText($titleKey).':</h3>';
      $subCS = new ColorStatistics;
      $subCS->name   = $this->name;
      $subCS->count  = $c;
      $subCol = new Color();
      $subCol->setRed($r);
      $subCol->setGreen($g);
      $subCol->setBlue($b);
      $subCS->col = $subCol;
      $subCS->echoSimpleNoNameSquareBox($width);
      return $subCS;
    }  
  }
  
  public function fullTableByName($name) {
    global $TPL_LANG;
    $lang = $TPL_LANG->getLanguage();
    $resultSet = averageRGB($name, $lang, "%");
    $row = mysqli_fetch_assoc($resultSet);
    $c = $row['anzahl'];
    if($c < 2) {
      $TPL_LANG->echoText('statistik.stat.average.none.avail');
      return;
    }
    

    echo '<table><tr style="vertical-align:top;"><td>'; 
    
    //// Schnitt über alle:
    $subCS = $this->averageColourBox($name, $lang, "%", 150, "statistik.stat.average.all");
    echo '</td><td>';
    
    // Weblich:
    $this->averageColourBox($name, $lang, "1", 100, "statistik.female");
    echo '</td><td>';
    
    // männlich?
    $this->averageColourBox($name, $lang, "2", 100, "statistik.male");
    echo '</td><td>';
    
    // tonwertgespreizt:

    $subCol = $subCS->getColor();
    $subColClone = new Color();
    $subColClone->setRed  ($subCol->getRed  ());
    $subColClone->setGreen($subCol->getGreen());
    $subColClone->setBlue ($subCol->getBlue ());

    $subCol->tonwertSpreizung();
    $subCS->count = 0;
    echo "<h3>" . $TPL_LANG->getText("statistik.stretched") . "</h3>\n";
    $subCS->echoSimpleNoNameSquareBox(100);
    $subCS->setColor($subColClone);

    
    
    echo '</td><td>&#160;&#160;&#160;&#160;</td><td>' . "\n";
     // Letzte Spalte mit Infos zur Farbe
    
    echo '<h2>' . $TPL_LANG->getText('statistik.stat.average.rgb.desc') . '</h2>' . "\n";
    
    // RGB %
    echo '<h3>' .$TPL_LANG->getText('statistik.stat.average.rgb.proc.title'). "</h3>\n";
    echo '<p>' . $subCS->col->getPercentagesString() . "</p>\n";
    
    // HSV
    echo '<h3>' .$TPL_LANG->getText('statistik.stat.average.rgb.hsv.h.title'). "</h3>\n";
    echo '<p>' . round($subCS->col->getHSV(), 3) . "⁰</p>\n";
    
     // CSS-Block
    echo '<h3>' . $TPL_LANG->getText('statistik.stat.average.css.title') . "</h3>\n";
    
    echo '<div style="border-color:black; border-style:solid; background-color: #ccf;">' . "\n" .
         'tag {<br />' .
         '&#160;&#160;color: #' . $subCS->col->getHex() . '; <br />' . "\n" .
         "}\n" .
         "</div>";
    
    // Java-Block
    echo '<h3>' . $TPL_LANG->getText('statistik.stat.average.java.title')  . "</h3>\n";

    echo '<div style="border-color:black; border-style:solid; background-color: #ccf;">' . "\n";
    
    echo 'import java.awt.color;<br />' . "\n";
    
    $rint = intval($subCS->col->getRed()   + 0.5);
    $gint = intval($subCS->col->getGreen() + 0.5); 
    $bint = intval($subCS->col->getBlue()  + 0.5);
    echo 'Color c = new Color(' . $rint . ', ' . $gint . ', ' . $bint . ');' . "\n";
    echo "</div>\n";
    
    echo '</td></table>';
    return $subCS;
  }
  
  public function echoSimpleNoNameSquareBox($width) {
    global $TPL_LANG;
    $discArray=array();
    if($this->count == 0) {
      
    } else if($this->count != 1) {
      $discArray[] = $this->count . '&#160;' . $TPL_LANG->getText('statistik.nominations');
    } else { // genau eine Nomination
      $discArray[] = $this->count . '&#160;' . $TPL_LANG->getText('statistik.nomination');
    }
    $discArray[] = "hex:&#160;#" . $this->col->getHex();
    echo $this->describedHtmlTableBox($this->col->getHEX(), $width."px", $discArray, 'bottom', 16, false);
  }
  
  
  public function fullRangeByName($inf) {
    global $TPL_LANG;
    $lang = $TPL_LANG->getLanguage();
    
    echo "<h2>-- " . $this->name . " --</h2>\n";
    $this->averageColourBox($this->name, $lang, "%",160, "statistik.colourAverage");

    // weiblich:
    $this->averageColourBox($this->name, $lang, "1",120, "statistik.female");

    // männlich? 
    $this->averageColourBox($this->name, $lang, "2",120, "statistik.male");
  }
  
  
  public function fullRangeByRGB() {
    global $TPL_LANG;
    echo '<h3>' . $TPL_LANG->getText('statistik.similarColours'). '</h3>';
    echo '<p>'.$TPL_LANG->getText('statistik.similarColours.desc').'</p>';
    $col = $this->col;
    $resultSet = getNearestColours($col->getRed(), $col->getGreen(), $col->getBlue(), $TPL_LANG->getLanguage());
    while($row = mysqli_fetch_assoc($resultSet)) {
      $subCS = new ColorStatistics;
      $subCS->name   = $row['Name'];
      $subCS->count  = $row['cnt'];
      $subCol = new Color();
      $subCol->setRed($row['r']);
      $subCol->setGreen($row['g']);
      $subCol->setBlue($row['b']);
      $subCS->col = $subCol;
      $subCS->diff = $row['abstand'];
      $subCS->simpleHtmlOutputBox();
    }
  }
  
   public function fullRangeByRGBHoriz() {
    global $TPL_LANG;
    echo '<h3>' . $TPL_LANG->getText('statistik.similarColours'). '</h3>';
    echo '<p>'.$TPL_LANG->getText('statistik.similarColours.desc').'</p>';
    echo '<table><tr>';
    $col = $this->col;
    $resultSet = getNearestColours($col->getRed(), $col->getGreen(), $col->getBlue(), $TPL_LANG->getLanguage());
    while($row = mysqli_fetch_assoc($resultSet)) {
      echo '<td>';
      $subCS = new ColorStatistics;
      $subCS->name   = $row['Name'];
      $subCS->count  = $row['cnt'];
      $subCol = new Color();
      $subCol->setRed($row['r']);
      $subCol->setGreen($row['g']);
      $subCol->setBlue($row['b']);
      $subCS->col = $subCol;
      $subCS->diff = $row['abstand'];
      //$subCS->simpleHtmlOutputBox();  
      $descArray = array();
      $descArray[] = '<b>' . $subCS->name . '</b>';
      $descArray[] = $subCS->count. '&#160;' . $TPL_LANG->getText('nominate.nominations');
      $descArray[] = "hex:&#160;#" . $subCol->getHex(); 
      echo $subCS->describedHtmlTableBox($subCol->getHEX(), "48px", $descArray, "bottom", 12, false);
      echo '</td>' . "\n";
    }
    echo '</tr></table>';
  }
  
  
  public function fullHTMLStatistics() {
    echo '<table><tr style="vertical-align:top;"><td style="border-color: #aaa; border-style:solid; border: 2px;"><td style="margin-left:20px; margin-right: 20px; background-color: #' . $this->col->getHex(). ';">&#160;&#160;&#160;</td><td>';
    $this->fullRangeByRGB();
    echo '</td><td style="margin-left:20px; margin-right: 20px; background-color: #' . $this->col->getHex(). ';">&#160;&#160;&#160;</td><td>';
    $this->fullRangeByName(3);
    echo '</td></tr></table>';
  }
} // end class Color

?>
