<?php


// Mail Funktionen

 /**
  * return true, iff the post-variable is NOT empty.
  */
	function notEmptyPost($varname) {
		if(! isset($_POST[$varname])) {
			return false;
		}
		return "" != trim($_POST[$varname]);
	}

 /**
  * Check, if at least one field contains something.
  */
	function issetSomething() {
		return notEmptyPost("POST_EMail")       ||
			notEmptyPost("POST_Name")        ||
			notEmptyPost("POST_Subject")     ||
			notEmptyPost("POST_Message")     ||
			notEmptyPost("POST_kontakt")     ||
			notEmptyPost("POST_SelfMessage");
	}

 /**
  * Check, if the Message contains enough information to be sent. That is:
  * E-Mail must be filled
  * Subject or Message musst be filled
  * E-Mail must be consistent (contain an @ sign) 
  * TODO: E-Mail is not checked yet.
  */
	function isCorrect() {
		if(! notEmptyPost("POST_EMail")) { return false; }
		if(!isValidInetAddress($_POST["POST_EMail"])) {
			return false;
		}
		return notEmptyPost("POST_Subject") || notEmptyPost("POST_Message") ;
	}

 /**
  * Tell the user, what a correct message must be.
  */
	function howtoMessage() {
		global $TPL_LANG;
		echo '<p style="color: #A60; font-size:144%;"><b>';
		$TPL_LANG->echoText('kontakt.err.msg.1');
		echo '</b></p><br />' . "\n";
	}

	function sendMailMessage() {
		$to    = 'philipp.gressly@gmail.com';
		$from  = $_POST["POST_Name"] . '" <' . $_POST["POST_EMail"] . '>';
		contentMailer($to, $from);
		if(notEmptyPost("POST_SelfMessage")) {
			$to   = $from;
			$from = "info@colour.name";
			contentMailer($to, $from);
		}
		//remove fields
		$_POST["POST_EMail"] = ""; // send again, only if user enters email agai
	}

	function contentMailer($to, $from) {
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=utf-8\r\n";
		$headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
		$headers .= 'from: "' . $_POST["POST_Name"] . '" <' . $_POST["POST_EMail"] . '>';

		$subject = 'Formular www.colour.name: ' . $_POST["POST_Subject"];

		$message = 'Name: '        . $_POST["POST_Name"]    . "\n\n" .
		           "Message:\n\n"  . $_POST["POST_Message"];

		mail($to, $subject, $message, $headers);
	}


	function thankYourMessage() {
		global $TPL_LANG;
		echo '<h2>'. $TPL_LANG->getText('kontakt.thanks') . "</h2>\n";
		echo "<p style=\"font-size: 150%; \">" . $TPL_LANG->getText('kontakt.thanks.desc') .  "</p><br />\n";
	}


	// Steuerung
	function mail_steuerung() {
		if(issetSomething()) {
			if(isCorrect()) {
				sendMailMessage();
				thankYourMessage();
			} else {
				howtoMessage();
				include "formonly.php";
			}
		} else {
			include "formonly.php";
		}
	}


?>