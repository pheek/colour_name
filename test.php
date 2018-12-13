<?php
	global $TPL_NO_LANG_FOLDER;
	$TPL_NO_LANG_FOLDER = true;
	include_once 'dir.php';
 ?>

<p>Diese Seite ist absichtlich nicht übersetzt in andere Sprachen. Sie zeigt lediglich den Entwicklern, wie vorzugehen sei.</p>
<p>Dieser Test zeigt, dass hier Seiten geben kann, die nicht von der Sprache abhängig sind.</p>
		<h3>Philosophie</h3>

		<h4>Webseiten mit quasi nur Text</h4>

		<p>Webseiten mit Quasi nur Text werden in <tt>/_lang/xy/&lt;folder&gt;/site.php</tt> abgespeichert. Damit diese Seiten korrekt aufgerufen werden, stehen sie ebenso auf der oberster Hierarchie in <tt>/&lt;folder&gt;/site.php</tt>; dort stehet lediglich "<tt>include_once 'dir.php';</tt>" drin. Damit wird sowohl das Layout, wie auch der Sprachinhalt geladen.</p>


   <h4>Webseiten mit keinem Text oder mit ausschließlich Property-Text</h4>
<p>Steht in einer Seite lediglich proprety-Text oder anderes, so wird wie hier folgendes eingegeben:</p>
<pre>

	global $TPL_NO_LANG_FOLDER;
	$TPL_NO_LANG_FOLDER = true;
	include_once 'dir.php';

</pre>
<p>Dabei wird das Sprach Unterverzeichnis "<tt>/_lang/xy/&lt;folder&gt;/</tt>" weggelassen und lediglich das layout geladen. Danbei die aktuelle Seite selbst wieder eingefügt. Wichtig hier ist das "<tt>include_once</tt>", datit '<tt>dir.php</tt>' nicht nochmals eingebunden wird.</p>