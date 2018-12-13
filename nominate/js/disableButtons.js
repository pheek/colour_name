/**
 * This client-side function enables the OK-Button as soon
 * as the user selected netzhaut, medium and colorname.
 * 
 * The function is called at body.onload and on each change of any field.
 */
function disableButtons() {
	var okButt     = document.getElementById("okButton")           ;
	var sText      = document.getElementById("nameField")   . value;
	var ddNetzhautSelect = document.getElementById('netzhaut_dd');
	var ddNetzhautValue  = ddNetzhautSelect.options[ddNetzhautSelect.selectedIndex].value;
	var ddMediumSelect   = document.getElementById('medium_dd');
	var ddMediumValue    = ddMediumSelect.options[ddMediumSelect.selectedIndex]    . value;
 				
	okButt.disabled = ("" == sText) || ("none" == ddNetzhautValue) || ("none" == ddMediumValue);
  
	//document.getElementById("nextBtn").focus();
	document.getElementById("nameField").focus();
 
	if("none" == ddNetzhautValue) {
		ddNetzhautSelect.style.color = 'red';
	} else {
    ddNetzhautSelect.style.color = 'black';
	}
	if("none" == ddMediumValue) {
    ddMediumSelect.style.color = 'red';
	} else {
    ddMediumSelect.style.color = 'black';
	}
} // call in body: onload
