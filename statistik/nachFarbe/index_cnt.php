<?php
	global $TPL_PATHS;
	require_once $TPL_PATHS->getServerRoot() . 'domain/Color.class.php';
	require_once $TPL_PATHS->getServerRoot() . 'statistik/ColorStatistics.class.php';
	global $TPL_LANG;
?>

<?php
// speziell für Bruno.
	function hasValue($v) {
		return isset($v);
	}

//	if(hasValue($_POST['colorp'])) {
	if(array_key_exists("colorp", $_POST)) {
		$col = new Color();
		$col->setByHex($_POST['colorp']);
		$colStat = new ColorStatistics();
		$colStat->setColor($col);
		$colStat->fullRangeByRGBHoriz();
	}
?>


<table>
	<tr style="vertical-align:top;">
		<td><div id="picker" /></td>
		<td>
		<form action="" style="width: 400px;" method="POST">
		<div class="form-item"><table><tr><td><label for="color">Hex:</label></td>
		
		<td><input type="text" id="color" name="colorp" value="<?php 
		     if (array_key_exists("colorp", $_POST)) {
		        echo $_POST["colorp"];
		     } else {
		       echo "#888888";
		     }
		  ?>" /></td></tr>
	<tr><td>&#160;</td><td>
		<input type="submit" value="<?php $TPL_LANG->echoText('statistik.stat.byColour.quest')?>" />
</div></td></tr></table>
			</form>
		</td>
	</tr>
</table>


<p>Color-Picker by <a href="http://www.acko.net/">Steven Wittens</a> under the <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a>.</p>
