<?php
// philipp gressly freimann (phi@gress.ly)
// 28. Maerz 2012
// V. 2.0 (colour.name)

require_once 'Color.class.php';
require_once 'InsertNomination.class.php';

class ColorNomination {

  // States:
  //
  // COLORED = NEW: The Constructor assigns a random Color
  // NAMED        : As soon as the user entered a name and submitted his nomination.
  // SAVED        : As soon as this nomination is saved into the database (db)
  // see functions isNamed() and isSaved().
  private $saved;

  private $nom_name; // user input
  private $col;      // Color reference
  private $nom_netzhaut;
  private $nom_medium;
  private $nom_timestamp;
  private $nom_IP;
  private $nom_lang; // this must not be the GUI language !


  // Lösche name, farbe, ... aber erzeuge eine neue Zufallsfarbe
  // netzhaut, medium und ip können bleiben, sie ändern sich kaum in der Session.
  // Zudem kann damit die <option selected='selected'> gesteuert werden.
  public function reset() {
    $this->saved = false;
    unset($this->nom_name);
    unset($this->col);
    $this->col = Color::createRandomColor();
    // unset($this->nom_netzhaut);
    // unset($this->nom_medium);
    unset($this->nom_timestamp);
    // unset($this->nom_IP);
    $this->mkRandom();
  }

  public function __construct() {
    //NEW = colored
    $this->mkRandom();
  }
 

  public function setName($newName) {
    $newName = $this->normalizeColorName($newName);
    //echo "debug ColorNomination: setName ... normalized name: " . $newName . '<br/>'; 
    $this->nom_name = $newName;
  }

  public function getName() {
    if(! isset($this->nom_name)) {
      return "";
    }
    return $this->nom_name;
  }

  public function setNetzhaut($netzhaut) {
    $this->nom_netzhaut = $netzhaut;
  }
  public function getNetzhaut() {
    return $this->nom_netzhaut;
  }

  public function setMedium($medium) {
    $this->nom_medium = $medium;
  }
  public function getMedium() {
    return $this->nom_medium;
  }

  public function setIP($ip) {
    $this->nom_IP = $ip;
  }
  public function getIP() {
    return $this->nom_IP;
  }

  public function getColour() {
    return $this->col;
  }

  public function stampTime() {
    $this->nom_timestamp = time();
  }

  public function getLang() {
    return $this->nom_lang;
  }
  
  public function setLang($lang) {
    $this->nom_lang = $lang;
  }


  // There is no "unset" of the saved state.
  // The saved state is the "end-state" of any nomination.
  public function setSavedState() {
    $this->saved = true;
  }

  // for debug purpose only
  // TODO: remove if application is finished.
  public function toString() {
    return "Nomination (debug): " .
      "Name: "     . $this->nom_name . "<br/>" .
      "Col: "      . $this->col->getHEX() . "<br />" .
      "saved: "    . $this->isSaved() . "<br />" .
      "Netzhaut: " . $this->nom_netzhaut . "<br />" .
      "Medium: "   . $this->nom_medium . "<br />" .
      "IP: "       . $this->nom_IP . "<br />" .
      "Time: "     . $this->getSQLTimestamp() . "<br />" ;
  }

  public function getSQLTimestamp() {
    date_default_timezone_set("Europe/Zurich");
    return date("Y-m-d H:i:s", $this->nom_timestamp);
  }

  public function notSavedAndValid() {
    //echo 'debug in notSavedAndValid(): ' . $this->toString();
    if($this->isSaved()) {
      return false;
    }
    if(! strIsSet($this->nom_name)      ) { return false; }
    if(! isset($this->col)              ) { return false; }
    if(! is_numeric($this->nom_netzhaut)) { return false; }
    if(! is_numeric($this->nom_medium)  ) { return false; }
    return true;
  }

  public function storeInDB() {
    $in = new InsertNomination();
    $in->insertNomination($this);
    //echo 'store in db: ' . $this->toString();
  }

  public function isNamed() {
    return isset($this->nom_name);
  }

  public function isSaved() {
    return $this->saved;
  }  

