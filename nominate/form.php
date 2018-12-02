<?php
  global $TPL_PATHS;
  require_once $TPL_PATHS->getServerRoot() . 'domain/ColorNomination.class.php';

  $nomination = getBean('Nomination');
  if($nomination->isSaved() || isset($_POST['next_color'])) {
    $nomination->reset();
  }
?>

<?php global $TPL_LANG; ?>
<p><?php $TPL_LANG->echoText('nominate.descLine1'     ); ?><br />
   <?php $TPL_LANG->echoText('nominate.descLine2'     ); ?><br />
   <?php $TPL_LANG->echoText('nominate.nameThisColour'); ?>:</p>

<form  method="post"> <?php /* no action: Affenformular */ ?>
 
   <?php 
      global $TPL_PATHS;
      include_once $TPL_PATHS->getServerRoot() . 'nominate/dropdowns.fct.php';
    ?>

   <table><tr><td><span id="netzhaut_lbl"><?php $TPL_LANG->echoText('nominate.retina') ?></span></td>                         <td><?php $TPL_LANG->echoText('nominate.medium')?></td>&#160;<td></td>
          </tr>
          <tr><td><?php echo getNetzhautDropDown(); ?></td><td><?php  echo getMediumDropDown()  ; ?></td>

              <td>(<a target="_blank" href="http://labs.tineye.com/multicolr#colors=<?php echo $nomination->getColour()->getHex();?>;weights=100;"><?php $TPL_LANG->echoText('nominate.tipp'); ?></a>)</td>
          </tr>
   </table>


<?php  include_once $TPL_PATHS->getServerRoot() . '/nominate/helper.fct.php';
?>

	<table style="width:100%;">
		<tr>
			<td colspan="3"><?php showNominationColor(); ?></td>
		</tr>
		<tr>
			<td style="width:80%;">
				<p><?php $TPL_LANG->echoText('nominate.form.your.nomination'); ?>:&#160;<input type="text"
				 id     = "nameField"
				 onfocus= "disableButtons()"
				 onkeyup= "disableButtons()"
				 value  = "<?php echo $nomination->getName();?>"
				 name   = "color_name"
				 size   = "40" />
				</p>
			</td>
			<td><p><input id="okButton"   type="submit" name="okBtn" value="<?php $TPL_LANG->echoText('nominate.form.submit')?>" /></p> </td>
			<td><p><input id="abbruchBtn" type="submit" name="next_color"      value="<?php $TPL_LANG->echoText('nominate.form.different')?>" />  </p></td>
		</tr>
	</table>

</form>