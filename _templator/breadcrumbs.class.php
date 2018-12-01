<?php
// 30. 11. 2011
//require_once "strstr.php"; // string functions

class BreadCrumbs {
  public   $PFEIL = "&#8594;"; /* pfeil nach rechts oder: "&#160;&gt;&#160;";   */
  
  private  $trail = "";
  

   public function BreadCrumbs() {
    global $TPL_PATHS;
    $verzeichnis = $TPL_PATHS->getClientServerDir(); // eg "/warenkorb/artikelliste/"
    $page        = $TPL_PATHS->getActFileName(); // eg "index.php"
    $this->trail = $this->makeActTrail($verzeichnis, $page, false);
    //echo "debug actTrail: " . $this->trail . "<bc />\n";
  }
  
  public function getTrail() {
      return $this->trail;
  }
  
  private function makeActTrail($verzeichnis, $page, $hasSubDir) {
    global $TPL_PATHS;
    
   // echo "Breadcrumbs: makeActTrail $verzeichnis / $page (subdirs? $hasSubDir)<br />\n";
    if(! $this->bcIsTopVerzeichnis($verzeichnis)) {
      $actLink    = $this->bcMakeLink($verzeichnis, $page, $hasSubDir);
      $superDir   = $TPL_PATHS->oneDirectoryUp($verzeichnis);
      //echo "DBG: $superDir<br />\n";
      $superTrail = $this->makeActTrail($superDir, "index.php", true);
      return $this->bcConcat($superTrail, $actLink);
    }
    return $this->bcMakeLink($verzeichnis, $page, $hasSubDir);
  }
  
  private function bcMakeLink($verzeichnis, $page, $hasSubDirs) {
    if($this->bcIsIndexPage($page)) {
      if($hasSubDirs) {
        return $this->bcAHREF($verzeichnis);
      } else {
        return $this->bcDirNAME($verzeichnis);
      }
    } else {
     // echo "here";
      return $this->bcAHREF($verzeichnis);
    }
  }
  
  private function bcAHREF($verzeichnis) {
    global $TPL_PATHS;
    return "<a href=\"". $TPL_PATHS->getClientRoot() . $verzeichnis. "\">" .
            $this->bcDirName($verzeichnis) . "</a>";
  }
 
  private function bcDirName($verzeichnis) {
    global $TPL_DIR_NAME;
    global $TPL_PATHS;
    global $TPL_LANG;
    //$dirPath = $TPL_PATHS->getServerRoot() . $verzeichnis . "dir.php";
   // //include $dirPath;
   // //return $TPL_DIR_NAME[$TPL_LANG->getLanguage()];
    
    return $TPL_LANG->getDirName($verzeichnis);
  }
 
  private function bcConcat($superDir, $subDir) {
      return $superDir . $this->PFEIL . $subDir;
  }

  private function bcIsIndexPage($page) {
      return "index.php" == $page;
  }

  private function bcIsTopVerzeichnis($verz) {
    global $TPL_PATHS;
    return ('/' == $verz) || ($TPL_PATHS->getServerRoot() == $verz);
  }

} // end class "BreadCrumbs"

$TPL_BREADCRUMBS = new BreadCrumbs(); // use as singleton. Only instantiate here once

?>