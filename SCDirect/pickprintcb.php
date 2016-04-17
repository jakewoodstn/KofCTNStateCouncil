<?php 
include "config.php";
$loc = $_SERVER['HTTP_HOST'];
$locat1 = "http://$loc$installpath/managemenu.php";
$locat2 = "http://$loc$installpath/login.php";

#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
if ($_COOKIE['validlogin']=='true'){
    #Good the User has logged in. Lets See who they are
    $ipi = getenv("REMOTE_ADDR"); 
    $httprefi = getenv ("HTTP_REFERER");
    $httpagenti = getenv ("HTTP_USER_AGENT");
    $logseclevel = $_COOKIE['logID'];
   // if(!((!empty($_POST['printselect'])))){
      
    
    #now for the menu HTML code



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
          <title>State Council Directory Menu</title>
          <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
          <meta name='keywords' content='php grid, php datagrid, php data grid, datagrid sample, datagrid php, datagrid, grid php, datagrid in php, data grid in php, free php grid, free php datagrid, pear datagrid, datagrid paging' />
          <meta name='description' content='Advanced Power of PHP - using PHP DataGrid Pro for displaying some statistical data' />
          <meta content='Advanced Power of PHP' name='author'></meta>
          
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
<link rel="stylesheet" type="text/css" media="all" href="scddef.css" />          
          
        </head>
      
      <body>  
      <div id="container">
		   <div id="masthead">
           	</div>
	  </div>

    <table align="center" border=0 cellspacing=3 cellpadding=2 width=450>
            <tr>
                <td align="center">
                    <H1 align="center">
                    <span class="TitleBlock"> Print Labels for Which Group(s)</span><h1>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <FORM align="center" NAME="Print Options" ACTION="genmaillabels.php" target="_new" METHOD=POST>
                            <input type="hidden" name="ip" value="<?php echo $ipi; ?>" />
                            <input type="hidden" name="httpref" value="<?php echo $httprefi; ?>" />
                            <input type="hidden" name="httpagent" value="<?php echo $httpagenti; ?>" />
                            <TABLE align="center" ID="Table1" WIDTH=440">
<?php
								$inum = 1;
                                foreach($printcat as $elm){
										echo '<tr align="left"><td width=25%>&nbsp;</td><td width=75%> <input type="checkbox" name="'.$elm['name'] .'" value="' .$elm['ID'] .'" /> ' .$elm['label'] .'<br />';
									    echo '</td> </tr>';
								}
                                        ?>
                                        </select>
                           </table>
                           <tr>
                           <td align="center">
                           	<input name="submit" type="submit" value="Generate Labels" />
                           </td>
                           </tr>
                       
                       
                       </form>
                       
                       
                 </td>
            </tr>
        </table>
<?php 
}   // No Submission
?>





</body>
</html>

<?php
 
//}   // Invalid Login
?>
