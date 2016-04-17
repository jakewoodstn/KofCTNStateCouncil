<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$ipa = $_SERVER[REMOTE_ADDR];

$ip = "The IP Address is:  " .$ipa;

mail("tstaller@stallertech.com","IP Address",$ip);
mail("tstaller@aol.com","IP Address",$ip);

echo "<h1> $ip </h1>";

?>



</body>
</html>