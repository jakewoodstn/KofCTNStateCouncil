<?php

//require_once('data.php');



#---------------------#

# Get PDF Submission from the Client

# and Write to a file where the FN is a GUID

#---------------------#

    $fn =uniqid("");

    $fpfile = "./$fn.xml";

    $pdf = file_get_contents("php://input");

    $fo = fopen($fpfile,"w");

    fwrite($fo,$pdf);

    fclose($fo);

	



//include('config.php');

$jurisdiction = "Tennessee";

include('xmlparser.php');

	

// Create the parser and parse the file

$xml_parser = xml_parser_create();

xml_set_element_handler($xml_parser, "startElement", "endElement");

xml_set_character_data_handler($xml_parser, "characterData");



if (!($fp = fopen($fpfile,"r")))

{

    die ("could not open XML for input");

}



while ($data = fread($fp, 4096))

{

  if (!xml_parse($xml_parser, $data, feof($fp)))



    {

        die(sprintf("XML error: %s at line %d",

                    xml_error_string(xml_get_error_code($xml_parser)),

                    xml_get_current_line_number($xml_parser)));

    }

}



xml_parser_free($xml_parser);







//print_r($values);

fclose($fp);

include("configdb.php");



/* END XML PROCESSING */

$values[cuserid] = ltrim($values[cuserid],"0");

$fldlist = array('title','fname','mi','lname','suffix','nname','cspouse','snname','address1','address2','city','state','zip','hphone','wphone','cphone','fphone','email','wemail','council','assembly','psdterm','deceased','seclevel','userid','passhash');

// set the appropriate flags for the various positions (which group, and security level)

$secorder = 0;
$dirgroup = 0;
$seclevel = 0;

switch(substr($values[cposition],0,13)){

	case "Grand Knight":

	   $seclevel = 1;
	   $dirgroup = 6;
	   $secorder = 0;
	   break;
	case "Financial Sec":
		$dirgroup = 7;
		$secorder = 0;
		break;
	case "Faithful Navi":
		$dirgroup = 10;
		$secorder = 0;
		break;
	case "Faithful Comp":
		$dirgroup = 11;
		$secorder = 0;
		break;
	case "District Mast":
	    $dirgroup = 9;
		break;
	case "District Depu":
		$seclevel= 3;
		$dirgroup=4;
		break;
	case "District Ward":
		$dirgroup = 5;
		break;
	case "Membership Di":
		$dirgroup = 3;
		$seclevel = 4;
		break;
	case "Program Direc":
		$dirgroup = 2;
		$seclevel = 4;
		break;
	case "Past State De":
		$dirgroup = 8;
		$secorder = 0;
		break;
	case "State Deputy":
		$dirgroup = 1;
		$secorder = 1;
		$seclevel = 4;
		break;
	case "State Secreta":
		$dirgroup = 1;
		$secorder = 3;
		$seclevel = 10;
		break;
	case "State Treasur":
		$dirgroup = 1;
		$secorder = 4;
		$seclevel = 4;
		break;
	case "State Advocat":
		$dirgroup = 1;
		$secorder = 5;
		$seclevel = 4;
		break;
	case "State Warden":
		$secorder = 6;
		$dirgroup = 1;
		$seclevel = 4;
		break;
	case "State Chaplai":
		$dirgroup = 1;
		$secorder = 2;
		$seclevel = 4;
		break;
	case "Immediate Pas":
		$secorder = 7;
		$dirgroup = 1;
		$seclevel = 4;
		break;
	case "General Progr":
		$dirgroup = 2;
		$secorder = 1;
		$seclevel = 4;
		break;
	case "Church Consul":
		$dirgroup = 2;
		$secorder = 2;
		$seclevel = 0;
		break;
	case "Charities Con":
		$dirgroup = 2;
		$secorder = 3;
		$seclevel = 0;
		break;
	case "Community Con":
		$dirgroup = 2;
		$secorder = 4;
		$seclevel = 0;
		break;
	case "Council Consu":
		$dirgroup = 2;
		$secorder = 5;
		$seclevel = 0;
		break;
	case "Family Consul":
		$dirgroup = 2;
		$secorder = 6;
		$seclevel = 0;
		break;
	case "Pro-Life Coup":
		$dirgroup = 2;
		$secorder = 7;
		$seclevel = 0;
		break;
	case "Squires Consu":
		$dirgroup = 2;
		$secorder = 8;
		$seclevel = 0;
		break;
	case "Youth Consult":
		$dirgroup = 2;
		$secorder = 9;
		$seclevel = 0;
		break;
	case "Ceremonials D":
		$dirgroup = 3;
		$seclevel = 4;
		break;
	case "Ceremonials A":
		$dirgroup = 3;
		$seclevel = 4;
		break;
	case "Administrativ":
		$dirgroup = 2;
		$secorder = 15;
		$seclevel = 4;
		break;
	case "Insurance Pro":
		$dirgroup = 2;
		$secorder = 10;
		$seclevel = 0;
		break;
	case "Historian":
		$dirgroup = 2;
		$secorder = 11;
		$seclevel = 0;
		break;
	case "Webmaster":
		$dirgroup = 2;
		$secorder = 12;
		$seclevel = 10;
		break;
	case "Public Relati":
		$dirgroup = 2;
		$secorder = 13;
		$seclevel = 0;
		break;
	case "Photographer":
		$dirgroup = 2;
		$secorder = 14;
		$seclevel = 0;
		break;
	case "Newsletter-Fo":
		$dirgroup = 2;
		$secorder = 16;
		$seclevel = 0;
		break;
	case "Membership Co":
		$dirgroup = 3;
		$seclevel = 4;
		break;
	case "Membership As":
		$dirgroup = 3;
		$seclevel = 0;
		break;
	case "Retention Con":
		$dirgroup = 3;
		$seclevel = 4;
		break;
	case "Retention Ass":
		$dirgroup = 3;
		$seclevel = 0;
		break;
	case "Hispanic Memb":
		$dirgroup = 3;
		$seclevel = 0;
		break;
	case "New Council D":
		$dirgroup = 2;
		$secorder = 17;
		$seclevel = 0;
		break;
}	

