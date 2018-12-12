<?php
/** 2018 phi@gress.ly
 *  GPL https://www.gnu.org/licenses/gpl-3.0
 *  This is the main script which includes the requested page.
 *  Because thie page (request) calls this before being processed,
 *  the request has to be killed after the page is sucessuflly included.

 *  How does it work?
 *   - User calls a page.
 *   - Page includes "dir.php" in the same directory.
 *   - "dir.php" calls this script (starter.php) once (require_once or include_once)
 *   - this script calls additional helper scripts
 *   - this script calls the layout (layout.php)
 *   - the layout.php includes the (originaly requested) page, but the one in "_lang/i18n"
 */

/** TPL_CLIENT_ROOT is used, if you want to run the application on a server
 * (like apache/localhost), where the application is not the web-root.
 */

  // Error reporting must also be enabled in
  // /etc/php5/apache2/php.ini "display.errors = On"
  // (/etc/init.d/apache2 restart)
  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

  include_once 'path.class.php';
  // USE $TPL_PATHS-> ...
  //global $TPL_PATHS; // initialized in "path.class.php"
  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . '/domain/ColorNomination.class.php';

  /*include 'debuginfo.php'; */

  // uncomment if breadcrumbs used
  // The names of the "breadcrumbs" are defined in "dir.php" and "index.php"
  include_once 'breadcrumbs.class.php';
  // USE $TPL_BREADCRUMBS->..

  include $TPL_PATHS->getServerRoot() . "_layout/layout.php";
?>