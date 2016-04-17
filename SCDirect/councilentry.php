<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Council Data Form</title>
<link href="niceforms-default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="scddef.css" />     
<script type="text/javascript">
	function init() {
	     var control = document.getElementById("council");
		 control.focus();
				
		return true;

		}
   </script>
</head>
<body onload="init()">
<?php
require_once('data.php');
include('config.php');
#$currrow = $_SERVER['QUERY_STRING'];
$currrow = $_GET['record'];
$fldlist = array('council','suspended','district','aid','cercons','ca','name','address1','address2','city','state','zip','meeting1','mtime1','meeting2','mtime2','officers','offtime');
$err = "";
$errmsg = "";
$enupd = false;
$defstate = "TN";
#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
// also make sure they have admin rights
if (($_COOKIE['validlogin']=='true' && $_COOKIE['logID']>9) || $_COOKIE['adminlogin']=='true'){
	include('configdb.php');
	include('opendb.php');
	//  We are loged in, lets see if we are submitting an update	
	if (isset($_POST['submit'])){
		#Good the User has logged in. Lets See who they are
		$ipi = getenv("REMOTE_ADDR"); 
		$httprefi = getenv ("HTTP_REFERER");
		$httpagenti = getenv ("HTTP_USER_AGENT");
		$logseclevel = $_COOKIE['logID'];
		$userid = $_COOKIE['userid'];
		$loc = $_SERVER['HTTP_HOST'];
		$locat2 = "http://$loc$installpath/scdmenu.php";
		if (isset($_POST['cancel'])){
			echo "<script>location.href='$locat2'</script>";
			die;
		}
		//  see if the council exists
		$cnum = $_POST['council'];
		$qry = 'select * from council where ccouncil = ' .$cnum;
		if (mysql_query($qry)){
			$cintable = true;
		} else {
			$cintable = false;
		}
		// if not then insert into the table
		if (!$cintable){
			
			$vals = "VALUES (";
			$basequery = "INSERT INTO council (";
			foreach($fldlist as $ekey){
				//$vals .= "$" .$ekey ." , ";
				switch ($ekey){
					case 'aid':
					case 'cercons':
						$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
						$basequery .= "i" .$ekey .", ";
						break;
					case 'district':
						$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
						$basequery .= "t" .$ekey .", ";
						break;
					case 'suspended':
						$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
						if ($_POST['suspended']=='1'){
							$cmdevstr = "\$valstr = '1, ';";
						} else {
							$cmdevstr = "\$valstr = '0, ';";
						}
						$basequery .= "b" .$ekey .", ";
						break;
					case 'ca':
						if ($_POST['ca']=='1'){
							$cmdevstr = "\$valstr = '1, ';";
						} else {
							$cmdevstr = "\$valstr = '0, ';";
						}
						//eval($cmdevstr);
						$basequery .= "bcouncil, ";
					
						break;
					case 'meeting1':
					case 'mtime1':
					case 'meeting2':
					case 'mtime2':
					case 'officers':
					case 'offtime':
							$cmdevstr = "\$valstr = sprintf(\" %s ,\", \$_POST[" .$ekey ."]);";
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
		} else {
			$insquery = "UPDATE council SET ";
			foreach($fldlist as $ekey){
				$cmdevstr = "\$valstr = sprintf(\" '%s' \", \$_POST[" .$ekey ."]);";
				eval($cmdevstr);			

				switch ($ekey){
					case 'aid':
					case 'cercons':
						$cmdevstr = "\$valstr = sprintf(\" %s \", \$_POST[" .$ekey ."]);";
						eval($cmdevstr);
						$insquery .= "i" .$ekey ." = " .$valstr .", ";
						break;
					case 'district':
						$cmdevstr = "\$valstr = sprintf(\" %s \", \$_POST[" .$ekey ."]);";
						eval($cmdevstr);			

						$insquery .= "t" .$ekey ." = " .$valstr .", ";
						break;
					case 'suspended':
						if ($_POST['suspended']=='1'){
							$cmdevstr = "\$valstr = '1, ';";
						} else {
							$cmdevstr = "\$valstr = '0, ';";
						}
						eval($cmdevstr);
						$insquery .= "b" .$ekey ." = " .$valstr ;
						break;
					case 'ca':
						if ($_POST['ca']=='1'){
							$cmdevstr = "\$valstr = '1, ';";
						} else {
							$cmdevstr = "\$valstr = '0, ';";
						}
						eval($cmdevstr);
						$insquery .= "bcouncil = " .$valstr ;
					
						break;
					case 'meeting1':
					case 'mtime1':
					case 'meeting2':
					case 'mtime2':
					case 'officers':
					case 'offtime':
						$insquery .= $ekey ." = " .$valstr .", ";
						break;
					default:
						$insquery .= "c" .$ekey ." = " .$valstr .", ";
				}
			}
			$insquery = substr($insquery,0,-2);
			$insquery .= " WHERE ccouncil = '" .$_POST['council'] ."'"; 		
			echo $insquery;		
		}
		
		$result = mysql_query($insquery);
		if (!$result) {
			if (mysql_errno <> 1062){
				echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
				mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error() ."was encountered adding ".$userid ." " .$fname ." " .$lname);
				die;
			}
		}
		
		// Populate the variable to insert the values into the form
		foreach($fldlist as $ekey){
			$cmdevstr = "\$".$ekey ." = sprintf(\" '%s' \", \$_POST[" .$ekey ."]);";
			eval($cmdevstr);			
		}
		
	} elseif (isset($_POST['prev']) || isset($_POST['next'])) {
		// move to previous or next record
		$result1 = mysql_query('select * from council order by ccouncil');
		if (!$result1) {
			if (mysql_errno <> 1062){
				echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
				mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error()) ;
				die;
			}
		}
		$nrows=mysql_num_rows($result1);
		if ($nrows>0){
			if (isset($_POST['prev'])) {
				$currrow = $currrow-1;
			} else {
				$currrow = $currrow+1;
			}
			if ($currrow < 0) {
				$currrow = 0;
			} else {
				if ($currrow >= $nrows){
					$currrow = $nrows-1;
				}
			}
			mysql_data_seek($result1,$currrow);
			$row = mysql_fetch_array($result1);
			$council = $row['ccouncil'];
			$suspended = $row['bsuspended'];
			$city = $row['ccity'];
			$district = $row['tdistrict'];
			$aid = $row['iaid'];
			$cercons = $row['icercons'];
			$ca = $row['bcouncil'];
			$name = $row['cname'];
			$address1 = $row['address1'];
			$address2 = $row['address2'];
			$state = $row['cstate'];
			$zip = $row['czip'];
			$meeting1 = $row['meeting1'];
			$mtime1 = $row['mtime1'];
			$meeting2 = $row['meeting2'];
			$mtime2 = $row['mtime2'];
			$officers = $row['officers'];
			$offtime = $row['offtime'];
			$_SESSION['currentrow'] = $currrow;
			
		}
	} elseif (isset($_POST['retrieve'])){
		$cnum = $_POST['council'];
		$qry = "select * from council where ccouncil ='" .$cnum ."'";
		echo $qry;
		$result1 = mysql_query($qry);
		$row = mysql_fetch_array($result1);
			$council = $row['ccouncil'];
			$suspended = $row['bsuspended'];
			$city = $row['ccity'];
			$district = $row['tdistrict'];
			$aid = $row['iaid'];
			$cercons = $row['icercons'];
			$ca = $row['bcouncil'];
			$name = $row['cname'];
			$address1 = $row['address1'];
			$address2 = $row['address2'];
			$state = $row['cstate'];
			$zip = $row['czip'];
			$meeting1 = $row['meeting1'];
			$mtime1 = $row['mtime1'];
			$meeting2 = $row['meeting2'];
			$mtime2 = $row['mtime2'];
			$officers = $row['officers'];
			$offtime = $row['offtime'];
		
	}
//	include 'closedb.php';
	?>
      <div id="container">
		   <div id="masthead">
       	</div>
	  </div>

<form action="councilentry.php?<?php echo "record=" .$currrow; ?>" method="post" name="councilentry" class="niceform">
<table align="center" width="627">
   <tr>
       <td width="398" align = "right">
       		<label for="council">Council/Assembly Number:</label>
    		<input type="text" name="council" id="council" value="<?php echo $council; ?>" tabindex="1" />
    	</td>
        <td width = "217" align="left">
 <?php       
     if ($ca == 1){
		 echo '<label><input type="radio" name="ca" value="1" id="CA0" checked="checked" tabindex="8"/>Council</label>
    		<label><input type="radio" name="ca" value="0" id="CA1" tabindex="9" />Assembly</label>';
	 } else{
		 echo '<label><input type="radio" name="ca" value="1" id="CA0" tabindex="8"/>Council</label>
    		<label><input type="radio" name="ca" value="0" id="CA1" checked="checked" tabindex="9" />Assembly</label>';

	 }
	 ?>
            
         </td>
     </tr>
     <tr>
     	<td align="right">
         <label for="address1">Council Name</label>
    <input name="name" type="text" id="name" value="<?php echo $name; ?>" size="54" tabindex="2"/>   
        </td>
        <td>
        	<input type="checkbox" name="suspended" id="suspended" tabindex="10" value="1" /><label for="suspended">Council Suspended</label>
        
        </td>
     </tr>
     <tr>
   	   <td align="right">
   	     <label for="address1">Meeting Address</label>
    <input name="address1" type="text" id="address1" value="<?php echo $address1; ?>" size="54" tabindex="3" />
		</td>
        <td> 
            <select name="cercons" size="1" tabindex="11">
                <option value="1" <?php if ($cercons==1){echo 'selected="selected"';} ?>>West Tennessee</option>
                <option value="2" <?php if ($cercons==2){echo 'selected="selected"';} ?>>Middle Tennessee</option>
                <option value="3" <?php if ($cercons==3){echo 'selected="selected"';} ?>>East Tennessee</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td align="right">
    		<input name="address2" type="text" id="address2" value="<?php echo $address2; ?>" size="54" tabindex="4"/> 
        </td>
        <td align="left">
      <select name="aid" size="1" tabindex="12">
		<?php 
//        include 'configdb.php';
//        include 'opendb.php';
        
        $query= "select iaid, cagentname from insagents";
        
        $result = mysql_query($query);
        if (!$result) {
            if (mysql_errno <> 1062){
                echo 'Could not run query: ' . mysql_error() ;
                die;
            }
        }
        mysql_data_seek($result,0);
        while ($info=mysql_fetch_array($result)){
            $raid= $info['iaid'];
            $aname = $info['cagentname'];
			if ($raid==$aid){
				echo "<option value=\"$raid\" selected= \"selected\">$aname</option>";
			} else {
            	echo "<option value=\"$raid\">$aname</option>";
			}
        }
        mysql_free_result($result);

?>
      </select>
 		</td>
    </tr>
    <tr>
    	<td align="right">
        	 <label for="city">City, State, Zip</label><input type="text" name="city" id="city" value="<?php echo $city; ?>" tabindex="5" /><input name="state" type="text" id="state" value="<?php echo $state; ?>" size="6" maxlength="2" tabindex="6" /><input name="zip" type="text" id="zip" value="<?php echo $zip; ?>" size="10" maxlength="10"  tabindex="7" />
 
        </td>
 
    <td>   
        		<select name="district" size="1" tabindex="8">
 
                    <option value="1" <?php if ($district==1){echo 'selected="selected"';} ?>>District 1</option>
                    <option value="2" <?php if ($district==2){echo 'selected="selected"';} ?>>District 2</option>
                    <option value="3" <?php if ($district==3){echo 'selected="selected"';} ?>>District 3</option>
                    <option value="4" <?php if ($district==4){echo 'selected="selected"';} ?>>District 4</option>
                    <option value="5" <?php if ($district==5){echo 'selected="selected"';} ?>>District 5</option>
                    <option value="6" <?php if ($district==6){echo 'selected="selected"';} ?>>District 6</option>
                    <option value="7" <?php if ($district==7){echo 'selected="selected"';} ?>>District 7</option>
                    <option value="8" <?php if ($district==8){echo 'selected="selected"';} ?>>District 8</option>
                    <option value="9" <?php if ($district==9){echo 'selected="selected"';} ?>>District 9</option>
                    <option value="10" <?php if ($district==10){echo 'selected="selected"';} ?>>District 10</option>
                    <option value="11" <?php if ($district==11){echo 'selected="selected"';} ?>>District 11</option>
                    <option value="12" <?php if ($district==12){echo 'selected="selected"';} ?>>District 12</option>
                    <option value="13" <?php if ($district==13){echo 'selected="selected"';} ?>>District 13</option>
                    <option value="14" <?php if ($district==14){echo 'selected="selected"';} ?>>District 14</option>
                    <option value="15" <?php if ($district==15){echo 'selected="selected"';} ?>>District 15</option>
                    <option value="16" <?php if ($district==16){echo 'selected="selected"';} ?>>District 16</option>
                    <option value="17" <?php if ($district==17){echo 'selected="selected"';} ?>>District 17</option>
                    <option value="18" <?php if ($district==18){echo 'selected="selected"';} ?>>District 18</option>
                    <option value="19" <?php if ($district==19){echo 'selected="selected"';} ?>>District 19</option>
                    <option value="20" <?php if ($district==20){echo 'selected="selected"';} ?>>District 20</option>
              </select>
        </td>
    </tr>
    <tr>
      <td align="right">
        <label for="meeting1">First Meeting</label><input name="meeting1" type="text" id="meeting1" value="<?php echo $meeting1; ?>" size="50" tabindex="14"/>
        </td>
        <td>
	   	     <label for="time1">Meeting Time</label><input name="time1" type="text" id="time1" value="<?php echo $time1; ?>" size="20" tabindex="15"/>
        </td>
    </tr>
    <tr>
      <td align="right">
        <label for="meeting2">Second Meeting</label><input name="meeting2" type="text" id="meeting2" value="<?php echo $meeting2; ?>" size="50" tabindex="16"/>
        </td>
        <td>
	   	     <label for="time2">Meeting Time</label><input name="time2" type="text" id="time2" value="<?php echo $time2; ?>" size="20" tabindex="17"/>
        </td>
    </tr>
    <tr>
      <td align="right">
        <label for="meeting3">Officers Meeting</label><input name="meeting3" type="text" id="meeting3" value="<?php echo $meeting3; ?>" size="50" tabindex="18"/>
        </td>
        <td>
	   	     <label for="time3">Meeting Time</label><input name="time3" type="text" id="time3" value="<?php echo $time3; ?>" size="20" tabindex="19"/>
        </td>
    </tr>
    <tr align="center">
        <td colspan="2">
        <input name="submit" type="submit" value="Submit" tabindex="20"/>&nbsp;&nbsp;<input name="cancel" type="submit" value="Cancel" tabindex="21"/>
        </td>
    </tr>
 <tr align="center">
        <td colspan="2">
        <input name="prev" type="submit" value="prev" tabindex="22"/>&nbsp;&nbsp;<input name="retrieve" type="submit" value="Retrieve" tabindex="23"/>&nbsp;&nbsp;<input name="next" type="submit" value="next" tabindex="24"/>
        </td>
    </tr>    


  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </table>
</form>
</body>
</html>

<?php
	include 'closedb.php';
} else {
		$loc = $_SERVER['HTTP_HOST'];
		$locat = "http://$loc$installpath/scdmenu.php";
		echo "<script>location.href='$locat'</script>";
		die;
	
	
	
}




?>