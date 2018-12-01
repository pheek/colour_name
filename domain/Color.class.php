<?php

/**
 * RGB relevant stuff
 *
 * @author phi
 */
class Color {
  // je 0..255
  private $r, $g, $b;
  private $dbID;
    
  
  public function setDBID($dbID) {
    $this->dbID = $dbID;
  }
  public function getDBID() {
    return $this->dbID;
  }
  
  public function setByHex($hex) {
    if('#' == substr($hex, 0, 1)) {
      $hex = substr($hex, 1, 6);
    }
    $this->r = hexdec(substr($hex, 0, 2));
    $this->g = hexdec(substr($hex, 2, 2));
    $this->b = hexdec(substr($hex, 4, 2));
  }
  
  public function setRed($r) {
    $this->r = $r;
  }
  public function setGreen($g) {
    $this->g = $g;
  }
  
  public function setBlue($b) {
    $this->b = $b;
  }
  
  public function getRed() {
    return $this->r;
  }
  public function getGreen() {
    return $this->g;
  }
  public function getBlue() {
    return $this->b;
  }
  
  public function getHEX() {
    return $this->my_dechex($this->r) . $this->my_dechex($this->g) . $this->my_dechex($this->b);     
  }
  
  // ensure a hex-col-value has 2 digits
  private function my_dechex($nom_dec) {
    $nom_hex = dechex($nom_dec);
    if($nom_dec < 16) {
      $nom_hex = "0" . $nom_hex;	
    }
    return $nom_hex;
  }
   
  /**
   * Actually this has to be done, for average-colours.
   * Average colours are always too far away from the edge.
   * This "algorithm" stretches so that at least one (1) value (of r, g and b)
   * becomes to be 0 or 255. 
   *  
   */
  public function tonwertSpreizung() {
    $min = $this->minRGB();
    $max = $this->maxRGB();
    $diffU = $min;
    $diffO = 255 - $max;
    if($diffU < $diffO) {
      $diff = $diffU;
    } else {
      $diff = $diffO;
    }
    $nue = 127.5 / (127.5 - $diff);
    $this->r = $this->stretch($this->r, $nue);
    $this->g = $this->stretch($this->g, $nue);
    $this->b = $this->stretch($this->b, $nue);
  }
  
  private function stretch($val, $nue) {
    $vec = abs(127.5 - $val);
    $newDist = $vec * $nue; // distance from 127.5
    if($val < 127.5) {
      return 127.5 - $newDist;
    } else {
      return 127.5 + $newDist;
    }
  }

  /**
   * Ursprünglich wurde hier einfch eine Mix aus r, g und b von je 0..255 gewählt.
   * Da unser Auge aber Gelb besser unterscheiden kann, denn Rot und Grün liegen in den
   * Wellenlängen nahe beieinander, so habe ich eine Gelb-Korrektur eingebaut.
   * Diese verringert zufällig den Blau-Anteil und erhöht proportional dazu den Grün und Rot Anteil.
   * Somit kommt auch Gelb etwa gleich häufig vor wie Blau, Rot und Grün.
   */
  public static function createRandomColor() {
     $col = new Color();
     $col->r = mt_rand(0, 255);
     $col->g = mt_rand(0, 255);
     $col->b = mt_rand(0, 255);
     // yellow :
     $yProc = (mt_rand() / getRandMax()) * (mt_rand() / getRandMax()); // 0..1, aber etwas häufiger bei 0
     
     // green corret: 
     $deltaG = 255 - $col->g;
     $col->g = intval($col->g + $deltaG * $yProc);

     // red correction
     $deltaR = 255 - $col->r;
     $col->c = intval($col->r + $deltaR * $yProc);

     // blue correction (other side)
     $deltaB = $col->b;
     $col->b = intval($col->b - $deltaB * $yProc);

     // fix rechenfehler:
     $col->r = Color::fixCol($col->r);
     $col->g = Color::fixCol($col->g);
     $col->b = Color::fixCol($col->b);

     return $col;
  }

  private static function fixCol($val) {
    if($val <   0) return   0;
    if($val > 255) return 255;
    return $val;
  }
  
  public function getCSSCode() {
      return 'background-color: #' . $this->getHEX() . ';';
  }
  
  public function getJavaCode() {
      return 'Color c = new Color(' . r . ', '. g . ', ' . b. ');';
  }
 
  public function randomizeThisColor() {
    $this->r = mt_rand(0,   255);
    $this->g = mt_rand(0,   255);
    $this->b = mt_rand(0,   255);
  }

  public function toHTMLTD($showProperties) {
    echo "  <td>";
    $this->toHTML($showProperties);
    echo "</td>\n";
  }

  public function toDebugString() {
    $this->toHTML(true);
  }

  public function toHTML($showProperties, $wide = false) {
    // TODO: is this used? What about the funcitons in the class
    //       ColorStatistics.class.php.
    $color_hex_r = $this->my_dechex($this->r);
    $color_hex_g = $this->my_dechex($this->g);
    $color_hex_b = $this->my_dechex($this->b);
  
    echo '<table style="width:100%;"><tr>';

    // FARBE
    echo "<td>";
    echo '<table class="colorbox" style="width: ' . 
      ($wide ? "100%" : "3cm")
      . '; background-color: #';
      echo $color_hex_r . $color_hex_g . $color_hex_b;
      echo ';"><tr><td></td></tr></table>';
    echo "</td>";

    // Properties
    if($showProperties) {

    }
    echo "</tr></table>\n";
  }

  public function showWideColorBox() {
    $this->toHTML(false, true);
  }
  
  /**
   * A value from 0 .. 255 is translated to 0..100%
   * @param type $zero255Value 
   */
  public function perc($zero255Value) {
    $perc = ($zero255Value * 100) / 255;
    $perc = round($perc, 2);
    return $perc;
  }

  public function maxRGB() {
    if(($this->r > $this->g) && ($this->r > $this->b)) {
      return $this->r;
    }
    if($this->g > $this->b) {
      return $this->g;
    }
    return $this->b;
    
  }
  public function minRGB() {
    if(($this->r < $this->g) && ($this->r < $this->b)) {
      return $this->r;
    }
    if($this->g < $this->b) {
      return $this->g;
    }
    return $this->b;
  }
  
  public function getPercentagesString() {
    global $TPL_LANG;
    return $TPL_LANG->getText('red')   . "&#160;"  . $this->perc($this->r) . "%, " .
           $TPL_LANG->getText('green') . "&#160;"  . $this->perc($this->g) . "%, " .
           $TPL_LANG->getText('blue')  . "&#160;"  . $this->perc($this->b) . "%";
  }
  
  private function getHSVPM() {
    $max = $this->maxRGB();
    $min = $this->minRGB();
    if($max == $min) {
      return 0;
    }
    $mmdiff = $max-$min;
    if($max == $this->r) {
      return 60 * (($this->g - $this->b) / $mmdiff);
    }
    if($max == $this->g) {
      return 60 * (2 + ($this->b - $this->r) / $mmdiff);
    }
    if($max == $this->b) {
      return 60 * (4 + ($this->r - $this->g) / $mmdiff);
    }
    return 0;
  }
  
  public function getHSV() {
    $hsv = $this->getHSVPM();
    if($hsv < 0) {
      return 360 + $hsv;
    }
    return $hsv;
  }
  
    
} // end class Color

?>
