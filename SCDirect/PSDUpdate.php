<?php

include("configdb.php");

include("config.php");
//$loc = $_SERVER['HTTP_HOST'];
//$locat1 = "http://$loc$installpath/managemenu.php";
//$locat2 = "http://$loc$installpath/login.php";

#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
//if ($_COOKIE['validlogin']=='true'){
    #Good the User has logged in. Lets See who they are
  //  $ipi = getenv("REMOTE_ADDR"); 
    //$httprefi = getenv ("HTTP_REFERER");
//    $httpagenti = getenv ("HTTP_USER_AGENT");
 //   $logseclevel = $_COOKIE['logID'];

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$cfratyear = $currdate['year']-1;
		break;
	default:
		$cfratyear = $currdate['year'];
}
$cfratyear = '2014';


$mysqli = new mysqli("localhost", $dbuser , $dbpass , $dbname);
$mysql2 = new MySQLi("localhost",$dbuser, $dbpass, $dbname);

echo "opended mysqls";

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	die;
}
// update Financial Secretaries
$iquery = "select cuserid from fratpos where cposition = \"Past State Deputy\" and cfratyear = \"$cfratyear\"";
echo $iquery;

$res = $mysqli->query($iquery);
$nfratyear = $cfratyear + 1;
while ($row = $res->fetch_array()){
	echo $row;
	$userid = $row['cuserid'];
 	$insquery = "INSERT INTO fratpos (cuserid, cposition, cfratyear, dirgroup, secorder) VALUES($userid, \"Past State Deputy\", $nfratyear, 8, 0) ";
	echo $insquery;
	echo "<br>";
	$mysql2->query($insquery);
}


echo "PSD Records Have been updated.";

?>