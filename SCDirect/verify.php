<?php
include"config.php";

$loc = $_SERVER['HTTP_HOST'];
$str = $_SERVER['QUERY_STRING'];

parse_str($str);

switch($logintype) {
	case "verify":
			include "configdb.php";
			include "opendb.php";
			$qry = "update members set bverified=1 where cuserid = " .$user;
			mysql_query($qry);
			include "closedb.php";
		break;
	case "edit":
		
		$locat2 = "editform.php?user=" .$user;
		echo "<script>location.href='http://$loc$installpath/$locat2'</script>";
      	die;
	
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<H1> Thank You for Verifying your Information!!</h1>

</body>
</html>


