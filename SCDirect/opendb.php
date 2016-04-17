<?php

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql:'.mysql_error().'|'.$dbhost.'|'.$dbuser.'|'.$dbpass);

mysql_select_db($dbname);

?>