  private function normalizeColorName($name) {
    $name = trim($name);
    // 1. Kleinschreiben
    $name = $this->strtolower_utf8($name);

    // 2. Kritische Sonderzeichen entfernen
    $additional_replacements    = array
      (   "\\"  => "|" // security
        , "_"   => "-" 
        , "\""  => " " // security SQL Injection
       // , "'"   => " "
        , ";"   => "," // security SQL Injection
          );
    
    $name = strtr( $name, $additional_replacements );

    // 3. Mehrfache Leerschläge entfernen
    $name = preg_replace('/\s+/', ' ', $name);
    $name = preg_replace('/\s-/', '-', $name);
    $name = preg_replace('/-\s/', '-', $name);

    $name = trim($name);
    
    //echo 'DEBUG: trimmed name: ' . $name . "<br />\n";
    return $name;
  }
  
  // only a strtolower is performed: No special chars are removed!
  private function strtolower_utf8($inputString) {
  $additional_replacements    = array
        ( "ǅ"  => "ǆ"        //   453 ->   454
        , "ǈ"  => "ǉ"        //   456 ->   457
        , "ǋ"  => "ǌ"        //   459 ->   460
        , "ǲ"  => "ǳ"        //   498 ->   499
        , "Ϸ"  => "ϸ"        //  1015 ->  1016
        , "Ϲ"  => "ϲ"        //  1017 ->  1010
        , "Ϻ"  => "ϻ"        //  1018 ->  1019
        , "ᾈ"  => "ᾀ"        //  8072 ->  8064
        , "ᾉ"  => "ᾁ"        //  8073 ->  8065
        , "ᾊ"  => "ᾂ"        //  8074 ->  8066
        , "ᾋ"  => "ᾃ"        //  8075 ->  8067
        , "ᾌ"  => "ᾄ"        //  8076 ->  8068
        , "ᾍ"  => "ᾅ"        //  8077 ->  8069
        , "ᾎ"  => "ᾆ"        //  8078 ->  8070
        , "ᾏ"  => "ᾇ"        //  8079 ->  8071
        , "ᾘ"  => "ᾐ"        //  8088 ->  8080
        , "ᾙ"  => "ᾑ"        //  8089 ->  8081
        , "ᾚ"  => "ᾒ"        //  8090 ->  8082
        , "ᾛ"  => "ᾓ"        //  8091 ->  8083
        , "ᾜ"  => "ᾔ"        //  8092 ->  8084
        , "ᾝ"  => "ᾕ"        //  8093 ->  8085
        , "ᾞ"  => "ᾖ"        //  8094 ->  8086
        , "ᾟ"  => "ᾗ"        //  8095 ->  8087
        , "ᾨ"  => "ᾠ"        //  8104 ->  8096
        , "ᾩ"  => "ᾡ"        //  8105 ->  8097
        , "ᾪ"  => "ᾢ"        //  8106 ->  8098
        , "ᾫ"  => "ᾣ"        //  8107 ->  8099
        , "ᾬ"  => "ᾤ"        //  8108 ->  8100
        , "ᾭ"  => "ᾥ"        //  8109 ->  8101
        , "ᾮ"  => "ᾦ"        //  8110 ->  8102
        , "ᾯ"  => "ᾧ"        //  8111 ->  8103
        , "ᾼ"  => "ᾳ"        //  8124 ->  8115
        , "ῌ"  => "ῃ"        //  8140 ->  8131
        , "ῼ"  => "ῳ"        //  8188 ->  8179
        , "Ⅰ"  => "ⅰ"        //  8544 ->  8560
        , "Ⅱ"  => "ⅱ"        //  8545 ->  8561
        , "Ⅲ"  => "ⅲ"        //  8546 ->  8562
        , "Ⅳ"  => "ⅳ"        //  8547 ->  8563
        , "Ⅴ"  => "ⅴ"        //  8548 ->  8564
        , "Ⅵ"  => "ⅵ"        //  8549 ->  8565
        , "Ⅶ"  => "ⅶ"        //  8550 ->  8566
        , "Ⅷ"  => "ⅷ"        //  8551 ->  8567
        , "Ⅸ"  => "ⅸ"        //  8552 ->  8568
        , "Ⅹ"  => "ⅹ"        //  8553 ->  8569
        , "Ⅺ"  => "ⅺ"        //  8554 ->  8570
        , "Ⅻ"  => "ⅻ"        //  8555 ->  8571
        , "Ⅼ"  => "ⅼ"        //  8556 ->  8572
        , "Ⅽ"  => "ⅽ"        //  8557 ->  8573
        , "Ⅾ"  => "ⅾ"        //  8558 ->  8574
        , "Ⅿ"  => "ⅿ"        //  8559 ->  8575
        , "Ⓐ"  => "ⓐ"        //  9398 ->  9424
        , "Ⓑ"  => "ⓑ"        //  9399 ->  9425
        , "Ⓒ"  => "ⓒ"        //  9400 ->  9426
        , "Ⓓ"  => "ⓓ"        //  9401 ->  9427
        , "Ⓔ"  => "ⓔ"        //  9402 ->  9428
        , "Ⓕ"  => "ⓕ"        //  9403 ->  9429
        , "Ⓖ"  => "ⓖ"        //  9404 ->  9430
        , "Ⓗ"  => "ⓗ"        //  9405 ->  9431
        , "Ⓘ"  => "ⓘ"        //  9406 ->  9432
        , "Ⓙ"  => "ⓙ"        //  9407 ->  9433
        , "Ⓚ"  => "ⓚ"        //  9408 ->  9434
        , "Ⓛ"  => "ⓛ"        //  9409 ->  9435
        , "Ⓜ"  => "ⓜ"        //  9410 ->  9436
        , "Ⓝ"  => "ⓝ"        //  9411 ->  9437
        , "Ⓞ"  => "ⓞ"        //  9412 ->  9438
        , "Ⓟ"  => "ⓟ"        //  9413 ->  9439
        , "Ⓠ"  => "ⓠ"        //  9414 ->  9440
        , "Ⓡ"  => "ⓡ"        //  9415 ->  9441
        , "Ⓢ"  => "ⓢ"        //  9416 ->  9442
        , "Ⓣ"  => "ⓣ"        //  9417 ->  9443
        , "Ⓤ"  => "ⓤ"        //  9418 ->  9444
        , "Ⓥ"  => "ⓥ"        //  9419 ->  9445
        , "Ⓦ"  => "ⓦ"        //  9420 ->  9446
        , "Ⓧ"  => "ⓧ"        //  9421 ->  9447
        , "Ⓨ"  => "ⓨ"        //  9422 ->  9448
        , "Ⓩ"  => "ⓩ"        //  9423 ->  9449
        );
   
  // see manual of mb_strtolower (php.net)

  //    $outputString    = mb_strtolower( $inputString, "UTF-8");
    $outputString = preg_replace('`/^(.*)$/`u', '\L$1\E', $inputString);
    $outputString    = strtr( $outputString, $additional_replacements );
   
    return $outputString;
  }
  
