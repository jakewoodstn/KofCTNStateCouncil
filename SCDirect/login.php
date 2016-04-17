<?php
// Config.php is the main configuration file.
include('config.php');
$loc = $_SERVER['HTTP_HOST'];
$locat2 = "http://$loc$installpath/scdmenu.php";
$locat3 = "http://$loc$installpath/entryform.php";

$msg = "";
// Language file.
include("lang/$language");
// Password protection.
$login_password = "";
// Random string generator.
function randomstring($length){
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$string  = $chars{ rand(0,61) };
	for($i=1;$i<$length;$i++){
		$string .= $chars{ rand(0,61) };
	}
	return $string;
}
#see if a session has started and if we are already logged in
#if so then just redirect to the management menu
$sesid = session_id();
if (!empty($sesid)){
	echo "validlogin " .$_COOKIE['validlogin'] ."</br>";
	if ($_COOKIE['validlogin']=='true'){
		echo "<script>location.href='$locat2'</script>";
	} else if ($_COOKIE['createlogin']== 'true') {
		echo "<script>location.href='$locat3;</script>";
	}
}
if ($password_protect == "on") {

	session_start();
	#if the scdirect cookie exists on the system
	#then the user has asked to be remembered so
	#retrieve the username and password hash from
	#their system for Authentication
	if (!empty($_COOKIE['scdirect'])){
		$userid = $_COOKIE['scdirect'];
		$_SESSION['userid'] = $userid;
		$_SESSION['pass_hash_upload']= $_COOKIE['scdirect2'];
		$_POST['userid']= $userid;
		$_POST['pass_hash_upload']=$_COOKIE['scdirect2'];
		$remembered = true;
		include('configdb.php');
		include('opendb.php');
		$query = "Select * from members where cuserid = '$userid'";
		$data = mysql_query($query);
		if (mysql_num_rows($data)!=0){
            $pwd = mysql_fetch_array($data);
			$login_password = $pwd['cpasshash'];
			$logseclevel = $pwd['tseclevel'];
		}else{
			$login_password = "";
		}
        include('closedb.php');
		$_POST['userid'] = $userid;
		$_POST['pass_string_hash'] = "remember";
		$_POST['agenthash']= "remember";
		$_POST['remember']="remember";
		$string_response = "remember";
		$agent_response = "remember";
		$msg .= "retrieved from Cookie \n";
	}
	if (!array_key_exists('pass_hash_upload', $_SESSION)){
		$_SESSION['pass_hash_upload']="";
	}
	if (!array_key_exists('pass_string_hash',$_POST)){
		$_POST['pass_string_hash'] = "";
		$string_response=" ";
	}
	if (!array_key_exists('agenthash',$_POST)){
		$_POST['pass_hash_upload'] = "";
		$agent_response = " ";
	}

	if(!empty($_POST['pass_hash_upload'])&& !empty($_POST['userid'])) {
		// Crypt, hash, and store password in session.
		$msg .="Retrieve User Info/set session variables \n";
		if (!$remembered){
			$userid = $_POST['userid'];
			$_SESSION['userid'] = $userid;
			$PW1 = $_POST['pass_hash_upload'];
			$_SESSION['pass_hash_upload'] = $_POST['pass_hash2'];
			// Crypt random string with random string seed for agent response.
			$string_agent = crypt($_SESSION['random'], $_SESSION['random']);
			// Hash crypted random string for random string response.
			$string_string = md5($string_agent);
			// Hash and concatenate md5/crypted random string and password hash posts.
			$string_response = md5($string_string . $_POST['pass_hash2']);
			// Concatenate agent and language.
			$agent_lang = getenv('HTTP_USER_AGENT') . getenv('HTTP_ACCEPT_LANGUAGE');
			// Hash crypted agent/language concatenate with random string seed for check against post.
			$agent_response = md5(crypt(md5($agent_lang), $string_agent));
		}
		include('configdb.php');
		include('opendb.php');
		
		
		$userid2 = mysql_real_escape_string($userid);
		$query = "Select * from members where cuserid = '$userid'";
		$data = mysql_query($query);
		if (mysql_num_rows($data)!=0){
            $pwd = mysql_fetch_array($data);
			$login_password = $pwd['cpasshash'];
			$logseclevel = $pwd['tseclevel'];
			$homecouncil = $pwd['icouncil'];
			$data = mysql_query("select tdistrict from council where ccouncil = '$homecouncil' and bcouncil = true");
			if (mysql_num_rows($data)!=0){
				$pwd = mysql_fetch_array($data);
				$homedistrict = $pwd['tdistrict'];
			}else{
				$homedistrict = 1000;
			}
		}else{
			$login_password = "";
		}
        include('closedb.php');
	// Check crypted pass against stored pass. Check random string and pass hashed concatenate against post. Check hashed and crypted agent/language concatenate against post.
	}

	if (($userid == $createuser && $_SESSION['pass_hash_upload'] == md5($createpwd))||($userid == $viewuser && $_SESSION['pass_hash_upload'] == md5($viewpwd))) {
			$speciallogin = 'true';
			switch ($userid){
				case $createuser:
					$logseclevel = 0;
					break;
				case $viewuser:
					$logseclevel = -1;
					break;
			}
		} else {
			$speciallogin = 'false';
		}
	if (($speciallogin != 'true')&& (($_SESSION['pass_hash_upload'] != $login_password) || ($_POST['pass_string_hash'] != $string_response) || ($_POST['agenthash'] != $agent_response))) {
		$msg .= "Display Login Menu\n";
		// Otherwise, give login.
#		if ($head == "on") {
#			include("header.php");
#		}
		// Set random string session.
		$_SESSION['random'] = randomstring(40);
		// Crypt random string with random string seed.
		$rand_string = crypt($_SESSION['random'], $_SESSION['random']);
		// Concatenate agent and language.
		$agent_lang = getenv('HTTP_USER_AGENT').getenv('HTTP_ACCEPT_LANGUAGE');
		// Crypt agent and language with random string seed for form submission.
		$agent = crypt(md5($agent_lang), $rand_string);

		// Form md5 and encrypt javascript.

		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">

		<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">

		<head>

	        <title>State Council Directory Login</title>

	        <link rel=\"stylesheet\" type=\"text/css\" href=\"degcal.css\" />
            <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"scddef.css\" /> 
		</head>

		

		<script type=\"text/javascript\" src=\"data/crypt/sha256.js\"></script>

		<script type=\"text/javascript\" src=\"data/crypt/md5.js\"></script>

		<script type=\"text/javascript\">

		function obfuscate() {

			document.form1.pass_hash_upload.value = hex_sha256(document.form1.pass_upload.value);
			
			document.form1.pass_hash2.value = hex_md5(document.form1.pass_upload.value);

			document.form1.string_hash.value = hex_md5(document.form1.string.value);

			document.form1.pass_string_hash.value =  hex_md5(document.form1.string_hash.value  + document.form1.pass_hash2.value);

			document.form1.agenthash.value = hex_md5(document.form1.agent.value);

			document.form1.pass_upload.value = \"\";

			document.form1.string.value = \"\";

			document.form1.agent.value = \"\";

			document.form1.jscript.value = \"on\";

			return true;

		}

		</script>
		
		<body>
         <div id=\"container\">
		   <div id=\"masthead\">
           	</div>
	  </div>

		<table width=300 align=center>

		<tr>

			<td align=\"center\">

				<b>$l_global13</b>

			</td>

		</tr>

		<tr>

		<td>

		<form action=\"login.php\" method=\"post\" name=\"form1\" onsubmit=\"return obfuscate()\">

		$p

		<input name=\"jscript\" type=\"hidden\" value=\"off\" />

		<input name=\"pass_hash_upload\" type=\"hidden\" value=\"\" />

		<input name=\"pass_hash2\" type=\"hidden\" value=\"\" />

		<input name=\"string_hash\" type=\"hidden\" value=\"\" />

		<input name=\"pass_string_hash\" type=\"hidden\" value=\"\" />

		<input name=\"agenthash\" type=\"hidden\" value=\"\" />

		<input name=\"string\" type=\"hidden\" value=\"$rand_string\" />

		<input name=\"agent\" type=\"hidden\" value=\"$agent\" />

		User ID:    <input type=\"text\" name=\"userid\" /> <br/>

		Password:   <input type=\"password\" name=\"pass_upload\" /> <br /> <br />

		<input name=\"remember\" type=\"checkbox\" value=\"remember\" /> Remember my login on this computer<br />

		<input type=\"submit\" value=\"$l_global14\" />    

		$p2

		</form>

		</td>

		</tr>
		<tr>
		<td>
			<button onclick=\"location.href='http://$loc/'\">Return to Home Page </button>
			</td>
			</tr>
			

		</table>
		
		</body>";
		

#<button onclick=\"location.href='$loc\index.htm'\">Return to Home Page </button>
#		if ($head == "on") {

#			include("footer.php");

#		}

		exit();

	} else {

		    $msg .= "!$userid!$homecouncil!$homedistrict!";

			#mail("tstaller@aol.com", "Login Diagnostics", $msg, "Login");
            setcookie('validlogin','true');
            setcookie('userid',$userid);
		    setcookie('logID',$logseclevel);
			setcookie('hcouncil',$homecouncil);
			setcookie('hdist',$homedistrict);
			setcookie('currentrow',0);

            if ($userid == 'admin'||$logseclevel>9){
                setcookie('adminlogin','true');
            }
			if ($speciallogin == 'true'){
				setcookie('speclogin','NEW');
			}else{
				setcookie('speclogin','NO');
			}
	    	if ($_POST['remember']=="remember"){
				#hash the User ID
				#$UIDMd5 = md5($userid);
				#Save it in a cookie and Set cookie to expire in 30 days
				setcookie('scdirect',$userid,time()+2592000);
				setcookie('scdirect2',$login_password,time()+2592000);
	    	}

            // End password protection.
            #If we made it here it is a valid login and we need to redirect to the 
			#Appropriate page
            $loc = $_SERVER['HTTP_HOST'];
            $locat = "scdmenu.php";
			//$locat = "http://$loc$installpath/scdmenu.php";
			if ($userid==$createuser) {
				$locat = "http://$loc$installpath/entryform.php";
				setcookie('logID',0);
				setcookie('speclogin','NEW');
				setcookie('scdform','add');
			}
			if ($userid == $viewuser) {
				//$locat = "http://$loc$installpath/scdmenu.php";
				$locat = "scdmenu.php";
  		    	setcookie('logID',-1);
				setcookie('userid',$userid);
			
			}

            echo "<script>location.href='$locat'</script>";

            #header("Location:$locat");

            die;   

        }

} else {

}













?>



