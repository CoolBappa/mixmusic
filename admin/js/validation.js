//function for check / uncheck all [named] checkboxes
function checkUncheckAll(theElement,chkname) {
	    var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){

      if(theForm[z].type == 'checkbox' && theForm[z].name == chkname && (!theForm[z].disabled)){
	  theForm[z].checked = theElement.checked;
	  }
     }
    }
	
//function for check if any checkbox selected [named] checkboxes
function checkAnySelected(theElement,chkname) {
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){

      if(theForm[z].type == 'checkbox' && theForm[z].name == chkname && (!theForm[z].disabled) && (theForm[z].checked)){
	  return true;
	  }
     }
	 return false;
    }
//function for validate form data

function chkfrm(Compulsory,CompulsoryName,frm)
{
	for (i=0;i<=Compulsory.length-1;i++)
		{
			//myobj = document.getElementById(Compulsory[i]);
			myobj = eval('frm.'+ Compulsory[i]);
				
			if(myobj)
			{
				if(myobj.value.length<=0)
				{
					alert("Enter " + CompulsoryName[i]);
					myobj.focus();
					return false;
				}
			}
		}
		return true;
}

//function for validate float data
function chkfloat(Compulsory,CompulsoryName,frm)
{

	for (i=0;i<=Compulsory.length-1;i++)
		{
			//myobj = document.getElementById(Compulsory[i]);
			myobj = eval('frm.'+ Compulsory[i]);

			if(myobj)
			{
				if(isNaN(myobj.value))
				{
					alert("Enter valid " + CompulsoryName[i]);
					myobj.focus();
					return false;
				}
			}
		}
		
		return true;
}


//function for validate combo by comparing it's default value
function chkcombo(Compulsory,CompulsoryDefault,CompulsoryName,frm)
{
	for (i=0;i<=Compulsory.length-1;i++)
		{
			//myobj = document.getElementById(Compulsory[i]);
			myobj = eval('frm.'+ Compulsory[i]);
			
			if(myobj)
			{
				if(myobj.value.length<=0 || myobj.value == CompulsoryDefault[i])
				{
					alert("Select " + CompulsoryName[i]);
					myobj.focus();
					return false;
				}
			}
		}
		
		return true;
}

//function for validate email address
function validemail(myfld)
{
	x=myfld.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (filter.test(x)) return true;
	else {alert('Invalid Email address'); myfld.focus(); return false;}
}

//function for validate image
function validcsv(myfld)
{
	strname = myfld.value;
	strname=strname.substring(strname.lastIndexOf(".")+1)
	strname=strname.toLowerCase();
	if(strname != "csv")
	{
		alert(" Only CSV Files are allowed");
		myfld.focus();
		return false;
	}
	return true;
}

//function for validate image
function validimage(myfld)
{
	strname = myfld.value;
	strname=strname.substring(strname.lastIndexOf(".")+1)
	strname=strname.toLowerCase();
	if(strname != "jpg" && strname!="gif" && strname!="png")
	{
		alert(" Please Select Image Type To [jpg | gif | png ]");
		myfld.focus();
		return false;
	}
	return true;
}

function openpage(url)
{
	window.open(url,"","scrollbars=yes,toolbar=no,left=100,height=300,top=200,width=850"); return false;
}

//function for validate audio
function validaudio(myfld)
{
	strname = myfld.value;
	strname=strname.substring(strname.lastIndexOf(".")+1)
	strname=strname.toLowerCase();
	if(strname != "mp3" && strname!="wav")
	{
		alert(" Please Select Audio Type To [ .mp3 | .wav ] !");
		myfld.focus();
		return false;
	}
	return true;
}

//function for validate audio
function validvideo(myfld)
{
	strname = myfld.value;
	strname=strname.substring(strname.lastIndexOf(".")+1)
	strname=strname.toLowerCase();
	if(strname != "flv" && strname!="mpeg" && strname!="mpg" && strname!="avi")
	{
		alert(" Please Select Audio Type To [ .flv | .mpeg | .mpg | .avi ] !");
		myfld.focus();
		return false;
	}
	return true;
}

//function for compare 2 fields
function cmpvalue(myfld1,myfld2,errmsg)
{
	val1 = myfld1.value;
	val2 = myfld2.value;
	
	if(val1==val2) return true;
	else {alert(errmsg); myfld1.focus(); return false;}
	
}


//function for check valid user name
function ValidUserName(username)
{
	var illegalChars = /\W/;
  // allow only letters, numbers, and underscores
    if (illegalChars.test(username.value)) {
		alert('Enter Valid User Name');
		username.focus();
       return false;
    }
	else return true;
}

