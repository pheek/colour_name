<?php

// Methods to use a session bean

  function getBean($name) {
    // Session (1. load classes, 2. start session)
    global $TPL_PATHS;

    require_once $TPL_PATHS->getServerRoot() . '/domain/ColorNomination.class.php';
    if(! session_id()) {
      session_start();
    }

    if(array_key_exists($name, $_SESSION)) {
      $obj = $_SESSION[$name];
      return $obj;
    }

    if('Nomination' == $name) {
      $obj = new ColorNomination();
    } // other objects could be created here: else if ... else if ...

    // Store in session
    $_SESSION[$name] = $obj;

    return $obj;
  }

?>