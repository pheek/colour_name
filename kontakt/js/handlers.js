// 16. 3. 2011
// Author: Philipp Gressly Freimann

// Shows how to separate business logic from handlers from Document.
// Notice that there are ABSOLUTELY NO handlers registered in the
// main xhtml-Document! (Idea Victor Ruch, Timon Waldvogel: Siemens)
//
// Notice also, that there are no Business functions declared in here.

///////////// H A N D L E R S ///////////////////                                         


function registerHandlers() {
  //              Tag-ID             EVENT       FUNCTION(business functions)
  registerHandler("INPUT_Subject",   "onkeyup" , "entryCheck");
  registerHandler("INPUT_Subject",   "onclick" , "entryCheck");
  registerHandler("INPUT_Subject",   "onchange", "entryCheck");
  registerHandler("INPUT_EMail"  ,   "onkeyup" , "entryCheck");
  registerHandler("INPUT_EMail"  ,   "onclick" , "entryCheck");
  registerHandler("INPUT_EMail"  ,   "onchange", "entryCheck");
  registerHandler("INPUT_Message",   "onkeyup" , "entryCheck");
  registerHandler("INPUT_Message",   "onclick" , "entryCheck");
  registerHandler("INPUT_Message",   "onchange", "entryCheck");
}

// Main entry point: Notice that this is the only call outside a function.
window.onload = function() {
    registerHandlers();
    entryCheck(); // geschieht in mail.js
};

/////////////////////////////////////////////////
/**
 * @param id       XML-ID of the TAG
 * @param event    onkeyup, onclick, on... (any HTML Event Handler)
 * @param fct      the function to be executed when the Handler is activated
 */
function registerHandler(id, event, fct) {
    var IDEle = document.getElementById(id);
    if(null == IDEle) {
        // usually wrong page (no "id" available) "thank-page"
        return;
    }
    IDEle.setAttribute(event, fct + "();");
}

/////////////////////////////////////////////////
function loadScript(name) {
  var firstScript = document.getElementsByTagName("script")[0];
  var bScript     = createScriptTag(name);
  firstScript.parentNode.insertBefore(bScript, firstScript);
}

function createTagNS(type) {
  var tag;
  var ns = "http://www.w3.org/1999/xhtml";
  if(document.createElementNS) { // firefox knows ElementNS
    tag = document.createElementNS(ns, type);
  } else {
    tag = document.createElement(type);
  }
  return tag;
}

function createScriptTag(name) {
    var scriptTag;
    scriptTag = createTagNS("script");
    scriptTag.async = true;
    scriptTag.setAttribute("type", "text\/javascript");
    scriptTag.setAttribute("src" , name);
    return scriptTag;
}
