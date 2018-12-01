<?php
 
 // Draw a line of languages, which can be selected.
 // the actual language is also listed, but not as link.

 global $TPL_LANG;
  
 echo '<span class="lang_selector">';
 $isFirst = true;
 foreach($TPL_LANG->getPossibleLanguagesArray() as $lng) {
   if(! $isFirst) {
       echo "&#160;&#160;|&#160;&#160;";
   }
   $isFirst = false;
   if($TPL_LANG->getLanguage() == $lng) {
       echo $lng;
   } else {
     echo '<a href="?lang=' . $lng . '">' . $lng . '</a>';
   }
 }
 echo '</span>';
 
?>
