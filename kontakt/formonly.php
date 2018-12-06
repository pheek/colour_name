<form method="POST">
<?php
	global $TPL_LANG;

	$frm_name    = $TPL_LANG->getText('kontakt.name'   );
	$frm_email   = $TPL_LANG->getText('kontakt.email'  );
	$frm_subject = $TPL_LANG->getText('kontakt.subject');
	$frm_message = $TPL_LANG->getText('kontakt.message');
	$frm_submit  = $TPL_LANG->getText('kontakt.submit' );
	$frm_backMsg = $TPL_LANG->getText('kontakt.backMsg');
	$frm_intro   = $TPL_LANG->getText('kontakt.intro'  );
         
	function emptyPostVar($pv) {
		if(! isset($_POST[$pv])) {
			//echo "{dbg emptiing: " . $pv . "}.<br />\n";
			$_POST[$pv] = "";
		}
	}
	emptyPostVar("POST_Name"       );
	emptyPostVar("POST_EMail"      );
	emptyPostVar("POST_Subject"    );
	emptyPostVar("POST_Message"    ); 
	emptyPostvar("POST_SelfMessage");
	emptyPostVar("POST_kontakt"    ); 
?>

  <p><?php echo $frm_intro; ?></p> 
  <table style="background-color: #ddf; width: 80%;">
    <tr>
      <td><?php echo $frm_name; ?></td>
      <td><input style="width:12cm;" type="text" 
                  id="INPUT_Name" name="POST_Name" value="<?=$_POST["POST_Name"]?>" /></td>
    </tr>
    <tr>
      <td><span id="LBL_EMail"><?php echo $frm_email; ?></span></td>
      <td><input style="width: 12cm;" type="text"
                  id="INPUT_EMail" name="POST_EMail" value="<?=$_POST["POST_EMail"]?>" /></td>
    </tr>
    <tr>
      <td><span id="LBL_Subject"><?php echo $frm_subject; ?></span></td>
      <td><input style="width: 12cm;" type="text" 
                 id="INPUT_Subject" name="POST_Subject" value="<?=$_POST["POST_Subject"]?>" /></td>
    </tr>
    <tr style="vertical-align: top;"><td><span id="LBL_Message"><?php echo $frm_message?></span></td>
      <td><textarea style="width: 100%;" wrap="All" cols="80" rows="15" 
                    id="INPUT_Message" name="POST_Message"><?=$_POST["POST_Message"]?></textarea>
      </td>
    </tr>
    <tr><td>&#160;</td>
      <td><input type="checkbox" name="POST_SelfMessage" /><?php echo $frm_backMsg; ?></td>
    </tr>
    <tr>
       <td>&#160;</td>
      <td>
        <input class="button_inactive"  type="submit" name="POST_submit"
               id="INPUT_submit" value="<?php echo $frm_submit; ?>" /></td>
    </tr>
  </table>

</form>