<?php  
  
  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . 'statistik/ColorStatistics.class.php';
  require_once $TPL_PATHS->getServerRoot() . '/_lang/LangBundle.class.php';
 
  
  function outputNomination() { 
    global $TPL_LANG;
     $nomination = getBean('Nomination');
     $nominated_name = $_POST['color_name'];
 
     $nomination->setName($nominated_name);
     $nomination->setNetzhaut($_POST['netzhaut_dd']);
     $nomination->setMedium($_POST['medium_dd']);
     $nomination->stampTime();
     $nomination->setIP($_SERVER['REMOTE_ADDR']);
     $nomination->setLang($TPL_LANG->getLanguage());
     echo '<h3>'. $TPL_LANG->getText('submitted.your').' "' . $nomination->getName() . '"</h3>';
     echo '<table><tr><td>';
     $yours = new ColorStatistics();
     $yours->setValuesFromNomination($nomination);
     $yours->simpleHtmlOutputBox();
     echo '</td><td>';
     global $TPL_PATHS;
     echo '<form action="'.$TPL_PATHS->getClientRoot().'/nominate/" method="post"><input class="nextButton" name="nextBtn" value="'. $TPL_LANG->getText('submitted.nextButton').'" type="submit" /></form>';
//     echo '<a class="nextButton" href="'.$TPL_PATHS->getClientRoot().'/nominate/">'.$TPL_LANG->getText('submitted.nextButton').'</a>';
     echo '</td></tr></table>';
     if($nomination->notSavedAndValid()) {
       $nomination->storeInDB();
       $nomination->setSavedState(); 
     
       //echo "<br/>Wurde gespeichet.<br />";
     }
     
     echo '<hr />';
     
     $yours->fullHTMLStatistics();

  }
  
  
// is NOT submitted from form?
  if(! isset($_POST['color_name'])) {
     include 'index.php';
  } else {
    outputNomination();
 } // else (else = result is a POST) 

?>