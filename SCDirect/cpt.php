<?php
include 'configdb.php';
include 'opendb.php';

/*
$query = "ALTER TABLE degreeinfo ADD COLUMN (ccity VARCHAR(30)) ";
*/

//$query = "ALTER TABLE degreeinfo ADD COLUMN (ccity VARCHAR(30)) ";

$query = "CREATE TABLE fratpos( ".
         'recid INT UNSIGNED NOT NULL AUTO_INCREMENT, '.
         "cuserid VARCHAR(20) NOT NULL, ".
		 "cposition VARCHAR(40) NOT NULL, ".
		 "cfratyear VARCHAR(5) NOT NULL, ".
		 "dirgroup TINYINT(3) UNSIGNED NOT NULL, ".
		 "secorder TINYINT(3) UNSIGNED NOT NULL, ".
         "PRIMARY KEY(recid), KEY(cuserid))";

$result = mysql_query($query);
if (!$result) {
	if (mysql_errno <> 1062){
		echo 'Could not run query: ' . mysql_error() ;
		die;
	}
} else {
	echo "SUCCESS!!!!";
	die;
}





include 'closedb.php';
?>