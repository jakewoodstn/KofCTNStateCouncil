<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Update Form</title>
<!--<script language="javascript" type="text/javascript" src="jscripts/niceforms.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
--->
<script type="text/javascript" src="jscripts/cbox.js"></script>
<script type="text/javascript">


		function gentarget()
		{
			var control = document.getElementById('userid');
			
			var tarstr = 'posform.php?memid='+ control.value;
			
			return tarstr;
		}

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

	//     var control = document.getElementById("position");
	//  	 var PosVal = control.value;

	//	toggleVisibility("psdterm", false);
	//	toggleVisibility("deceased", false);
	 //   toggleVisibility("psdlab", false);
	//	toggleVisibility("declab", false);
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
	   href=mylink + '?memid='+ control.value;
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
<link rel="stylesheet" type="text/css" media="all" href="scddef.css" />          
 
</head>
<body onload="init()">
      <div id="container">
		   <div id="masthead">
           	</div>
	  </div>
        

<?php
require_once('data.php');
include('config.php');

$fldlist = array('title','fname','mi','lname','suffix','nname','cspouse','snname','address1','address2','city','state','zip','hphone','wphone','cphone','fphone','email','wemail','council','assembly','psdterm','deceased','seclevel','fratyear','userid','passhash');
$err = "";
$errmsg = "";
$enupd = false;
$defstate = "TN";
#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
// also make sure they have admin rights
if (($_COOKIE['validlogin']=='true' && $_COOKIE['logID']>9) || $_COOKIE['adminlogin']=='true'){
    #Good the User has logged in. Lets See who they are
    $ipi = getenv("REMOTE_ADDR"); 
    $httprefi = getenv ("HTTP_REFERER");
    $httpagenti = getenv ("HTTP_USER_AGENT");
    $logseclevel = $_COOKIE['logID'];
	$userid = $_COOKIE['userid'];
	$scdform = $_COOKIE['scdform'];
	if (isset($_POST['upddata'])||isset($_POST['retrieve'])){
		$scdform = "edit";
	}else {
		$scdform = "add";
	}
	
	$loc = $_SERVER['HTTP_HOST'];
	$locat2 = "http://$loc$installpath/scdmenu.php";
	if (isset($_POST['cancel'])){
		echo "<script>location.href='$locat2'</script>";
		die;
	}

	if(isset($_POST) && $_POST){
		if (!isset($_POST['retrieve'])){
			# Validate the input 
			$data = new data($_POST);
			$data->alpha(array('title','fname','lname','suffix'));
			$data->alpha(array('nname','cspouse','snname','city','state'));
			$data->alNumExc(array('address1','address2','mi'),array('.', ',','-',' '));
			$data->numExc(array('hphone','wphone','cphone','fphone'),array('-','+','(',')',' '));
			$data->numExc(array('zip'),array('-',' '),5);
			$data->email(array('email','wemail'));
			$data->alpha(array('position'));
			$data->num(array('council','assembly','userid','fratyear'));
			$err = $data->returnError(); //Catch all the invalid fields
			// $err contains the list of field names which are invalid.
			
			// If passwords don't match, then set the error flag
			if ($_POST['pasword'] != $_POST['confirmpw'] && $_POST['pasword']!="") {
				$err .= " pasword pwconfirm";
			}
			// Strip leading zero
			$userid = ltrim($userid,"0");			
			// Now Retrieve Council numbers and Assembly numbers and ensure the they 
			// are in the jurisdiction
			// Council First
			include 'configdb.php';
			include 'opendb.php';
			$council = $_POST['council'];
			$assembly = $_POST['assembly'];
			$position = $_POST['position'];
			$userid = $_POST['userid'];
			$query = "SELECT * FROM council WHERE ccouncil = $council and bcouncil=true";
			$result = mysql_query($query);
			$resCnt = mysql_num_rows($result);    
			if ($resCnt==0){
				$err .= " council";
			}
			mysql_free_result($result);
			//Now check Assembly
			if ($assembly>0 || preg_match('/Faithful/',$position)){
				$query = "SELECT * FROM council WHERE ccouncil = $assembly and bcouncil=false";
				$result = mysql_query($query);
				$resCnt = mysql_num_rows($result);    
				if ($resCnt==0){
					$err .= " assembly";
				}
				mysql_free_result($result);
			}
			if ($err != ''){
				$errmsg = "Some data was invalid, Please review the fields in red";
			}else{
				$errmsg = "";
			}
			// check to see if Member number already exists
			if ($userid > 0) {
				$query = "SELECT cuserid, clname, cfname, cmi FROM members WHERE cuserid = $userid";
				$result= mysql_query($query);
				$resCnt = mysql_num_rows($result);
				if ($resCnt >0){
					$errmsg .= "</br> That member already Exists, Modify Data or click Update";
					$enupd = true;
				}
			}
			if($err != ''){
				 // repopulate the form fields with the posted data
				 // and set the default color to black
				 foreach($fldlist as $ekey){
					$cmdev = "$".$ekey." = \$_POST['".$ekey ."'];";
					eval($cmdev);
					$cmdev = "$". $ekey."c = '#FFFFFF';";
					eval($cmdev);
				} 
				//Set Error Message
				$elist = preg_split("/[\s,]+/", $err,-1,PREG_SPLIT_NO_EMPTY);
				foreach($elist as $ekey){
					switch ($ekey){
						case "passhash":
							$cmdev = "$paswordc = '#FF0000';";
							eval($cmdev);
							$cmdev = "$confirmpwc = '#FF0000';";
							break;
						default:
							$cmdev = "$". $ekey."c = '#FF0000';";
					}
					eval($cmdev);
				}
			} else {
				// Generate the SQL query
				// first set our default redirect 
				$loc = $_SERVER['HTTP_HOST'];
				$locat = "http://$loc$installpath/scdmenu.php";
	
				switch($scdform){
				 	case "add":
						$vals = "VALUES (";
						$basequery = "INSERT INTO members (";
						foreach($fldlist as $ekey){
							//$vals .= "$" .$ekey ." , ";
							switch ($ekey){
								case 'council':
								case 'assembly':
									$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$_POST[" .$ekey ."]);";
									$basequery .= "i" .$ekey .", ";
									break;
								case 'seclevel':
									if ($_POST['seclevel']==''){
										$cmdevstr = "\$valstr = '0 ,';";
									} else {
										$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
									}
									$basequery .= "t" .$ekey .", ";
									break;
								case 'deceased':
									$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$_POST[" .$ekey ."]);";
									if ($_POST['deceased']==''){
										$cmdevstr = "\$valstr = '0, ';";
									} else {
										$cmdevstr = "\$valstr = '1, ';";
									}
									$basequery .= "b" .$ekey .", ";
									break;
								case 'passhash':
									if ($_POST['pasword']==''){
										$cmdevstr = "\$valstr = '';";
	
									} else {
										$pwenc = md5($_POST['pasword']);
										$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$pwenc);";
										$basequery .= "c" .$ekey .", ";
									}
									break;
								case 'dirgroup':
									$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
									if ($_POST['dirgroup']==''){
										$cmdevstr = "\$valstr = '0 ,';";
									} else {
										$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
									}
									$basequery .= $ekey .", ";
	
									break;
								default:
									$basequery .= "c" .$ekey .", ";
									$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$_POST[" .$ekey ."]);";
	
							}
							// Add the Value to the Query Values clause
							eval($cmdevstr);
							$vals .= $valstr;
	
						}
						$vals = substr($vals,0,-2);
						$vals .= ")";
						$basequery = substr($basequery,0, -2);
						$basequery .= ") ";
						$insquery= $basequery .$vals;
						break;
					case "update":
						//set redirect for directory update mode
						$locat = "http://$loc$installpath/updateform.php";
					case "edit":
						$insquery = "UPDATE members SET ";
						foreach($fldlist as $ekey){
							$cmdevstr = "\$valstr = sprintf(\" '%s' \", \$_POST[" .$ekey ."]);";
							eval($cmdevstr);			
							switch ($ekey){
								case 'council':
								case 'assembly':
									$insquery .= "i" .$ekey ." = " .$valstr .", ";
									break;
								case 'seclevel':
									$insquery .= "t" .$ekey ." = " .$valstr .", ";
									break;
								case 'deceased':
									$insquery .= "b" .$ekey ." = " .$valstr .", ";
									break;
								case 'passhash':
									if ($_POST['pasword']!=''){
										$pwenc = md5($_POST['pasword']);
										$cmdevstr = "\$valstr = sprintf(\" '%s' \", \$pwenc);";
										eval($cmdevstr);
										$insquery .= "c" .$ekey ." = " .$valstr .", ";
									}
									break;
								case 'userid':
									break;
								default:
									$insquery .= "c" .$ekey ." = " .$valstr .", ";
							}
						}
						$insquery = substr($insquery,0,-2);					
				} 
				if ($scdform == "edit" || $scdform=='update'){
					$insquery .= " WHERE cuserid = '" .$userid ."'"; 
				}
				
	 
	
				mail('tstaller@aol.com','Directory Query',$insquery);
				
				$result = mysql_query($insquery);
				if (!$result) {
					if (mysql_errno <> 1062){
						echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
						mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error() ."was encountered adding ".$userid ." " .$fname ." " .$lname);
						die;
					}
				} else{
					//setcookie('scdform','add');
					$scdform = 'add';
					unset($_POST['upddata']);
					$loc = $_SERVER['HTTP_HOST'];
					$locat = "http://$loc$installpath/updateform.php";
	//				mail("tstaller@aol.com","redirectdebug",$locat);			
					echo "<script>location.href='$locat'</script>";
					die;
				}
			
			}
			include 'closedb.php';
		} else {
			// Retrieve member from Database
			//popup('addpos.php','position')
			
			include 'configdb.php';
			include 'opendb.php';
			$qry = "Select * from members where cuserid = " .$_POST['userid'];
				$result = mysql_query($qry);
				if (!$result) {
					if (mysql_errno <> 1062){
						echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
						mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error() ."was encountered adding ".$userid ." " .$fname ." " .$lname);
						die;
					}
				}
				$row = mysql_fetch_array($result);
				$userid = $row['cuserid'];
				$title = $row["ctitle"];
				$fname = $row['cfname'];
				$mi = $row['cmi'];
				$lname = $row['clname'];
				$suffix = $row['csuffix'];
				$nname = $row['cnname'];
				$cspouse = $row['ccspouse'];
				$snname = $row['csnname'];
				$address1 = $row['caddress1'];
				$address2 = $row['caddress2'];
				$city = $row['ccity'];
				$state = $row['cstate'];
				$zip = $row['czip'];
				$hphone = $row['chphone'];
				$wphone = $row['cwphone'];
				$cphone = $row['ccphone'];
				$fphone = $row['cfphone'];
				$email = $row['cemail'];
				$wemail = $row['cwemail'];
				$council = $row['icouncil'];
				$assembly = $row['iassembly'];
				$psdterm = $row['cpsdterm'];
				$deceased = $row['bdeceased'];
				$logseclevel = $row['tseclevel'];
				$useridc = '#FFFFFF';
				$titlec = '#FFFFFF';
				$fnamec = '#FFFFFF';
				$mic = '#FFFFFF';
				$lnamec = '#FFFFFF';
				$suffixc = '#FFFFFF';
				$nnamec = '#FFFFFF';
				$cspousec = '#FFFFFF';
				$snnamec = '#FFFFFF';
				$address1c = '#FFFFFF';
				$address2c = '#FFFFFF';
				$cityc = '#FFFFFF';
				$statec = '#FFFFFF';
				$zipc = '#FFFFFF';
				$hphonec = '#FFFFFF';
				$wphonec = '#FFFFFF';
				$cphonec = '#FFFFFF';
				$fphonec = '#FFFFFF';
				$emailc = '#FFFFFF';
				$wemailc = '#FFFFFF';
				$positionc = '#FFFFFF';
				$assemblyc = '#FFFFFF';
				$psdtermc = '#FFFFFF';
				$deceasedc = '#FFFFFF';
				$seclevc = '#FFFFFF';
				$fratyearc = '#FFFFFF';
				$paswordc = '#FFFFFF';
				$confirmpwc = '#FFFFFF';
				$err = 'none';
				$enupd = true;
			
		}
	}
	if ( ($err =="")){
		$fratyear = date('Y');
		$userid = "";
		$title = "";
		$fname = "";
		$mi = "";
		$lname = "";
		$suffix = "";
		$nname = "";
		$cspouse = "";
		$snname = "";
		$address1 = "";
		$address2 = "";
		$city = "";
		$state = $defstate;
		$zip = "";
		$hphone = "";
		$wphone = "";
		$cphone = "";
		$fphone = "";
		$email = "";
		$wemail = "";
		$position = "";
		$council = "";
		$assembly = "";
		$psdterm = "";
		$deceased = "";
		$logseclevel = 0;
		$pasword = "mjm1882";
		$confirmpw = 'mjm1882';
		$dirgroup = '';
		$useridc = '#FFFFFF';
		$titlec = '#FFFFFF';
		$fnamec = '#FFFFFF';
		$mic = '#FFFFFF';
		$lnamec = '#FFFFFF';
		$suffixc = '#FFFFFF';
		$nnamec = '#FFFFFF';
		$cspousec = '#FFFFFF';
		$snnamec = '#FFFFFF';
		$address1c = '#FFFFFF';
		$address2c = '#FFFFFF';
		$cityc = '#FFFFFF';
		$statec = '#FFFFFF';
		$zipc = '#FFFFFF';
		$hphonec = '#FFFFFF';
		$wphonec = '#FFFFFF';
		$cphonec = '#FFFFFF';
		$fphonec = '#FFFFFF';
		$emailc = '#FFFFFF';
		$wemailc = '#FFFFFF';
		$positionc = '#FFFFFF';
		$councilc = '#FFFFFF';
		$assemblyc = '#FFFFFF';
		$psdtermc = '#FFFFFF';
		$deceasedc = '#FFFFFF';
		$seclevc = '#FFFFFF';
		$fratyearc = '#FFFFFF';
		$paswordc = '#FFFFFF';
		$confirmpwc = '#FFFFFF';
		$dirgroupc = '#FFFFFF';

	}
	if ($enupd == true){
		$useridc = '#ff0000';
	}
	
	?>
	
	<form id="form1" name="form1" method="post"  action="updateform.php" class = "niceform">
	  <table align="center" width="800" border="0">
      	<tr>
        	<td colspan="4" align="center"><h1>State Directory Data Form</h1></td>
        </tr>
