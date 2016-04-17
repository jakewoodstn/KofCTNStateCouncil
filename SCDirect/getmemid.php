<?php
//require_once('data.php');
include('config.php');
include 'configdb.php';
include 'opendb.php';
$qry = "Select cfname, clname, cuserid from members order by clname,cfname";
$result = mysql_query($qry);
if (!$result) {
	if (mysql_errno <> 1062){
		echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button, The adminsitrator has been notified of the error</br> ";
		mail("tstaller@aol.com","Directory Query Error", "error" . mysql_error() ."was encountered adding ".$userid ." " .$fname ." " .$lname);
		die;
	}
}
    $opts = "";
    while($row = mysql_fetch_array($result)){
		
		$opts .= '<option value = "' .$row['cuserid'] .'"> ' .$row['clname'] .', ' .$row['cfname'] .'</option>\n';
	};
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script>
function select_item(item)
{
if (item==0){
	targetitem.value = '';
} else {
	var e = document.getElementById("memsel");
	targetitem.value = e.options[e.selectedIndex].value;
};
top.close();
return false;
}
</script>
<body>


<CENTER>
<B>Retrieve Member:</B>
<BR>
<select name="member" id="memsel">
<?php

    //while($row = mysql_fetch_array($result)){
	//	echo '<option value = "' & $row['cuserid'] & '"> ' & $row['clname'] & ', ' & $row['cfname'] & '</option>';
	//};
    echo $opts;

?>

</select>
<br />
<br />


<button onClick='return select_item("1")'>Retrieve </button>
    <button onClick='return select_item("0")'>Cancel</button>
</CENTER>

</body>
</html>