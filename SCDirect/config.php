<?php
########################################################################
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
// PASSWORD PROTECTION SETTINGS //
// I STRONGLY recommend using the built in password protection, unless you are using SSL. I believe it is much more secure than .htaccess or most other password protection scripts. The passwords cannot be set using the config.php file. Cookies must be enabled.
$password_protect = "on";

// new profile creation login settings.  When this username and password are utilized, the
// system will open the profile entry form and allow a new profile entry
$createuser= "park";
$createpwd="wills";

//New Profile Notification Email Address

$createnotifyemail = "stateadvocate@kofc-tn.org";

// Directory View login settings.  When this username and Password are utilized the system
// will open the view/generate directory menu

$viewuser = "porter";
$viewpwd="wicke";

//Current Fraternal year Default Value

function GetFratYear($offset)
{

if (empty($offset)){$offset=0;}

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

return $currfratyear+ $offset;

}

function GetNextFratYear($offset)
{

if (empty($offset)){$offset=0;}

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


return $currfratyear+$offset;

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
			

// From address for Info Verificaiton Email

$verifyfrom = "stateadvocate@kofc-tn.org";

// Opening Text for Verification Email

$optext = "<p>In an effort to keep our State Council directory as accurate as possible, I ask that you review the information in the table below.  If the information is correct, simply click on the appropriate link and you will be taken to the state council web site to verify or correct your information.</p>";

// Closing Text for Verification email

$cltext = "<p>If you have any questions or concerns regarding this request for information, Please contact me via email at stateadvocate@kofc-tn.org, or by telephone at 865-388-3649.</p>
<p>Fraternally Yours,</p>
<p>Tracy Staller</p>
<p>State Advocate,<br /> 
Tennessee State Council<br />
Knights of Columbus</p>";


// Html start tag. The following are only used for Upload-Point script pages.
$p = "<p>";
// Html end tag
$p2 = "</p>";

?>