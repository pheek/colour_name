<?php
  /*
   * Distinguish between "localhost" and "internet-version".
   * Change TPL_{CLIENT|SERVER}_ROOT in Constructor. 
   */

  require_once __DIR__ . '/../_lang/LangBundle.class.php';
  require_once 'strstr.php'      ;
  
  /**
   * evtl mit TRUE/FALSE initialisieren
   */
  function isLocalhost() {
    return ("localhost" == $_SERVER["HTTP_HOST"]);
  }
  
  // URLs for the templator
  class TPL_Paths {

    private $clientPath;
    private $TPL_CLIENT_ROOT;
    private $TPL_SERVER_ROOT;
 
  // for DB-connection info see "/db/DB.class.php"
  public function TPL_Paths() {
    $this->clientPath = $_SERVER["PHP_SELF"];
    if(isLocalhost()) {
        $this->TPL_CLIENT_ROOT = '/de.colour.name';
        $this->TPL_SERVER_ROOT = '/var/www/html/de.colour.name';
    } else {
        $this->TPL_CLIENT_ROOT = '';
        $this->TPL_SERVER_ROOT = '/var/www/name/colour';
      
       // Test in home wireless
       //$this->TPL_CLIENT_ROOT = '/colour';
       //$this->TPL_SERVER_ROOT = '/var/www/colour';
    }

    $this->TPL_SERVER_ROOT = realpath ( $this->TPL_SERVER_ROOT) . '/';
  }
 
  private function tpl2WebLink($reference) {
    //global $TPL_CLIENT_ROOT;
    return '<a href="'. $this->TPL_CLIENT_ROOT . $reference . '">';
  }
  
  /**
   * interner Link.
   */
  public function intLink($ref, $linkText) {
      if(strEndsWith($this->TPL_CLIENT_ROOT, '/')) {
          $spacer = "";
      } else {
          $spacer = "/";
      }
      return '<a href="' . $this->TPL_CLIENT_ROOT . $spacer . $ref . '">' . $linkText . '</a>';
  }

  public function getClientPath() {
    return $this->clientPath;
  }

  /* same as getClientPath, but without the $TPL_CLIENT_ROOT */
  public function getCanonicalClientPath() {
    $ccp = substr($this->getClientPath(), strlen($this->TPL_CLIENT_ROOT));
    if(! (strStartsWith($ccp, "/"))) {
        $ccp = "/" . $ccp;
    }
    return $ccp;
  }

  public function getServerPathLang() {
    global $TPL_LANG;
    $serverPathLang =  $this->TPL_SERVER_ROOT . "_lang/" .  $TPL_LANG->getLanguage() . $this->getCanonicalClientPath();

    //echo "debug path.class.php :: getServerPathLang()$serverPathLang = ";
    //echo $serverPathLang . '<br/>';

    return $serverPathLang;
  }
  
  public function getServerPath() {
    if(strEndsWith($this->TPL_SERVER_ROOT, '/')) { //TODO: strConcatPaths (without ..//.. double // 
        $sp = substr($this->TPL_SERVER_ROOT, 0, strlen($this->TPL_SERVER_ROOT) - 1) . $this->getCanonicalClientPath();
    } else {
       $sp = $this->TPL_SERVER_ROOT . $this->getCanonicalClientPath();
    }    
    if(! (strStartsWith($sp, "/"))) {
       $sp = "/" . $sp;
    }
    return $sp;
  }

  public function getClientRoot() {
    return $this->TPL_CLIENT_ROOT;
  }
  
  public function getServerRoot() {
    return $this->TPL_SERVER_ROOT;
  }
  
  public function getClientServerDir() {
    if($this->getClientDir() == $this->getServerDir()) {
        return $this->getClientDir();
    }
    else throw new Exception ("Client Server Dir does not match urls_class.php" . $this->getClientDir() . " != " . $this->getServerDir(), 0, null);
  }
  
  private function getClientDir() {
      return $this->extractCanonicalDir($this->getClientRoot(), $this->getClientPath());
  }
  private function getServerDir() {
      return $this->extractCanonicalDir($this->getServerRoot(), $this->getServerPath());
  }
  
  private function extractCanonicalDir($root, $whole) {
    if(strStartsWith($whole, $root)) {
      $endPart = substr($whole, strlen($root));
    } else {
      $endPart = $whole;
    }
    if(! (strStartsWith($endPart, "/"))) {
       $endPart = "/". $endPart;  
    }
//    echo "DEBUG extractCononicalDir $root, $whole, $endPart<br />";
    return $this->removeFileFromPath($endPart);
  }
  
  public function oneDirectoryUp($dir) {
    if(strEndsWith($dir, "/")) {
        $dir = substr($dir, 0, strlen($dir) - 1);
    }
    $lastSlashPos = strFindLastPos($dir, "/");
    if(-1 == $lastSlashPos) {
        return "/";
    }
    return substr($dir, 0, $lastSlashPos + 1);
  }
  
  private function removeFileFromPath($path) {
    if(strEndsWith($path, "/")) {
        return $path;
    }
    $lastSlashPos = strFindLastPos($path, "/");
    $lastDotPos   = strFindLastPos($path, ".");
    if($lastDotPos > $lastSlashPos) { // last is file, not dir!
        return substr($path, 0, $lastSlashPos + 1);
    }
    return $path;
  }
  
  public function getActFileName() {
    $actFileName = "index.php";
    $path = $this->getCanonicalClientPath();
    $lastSlashPos = strFindLastPos($path, "/");
    $lastDotPos   = strFindLastPos($path, ".");
    if($lastDotPos > $lastSlashPos) {
        $actFileName = substr($path, $lastSlashPos + 1);
    }
    return $actFileName;
  }
  
  public function debugURLS() { 
    echo "<br />getActFileName(): "   . $this->getActFileName()         . "<br />\n";
    echo "getServerRoot(): "          . $this->getServerRoot()          . "<br />\n"; 
    echo "getServerPath(): "          . $this->getServerPath()          . "<br />\n";
    echo "getClientPath(): "          . $this->getClientPath()          . "<br />\n";
    echo "getClientRoot(): "          . $this->getClientRoot()          . "<br />\n";
    echo "getCanonicalClientPath(): " . $this->getCanonicalClientPath() . "<br />\n";
    echo "getClientServerDir(): "     . $this->getClientServerDir()     . "<br />\n";
    $act = $this->getClientServerDir();
    $act = $this->oneDirectoryUp($act);
    echo "parent: "                   . $act                            . "<br />\n";
    $act = $this->oneDirectoryUp($act);
    echo "parent of parent: "         . $act                            . "<br />\n";
    $act = $this->oneDirectoryUp($act);
    echo "grand grand parent: "       . $act                            . "<br />\n";
  }

} // end class TPL_Urls

global $TPL_PATHS;
if(! isset($TPL_PATHS)) {
  $TPL_PATHS = new TPL_Paths(); // use as singleton: only instantiate here once.
}

/*DEBUG 
 * Einschalten zum Debuggen:
 */
 //$TPL_PATHS->debugURLS(); 

 ?>