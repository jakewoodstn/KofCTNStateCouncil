<?php
function formatphone($Phone){
   if(isset($Phone))
   {  
   	    $remchar = array(" ","(", ")","-",".",",","[","]","/","|");
        $Phone = str_replace($remchar,'',$Phone);
		$fphone = ""; 
		switch(strlen($Phone)){
			case 7:
				$pf = substr($Phone,0,3);
				$num = substr($Phone,3,4);
				$fphone = $Pf ."-" .$num;
				break;
			default:
				$ac = substr($Phone,0,3);
				$Pf = substr($Phone,3,3);
				$num = substr($Phone,6,4);
				$fphone = "(" .$ac .") " .$Pf ."-" .$num;	
				break;
		}
		return $fphone;
   }
}

function checkformat($nstr){
		$nstr = trim($nstr);
		if (strlen($nstr)==1){
			$nstr = str_replace('.','',$nstr);
			$nstr .= ".";
		}
		return $nstr;
		
}

function subPrefix($pfx){
	switch ($pfx){
		case "Mr":
			$pfx = "Mr.";
	  		break;
		case "RMr":
			$pfx = "Rev. Mr.";
			break;
		case "Rev":
			$pfx = "Rev.";
			break;
		case "MRev":
			$pfx = "Most Rev.";
			break;
		case "Dr":
			$pfx = "Dr.";
			break;
		default:
			$pfx = " ";
	}
	return $pfx;
}


function GenTable($infoarr,$carr, $sect){
			
			//print_r($carr);
			
			$prefix = trim(subPrefix($infoarr['ctitle']));
			$fname=trim(checkformat($infoarr['cfname']));
			$mi = trim(checkformat($infoarr['cmi']));
			$lname=trim($infoarr['clname']);
			$suffix=trim($infoarr['csuffix']);		
			$nname=$infoarr['cnname'];
			$sfname=trim($infoarr['ccspouse']);
			$snname=$infoarr['csnname'];
			$address1 = trim($infoarr['caddress1']);
			$address2 = trim($infoarr['caddress2']);
			$cityline = trim($infoarr['ccity']) .", " .trim($infoarr['cstate']) ." " .trim($infoarr['czip']);
			$hphone = $infoarr['chphone'];
			$wphone = $infoarr['cwphone'];
			$cphone = $infoarr['ccphone'];
			$fphone = $infoarr['cfphone'];
			$email = $infoarr['cemail'];
			$wemail = $infoarr['cwemail'];
			$position = $infoarr['cposition'];
			$council = $infoarr['icouncil'];
			$assembly = $infoarr['iassembly'];
			$psdterm = $infoarr['cpsdterm'];
			$deceased = $infoarr['bdeceased'];
			$seclev = $infoarr['tseclevel'];
			$fratyear = $infoarr['cfratyear'];
			$block = '<table rules="all" border="2" style="border-color: #666;" cellpadding="10" width = "450">';
			$block .= "<tr><td width=150>Title:</td><td>".$prefix ."</td></tr>";
			$block .= "<tr><td width=150>First Name:</td><td>".$fname ."</td></tr>";
			$block .= "<tr><td width=150>Middle Initial:</td><td>".$mi ."</td></tr>";
			$block .= "<tr><td width=150>Last Name:</td><td>".$lname ."</td></tr>";
			$block .= "<tr><td width=150>Suffix:</td><td>".$suffix ."</td></tr>";
			$block .= "<tr><td width=150>Prefers to be called:</td><td>".$nname ."</td></tr>";
			$block .= "<tr><td width=150>Spouses First Name:</td><td>".$sfname ."</td></tr>";
			$block .= "<tr><td width=150>Spouse called:</td><td>".$snname ."</td></tr>";
			$block .= "<tr><td>Address:</td><td>" .$address1 ."</td></tr>";
			$block .= "<tr><td>&nbsp;</td><td>" .$address2 ."</td></tr>";
			$block .= "<tr><td>&nbsp;</td><td>" .$cityline ."</td></tr>";
			$block .= "<tr><td>Home Phone:</td><td>" .formatphone($hphone) ."</td></tr>";
			$block .= "<tr><td>Work Phone:</td><td>" .formatphone($wphone) ."</td></tr>";
			$block .= "<tr><td>Cell Phone:</td><td>" .formatphone($cphone) ."</td></tr>";
			$block .= "<tr><td>Fax:</td><td>" .formatphone($fphone) ."</td></tr>";
			$block .= "<tr><td>Primary Email:</td><td>" .$email ."</td></tr>";
			$block .= "<tr><td>Secondary Email:</td><td>" .$wemail ."</td></tr>";
			$block .= "<tr><td>Home Council:</td><td>" .$council ."</td></tr>";
			$block .= "<tr><td>Home Assembly:</td><td>" .$assembly ."</td></tr>";
			foreach($carr as $position){
				$block .= "<tr><td>Office/Position:</td><td>" .$position ."</td></tr>";
			}
			$block .= "</table> <br><br>";
		return $block;
}

include "config.php";
$loc = $_SERVER['HTTP_HOST'];

$qry = "Select * from members order by CONCAT(clname,', ',cfname) where bverified = 0";
include 'configdb.php';
include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		
		while ($info = mysql_fetch_array( $data )) {
			$userid = $info['cuserid'];
			$destemail = $info['cemail'];
			$qry2 = "select cposition from fratpos where cuserid='" .$info['cuserid'] ."' and cuserid <> 'admin'" ;
			$info2 = array("");
			$data2 = mysql_query($qry2);
			if($data2){
				if (mysql_num_rows($data2)>0){
					$info2=mysql_fetch_assoc($data2);
				}
			}
			$block = GenTable($info,$info2,"SO");
			//$headers['From']= $verifyfrom;
			//$headers['Reply-To
			
			$headers = "From: " . $verifyfrom . "\r\n";
			$headers .= "Reply-To: ". $verifyfrom . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message .="<br>";
			
			$message .= $optext;
			$message .= '<p><a href="http://' .$loc .$installpath .'/verify.php?logintype=verify&user=' .$userid .'">This Information is Correct and complete</a></p>';
			$message .= '<p><a href="http://' .$loc .$installpath .'/verify.php?logintype=edit&user='.$userid .'">I need to Correct this information</a></p>';
			
			$message .= $block;

			
			$message .= $cltext;
			$message .= '</body></html>';
	
	
			//echo $message;	
			if (strlen($destemail)>0) {
				mail($destemail,"Directory Information Verification",$message,$headers);
			}
			
		}
	}
}

include 'closedb.php';











?>