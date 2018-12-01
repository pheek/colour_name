<?php

  function showNominationColor() {
    global $TPL_PATHS;
    require_once $TPL_PATHS->getServerRoot() . '/_templator/useSessionBean.fct.php';
    $nomination = getBean('Nomination');
    
    $nomination->showWideColorBox();
  }

  function isLoadedFormSubmit() {
    return isset($_POST['color_name']);
  }


  function affenFormularSteuerung() {  
    // $TPL_DB muss hier sein, denn es wird wieder
    // innerhalb von submit.php bzw. form.php benötigt.
    global $TPL_DB;
    global $TPL_LANG;
        
    global $TPL_PATHS;

    $serverRoot = $TPL_PATHS->getServerRoot();
    require_once $serverRoot . '/_templator/useSessionBean.fct.php';


    //$serverRootLang = $serverRoot . '_lang/' . $TPL_LANG->getLanguage() . '/';

    // "Andere Farbe" anbieten
    if(isset($_POST['next_color'])) {
      $incl = $serverRoot . '/nominate/form.php';
    } else {
      if(isLoadedFormSubmit()){
        $incl = $serverRoot . '/nominate/submit.php';
      } else {
        $incl = $serverRoot . '/nominate/form.php';
      }
    }
 
    include $incl;

  }

 ?>