$mysqli = new mysqli("localhost", $dbuser , $dbpass , $dbname);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	die;
}
// Determine if Member number exists in database
if ($values[cuserid] > 0) {
	$query = "SELECT cuserid, clname, cfname, cmi FROM members WHERE cuserid = $values[cuserid]";
	$result= $mysqli->query($query);
	$resCnt = $result->num_rows;
	// Set the update flage true if a row is returned
	if ($resCnt >0){
		$enupd = true;
	} else {
		$enupd = false;
	}
}
// determine if the Council is in the TN jurisdiction
if ($values[icouncil] > 0) {
	$query = "Select ccouncil from council where ccouncil = $values[icouncil]";
	$result = $mysqli->query($query);
	$resCnt = $result->num_rows;
	if ($resCnt = 0) {
		echo "ERROR:  Council Number $values[icouncil] does not belong to the $jurisdiction Jurisdiction.  Please correct and resubmit";
		die;
	}
	$result->free();
}

// Determine if the Assembly is in the TN Jurisdiction
if ($values[iassembly] > 0) {
	$query = "Select ccouncil from council where ccouncil = $values[icouncil] and bcouncil = false";
	$result = $mysqli->query($query);
	$resCnt = $result->num_rows;
	if ($resCnt = 0) {
		echo "ERROR:  Assembly Number $values[iassembly] does not belong to the $jurisdiction Jurisdiction.  Please correct and resubmit";
		die;
	}
	$result->free();
}
// develop the appropriate query for an add or an update
if (! $enupd) {
	$vals = "VALUES (";
	$basequery = "INSERT INTO members (";
	foreach($fldlist as $ekey){
		//$vals .= "$" .$ekey ." , ";
		switch ($ekey){
			case 'council':
			case 'assembly':
			    $ekey = "i".$ekey;
			    $vals .= "'" .$values[$ekey] ."', ";
				//$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$values[" .$ekey ."]);";
				$basequery .= $ekey .", ";
				break;
			case 'seclevel':
				$ekey = "t" .$ekey;
				$vals .= "\"" .$seclevel ."\", ";
				$basequery .= $ekey .", ";
				break;
			case 'deceased':
			    $ekey = "b" .$ekey;
				$vals .= "0, ";
				$basequery .= $ekey .", ";
				break;
			case 'passhash':
					$pwenc = md5("mjm1882");
					$vals .= "\"" .$pwenc ."\", ";
					//$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$pwenc);";
					$basequery .= "c" .$ekey .", ";
				break;
			default:
				$ekey = "c" .$ekey;
				$basequery .=  $ekey .", ";
				$vals .= "\"" .$values[$ekey] ."\", ";
				//$cmdevstr = "\$valstr = sprintf(\" '%s' ,\", \$values[" .$ekey ."]);";
		}

		// Add the Value to the Query Values clause

		//eval($cmdevstr);

		//$vals .= $valstr;



	}

	

	$vals = substr($vals,0,-2);

	$vals .= ")";

	$basequery = substr($basequery,0, -2);

	$basequery .= ") ";

	$iuquery= $basequery .$vals;

} else {

	

	// Generate Query to Update the Members Record

	$iuquery = "UPDATE members SET ";

	foreach($fldlist as $ekey){

		$cmdevstr = "\$valstr = sprintf(\" '%s' \", \$values['" .$ekey ."']);";

		//$valstr = sprintf('%s', $values[$ekey]);

		//eval($cmdevstr);	

		

			

		switch ($ekey){

			case 'council':

			case 'assembly':

				$ekey = "i" .$ekey;

				$iuquery .= $ekey ." = \"" .$values[$ekey] ."\", ";

				break;

			case 'seclevel':

				$ekey = "t" .$ekey;

				$iuquery .= $ekey ." = \"" .$seclevel ."\", ";

				break;

			case 'deceased':

				$ekey = "b" .$ekey;

				$iuquery .= $ekey ." = 0, ";

				break;

			case 'passhash':

				// dont update the password

				break;

			case 'userid':

				// we dont update the userid

				break;

			default:

				$ekey = "c" .$ekey;

				$iuquery .= $ekey ." = \"" .$values[$ekey] ."\", ";

		}

		

	}

	$iuquery = substr($iuquery,0,-2);					

	$iuquery .= " WHERE cuserid = \"" .$values[cuserid] ."\""; 



}



