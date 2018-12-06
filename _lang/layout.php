<?php 
  global $TPL_PATHS;
  global $TPL_LANG;
  require_once $TPL_PATHS->getServerRoot() . '_templator/custom_css.php';

  $TPL_CUSTOM_CSS[sizeof($TPL_CUSTOM_CSS)] = "css/rahmen.bunt.css";
  
  // check for "true" and not only for "it is there"!
  global $HAS_TO_BE_GRAY;
  if(/*isset($HAS_TO_BE_GRAY) && */ $HAS_TO_BE_GRAY) {
    // if not loaded from submit.
    // this must be done befor the include of the templator is performed
    $TPL_CUSTOM_CSS[sizeof($TPL_CUSTOM_CSS)] = "css/rahmen.gray.css";
  }

  include $TPL_PATHS->getServerRoot() . '_lang/htmlheader.php'; ?>

 <body <?php 
    if(isset($TPL_CUSTOM_BODY_ONLOAD)) {
    	echo " onload=\"". $TPL_CUSTOM_BODY_ONLOAD ."\"";
    }
  ?> >
     
  <table style="width: 100%; height: 100%;">
   <!-- head -->
   <tr class="rahmenhoehe">
    <td class="rahmenbreite rahmen_lt"></td>
    <td class="rahmen_tt"></td>
    <td class="rahmenbreite rahmen_rt"></td>
   </tr>
  
   <tr  style="vertical-align:top;">
       <td class="rahmenbreite rahmen_ll"></td>
       <td  style="padding: 3mm;">

        <table style="width: 100%;">
         <tr>
          <td> <h1><?php echo $TPL_LANG->getPageTitle(); ?></h1></td>
          <td style="text-align:right;"><?php echo $TPL_PATHS->intLink("", '<div class="logo"></div>' );?></td>
         </tr>
        </table>

        <?php include_once ''. $TPL_LANG->getLanguage() . "/navigation.php"; ?>

        <hr />
        <?php echo $TPL_BREADCRUMBS->getTrail(); ?>
        <hr />

            <?php // Hier wird der eigentliche Content eingebaut: ?>
          <table style="width: 100%;"><tr><td><?php include $TPL_PATHS->getServerPathLang(); ?></td></tr></table>

       </td>  
       <td class="rahmenbreite rahmen_rr"></td>
   </tr>
 
 <!-- foot -->
 <tr class="rahmenhoehe">
   <td class="rahmenbreite rahmen_lb"></td>
   <td class="rahmen_bb"><?php include_once "langSelector.php"; ?></td>
   <td class="rahmenbreite rahmen_rb"></td>
 </tr>

</table> </body> </html>