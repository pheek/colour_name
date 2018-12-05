<?php
  
	function echoCopyright() {
		global $TPL_PATHS;
		global $TPL_LANG;
		echo '&copy; 2008-2018; Philipp Gressly Freimann <a href="http://www.gress.ly">phi &lt;at&gt; gress DOT ly</a>';
		$TPL_PATHS->intLink("kontakt", $TPL_LANG->getText('kontakt.link.name'));
	}
  
  echoCopyright();
?>
