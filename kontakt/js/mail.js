// Autor Philipp Gressly Freimann (phi <ät> gress <dot> ly)
// Date: März 2011
//
// Prüfe, ob die Eingaben für das Formular korrekt sind.
// Korrekt: Mindestens Titel oder Inhalt.
//          javascript:  E-Mail möglich
//          serverseite: E-Mail nochmals prüfen, wenn vorhanden.

// MAIN
// Main entry Point for this Script: Called by "handlers.js"

//function mail_init() {
//    entryCheck();
//}

/* Check on every keyUp-Event ...*/
function entryCheck() {
  alertUserOnMissingOrIllegalEntries();
  setButtonState();
}

function alertUserOnMissingOrIllegalEntries() {
  alertUserOnIllegalEMail();  
  setDoppelforderungColor("INPUT_Subject", "LBL_Subject", "INPUT_Message", "LBL_Message");
}

function alertUserOnIllegalEMail() {
  var str_EMail    = getTrimmedValue("INPUT_EMail");
  if(! isEMailValid(str_EMail)) {
      markEMailCSS("entry_illegal");
  } else {
      markEMailCSS("entry_ok");
  }
}

function markEMailCSS(cssClass) {
   markElementCSS("LBL_EMail",   cssClass);
   markElementCSS("INPUT_EMail", cssClass);
}

function markElementCSS(eleID, cssClass) {
  var ele = document.getElementById(eleID);
  if(null == ele) {
      window.alert("DEBUG markElementCSS unknown ID: " + eleID);
      return;
  }
  var cls = ele.getAttribute("class");
  if(null == cls) {
      ele.setAttribute("class", cssClass);
      return;
  }
  if(cls.indexOf(cssClass) >= 0) {
    //window.alert("markElementCSS already: " + cssClass + " in (" + cls + ")");
    return;
  }
  ele.setAttribute("class", cssClass);
}

function alertUserOnMissingEntries() {
  window.alert("alert User on missing entries: NOT ANY MORE"); //     setDoppelforderungColor("INPUT_Subject", "LBL_Subject", "INPUT_Message", "LBL_Message");
}

function istWertEingefuellt(txt_feld_name) {
    var feldStr = getTrimmedValue(txt_feld_name);
    var len = feldStr.length;
    return len > 0;
}

function sindAlleForderungenErfuellt() {
    var subjectGefuellt      = istWertEingefuellt("INPUT_Subject");
    var messageGefuellt      = istWertEingefuellt("INPUT_Message");
    var mailValid            = isEMailValid(getTrimmedValue("INPUT_EMail"));

    return (subjectGefuellt || messageGefuellt) && mailValid;
}


function setDoppelforderungColor(frd1, lbl1Id, frd2, lbl2Id) {
    var iTxt1 = getTrimmedValue(frd1);
    var iTxt2 = getTrimmedValue(frd2);
    
    var ok = iTxt1.length > 0 || iTxt2.length > 0;
       
    markElementCSS(lbl1Id, ok? "entry_ok" : "entry_illegal");
    markElementCSS(lbl2Id, ok? "entry_ok" : "entry_illegal");
}

function setButtonState() {
  var submitButton = document.getElementById("INPUT_submit");
  //disableByDefault();
  var oks = sindAlleForderungenErfuellt();
  //window.alert("OK: " + oks)
  submitButton.disabled = ! oks;
  if(!oks) {
      submitButton.setAttribute("class", "button_inactive");
  } else {
      submitButton.setAttribute("class", "button_active");
  }  
}

function isEMailValid(str_EMail) {
    if(null == str_EMail) {
        return false;
    }
    if("" == str_EMail) {
        return false;
    }
    if(containsInnerSpaces(str_EMail)) {
        return false;
    }
    if(str_EMail.length < 1) {
        return false;
    }
    atPoint     = str_EMail.indexOf('@');
    lastAtPoint = str_EMail.lastIndexOf('@');
    lastDot     = str_EMail.lastIndexOf('.');
    if(atPoint != lastAtPoint) {
        return false;
    }
    if(atPoint < 0) {
        return false;
    }
    if(atPoint  + 1 < lastDot && lastDot < str_EMail.length - 2) {
        return true
    }
    return false;
}

function containsInnerSpaces(str) {
    if(null == str || str.length < 1) {
        return false;
    }
    return 0 <= str.trim().indexOf(" "); 
}