<?php
		if ($errmsg != ""){
			echo "<tr><td colspan='4' align = 'center'><p  style='color:'#FF0000'>";
			echo $errmsg;
			echo "</p></td></tr>";
		}
?>
	  	<tr>
			<td width=21%><div align="right">Membership Number</div></td>			
			<td width=40%><input name="userid" type="text" id="userid" tabindex="1" size="20" maxlength="20" value="<?php echo $userid; ?>" style="background-color:<?php echo $useridc; ?>;"/>  <input type=button onClick='targetitem = document.forms[0].userid; dataitem = window.open("getmemid.php",
 "dataitem", "toolbar=no,menubar=no,scrollbars=yes"); dataitem.targetitem = targetitem' 
 value="Lookup"><input name="retrieve" type="submit" value="Retrieve" tabindex="23"/> </td>
		</tr>
        <tr>
		</tr>
		  <tr>
			<td height="25" align="right">Title </td>
			<td><select name="title" id="title" tabindex="2" style="background-color:<?php echo $titlec; ?>;">
			<?php 
			   switch($title){
				   case "Mr":
						  echo '<option value="Mr" selected = "selected">Mr.</option>
						  <option value="RMr">Rev. Mr.</option>
						  <option value="Rev">Rev.</option>
						  <option value="MRev">Most Rev.</option>
						  <option value="Dr">Dr.</option>
						  <option value=" "></option>';
						  break;
				   case "RMr":
						  echo '<option value="Mr">Mr.</option>
						  <option value="RMr" selected="selected">Rev. Mr.</option>
						  <option value="Rev">Rev.</option>
						  <option value="MRev">Most Rev.</option>
						  <option value="Dr">Dr.</option>
						  <option value=" "> </option>';
						  break;
				   case "Rev":
						  echo '<option value="Mr">Mr.</option>
						  <option value="RMr">Rev. Mr.</option>
						  <option value="Rev" selected="selected">Rev.</option>
						  <option value="MRev">Most Rev.</option>
						  <option value="Dr">Dr.</option>
						  <option value=" "> </option>';
						  break;
				   case "MRev":
						  echo '<option value="Mr">Mr.</option>
						  <option value="RMr">Rev. Mr.</option>
						  <option value="Rev">Rev.</option>
						  <option value="MRev" selected="selected">Most Rev.</option>
						  <option value="Dr">Dr.</option>
						  <option value=" "> </option>';
						  break;
				   case "Dr":
						  echo '<option value="Mr">Mr.</option>
						  <option value="RMr">Rev. Mr.</option>
						  <option value="Rev">Rev.</option>
						  <option value="MRev">Most Rev.</option>
						  <option value="Dr" selected="selected">Dr.</option>
						  <option value=" "> </option>';
						  break;
				   default:
						  echo '<option value="Mr" selected = "selected">Mr.</option>
						  <option value="RMr">Rev. Mr.</option>
						  <option value="Rev">Rev.</option>
						  <option value="MRev">Most Rev.</option>
						  <option value="Dr">Dr.</option>
						  <option value=" " selected="selected"> </option>';
						  break;
			   } ?>					  
			</select></td>
   			<td width="16%" align="right">Phone: </td>
			<td width="34%"><input name="hphone" type="text" id="hphone" tabindex="15" size="14" maxlength="14" value="<?php echo $hphone; ?>" style="background-color:<?php echo $hphonec; ?>;"/></td>
	      </tr>
          <tr>
            <td align="right">First Name</td>
			<td><input name="fname" type="text" id="fname" tabindex="3" size="20" maxlength="20" value="<?php echo $fname; ?>" style="background-color:<?php echo $fnamec; ?>;"/></td>
			<td align="right">Work:</td>
			<td><input name="wphone" type="text" id="wphone" tabindex="16" size="14" maxlength="14" value="<?php echo $wphone; ?>" style="background-color:<?php echo $wphonec; ?>;"/></td>
          </tr>
          <tr>
            <td align="right">MI</td>
			<td width="29%"><input name="mi" type="text" id="mi" tabindex="4" size="10" maxlength="20" value="<?php echo $mi; ?>" style="background-color:<?php echo $mic; ?>;"/></td>
			<td align="right">Cell: </td>
			<td><input name="cphone" type="text" id="cphone" tabindex="17" size="14" maxlength="14" value="<?php echo $cphone; ?>" style="background-color:<?php echo $cphonec; ?>;"/></td>
          </tr>
          <tr>
            <td align="right">Last Name</td>
			<td><input name="lname" type="text" id="lname" tabindex="5" size="30" maxlength="30" value="<?php echo $lname; ?>" style="background-color:<?php echo $lnamec; ?>;"/></td>
   			<td align="right">Fax:</td>
			<td><input name="fphone" type="text" id="fphone" tabindex="18" size="14" maxlength="14" value="<?php echo $fphone; ?>" style="background-color:<?php echo $fphonec; ?>;"/></td>
          </tr>
          <tr>
            <td align="right">Suffix</td>
			<td><select name="suffix" id="suffix" tabindex="6" style="background-color:<?php echo $suffixc; ?>;">
			<?php 
				switch ($suffix){
					case "Jr":
						echo '<option value="Jr" selected="selected">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II">II</option>
							  <option value="III">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" "> </option>';
						break;
					case "Sr":
						echo '<option value="Jr">Jr</option>
							  <option value="Sr" selected="selected">Sr.</option>
							  <option value="II">II</option>
							  <option value="III">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" "> </option>';
						break;
					case "II":
						echo '<option value="Jr">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II" selected="selected">II</option>
							  <option value="III">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" "> </option>';
						break;
					case "III":
						echo '<option value="Jr">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II">II</option>
							  <option value="III" selected="selected">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" "> </option>';
						break;
					case "IV":
						echo '<option value="Jr">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II">II</option>
							  <option value="III">III</option>
							  <option value="IV" selected="selected">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" "> </option>';
						break;
					case "PSD":
						echo '<option value="Jr">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II">II</option>
							  <option value="III">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD" selected="selected">PSD</option>
							  <option value=" "> </option>';
						break;
					default:
						echo '<option value="Jr">Jr</option>
							  <option value="Sr">Sr.</option>
							  <option value="II">II</option>
							  <option value="III">III</option>
							  <option value="IV">IV</option>
							  <option Value="PSD">PSD</option>
							  <option value=" " selected="selected"> </option>';
						break;
				}
					?>
			</select></td>
			<td align="right">Home Email: </td>
			<td><input name="email" type="text" id="email" tabindex="19" size="30" maxlength="50" value="<?php echo $email; ?>" style="background-color:<?php echo $emailc; ?>;"/></td>
          </tr>
          <tr>
			<td align="right">Prefers to be called: </td>
			<td><input name="nname" type="text" id="nname" tabindex="7" size="15" maxlength="15" value="<?php echo $nname; ?>" style="background-color:<?php echo $nnamec; ?>;"/></td>
			<td align="right">Work Email: </td>
			<td><input name="wemail" type="text" id="wemail" tabindex="20" size="30" maxlength="50" value="<?php echo $wemail; ?>" style="background-color: <?php echo $wemailc; ?>;"/></td>
		  </tr>
		  <tr>
			<td align="right">Spouse's First Name: </td>
			<td><input name="cspouse" type="text" id="cspouse" tabindex="8" size="20" maxlength="20" value="<?php echo $cspouse; ?>" style="background-color:<?php echo $cspousec; ?>;"/></td>
			<td height="24" align="right"><button onclick="return popup('posform.php','position')">View Positions </button> </td>
			<td height="24"><button onclick="return popup('addpos.php','position')">Add/Edit Positions </button>
		</td>
			

		  </tr>
          <tr>
			<td align="right">Spouse Prefers to be Called: </td>
			<td><input name="snname" type="text" id="snname" tabindex="9" size="15" maxlength="15" value="<?php echo $snname; ?>" style="background-color:<?php echo $snnamec; ?>;"/></td>
			<td align="right">Council:</td>
			<td><input name="council" type="text" id="council" tabindex="22" size="8" maxlength="8" value="<?php echo $council; ?>" style="background-color:<?php echo $councilc; ?>;"/></td>

		  </tr>
		  <tr>
			<td align="right">Address: </td>
			<td><input name="address1" type="text" id="address1" tabindex="10" size="40" maxlength="40" value="<?php echo $address1; ?>" style="background-color:<?php echo $address1c; ?>;"/></td>
			<td align="right">Assembly: </td>
			<td><input name="assembly" type="text" id="assembly" tabindex="23" size="8" maxlength="8" value="<?php echo $assembly; ?>" style="background-color:<?php echo $assemblyc; ?>;"/></td>

		  </tr>
		  <tr>
          	<td>&nbsp;</td>
   			<td><input name="address2" type="text" id="address2" tabindex="11" size="40" maxlength="40" value="<?php echo $address2; ?>" style="background-color:<?php echo $address2c; ?>;"/></td>
			<td align="right">Login Password: </td>
			<td><input name="pasword" type="password" id="pasword" tabindex="24" size="20" maxlength="40" value="<?php echo $pasword;?>"  style="background-color:<?php echo $paswordc; ?>;"/></td>

          </tr>
		  <tr>
			<td align="right">City:</td>
			<td><input name="city" type="text" id="city" tabindex="12" size="20" maxlength="20" value="<?php echo $city; ?>" style="background-color:<?php echo $cityc; ?>;"/></td>
			<td align="right">Confirm Password: </td>
			<td><input name="confirmpw" type="password" id="confirmpw" tabindex="25" size="20" maxlength="40" value="<?php echo $confirmpw;?>"  style="background-color:<?php echo $confirmpwc; ?>;"/></td>

	      </tr>
          <tr>
			<td align="right">State:</td>
            <td><input name="state" type="text" id="state" tabindex="13" size="4" maxlength="4" value="<?php echo $state; ?>" style="background-color:<?php echo $statec; ?>;"/></td>
			<td align="right"><label id="psdlab">PSD Term:&nbsp;&nbsp;</label></td>
            <td><input name="psdterm" type="text" id="psdterm" tabindex="26" size="10" maxlength="10" value="<?php echo $psdterm; ?>" style="background-color:<?php echo $psdtermc; ?>;"/></td>

          </tr>
          <tr>
          	<td align="right">Zip:</td>
			<td><input name="zip" type="text" id="zip" tabindex="14" size="10" maxlength="10" value="<?php echo $zip; ?>" style="background-color:<?php echo $zipc; ?>;"/></td>
   		  	<td align="right">Fraternal Year:</td>
			<td><input name="fratyear" type="text" id="fratyear" tabindex="27" value="<?php echo $fratyear;?>" size="5" maxlength="5"style="background-color:<?php echo $fratyearc; ?>;" /> </td>
		 </tr>
	<?php
		 if ($_COOKIE['adminlogin']=='true'){
			 echo '<tr><td align="right">System Security Level: </td>
			<td><select name="seclevel" id="seclevel" tabindex="28">
				  <option value="0"';
				  if ($logseclevel==0){echo ' selected="selected"';}
				  echo '>0</option>
				  <option value="1"';
				  if ($logseclevel==1){echo ' selected="selected"';}
				  echo '>1</option>
				  <option value="2"';
				  if ($logseclevel==2){echo ' selected="selected"';}
				  echo '>2</option>
				  <option value="3"';
				  if ($logseclevel==3){echo ' selected="selected"';}
				  echo '>3</option>
				  <option value="4"';
				  if ($logseclevel==4){echo ' selected="selected"';}
				  echo '>4</option>
				  <option value="5"';
				  if ($logseclevel==5){echo ' selected="selected"';}
				  echo '>5</option>
				  <option value="6"';
				  if ($logseclevel==6){echo ' selected="selected"';}
				  echo '>6</option>
				  <option value="7"';
				  if ($logseclevel==7){echo ' selected="selected"';}
				  echo '>7</option>
				  <option value="8"';
				  if ($logseclevel==8){echo ' selected="selected"';}
				  echo '>8</option>
				  <option value="9"';
				  if ($logseclevel==9){echo ' selected="selected"';}
				  echo '>9</option>
				  <option value="10"';
				  if ($logseclevel==10){echo ' selected="selected"';}
				  echo '>10</option>
				</select>
			</td><td align = "right">Dir Group </td>
            <td><input name="dirgroup" type="text" id="dirgroup" tabindex="29" size="8" maxlength="8" value="' .$dirgroup .'" style="background-color:' .$dirgroupc .'"/></td></tr>';
		 } else {
			echo '<tr><td>&nbsp;</td>
			<td>&nbsp;</td></tr>';
		}
		$loc = $_SERVER['HTTP_HOST'];
		$locat2 = "http://$loc$installpath/scdmenu.php";

		
	?>
  <tr align="center">
        <td colspan="5">
        	
        </td>
    </tr>       
		  <tr>
			<td colspan="4" align="center">
<?php
			if($enupd == true){
				echo '<input type="submit" name="upddata" value="Update Data" />';
			} else {
				echo ' <input type="submit" name="subdata" value="Submit Data" />';
			}
?>            
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="cancel" value="Cancel" />

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