//function for show big image
function ViewImage(img)
{
		window.open(img);
}


function changecolortonormal(ctrl)
{
	ctlname=ctrl.name;
	document.getElementById(''+ctlname+'').style.color='black';
}

function confbox()
{
	var x = confirm('msg');
	return x;
}
function ShowPopup(url,height,width)
{
		window.open(url,'name','height='+height+',width='+width);
}


function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}
function refresh_headerchk(FormName, FieldName,headerchk)
{
	var flg=true;
	
	if(!document.forms[FormName])
		return;
	var headerchkObj=document.forms[FormName].elements[headerchk];
	var objCheckBoxes = new Array();
	objCheckBoxes=document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	
	for(i=0;i<countCheckBoxes;i++)
	{
		if(objCheckBoxes[i].checked==false)
		{
			flg=false;
			break;
		}
		
	} 
	headerchkObj.checked=flg;
}

function is_zero_checked(FormName, FieldName)
{
	
	var flg=true;
	
	if(!document.forms[FormName])
		return false;
	
	var objCheckBoxes = new Array();
	objCheckBoxes=document.forms[FormName].elements[FieldName];
	
	if(!objCheckBoxes)
		return;
	
	var countCheckBoxes = objCheckBoxes.length;
	
	for(i=0;i<countCheckBoxes;i++)
	{
		if(objCheckBoxes[i].checked==true)
		{
			flg=false;
			break;
		}
		else
		{
			continue;
		}
	} 
	if(flg==true)
	{
		alert("Please select at least one row to continue the process.");
		return false;
	}
	else
	{
		return true;
	}
}

function checkUncheckAll(theElement,chkname)
{
     var theForm = theElement.form;
	 var z = 0;
	 for(z=0; z<theForm.length;z++)
	 {
		if(theForm[z].type == 'checkbox' && theForm[z].name == chkname && (!theForm[z].disabled))
		{
	  		theForm[z].checked = theElement.checked;
	  	}
     }
}

function ban_msg(itemstr)
{
	switch(itemstr)
	{
		case "gang":
			alert("The Gang is banned : Access denied!");
			return false;
			break;
			
		case "forum":
			alert("The Forum is banned : Access denied!");
			return false;
			break;
		
		case "freply":
			alert("The Forum Reply is banned : Access denied!");
			return false;
			break;
		
		case "poll":
			alert("The Poll is banned : Access denied!");
			return false;
			break;
	
	}
	return true;
}
	
function show_logo_tip(sorce,href,divleft,width)
{	
	document.getElementById("logo_div").style.display="block";
}
function hide_logo_tip()
{
	document.getElementById("logo_div").style.display="none";
}
		
function overlay(curobj, subobjstr, opt_position)
{
	if (document.getElementById)
	{
		var subobj=document.getElementById(subobjstr);
		subobj.style.display=(subobj.style.display!="block")? "block" : "none";
		var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0); 
		var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0);
		subobj.style.left=xpos+"px";
		subobj.style.top=ypos+"px";
		return false;
	}
	else
	{
		return true;
		}
}
function overlayclose(subobj)
{
	document.getElementById(subobj).style.display="none";
}

function getposOffset(overlay, offsettype){
var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
var parentEl=overlay.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

//function for check any checkboxes are checked or not
function AnyChecked(theForm,chkname) {
 var z = 0;
 for(z=0; z<theForm.length;z++){

  if(theForm[z].type == 'checkbox' && theForm[z].name == chkname && (!theForm[z].disabled) && theForm[z].checked){
  return true;
  }
 }
 return false;
}

function validateno()
{
	if((event.keyCode<48) || (event.keyCode>58))
	{
		if(event.keyCode!=13)
		{
			event.keyCode=0;
			//alert("Only Numbers are Allowed");		
		}
		if(event.keyCode==13)
		{
			var t=document.f1.pgsize.value;
			var passed=true;
			if(isNaN(t))
			{
				alert("Only Numbers are Allowed");
				passed=false;
				document.f1.pgsize.focus();
			}
			else
			{
				if(t>100)
				{
					alert("Record Per Page is less than 100");
					passed=false;
					document.f1.pgsize.focus();
				}
				if(t<10)
				{
					alert("Record Per Page is greater than 10");
					passed=false;
					document.f1.pgsize.focus();
				}
			}
			if(passed==true)
			{
				document.f1.action="allacate.php";
				document.f1.submit();
			}
			else
			{
				event.keyCode=0;
			}
		}
	}
}