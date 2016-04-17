<?php

$locat1 = "http://$loc$installpath/scdmenu.php";
$locat2 = "http://$loc$installpath/login.php";

	function GetFratYear()
	{

	 	$currdate = getdate();
		switch ($currdate['mon']){
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
				$currfratyear = $currdate['year']-1;
				break;
			default:
				$currfratyear = $currdate['year'];
		}

	return ($currfratyear);

	}

#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there

if ($_COOKIE['validlogin']=='true'){
    #Good the User has logged in. Lets See who they are
    $ipi = getenv("REMOTE_ADDR"); 
    $httprefi = getenv ("HTTP_REFERER");
    $httpagenti = getenv ("HTTP_USER_AGENT");
    $logseclevel = $_COOKIE['logID'];
   // if(!((!empty($_POST['printselect'])))){
      
    
    #now for the menu HTML code
   

	if(!empty($_POST['submit'])){
	
	
    echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><body> <br><br>');
	echo ('Do not Leave or close this page.  Sending Mail...');########################################################################
# 
# Copyright (c)2010-2011 Tracy Staller
# tstaller@aol.com
# License: LGPL
########################################################################

// INITIAL SETTINGS //

// Language to use. (English=en.php .:. Deutsch=de.php .:. Espanol=es.php .:. Greek=gr.php .:. Nederlands=nl.php .:. Turkish=tr.php .:. 简体中文=zh-cn-utf8.php).
$language = "en.php";


// Site name and page title.
$page_title = "Tennessee State Council Directory";
$jurisdiction = "Tennessee";

$installpath = "/SCDirect";

function GetNextFratYear()
{

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$currfratyear = $currdate['year'];
		break;
	default:
		$currfratyear = $currdate['year']+1;
}


return $currfratyear;

}

//Print Categories for Labels etc.
$printcat = array(  array("label"=> "State Officer","name"=>"State_Officer","ID"=>1),
					array("label"=> "Program Staff","name"=>"Program_Staff","ID"=>2),
					array("label"=> "Membership Staff","name"=>"Membership_Staff","ID"=>3),
					array("label"=> "District Deputies","name"=>"District_Deputies","ID"=>4),
					array("label"=> "District Wardens","name"=>"District_Wardens","ID"=>5),
					array("label"=> "Grand Knights","name"=>"Grand_Knights","ID"=>6),
					array("label"=> "Financial Secretaries","name"=>"Financial_Secretaries","ID"=>7),
					array("label"=> "Past State Deputies","name"=>"Past_State_Deputies","ID"=>8),
					array("label"=> "4th Degree Staff","name"=>"4th_Degree_Staff","ID"=>9),
					array("label"=> "Faithful Navigators","name"=>"Faithful_Navigators","ID"=>10),
					array("label"=> "Faithful Comptrollers","name"=>"Faithful_Comptrollers","ID"=>11)

);
$distlist = array(  array("label"=> "District 1", "ID"=>1, "name"=>"D1"),
					array("label"=> "District 2", "ID"=>2, "name"=>"D2"),
					array("label"=> "District 3", "ID"=>3, "name"=>"D3"),
					array("label"=> "District 4", "ID"=>4, "name"=>"D4"),
					array("label"=> "District 5", "ID"=>5, "name"=>"D5"),
					array("label"=> "District 6", "ID"=>6, "name"=>"D6"),
					array("label"=> "District 7", "ID"=>7, "name"=>"D7"),
					array("label"=> "District 8", "ID"=>8, "name"=>"D8"),
					array("label"=> "District 9", "ID"=>9, "name"=>"D9"),
					array("label"=> "District 10", "ID"=>10, "name"=>"D10"),
					array("label"=> "District 11", "ID"=>11, "name"=>"D11"),
					array("label"=> "District 12", "ID"=>12, "name"=>"D12"),
					array("label"=> "District 13", "ID"=>13, "name"=>"D13"),
					array("label"=> "District 14", "ID"=>14, "name"=>"D14"),
					array("label"=> "District 15", "ID"=>15, "name"=>"D15"),
					array("label"=> "District 16", "ID"=>16, "name"=>"D16"),
					array("label"=> "District 17", "ID"=>17, "name"=>"D17"),
					array("label"=> "District 18", "ID"=>18, "name"=>"D18"),
					array("label"=> "District 19", "ID"=>19, "name"=>"D19"),
					array("label"=> "District 20", "ID"=>20, "name"=>"D20")
					);
$regionlist = array(  array("label"=>"Memphis Diocese", "ID"=>1, "name"=>"R1"),
					  array("label"=>"Nashville Diocese", "ID"=>2, "name"=>"R2"),
					  array("label"=>"Knoxville Diocese", "ID"=>3, "name"=>"R3")
					);

$rostercols = array(  	array("label"=>"Position", "width"=>36,"ID"=>"cposition"),
						array("label"=>"Council", "width"=>8,"ID"=>"icouncil"),
						array("label"=>"Location", "width"=>28,"ID"=>"location"),
						array("label"=>"First", "width"=>11,"ID"=>"cfname"),
						array("label"=>"Middle", "width"=>11,"ID"=>"cmi"),
						array("label"=>"Last", "width"=>12,"ID"=>"clname"),
						array("label"=>"(Prefers)", "width"=>10,"ID"=>"cnname"),
						array("label"=>"Street Address", "width"=>26,"ID"=>"caddress1"),
						array("label"=>"Street Address2", "width"=>26,"ID"=>"caddress2"),
						array("label"=>"City", "width"=>12,"ID"=>"ccity"),
						array("label"=>"State", "width"=>14,"ID"=>"cstate"),
						array("label"=>"Zip", "width"=>12,"ID"=>"czip"),
						array("label"=>"Home Phone", "width"=>15,"ID"=>"chphone"),
						array("label"=>"Cell Phone", "width"=>15,"ID"=>"ccphone"),
						array("label"=>"Work Phone", "width"=>15,"ID"=>"cwphone"),
						array("label"=>"Primary Email", "width"=>31,"ID"=>"cemail"),
						array("label"=>"Secondary Email", "width"=>31,"ID"=>"cwemail"),
						array("label"=>"Spouse", "width"=>11,"ID"=>"ccspouse"),
						array("label"=>"Spouse (Prefers)", "width"=>11,"ID"=>"csnname"),
						array("label"=>"Term", "width"=>17,"ID"=>"cpsdterm"),
						array("label"=>"Assembly", "width"=>12,"ID"=>"iassembly")
						);

$soscols = array(	array("ID"=>"cposition", "colid"=>"A"),
					array("ID"=>"icouncil", "colid"=>"N"),
					array("ID"=>"cfname", "colid"=>"B"),
					array("ID"=>"cmi", "colid"=>"C"),
					array("ID"=>"clname", "colid"=>"D"),
					array("ID"=>"cnname", "colid"=>"E"),
					array("ID"=>"caddress1", "colid"=>"F"),
					array("ID"=>"caddress2", "colid"=>"G"),
					array("ID"=>"ccity", "colid"=>"H"),
					array("ID"=>"cstate", "colid"=>"I"),
					array("ID"=>"czip", "colid"=>"J"),
					array("ID"=>"chphone", "colid"=>"K"),
					array("ID"=>"ccphone", "colid"=>"L"),
					array("ID"=>"cwphone", "colid"=>"M"),
					array("ID"=>"cemail", "colid"=>"N"),
					array("ID"=>"cwemail", "colid"=>"O"),
					array("ID"=>"ccspouse", "colid"=>"P"),
					array("ID"=>"csnname", "colid"=>"Q")
					
					);
					
$psdcols = array(	array("ID"=>"cpsdterm", "colid"=>"A"),
					array("ID"=>"icouncil", "colid"=>"N"),
					array("ID"=>"cfname", "colid"=>"B"),
					array("ID"=>"cmi", "colid"=>"C"),
					array("ID"=>"clname", "colid"=>"D"),
					array("ID"=>"cnname", "colid"=>"E"),
					array("ID"=>"caddress1", "colid"=>"F"),
					array("ID"=>"caddress2", "colid"=>"G"),
					array("ID"=>"ccity", "colid"=>"H"),
					array("ID"=>"cstate", "colid"=>"I"),
					array("ID"=>"czip", "colid"=>"J"),
					array("ID"=>"chphone", "colid"=>"K"),
					array("ID"=>"ccphone", "colid"=>"L"),
					array("ID"=>"cwphone", "colid"=>"M"),
					array("ID"=>"cemail", "colid"=>"N"),
					array("ID"=>"cwemail", "colid"=>"O"),
					array("ID"=>"ccspouse", "colid"=>"P"),
					array("ID"=>"csnname", "colid"=>"Q")
					
					);
					
					
					
$gkcols = array(	array("ID"=>"icouncil", "colid"=>"A"),
					//array("ID"=>"location", "colid"=>"B"),
					array("ID"=>"cfname", "colid"=>"B"),
					array("ID"=>"cmi", "colid"=>"C"),
					array("ID"=>"clname", "colid"=>"D"),
					array("ID"=>"cnname", "colid"=>"E"),
					array("ID"=>"caddress1", "colid"=>"F"),
					array("ID"=>"caddress2", "colid"=>"G"),
					array("ID"=>"ccity", "colid"=>"H"),
					array("ID"=>"cstate", "colid"=>"I"),
					array("ID"=>"czip", "colid"=>"J"),
					array("ID"=>"chphone", "colid"=>"K"),
					array("ID"=>"ccphone", "colid"=>"L"),
					array("ID"=>"cwphone", "colid"=>"M"),
					array("ID"=>"cemail", "colid"=>"N"),
					array("ID"=>"cwemail", "colid"=>"O"),
					array("ID"=>"ccspouse", "colid"=>"P"),
					array("ID"=>"csnname", "colid"=>"Q")
			);

$fdscols = array(	array("ID"=>"cposition", "colid"=>"A"),
					array("ID"=>"cfname", "colid"=>"B"),
					array("ID"=>"cmi", "colid"=>"C"),
					array("ID"=>"clname", "colid"=>"D"),
					array("ID"=>"cnname", "colid"=>"E"),
					array("ID"=>"caddress1", "colid"=>"F"),
					array("ID"=>"caddress2", "colid"=>"G"),
					array("ID"=>"ccity", "colid"=>"H"),
					array("ID"=>"cstate", "colid"=>"I"),
					array("ID"=>"czip", "colid"=>"J"),
					array("ID"=>"chphone", "colid"=>"K"),
					array("ID"=>"ccphone", "colid"=>"L"),
					array("ID"=>"cwphone", "colid"=>"M"),
					array("ID"=>"cemail", "colid"=>"N"),
					array("ID"=>"cwemail", "colid"=>"O"),
					array("ID"=>"ccspouse", "colid"=>"P"),
					array("ID"=>"csnname", "colid"=>"Q")
			);


$fdcols = array(	array("ID"=>"icouncil", "colid"=>"B"),
					array("ID"=>"iassembly", "colid"=>"A"),
					//array("ID"=>"location", "colid"=>"C"),
					array("ID"=>"cfname", "colid"=>"C"),
					array("ID"=>"cmi", "colid"=>"D"),
					array("ID"=>"clname", "colid"=>"E"),
					array("ID"=>"cnname", "colid"=>"F"),
					array("ID"=>"caddress1", "colid"=>"G"),
					array("ID"=>"caddress2", "colid"=>"H"),
					array("ID"=>"ccity", "colid"=>"I"),
					array("ID"=>"cstate", "colid"=>"J"),
					array("ID"=>"czip", "colid"=>"K"),
					array("ID"=>"chphone", "colid"=>"L"),
					array("ID"=>"ccphone", "colid"=>"M"),
					array("ID"=>"cwphone", "colid"=>"N"),
					array("ID"=>"email1", "colid"=>"O"),
					array("ID"=>"email2", "colid"=>"P"),
					array("ID"=>"ccspouse", "colid"=>"Q"),
					array("ID"=>"csnname", "colid"=>"R")
					
					);
			

//if ((include "/SCDirect/config.php") == FALSE){
//	echo 'Include failed <br>';
//}else{
//	echo 'include ok <br>';
//}


		$cfratYear = GetFratYear();	
		$cfy= $cfratYear;
		
				
		foreach($printcat as $pelem){
			if (!empty($_POST[$pelem['name']])){
				$drgrp = $_POST[$pelem['name']];
				$whr .= "fratpos1.dirgroup=" .$drgrp ." or " ;
			}
		}
		$whr = substr($whr,0,-4);
		
		foreach($distlist as $pelem){
			if (!empty($_POST[$pelem['name']])){
				$distgrp[] = $_POST[$pelem['name']];
				$distfilter=true;
			}
		}
		foreach($regionlist as $pelem){
			if (!empty($_POST[$pelem['name']])){
				$reggrp[] = $_POST[$pelem['name']];
				$regionfilter=true;
			}
		}
	}else{
		die;
	}
	
	$mailfrom = $_POST['from'];
	$mailsubj = $_POST['subject'];
	$mailbody = $_POST['mailbody'];
	$priority = $_POST['priority'];
	$diiaglist = '<html><body><br>';

	// Retrieve the info from the database

	if (!empty($whr)){
	$qry = "Select distinct members.*, fratpos1.*, council.bsuspended, council.tdistrict,council.icercons from members join (SELECT cuserid, 	cposition as cposition , MIN( dirgroup ) AS dirgroup, secorder AS secorder, cfratyear as cfratyear FROM fratpos where cfratyear=" .$cfy ." GROUP BY cuserid order by fratpos.dirgroup ) as fratpos1 on members.cuserid = fratpos1.cuserid join council on members.icouncil=council.ccouncil where council.bsuspended = 0 and fratpos1.cfratyear=" .$cfy  ." and (" .$whr .") order by fratpos1.dirgroup, fratpos1.secorder";
	}
	else
	{
	$qry = "Select distinct members.*, fratpos1.*, council.bsuspended, council.tdistrict,council.icercons from members join (SELECT cuserid, 	cposition as cposition , MIN( dirgroup ) AS dirgroup, secorder AS secorder, cfratyear as cfratyear FROM fratpos where cfratyearr=" .$cfy ." GROUP BY cuserid order by fratpos.dirgroup ) as fratpos1 on members.cuserid = fratpos1.cuserid join council on members.icouncil=council.ccouncil where council.bsuspended = 0 and fratpos1.cfratyear=" .$cfy  ." order by fratpos1.dirgroup, fratpos1.secorder";	
	}
	include 'configdb.php';
	include 'opendb.php';
	$data = mysql_query($qry);
	if (!$data) {
		echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
		echo $qry;
		die;
	}
	if ($data){
		# then make sure that we have at least one record
		if (mysql_num_rows($data)>0){
			while ($info = mysql_fetch_array( $data )) {
				$email = "";
				switch($info[dirgroup]){
					case 4:
					case 5:
					case 6:
					case 7:					
						if ($distfilter){
							if (in_array($info['tdistrict'],$distgrp)){
								if (!empty($info['cemail'])){
									$email .= $info['cemail'];
								}
								if (!empty($info['cwemail'])){
									if (!empty($email)){
										$email .= ", ";
									}
									$email .= $info['cwemail'];
								}

							}
						}elseif ($regionfilter){
							if (in_array($info['icercons'],$reggrp)){
								if (!empty($info['cemail'])){
									$email .= $info['cemail'];
								}
								if (!empty($info['cwemail'])){
									if (!empty($email)){
										$email .= ", ";
									}
									$email .= $info['cwemail'];
								}

							}
						} else {
							if (!empty($info['cemail'])){
								$email .= $info['cemail'];
							}
							if (!empty($info['cwemail'])){
								if (!empty($email)){
									$email .= ", ";
								}
								$email .= $info['cwemail'];
							}
						}
						
						break;
					default:
						if (!empty($info['cemail'])){
							$email .= $info['cemail'];
						}
						if (!empty($info['cwemail'])){
							if (!empty($email)){
								$email .= ", ";
							}
							$email .= $info['cwemail'];
						}
						break;
				}
					
				if (!empty($email)){
				
					$headers = "From: " . $mailfrom . "\r\n";
					$headers .= "Reply-To: ". $mailfrom . "\r\n";
					if($priority == "urgent"){
						$headers .= "X-Priority: 1 (Highest) \r\nX-MSMail-Priority: High \r\n";
					}
				
				
					$headers .= "MIME-Version: 1.0\r\n";
					if($_FILES["myfile"]["error"] > 0)
					  {
					  //echo "Error: " . $_FILES["myfile"]["error"] . "<br>";
					  //echo "File will not be sent";
					  $attach=false;
					  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					  }
					else
					  {
						//create a boundary string. It must be unique 
						//so we use the MD5 algorithm to generate a random hash 
						$random_hash = md5(date('r', time())); 
						$attach=true;	
						$headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash ."\""; 
						//read the atachment file contents into a string,
						//encode it with MIME base64,
						//and split it into smaller chunks
						$attachment = chunk_split(base64_encode(file_get_contents($_FILES["myfile"]["tmp_name"])));   
					 // echo "Upload: " . $_FILES["myfile"]["name"] . "<br>";
					  //echo "Type: " . $_FILES["myfile"]["type"] . "<br>";
					  //echo "Size: " . ($_FILES["myfile"]["size"] / 1024) . " kB<br>";
					  //echo "Stored in: " . $_FILES["myfile"]["tmp_name"];
					  }




					if (!$attach){
							//echo "no attachment";
						$message = '<html><body>';
						$message .="<br>";	
						$message .= $mailbody;
						$message .= '</body></html>';
					
					}else{
						//echo "attachment";
						$message = "\r\n";
						$message .="--PHP-mixed-" .$random_hash ;
						$message .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash ."\"";
						$message .= "\r\n\r\n--PHP-alt-".$random_hash ;
						$message .= "\r\nContent-Type: text/plain; charset=\"ISO-8859-1\"\r\n";
						$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";  	
						$message .= $mailbody;
						$message .= "\r\n\r\n--PHP-alt-".$random_hash;
						$message .= "\r\nContent-Type: text/html; charset=\"ISO-8859-1\"\r\n";
						$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";  	
						$message .= '<html><body>';
						$message .="<br>";
						$message .= $mailbody;
						$message .= '</body></html>';
						$message .= "\r\n\r\n--PHP-alt-".$random_hash ."--";
						$message .="\r\n\r\n--PHP-mixed-" .$random_hash ."\r\n";
						$message .="Content-Type: " .$_FILES["myfile"]["type"]."; name=\"".$_FILES["myfile"]["name"] ."\"\r\n";
						$message .="Content-Transfer-Encoding: base64\r\n";
						$message .="Content-Disposition: attachment\r\n\r\n";
						$message .= $attachment;
						$message .="\r\n--PHP-mixed-" .$random_hash ."--\r\n";
					}
			
					//echo $message;	
					if (strlen($email)>0) {
						mail($email,$mailsubj,$message,$headers);
						//mail("tstaller@aol.com",$mailsubj,$message,$headers);
						echo ".";
					}
					$diaglist .=" Sending Mail to:  " .$email ."</br>";
					$diaglist .= $mailsubj ."</br>";
					$diaglist .= $mailfrom ."</br>";
					$diaglist .= $mailbody ."</br>";
					$diaglist .= "----------------------------------------------------</br>"; 				
				}
			}
		}
		//echo $message;
		mail("tstaller@aol.com",$mailsubj." mail log",$diaglist,$headers);
		mail($mailfrom,$mailsubj." mail log",$diaglist,$headers);
	}

	include 'closedb.php';
    $loc = $_SERVER['HTTP_HOST'];
    $locat = "http://$loc$installpath/scdmenu.php";

//die;
    echo "<script>location.href='$locat'</script>";
  }
?>
