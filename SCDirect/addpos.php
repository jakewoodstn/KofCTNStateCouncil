<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Update Form</title>
<!--<script language="javascript" type="text/javascript" src="jscripts/niceforms.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
--->
<script type="text/javascript" src="jscripts/cbox.js"></script>
\<SCRIPT TYPE="text/javascript">
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

	function init() {

	     var control = document.getElementById("position");
	  	 var PosVal = control.value;

		document.getElementById("position").focus();

				
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
	//if (typeof(mylink) == 'string')
	//   href=mylink;
	//else
	//   href=mylink.href;
	href = tarstr;
	window.open(href, windowname, 'width=750,height=400,scrollbars=no');
	return false;
}
//-->
</SCRIPT>
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
</head>
<body onload="init()">

<?php
require_once('data.php');
include('config.php');

$userid = ltrim($_GET['memid'],"0");

#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
// also make sure they have admin rights
if (($_COOKIE['validlogin']=='true' && $_COOKIE['logID']>=0) || $_COOKIE['adminlogin']=='true' || $_COOKIE['speclogin']=='NEW'){
	if(isset($_POST) && $_POST){
		$poPos	= $_POST['position'];
		$fratyear = $_POST['fratyear'];
		$dirgrp = $_POST['dirgroup'];
		$secord = $_POST['secorder'];
		switch($poPos){
			case "Grand Knight":
				$dirgrp = 6;
				break;
			case "Financial Secretary":
				$dirgrp = 7;
			    break;
			case "District Warden":
				$dirgrp = 5;
				break;
			case "Faithful Navigator":
				$dirgrp = 10;
				break;
			case "Faithful Comptroller":
				$dirgrp = 11;
				break;	
			case "District Deputy":
				$dirgrp = 4;
				break;
			case "State Deputy":
				$dirgrp = 1;
				$secord = 1;
				break;
			case "State Chaplain":
				$dirgrp = 1;
				$secord = 2;
				break;
			case "State Secretary":
				$dirgrp = 1;
				$secord = 3;
				break;
			case "State Treasurer":
				$dirgrp = 1;
				$secord = 4;
				break;
			case "State Advocate":
				$dirgrp = 1;
				$secord = 5;
				break;
			case "State Warden":
				$dirgrp = 1;
				$secord = 6;
				break;
			
		}
			
			
		
		
		$insquery = "INSERT INTO fratpos (cuserid, cposition, cfratyear, dirgroup, secorder) VALUES(";
		$insquery .= $userid .", \"" .$poPos ."\", " .$fratyear .", " .$dirgrp .", " .$secord .")";
	mail('tstaller@aol.com','Directory Query',$insquery);
		include 'configdb.php';
		include 'opendb.php';
		$result = mysql_query($insquery);
		if (!$result) {
			if (mysql_errno <> 1062){
				echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
				mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error() ."was encountered adding ".$userid ." " .$poPos ." " .$fratyear);
				echo '<button onclick="return targetopener(this,true,true)">';
				die;
			}
			include 'closedb.php';
		
		} else {
			include 'closedb.php';
			echo "<script> targetopener(this,true,true)</script>";
			die;
		}

	}
	?>
	
	<form id="pform1" name="pform1" method="post"  action="addpos.php?memid=<?php echo $userid;?>" class = "niceform">
	  <table align="center" width="720" border="0">
      	<tr>
        	<td colspan="5" align="center"><h1>Postion Entry</h1></td>
        </tr>
	  	<tr>
			<td width=125><div align="center">Membership Number</div></td>
            <td width=200><div align="center">Position</div></td>
            <td width=125><div align="center">Fraternal Year</div></td>
			<td width=125><div align="center">Group</div></td>
            <td width=125><div align="center">Section Order</div></td>
        </tr>
        <tr>
          	<td width=100 align="center"><strong><?php echo $userid; ?></strong></td>
			<td width=200 align="center"><select name="position" id="position" style="" tabindex="1"  onChange="valchange(this, event);" onKeyDown="fnKeyDownHandler_A(this, event);" onKeyUp="fnKeyUpHandler_A(this, event); return false;" onKeyPress = "return fnKeyPressHandler_A(this, event);">
			<option value="" selected="selected" style="font-family:Courier,monospace;color:#ff0000;background-color:#ffff00;">--?--</option> <!-- This is the Editable Option -->
            
			<option value="Grand Knight" <?php if ($position=="Grand Knight") {echo 'selected="selected"';}?>>Grand Knight</option>
			<option value="Financial Secretary" <?php if ($position=="Financial Secretary") {echo 'selected="selected"';}?>>Financial Secretary</option>
			<option value="Membership Director" <?php if ($position=="Membership Director") {echo 'selected="selected"';}?>>Council Membership Director</option>
			<option value="Program Director" <?php if ($position=="Program Director") {echo 'selected="selected"';}?>>Council Program Director</option>
			<option value="District Deputy" <?php if ($position=="District Deputy") {echo 'selected="selected"';}?>>District Deputy</option>
			<option value="District Warden" <?php if ($position=="District Warden") {echo 'selected="selected"';}?>>District Warden</option>
			<option value="Faithful Navigator" <?php if ($position=="Faithful Navigator") {echo 'selected="selected"';}?>>Faithful Navigator</option>
			<option value="Faithful Comptroller" <?php if ($position=="Faithful Comptroller") {echo 'selected="selected"';}?>>Faithful Comptroller</option>
			<option value="Past State Deputy" <?php if ($position=="Past State Deputy") {echo 'selected="selected"';}?>>Past State Deputy</option>
			<option value="State Deputy" <?php if ($position=="State Deputy") {echo 'selected="selected"';}?>>State Deputy</option>
			<option value="State Secretary" <?php if ($position=="State Secretary") {echo 'selected="selected"';}?>>State Secretary</option>
			<option value="State Treasurer" <?php if ($position=="State Treasurer") {echo 'selected="selected"';}?>>State Treasurer</option>
			<option value="State Advocate" <?php if ($position=="State Advocate") {echo 'selected="selected"';}?>>State Advocate</option>
			<option value="State Warden <?php if ($position=="State Warden") {echo 'selected="selected"';}?>">State Warden</option>
            <option value="State Chaplain" <?php if ($position=="State Chaplain") {echo 'selected="selected"';}?>>State Chaplain</option>
			<option value="Immediate Past State Deputy" <?php if ($position=="Immediate Past State Deputy") {echo 'selected="selected"';}?>>IPSD</option>
			<option value="General Program Consultant"<?php if ($position=="General Program Consultant") {echo 'selected="selected"';}?>>General Program Consultant</option>
			<option value="Church Consultant" <?php if ($position=="Church Consultant") {echo 'selected="selected"';}?>>Church Consultant</option>
			<option value="Charities Consultant" <?php if ($position=="Charities Consultant") {echo 'selected="selected"';}?>>Charities Consultant</option>
			<option value="Community Consultant" <?php if ($position=="Community Consultant") {echo 'selected="selected"';}?>>Community Consultant</option>
			<option value="Council Consultant" <?php if ($position=="Council Consultant") {echo 'selected="selected"';}?>>Council Consultant</option>
			<option value="Family Consultant" <?php if ($position=="Family Consultant") {echo 'selected="selected"';}?>>Family Consultant</option>
			<option value="Pro-Life Couple" <?php if ($position=="Pro-Life Couple") {echo 'selected="selected"';}?>>Pro-Life Couple</option>
			<option value="Squires Consultant" <?php if ($position=="Squires Consultant") {echo 'selected="selected"';}?>>Squires Consultant</option>
			<option value="Vocations Consultant" <?php if ($position=="Vocations Consultant") {echo 'selected="selected"';}?>>Vocations Consultant</option>
			<option value="Youth Consultant" <?php if ($position=="Youth Consultant") {echo 'selected="selected"';}?>>Youth Consultant</option>
			<option value="Ceremonials Director" <?php if ($position=="Ceremonials Director") {echo 'selected="selected"';}?>>Ceremonials Director</option>
			<option value="Ceremonials Assistant-East" <?php if ($position=="Ceremonials Assistant-East") {echo 'selected="selected"';}?>>Ceremonials Asst. East</option>
			<option value="Ceremonials Assistant-Middle" <?php if ($position=="Ceremonials Assistant-Middle") {echo 'selected="selected"';}?>>Ceremonials Asst. Middle</option>
			<option value="Ceremonials Assistant-West" <?php if ($position=="Ceremonials Assistant-West") {echo 'selected="selected"';}?>>Ceremonials Asst. West</option>
			<option value="Administrative Assistant" <?php if ($position=="Administrative Assistant") {echo 'selected="selected"';}?>>Administrative Asst.</option>
			<option value="Insurance Promotion" <?php if ($position=="Insurance Promotion") {echo 'selected="selected"';}?>>Insurance Promotion</option>
			<option value="Historian" <?php if ($position=="Historian") {echo 'selected="selected"';}?>>Historian</option>
			<option value="Webmaster" <?php if ($position=="Webmaster") {echo 'selected="selected"';}?>>Webmaster</option>
			<option value="Public Relations"<?php if ($position=="Public Relations") {echo 'selected="selected"';}?>>Public Relations</option>
			<option value="Photographer" <?php if ($position=="Photographer") {echo 'selected="selected"';}?>>Photographer</option>
			<option value="Newsletter-Forms" <?php if ($position=="Newsletter-Forms") {echo 'selected="selected"';}?>>Newsletter-Forms</option>
			<option value="Membership Consultant" <?php if ($position=="Membership Consultant") {echo 'selected="selected"';}?>>Membership Consultant</option>
			<option value="Retention Consultant" <?php if ($position=="Retention Consultant") {echo 'selected="selected"';}?>>Rentention Consultant</option>
			<option value="Hispanic Membership Consultant" <?php if ($position=="Hispanic Membership Consultant") {echo 'selected="selected"';}?>>Hispanic Consultant</option>
			<option value="New Council Development" <?php if ($position=="New Council Development") {echo 'selected="selected"';}?>>New Council Development</option>
		</select>
			</td>
            <td width=125 align="center"><input name="fratyear" type="text" id="fratyear" tabindex="2" size="6" maxlength="6" value="<?php echo $currfratyear;?>" /></td>
            <td width=125 align="center"><input name="dirgroup" type="text" id="dirgroup" tabindex="3" size="6" maxlength="6" value="0" /></td>
            <td width=125 align="center"><input name="secorder" type="text" id="secorder" tabindex="4" size="6" maxlength="6" value="0" /></td>
		</tr>
		</td>
		  <tr>
			<td colspan="5
            " align="center">
			    <input type="submit" name="subdata" value="Submit Data" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="return targetopener(this,true,true)">Cancel </button>
		    </td>
		  </tr>
          <tr>
          	<td>
           		Group:
            </td>
            <td colspan=2>
                1 = State Officers 
            </td>
            <td colspan=2>
            	2= State Staff
            </td>
           </tr>
           <tr>
           	<td>&nbsp;
            	
            </td>
            <td colspan=2>
            	3 = Membership/Ceremonial Staff
            </td>
            <td colspan=2>
            	4 = District Deputies
            </td>
          </tr>
           <tr>
           	<td>&nbsp;
            	
            </td>
            <td colspan=2>
            	5 = District Wardens
            </td>
            <td colspan=2>
            	6 = Grand Knights
            </td>
          </tr>
           <tr>
           	<td>&nbsp;
            	
            </td>
            <td colspan=2>
            	7 = Financial Secretary
            </td>
            <td colspan=2>
            	8 = Past State Deputies
            </td>
          </tr>
          <tr>
           	<td>&nbsp;
            	
            </td>

             <td colspan=2>
            	9 = State 4th Degree Staff
            </td>
            <td colspan=2>
            	10 = Faithful Navigators
            </td>
          </tr>
         <tr>
           	<td>&nbsp;
            	
            </td>

            <td colspan=2>
            	11 = Faithful Comptrollers
            </td>
            <td colspan=2>&nbsp;
            	
            </td>
          </tr>
         
	  </table>
	</form>
    
<?php
	
} else {
    $loc = $_SERVER['HTTP_HOST'];
    $locat = "http://$loc$installpath/login.php";
    echo "<script>location.href='$locat'</script>";
    die;
}

?>    
    
    
	</body>
	</html>