// write update to the database

mail('tstaller@aol.com','Directory Query',$iuquery);



$result = $mysqli->query($iuquery);

$emad = $values[cemail];

if ($result > 0) {

	if ($enupd){

		echo "Your personal data has been updated in the State directory <br> <br>";
		mail($emad,"Update Received","Your personal data has been updated in the State directory");

	} else {

		echo "Your Personal Data has been saved to the State Directory!! <br><br>";

		echo "Your default password has been set to \"mjm1882\"<br><br>";
		mail($emad,"Information Received","Your Personal Data has been saved to the State Directory!! Your default password has been set to \"mjm1882\"");
	}

} else {

	 $iuquery .= $mysqli->errno ."  " .$mysqli->error;

     mail('tstaller@aol.com','Directory Error',$iuquery);

	echo "There was an error saving your personal Data, the error has been reported.<br>Please try to resubmit in a couple of days if you do not recieve a response";

	die;

}





//Prepare to add the Position to the database







$currfratyear = GetFratYear();

if ($values['fratyear']='nextyear'){

	$fratyear = $currfratyear+1;

} else {

	$fratyear = $currfratyear;

}



//check for an exsisting record for the position and fraternal year



$iquery = "select cuserid, cposition from fratpos where cuserid = \"$values[cuserid]\" and cposition = \"$values[cposition]\" and cfratyear = \"$fratyear\"";

mail('tstaller@aol.com','Directory Query',$iquery);

$result = $mysqli->query($iquery);







if ($result->num_rows <= 0){

// if the entry does not exist then add it



	$insquery = "INSERT INTO fratpos (cuserid, cposition, cfratyear, dirgroup, secorder) VALUES(";

	//$insquery .= $values[cuserid] .", \"" .$values[cposition] ."\", " .$fratyear .", " .$dirgroup .", " .$secorder .")";
	$insquery .= $values[cuserid] .", \"" .$values[cposition] ."\", " .$fratyear .", $dirgroup , $secorder )";
	mail('tstaller@aol.com','Directory Query',$insquery);

	$result = $mysqli->query($insquery);

	if (!$result) {

		if ($mysqli->errno <> 1062){

			echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";

			mail("tstaller@aol.com","Directory Query Error", "error" . $mysqli->errno ."was encountered adding ".$userid ." " .$poPos ." " .$fratyear);

			die;

		}

	}

}



unlink($fo);



$loc = $_SERVER['HTTP_HOST'];



$locat1 = "http://$loc/index.php";











?>







<br/><br/>



<button onclick="<?php echo "location.href='$locat1'" ?>">Return to Home Page </button>



