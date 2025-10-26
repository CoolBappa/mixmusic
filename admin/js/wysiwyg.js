function iFrameOn(){
	richTextField.document.designMode = 'On';
}
function iText(){
	richTextField.document.execCommand('insertHTML',false,text); 
}
function iBold(){
	richTextField.document.execCommand('bold',false,null); 
}
function iUnderline(){
	richTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	richTextField.document.execCommand('italic',false,null); 
}
function iFontSize(){
	var size = prompt('Enter a size 1 - 7', '');
	richTextField.document.execCommand('FontSize',false,size);
}
function setGreen(){
	richTextField.document.execCommand('ForeColor',false,'green');
}
function setOrange(){
	richTextField.document.execCommand('ForeColor',false,'#dd4814');
}
function setBlue(){
	richTextField.document.execCommand('ForeColor',false,'blue');
}
function setBlack(){
	richTextField.document.execCommand('ForeColor',false,'#222');
}
function setPurple(){
	richTextField.document.execCommand('ForeColor',false,'#8e44ad');
}
function setTeal(){
	richTextField.document.execCommand('ForeColor',false,'#16a085');
}
function setPink(){
	richTextField.document.execCommand('ForeColor',false,'deeppink');
}
function setRed(){
	richTextField.document.execCommand('ForeColor',false,'red');
}
function iHorizontalRule(){
	richTextField.document.execCommand('inserthorizontalrule',false,null);
}
function iUnorderedList(){
	richTextField.document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedList(){
	richTextField.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLink(){
	var linkURL = prompt("Enter the URL for this link:", "http://"); 
	richTextField.document.execCommand("CreateLink", false, linkURL);
}
function iUnLink(){
	richTextField.document.execCommand("Unlink", false, null);
}
function iImage(){
	var imgSrc = prompt('Enter image location', '');
    if(imgSrc != null){
        richTextField.document.execCommand('insertimage', false, imgSrc); 
    }
}

function submit_form(){
	var theForm = document.getElementById("myform");
	theForm.elements["myTextArea"].value = window.frames['richTextField'].document.body.innerHTML;
	theForm.submit();
}
