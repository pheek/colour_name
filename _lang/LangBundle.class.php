<?php

  /*
   * public methods to get language Texts
   */

  /**
   * As a singleton "$TPL_LANG" is defined. 
   * Use all Language Texts from $TPL_LANG->...
   *
   * @author phi
   */
  class LangBundle {
    public function getPossibleLanguagesArray() {
	    $langArray = array('de', 'en', 'fr');
      return $langArray;
    }
  
    public function getContent() {
      return $this->getContentFile(getFile());
    }
 
    public function getContentFile($file) {
      $lang = $this->getLanguage();
      return $file . "_" . $lang . ".php";    
    }
    
    private $lastLang = "de";
    private $cache;
    public function getText($key) {
      $lang = $this->getLanguage();
      if($this->lastLang != $this->getLanguage()) {
        $this->initCache($lang);
      }
      if(!isset($this->cache)) { // first use
        $this->initCache($lang);
      }
      if(array_key_exists($key, $this->cache)) {
        return $this->cache[$key];
      }
      return "TRANSLATE TO " . $lang . ': Key: ' . $key . "<br />\n";
    }
    
    public function echoText($key) {
      echo $this->getText($key);
    }
    
    private function initCache($lang) {
      // BUG: Suffix ".properties" did not work with utf-8 in Netbeans.
      $filename = __DIR__ . '/' . $lang . '.props';
      $this->cache = array();
      $file = fopen($filename, "r");
       while($row = fgets($file)) {
         $this->addLineToCache($row);
       }
      fclose($file);
    }
  
    private function addLineToCache($row) {
      $row = trim($row);
      //is empty?
      if(strlen($row) < 1) {
        return; // nothing to do
      }
      // Remove Comment Lines:
      if(strStartsWith($row, '/') || strStartsWith($row, '#') || strStartsWith($row, '!')) {
        return; // Nothing to do due to comment-line.
      }
      $keyval = explode('=', $row, 2);
      //echo "row:" . $row . "   keyval" . $keyval . "<br/>\n";
      $key = $keyval[0];
      $val = $keyval[1];
      $val=trim($val, ' "\'');
      $key = trim($key);
      $this->cache[$key] = $val;
    }
    
    public function getDirName($verzeichnis) {
      // remove ".php" extension:
     // $path = preg_replace('/\.[^.]*$/', '', $path);
      $key = '_DIR_' . $verzeichnis;
      return $this->getText($key);
    }
    /**
     * Page title from xx.properrties
     *  
     */
    public function getPageTitle() {
      global $TPL_PATHS;
      $path = $TPL_PATHS->getCanonicalClientPath();
      // remove ".php" extension:
      $path = preg_replace('/\.[^.]*$/', '', $path);
      $key = '_FILE_' . $path;
      return $this->getText($key);
    }
    /**
     * 1. Try URL "de.colour.name" -> language = "de"
     * 2. Override by using session['lang']
     * 3. Override by using request['lang'] (get or post)
     * 4. Write "request-language" to "session-language"
     * 
     * @global type $_SESSION
     * @global type $_REQUEST
     * @return string "iso language shortcut"
     */
    public function getLanguage() {
      if(! session_id()) {
        session_start();
      }
      global $_SESSION;
      global $_REQUEST;
    
      // 1. Default (least important information)
      $lang = "de";


      // 2. URL (more important)
      $url = $this->getURL();
    
      foreach ($this->getPossibleLanguagesArray() as $lng) {
        if(strstr($url, $lng . ".colour.name")) {$lang = $lng;}
      }
   
      // 3. Lang = Session
      if(isset($_SESSION) && array_key_exists('lang', $_SESSION)) {
        $sl = $_SESSION['lang'];
       
        foreach ($this->getPossibleLanguagesArray() as $lng) {
          if($lng == $sl) {$lang = $lng;}
        }
      }
    
      // 4. Lang = Request (most important information)
     if(array_key_exists('lang' , $_REQUEST)) {
       $langParam = $_REQUEST["lang"];
       foreach ($this->getPossibleLanguagesArray() as $lng) {
         if($lng == $langParam) {
            $lang = $lng;
             //echo "debug getLanguage: store $lng into session.<br/>";
             $_SESSION['lang'] = $lng;
         }
       }
     }
    
     return $lang;
   } // end function "getLanguage"
  
   
   function getFile() {
     echo 'DEBUG: wo wird LangBundle->getFile benötigt???<br/>';
     return "index";
   }
  
   function getURL() {
     // echo "proto: " . $_SERVER['SERVER_PROTOCOL'];
     $urI       = $_SERVER['REQUEST_URI']; // includes query string...
     $protokoll = substr($_SERVER['SERVER_PROTOCOL'],0,strpos($_SERVER['SERVER_PROTOCOL'], '/'));
     $port      = $_SERVER['SERVER_PORT'];
     $host      = $_SERVER['HTTP_HOST'];
     $urL       = strtolower($protokoll).'://'.$host.':'.$port.$urI;
     //echo "debug url: " . $urL;
     return $urL;
   }

  } // end class LangBundle

  // singleton
  global $TPL_LANG;
  if(! isset($TPL_LANG)) {
    $TPL_LANG = new LangBundle();
  }
?>
