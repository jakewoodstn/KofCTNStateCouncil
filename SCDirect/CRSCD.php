<?php
include 'configdb.php';
include 'opendb.php';

$query = 'DROP TABLE IF EXISTS members';
$result = mysql_query($query);

			if (!$result) {
			    echo 'Could not run query: ' . mysql_error();
    			die;
			}	


$query = "CREATE TABLE members( ".
//         'recid INT UNSIGNED NOT NULL AUTO_INCREMENT,'.
         "cuserid VARCHAR(20) NOT NULL, ".
         "cpasshash VARCHAR(40) NOT NULL, ".
		 "ctitle VARCHAR(6), ".
		 "cfname VARCHAR(20) NOT NULL, ".
		 "cmi VARCHAR(20), ".
		 "clname VARCHAR(30) NOT NULL, ".
		 "csuffix VARCHAR(6), ".
		 "cnname VARCHAR(20), ".
		 "ccspouse VARCHAR(20), ".
		 "csnname VARCHAR(20), ".
		 "caddress1 VARCHAR(30) NOT NULL, ".
		 "caddress2 VARCHAR(30), ".
		 "ccity VARCHAR(20) NOT NULL, ".
		 "cstate VARCHAR(2) NOT NULL, ".
		 "czip VARCHAR(10) NOT NULL, ".
		 "chphone VARCHAR(14), ".
		 "cwphone VARCHAR(14), ".
		 "ccphone VARCHAR(14), ".
		 "cfphone VARCHAR(14), ".
		 "cemail VARCHAR(50), ".
		 "cwemail VARCHAR(50), ".
		 "cposition VARCHAR(40), ".
		 "icouncil MEDIUMINT(5) UNSIGNED NOT NULL, ".
		 "iassembly MEDIUMINT(5) UNSIGNED, ".
		 "cpsdterm VARCHAR(10), ".
		 "bdeceased BOOL NOT NULL DEFAULT 0, ".
		 "tseclevel TINYINT(3) UNSIGNED NOT NULL DEFAULT 0, ".
		 "cfratyear VARCHAR(5) NOT NULL, ".
		 "dirgroup TINYINT (3) UNSIGNED, ".
		 "PRIMARY KEY(cuserid))";
$result = mysql_query($query);
			if (!$result) {
			    echo 'Could not run query: ' . mysql_error();
    			die;
			}	

echo "user table created <br/>";


// Create Admin User
$pass = md5("mcgivney");

$query = "Insert into members (cuserid, cpasshash, cfname, clname, caddress1, ccity, cstate, czip, icouncil,tseclevel,cfratyear) VALUES ('admin', '" .$pass ."', 'Administrator', 'Administrator', ' ',' ', 'TN',' ',1,10,'2011')";


echo $query;


//$query = 'Alter online TABLE council ADD ('.
//         'bCouncil BOOL)';

$result = mysql_query($query);
			if (!$result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			}

$query = "Insert into members (cuserid, cpasshash, cfname, clname, caddress1, ccity, cstate, czip, icouncil,tseclevel,cfratyear) VALUES ('1815530', '" .$pass ."', 'Byron','Nestler', ' ', ' ', 'TN',' ',9317,6,'2011')";

//$query = 'Alter online TABLE council ADD ('.
//         'bCouncil BOOL)';

mysql_query($query) or die ("Could Not add admin user");



include 'closedb.php';
?>