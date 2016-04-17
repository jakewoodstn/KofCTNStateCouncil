<?php

include("config.php");
$loc = $_SERVER['HTTP_HOST'];
$locat1 = "http://$loc$installpath/managemenu.php";
$locat2 = "http://$loc$installpath/scdadmin.php";

#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
if ($_COOKIE['validlogin']=='true'){
    #Good the User has logged in. Lets See who they are
    $ipi = getenv("REMOTE_ADDR"); 
    $httprefi = getenv ("HTTP_REFERER");
    $httpagenti = getenv ("HTTP_USER_AGENT");
    $logseclevel = $_COOKIE['logID'];
    if(!((!empty($_POST['blockdir'])) || (!empty($_POST['teledir'])) || (!empty($_POST['rosterdir'])) || (!empty($_POST['editinfo'])) || (!empty($_POST['update'])))){
      
    
    #now for the menu HTML code
    
    ?>

      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
               "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html>
        <head>
          <title>Administrative Menu</title>
          <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
          <meta name='keywords' content='php grid, php datagrid, php data grid, datagrid sample, datagrid php, datagrid, grid php, datagrid in php, data grid in php, free php grid, free php datagrid, pear datagrid, datagrid paging' />
          <meta name='description' content='Advanced Power of PHP - using PHP DataGrid Pro for displaying some statistical data' />
          <meta content='Advanced Power of PHP' name='author'></meta>
        </head>
      
      <body>    
        <table align="center" border=1 cellspacing=3 cellpadding=2 width=450>
            <tr>
                <td align="center">
                    <H1 align="center"> State Council Directory Menu
                    <h1>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <FORM align="center" NAME="Edit Options Councils" ACTION="adminmenu.php" METHOD=POST>
                            <input type="hidden" name="ip" value="<?php echo $ipi ?>" />
                            <input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
                            <input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />
                            <TABLE align="center" ID="Table1" WIDTH=440">
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT TYPE=SUBMIT NAME="blockdir" VALUE="Block Stye Directory (PDF)" ID="bsdbutton" size=300>
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT TYPE=SUBMIT NAME="teledir" VALUE="Telephone Style Directory (PDF)" ID="TSDbutton" size=300>
                                    </td>
                                </TR>
                             
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT TYPE=SUBMIT NAME="rosterdir" VALUE="Roster Directory (Excel)" ID="edubutton" size=300>
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT TYPE=SUBMIT NAME="editinfo" VALUE="Edit Personal Information" ID="edbutton" size=300>
                                    </td>
                                </TR>
                                 <?php
                                if ($logseclevel == 10){ ?>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT TYPE=SUBMIT NAME="update" VALUE="Update Directory Entries" ID="eddegbutton" size=300>
                                    </td>
                                </TR>

                              <?php
                                } ?>
                                <tr>
                                    <td colspan=3 align="center">
                                        &nbsp &nbsp
                                    </td>
                                </TR>
                            </table>
                    </FORM>
                  </td>
            </tr>
            <tr>
                <td align="center">
                 
                  <button onclick="<?php echo "location.href='$locat2'" ?>">Logout </button>
                </td>
            </tr>            
        </table>
      </body>   
<?php
    }else{
       if (!empty($_POST['blockdir'])){
            setcookie('scdform','blockdir');
        } elseif (!empty($_POST['teledir'])) {
            setcookie('scdform','teledir');
      } elseif (!empty($_POST['rosterdir'])){
            setcookie('scdform','rosterdir');
      }elseif (!empty($_POST['editinfo'])){
            setcookie('scdform','editinfo');
      } elseif (!empty($_POST['update'])){
        setcookie('scdform','update');
      }
      $locat2= "http://$loc$installpath/scdmain.php";
      echo "<script>location.href='$locat2'</script>";
      die;
    }

} else {
    $loc = $_SERVER['HTTP_HOST'];
    $locat = "http://$loc$installpath/login.php";
    echo "<script>location.href='$locat'</script>";
    die;
}
?>

</body>
</html>