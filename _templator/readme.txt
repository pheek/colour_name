************************
      _templator
************************
GNU Lesser Public Licence
2006 phi@gressly.ch


Function
********

    * Each directory contains a file called "dir.php".
      This dir.php starts the /_templator/_bin/starter.php - script.
    * Each file (xyz.php or index.php) should start with the following line:
       <?php $TPL_PAGE_TITLE="my page"; include "dir.php"; ?>

* 1. dir.php includes the templator.
      2. the templator includes the given (or requested) template.php
      3. the template includes the original page and stops further
         processing (see "die()" in starter.php).


Variables
*********
Set these variables in your content and "dir.php" files:

  $TPL_PAGE_TITLE (any page) : Title of the actual Page <title>xxx</title>
  $TPL_DIR_NAME   (dir.php)  : Readable name of the directory.

Use the following

   $TPL_CLIENT_ROOT (starter.php) Used for links
   $TPL_SERVER_ROOT (starter.php) Used for includes


   $tpl_urls  :: Class     Nützliche Funktionen für die URLs (<a href
                           ...> / include / ...)
      * getClientPath()
      * getCanonicalPath()
      * webLink()

   $tpl_act_style :: Class     Style abhängige Funktionen
      * getName()
