<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php 

$userid = $_GET['memid'];


?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Update Form</title>
<!--<script language="javascript" type="text/javascript" src="jscripts/niceforms.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
--->
<script type="text/javascript" src="jscripts/cbox.js"></script>
<SCRIPT TYPE="text/javascript">
<!--
function targetopener(mylink, closeme, closeonly)
{
if (! (window.focus && window.opener))return true;
window.opener.focus();
if (! closeonly)window.opener.location.href=mylink.href;
if (closeme)window.close();
return false;
}
//-->
</SCRIPT>
<script type="text/javascript">

        function toggleVisibility(controlId,Visible)
        {
            var control = document.getElementById(controlId);
			if (Visible) {
				control.style.visibility = "visible";
			}else{
				control.style.visibility = "hidden";
			}

           // if(control.style.visibility == "visible" || control.style.visibility == "")
           //     control.style.visibility = "hidden";
           // else 
           //     control.style.visibility = "visible";
 
        }



	function valchange(GDpDown, Evnt) {

		     var control = document.getElementById("position");
		  	 var PosVal = control.value;

		  fnChangeHandler_A(GDpDown, Evnt); 
		  if (document.form1.position.value == "Past State Deputy"){

				toggleVisibility("psdterm", true);
				//toggleVisibility("deceased", true);
				toggleVisibility("psdlab", true);
				//toggleVisibility("declab", true);
		  }else{
				toggleVisibility("psdterm", false);
				//toggleVisibility("deceased", false);
				toggleVisibility("psdlab", false);
				//toggleVisibility("declab", false);
		  }
				
			return true;

		}

	function init() {

	     var control = document.getElementById("position");
	  	 var PosVal = control.value;

		toggleVisibility("psdterm", false);
		toggleVisibility("deceased", false);
	    toggleVisibility("psdlab", false);
		toggleVisibility("declab", false);
		document.getElementById("userid").focus();

				
			return true;

		}



</script>

<SCRIPT TYPE="text/javascript">
<!--
function popup(mylink, windowname)
{
	var control = document.getElementById('userid');
	
	var tarstr = 'posform.php?memid='+ control.value;
			
	if (! window.focus)return true;
	var href;
	if (typeof(mylink) == 'string')
	   href=mylink + '?memid='+control.value;
	else
	   href=mylink.href;
	//href = tarstr;
	window.open(href, windowname, 'width=750,height=400,scrollbars=no');
	return false;
}
//-->
</SCRIPT>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
</head>
<body onload="init()">

	<form id="posform1" name="posform1" method="post"  action="posform.php" class = "niceform">
	  <table align="center" width="750"	 border="0">
   
		<tr>
        	<td colspan="4">
               <?php include "psf.php";?>
             </td>
        </tr>    
		  <tr>
			<td colspan="4" align="center"><button onclick="return popup('addpos.php','addpos')">Add </button>&nbsp;&nbsp;<button onclick="return targetopener(this,true,true)">Cancel </button>

		    </td>
		  </tr>
	  </table>
	</form>
	</body>
	</html>
