<?php
include("config.php");
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
    if(!((!empty($_POST['blockdir'])) || (!empty($_POST['nbsdir'])) || (!empty($_POST['teledir'])) || (!empty($_POST['rosterdir'])) || (!empty($_POST['editinfo'])) || (!empty($_POST['update']))||(!empty($_POST['massupdate']))||(!empty($_POST['printlabels']))||(!empty($_POST['emailblast']))||(!empty($_POST['clearlogin']))||(!empty($_POST['cupdate'])))){
  #now for the menu HTML code
    
    ?>

      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
               "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html>
        <head>
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
        
        <table align="center" border=1 cellspacing=3 cellpadding=2 width=450>
            <tr>
                <td align="center">
                    <H1 align="center">
                    <span class="TitleBlock"> State Council Directory Menu</span><h1>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <FORM align="center" NAME="Edit Options Councils" ACTION="scdmenu.php" target="_new" METHOD=POST>
                            <input type="hidden" name="ip" value="<?php echo $ipi; ?>" />
                            <input type="hidden" name="httpref" value="<?php echo $httprefi; ?>" />
                            <input type="hidden" name="httpagent" value="<?php echo $httpagenti; ?>" />
                            <TABLE align="center" ID="Table1" WIDTH=440">
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="blockdir" TYPE=SUBMIT class="NFButtonMenu" ID="bsdbutton" VALUE="Block Style Directory (PDF)" size=300>
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="teledir" TYPE=SUBMIT class="NFButtonMenu" ID="TSDbutton" VALUE="Telephone Style Directory (PDF)" size=300>
                                    </td>
                                </TR>
                               <?php
								if (($logseclevel>=4)){?>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="printlabels" TYPE=SUBMIT class="NFButtonMenu" ID="MLbutton" VALUE="Print Mailing Labels" size=300>
                                    </td>
                                </TR>
                                 <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="emailblast" TYPE=SUBMIT class="NFButtonMenu" ID="MLbutton" VALUE="Send Emails" size=300>
                                    </td>
                                </TR>
                                
                                 <?php
								}?>

                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="rosterdir" TYPE=SUBMIT class="NFButtonMenu" ID="edubutton" VALUE="Roster Directory (Excel)" size=300>
                                    </td>
                                </TR>
                                <?php
								if (($logseclevel>=0)){?>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="editinfo" TYPE=SUBMIT class="NFButtonMenu" ID="edbutton" VALUE="Edit Personal Information" size=300>
                                    </td>
                                </TR>
                                 <?php
								}
                                if ($logseclevel > 9){ ?>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="update" TYPE=SUBMIT class="NFButtonMenu" ID="eddegbutton" VALUE="Update Directory Data" size=300>
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="massupdate" TYPE=SUBMIT class="NFButtonMenu" ID="updebutton" VALUE="Update Directory" size=300>
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="cupdate" TYPE=SUBMIT class="NFButtonMenu" ID="cupbutton" VALUE="Update Council Info" size=300>
                                    </td>
                                </TR>
                                 <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="cfsupdate" TYPE=SUBMIT class="NFButtonMenu" ID="cfsupbutton" VALUE="Update FS Entries for Next Year" size=300>
                                    </td>
                                </TR>
<tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="nbsdir" TYPE=SUBMIT class="NFButtonMenu" ID="nbsdir" VALUE="Next Fraternal years Directory" size=300>
                                    </td>
                                </TR>
                              <?php
                                } ?>
                                <tr>
                                    <td colspan=3 align="center">
                                        &nbsp &nbsp
                                    </td>
                                </TR>
                                <tr>
                                    <td colspan=3 align="center">
                                        <INPUT NAME="clearlogin" TYPE=SUBMIT class="NFButtonMenu" ID="clearlogin" VALUE="Clear Remembered Login" size=300>
                                    </td>
                                </TR>
                            </table>
                    </FORM>
                  </td>
            </tr>
            <tr>
                <td align="center">
                 
                  <button onclick="<?php echo "location.href='$locat2'"; ?>">Logout </button>
                </td>
            </tr>            
            <tr>
                <td align="center">
                 
        			<button onclick="<?php echo "location.href='http://$loc/'"?>">Return to Home Page </button>
                </td>
            </tr>            

        </table>
        

        
      </body>   
<?php
    }else{
       if (!empty($_POST['blockdir'])){
            setcookie('scdform','blockdir');
 			$locat2= "http://$loc$installpath/genblockdir.php";
	   } elseif (!empty($_POST['nbsdir'])){
            setcookie('scdform','nblockdir');
 			$locat2= "http://$loc$installpath/gennfyblockdir.php";
        } elseif (!empty($_POST['teledir'])) {
            setcookie('scdform','teledir');
			// $locat2= "http://$loc$installpath/scdmain.php";
			$locat2= "http://$loc$installpath/genphonedir.php";
      } elseif (!empty($_POST['rosterdir'])){
            setcookie('scdform','rosterdir');
			 //$locat2= "http://$loc$installpath/scdmain.php";
			 $locat2= "http://$loc$installpath/genxlroster.php";
	  }elseif (!empty($_POST['printlabels'])){
		  	setcookie('scdform','printlabel');
			 $locat2= "http://$loc$installpath/pickprintcb.php";
	  }elseif (!empty($_POST['emailblast'])){
		  	setcookie('scdform','emailblast');
			 $locat2= "http://$loc$installpath/pickmailcb.php";			 
			 
      }elseif (!empty($_POST['editinfo'])){
            setcookie('scdform','edit');
			 $locat2= "http://$loc$installpath/entryform.php";
      } elseif (!empty($_POST['update'])){
        	setcookie('scdform','update');
		 	$locat2= "http://$loc$installpath/scdupd.php";
      } elseif (!empty($_POST['massupdate'])){
		    setcookie('scdform','add');
			$locat2= "http://$loc$installpath/updateform.php";
	  } elseif (!empty($_POST['cupdate'])){
		    //$locat2= "http://$loc$installpath/councilentry.php?" .htmlspecialchars(session_id());
			//$locat2= "councilentry.php";
			$locat2= "counciledit.php";
	  } elseif (!empty($_POST['cfsupdate'])){
		    setcookie('scdform','cfsupdate');
			$locat2= "http://$loc$installpath/FSUpdate.php";
	  } elseif (!empty($_POST['clearlogin'])){
			setcookie("scdirect",false);
			setcookie("scdirect2",false);
			setcookie('validlogin',"false"); 
			$locat2= "http://$loc$installpath/login.php";
		}


    
  
      echo "<script>location.href='$locat2'</script>";
      die;
    }

} else {
    $loc = $_SERVER['HTTP_HOST'];
    $locat = "login.php";
    echo "<script>location.href='$locat'</script>";
    die;
}
?>
</div>
</body>
</html>