  public function showWideColorBox() {
    if(! isset($this->col)) {
      $this->mkRandom();
    }
    $this->col->showWideColorBox();
  }

  private function mkRandom() {
    $this->col = Color::createRandomColor();
  }

  public function toDebugString() {
    return "NOM: " . $this->col->toDebugString() . "<br />Name: " .  $this->name . " (saved:  " . $this->saved . ")"; 
  }

  function showListOfNames($result) {
    echo "<p style=\"border-style: solid; border-color: #888;\">\n";
	  $i = 0;
    $arr = array();
	  while($row = mysqli_fetch_assoc($result)) {
		  $arr[$i++] = $row["Name"];
  	}
	  $over = $i;
	  sort($arr);
	  $i= 0;
	  while($i < $over) {
		  echo '<input type="submit" name="auswerten" value="' .
		        $arr[$i] . '" /> ';
	    $i++;
	  }
	  echo "...</p>\n";
  }
	
  function showList($result, $yourColor, $averageColor) {
	echo "<table>";
	echo "<tr><th>Ihr<br /> ".$yourColor->nom_name."</th>";
	if(isset($averageColor)) {
		echo "<th>Durchschnitts<br /> " . $yourColor->nom_name . "</th>";
	} else {
		// skip first
		$skip  =  mysqli_fetch_assoc($result);
	}
	echo "<th>andere<br />Teilnahmen</th>";
	echo "</tr>\n";
	
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$yourColor->toHTMLTD(false);
		if(isset($averageColor)) {
			$averageColor->toHTMLTD(false);
		}		
		$cg = $this->resultToColor($row);
		$cg->toHTMLTD(true);
		echo "</tr>\n";
	}
	echo "</table>\n";
  }

  function resultToColor($row) {
	$nomination           = new ColorNomination();
	$nomination->nom_name = $this->normalizeColorName($row['Name']);
        $nomination->col      = new Color();
        $nomination->col->setRed  ($row['r']);
        $nomination->col->setGreen($row['g']);
        $nomination->col->setBlue ($row['b']);

	$nomination->nom_netzhaut  = $row['netzhaut_ID'];
	$nomination->medium_ID     = $row['medium_ID'];

	return $nomination;
  }

} // end of class ColourNomination

?>