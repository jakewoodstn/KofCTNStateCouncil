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
	$userid = $_COOKIE['userid'];
		include('configdb.php');
		include('opendb.php');
    $query = "Select cemail from members where cuserid = '$userid'";
		$data = mysql_query($query);
		if (mysql_num_rows($data)!=0){
            $info = mysql_fetch_array($data);
			$fromaddress = $info['cemail'];
		}else{
			$fromaddress = "";
		}

	include('closedb.php');	
	
   // if(!((!empty($_POST['printselect'])))){
      
    
    #now for the menu HTML code



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
          <title>State Council Directory Emailer</title>
          <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

          
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
<link rel="stylesheet" type="text/css" media="all" href="scddef.css" />    
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
<script type="text/javascript" >
tinyMCE.init({
        mode : "textareas",
         theme : "advanced",
        plugins : "emotions,spellchecker", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "bold,italic,underline,|,cut,copy,paste,|,undo,redo,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect|,outdent,indent,|,bullist,numlist,|,link,unlink,anchor,image,|,forecolor,backcolor,|,insertdate,inserttime,|,spellchecker,advhr,removeformat,|,sub,sup,|,charmap,emotions",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false
});
</script >      
          
        </head>
      
      <body>  
      <div id="container">
		   <div id="masthead">
           	</div>
	  </div>

    <table align="center" border=1 cellspacing=3 cellpadding=2 width=880>
            <tr>
                <td colspan="2" align="center">
                    <H1 align="center">
                    <span class="TitleBlock"> Send Mail to:</span><h1>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                  <FORM align="center" NAME="Print Options" ACTION="blastmail.php" target="_new" METHOD=POST enctype="multipart/form-data">
                	<input type="hidden" name="ip" value="<?php echo $ipi; ?>" />
                    <input type="hidden" name="httpref" value="<?php echo $httprefi; ?>" />
                    <input type="hidden" name="httpagent" value="<?php echo $httpagenti; ?>" />
                       
                    <table align="center" id="table1a" Width = "850">
                        <tr>
                            <td width="220">
                                <TABLE align="right" ID="Table1" WIDTH="220">
					                   <?php
								         $inum = 1;
										foreach($printcat as $elm){
												echo '<tr align="left"><td width=15%>&nbsp;</td><td width=85%> <input type="checkbox" name="'.$elm['name'] .'" value="' .$elm['ID'] .'" /> ' .$elm['label'] .'<br />';
												echo '</td> </tr>';
										}
												?>       
                           		</table>
						  	</td>
                          	<td width="220">
                            	<TABLE ID="Table1b" WIDTH="220">


									<?php
										$inum = count($distlist);
										if($inum>count($printcat)){
											$colscnt = ceil($inum/ceil($inum/count($printcat)));
										} else {
											$colscnt = $inum;
										}
										$curcnt = 0;
										$colcnt = 0;
										foreach($distlist as $elm){
												if ($curcnt == $colscnt){
													echo '</table> </td><td width="220"><TABLE ID="Table"' .$colcnt .'"b" WIDTH="220">';
													$colcnt++;
													$curcnt = 0;
												}
												echo '<tr align="left"><td width=25%>&nbsp;</td><td width=75%> <input type="checkbox" name="'.$elm['name'] .'" value="' .$elm['ID'] .'" /> ' .$elm['label'] .'<br />';
												echo '</td> </tr>';
												$curcnt++;
										}
										if ($curcnt >1){
											echo '</table> </td>';
										}
												?> 
                                                 
                            <td width="220">
                            	<TABLE ID="Table1c" WIDTH="220">                             
									<?php
									$inum = 1;
									foreach($regionlist as $elm){
											echo '<tr align="left"><td width=25%>&nbsp;</td><td width=75%> <input type="checkbox" name="'.$elm['name'] .'" value="' .$elm['ID'] .'" /> ' .$elm['label'] .'<br />';
											echo '</td> </tr>';
									}
											?>       
								</TABLE>	
                          	</td>

                         </tr>						
                         <tr>
                           	<td align="left" colspan=5>
                            	From:&nbsp;<input name="from" type="text" value="<?php echo $fromaddress;?>" size="40" />
                            </td>
                         </tr>
                         <tr>
                           	<td align="left" colspan=5>
                            	Subject:&nbsp;<input name="subject" type="text" size="40" />
                            </td>
                         </tr>
                         <tr>
                           	<td align="left" colspan=5>
                            	<input name="priority" type="checkbox" value="urgent" />&nbsp; Urgent:
                            </td>
                         </tr>
						 
                         <tr>
                           	<td colspan=5>
                            	<textarea name="mailbody" cols="200" rows="30"></textarea>
                            </td>
                         </tr>
						 <tr>
						 	<td colspan=5 align="center">
                					Attach File: <input id="myfile" name="myfile" type="file">
        					</td>
						 </tr>
						 <tr>
                           <td colspan=5 align="center">
                           	<input name="submit" type="submit" value="Send Mail" />
                           </td>
                         </tr>
                       
                       </table>
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
