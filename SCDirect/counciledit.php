<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Council Data Form</title>
<link href="niceforms-default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="scddef.css" />     

</head>
<body onload="init()">




      <div id="container">
		   <div id="masthead">
       	</div>
	  </div>
<?php
require_once('data.php');
include('config.php');
#$currrow = $_SERVER['QUERY_STRING'];
$currrow = $_GET['record'];
$fldlist = array('council','suspended','district','aid','cercons','ca','name','address1','address2','city','state','zip','meeting1','mtime1','meeting2','mtime2','officers','offtime');
$err = "";
$errmsg = "";
$enupd = false;
$defstate = "TN";
#Check Cookie and see if the user actually Logged in or is trying to navigate here directly
# If they didn't go through the login page, then Kick them back there
// also make sure they have admin rights
if (($_COOKIE['validlogin']=='true' && $_COOKIE['logID']>9) || $_COOKIE['adminlogin']=='true'){
	include('configdb.php');
	include('opendb.php');
	//  We are loged in, lets see if we are submitting an update	   
        define ("DATAGRID_DIR", "datagrid/");                     /* Ex.: "datagrid/" */ 
        define ("PEAR_DIR", "datagrid/pear/");                    /* Ex.: "datagrid/pear/" */
      
        require_once(DATAGRID_DIR.'datagrid.class.php');
        require_once(PEAR_DIR.'PEAR.php');
        require_once(PEAR_DIR.'DB.php');
       include 'configdb.php';
		
     ##  *** creating variables that we need for database connection 
        $DB_USER= $dbuser;            
        $DB_PASS=$dbpass;           
        $DB_HOST=$dbhost;       
        $DB_NAME=$dbname;    		
	
      # Define Form Specific Variables
      $sql=" SELECT "
           ." council.recid, "
           ." council.ccouncil, "
		   ." council.tdistrict, "
		   ." council.iaid, "
		   ." council.bcouncil, "
		   ." council.bsuspended, "
           ." council.cname, "
		   ." council.caddress1, "
		   ." council.caddress2, "
           ." council.ccity, "
           ." council.cstate, "
		   ." council.czip, "
		   ." council.meeting1, "
		   ." council.mtime1, "
		   ." council.meeting2, "
		   ." council.mtime2, "
		   ." council.officers, "
           ." council.offtime, "
		   ." insagents.cagentname "
           ."FROM council Left Join insagents "
		   ."on council.iaid= insagents.iaid ";
//		   ."Where cuserid = '" .$userid ."'";
          $default_order_field = "ccouncil";
          //$dg_caption = '<b>Edit/Update Councils</b>';
          $table_name = "council";
          $primary_key = "recid";
          $default_page_size = 25;

      ob_start();
        $db_conn = DB::factory('mysql');  /* don't forget to change on appropriate db type */
        $result_conn = $db_conn->connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
        if(DB::isError($result_conn)){ die($result_conn->getDebugInfo()); }
      
      ##  *** set needed options
        $debug_mode = false;
        $messaging = true;
        $unique_prefix = "f_";  
        $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
  
      ##  *** set data source with needed options
        $default_order_type = "ASC";
        $dgrid->DataSource($db_conn, $sql, $default_order_field, $default_order_type);	    
        $dgrid->SetCaption($dg_caption);
            $layouts = array("view"=>"0", "edit"=>"1", "details"=>"1", "filter"=>"1"); 
          $dgrid->SetLayouts($layouts);
    	/// *** $mode_template = array("header"=>"", "body"=>"", "footer"=>"");
    	/// $details_template = array("header"=>"", "body"=>"", "footer"=>"");
    	/// $details_template['body'] = "<table><tr><td>{field_name_1}</td><td>{field_name_2}</td></tr></table>";
    	/// $details_template['footer'] = "<table><tr><td>[ADD][CREATE][EDIT][DELETE][BACK]</td></tr></table>";
    	/// $dgrid->SetTemplates("","",$details_template);
    	##  *** set modes for operations ("type" => "link|button|image")
    	##  *** "view" - view mode | "edit" - add/edit/details modes
    	##  *** "byFieldValue"=>"fieldName" - make the field to be a link to edit mode page
    	$modes = array(
    		"add"	  =>array("view"=>false, "edit"=>false, "type"=>"link", "show_add_button"=>"inside|outside"),
    		"edit"	  =>array("view"=>true, "edit"=>true,  "type"=>"link", "byFieldValue"=>""),
         "cancel"  =>array("view"=>true, "edit"=>true,  "type"=>"link"),
         "details" =>array("view"=>false, "edit"=>false, "type"=>"link"),
         "delete"  =>array("view"=>true, "edit"=>false,  "type"=>"image")
    	);
    	$dgrid->SetModes($modes);
 


    
      ## +---------------------------------------------------------------------------+
      ## | 6. View Mode Settings:                                                    | 
      ## +---------------------------------------------------------------------------+
      ##  *** set columns in view mode

	    $vm_table_properties = array("width"=>"720");

     	$dgrid->SetViewModeTableProperties($vm_table_properties);  

    	##  *** set columns in view mode
    	##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
	    ##  ***      "barchart" : number format in SELECT SQL must be equal with number format in max_value
	    /// $fill_from_array = array("0"=>"Banned", "1"=>"Active", "2"=>"Closed", "3"=>"Removed"); /* as "value"=>"option" */
   	  	$vm_colimns = array(
			"recid"=>array("header"=>"recid", "visible"=>"false"),
			"ccouncil"=>array("header"=>"Council",  	"type"=>"label", "align"=>"left",  "wrap"=>"nowrap",   "text_length"=>"40", "case"=>"normal"),
			"tdistrict"=>array("header"=>"District",  	"type"=>"label", "align"=>"left",  "wrap"=>"nowrap",   "text_length"=>"40", "case"=>"normal"),
			"cagentname" =>array("header"=>"Field Agent",  		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"15", "case"=>"normal"),
			"bcouncil"=>array("header"=>"Council", "type"=>"checkbox",  "align"=>"center", "width"=>"", "wrap"=>"nowrap", "sort_type"=>"numeric", "sort_by"=>"", "visible"=>"true", "on_js_event"=>"", "true_value"=>1, "false_value"=>0),
			"bsuspended"     =>array("header"=>"Suspended", "type"=>"checkbox",  "align"=>"center", "width"=>"", "wrap"=>"nowrap", "sort_type"=>"numeric", "sort_by"=>"", "visible"=>"true", "on_js_event"=>"", "true_value"=>1, "false_value"=>0),
			"cname" =>array("header"=>"Council Name",  		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"caddress2" =>array("header"=>"address2",  		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"ccity" =>array("header"=>"City",  		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"15", "case"=>"normal")
		 );

     	$dgrid->SetColumnsInViewMode($vm_colimns);

      ##  *** set paging settings
      	$bottom_paging = array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
      	$top_paging = array();
      	$pages_array = array("5"=>"5", "10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
      	$paging_arrows = array("first"=>"|&lt;&lt;", "previous"=>"&lt;&lt;", "next"=>"&gt;&gt;", "last"=>"&gt;&gt;|");
      	$dgrid->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size, $paging_arrows);
      ## +---------------------------------------------------------------------------+
      ## | 7. Add/Edit/Details Mode settings:                                        | 
      ## +---------------------------------------------------------------------------+
      ##  ***  set settings for edit/details mode
        $condition = "";
        $dgrid->SetTableEdit($table_name, $primary_key, $condition);

	 	##  ***  set settings for add/edit/details modes
    	//  $table_name  = "table_name";
    	//  $primary_key = "primary_key";
    	##  for ex.: "table_name.field = ".$_REQUEST['abc_rid'];
    	//  $condition   = "";
    	$dgrid->SetTableEdit($table_name, $primary_key, $condition);
		//fill the Field Agent Dropdown array
		$fill_from_array = array();
		$sql = "SELECT iaid, cagentname FROM insagents ORDER BY iaid ASC";
		$dSet = $dgrid->executeSql($sql);
		while($row = $dSet->fetchRow()){
   			$fill_from_array[$row[0]] = $row[1];
		}
		
    	##  *** set columns in edit mode   
    	##  *** first letter:  r - required, s - simple (not required)
    	##  *** second letter: t - text(including datetime), n - numeric, a - alphanumeric,
    	##                     e - email, f - float, y - any, l - login name, z - zipcode,
    	##                     p - password, i - integer, v - verified, c - checkbox, u - URL
    	##  *** third letter (optional): 
    	##          for numbers: s - signed, u - unsigned, p - positive, n - negative
    	##          for strings: u - upper,  l - lower,    n - normal,   y - any
    	##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
    	##  *** Ex.: type = textbox|textarea|label|date(yyyy-mm-dd)|datedmy(dd-mm-yyyy)|datetime(yyyy-mm-dd hh:mm:ss)|datetimedmy(dd-mm-yyyy hh:mm:ss)|time(hh:mm:ss)|image|password|enum|print|checkbox
    	##  *** make sure your WYSIWYG dir has 755 access permissions
    	##  *** make sure uploading directories for files/images have 755 access permissions
    	/// $fill_from_array = array("0"=>"No", "1"=>"Yes", "2"=>"Don't know", "3"=>"My be"); /* as "value"=>"option" */
    	$em_columns = array(
			"recid"=>array("header"=>"recid", "visible"=>"false"),
			"ccouncil"=>array("header"=>"Council", "type"=>"textbox", "align"=>"left",  "wrap"=>"nowrap",   "text_length"=>"40", "case"=>"normal"),
			"tdistrict"=>array("header"=>"District",  	"type"=>"textbox", "align"=>"left",  "wrap"=>"nowrap",   "text_length"=>"40", "case"=>"normal"),
			"bcouncil"     =>array("header"=>"Council", "type"=>"checkbox",  "align"=>"center", "width"=>"", "wrap"=>"nowrap", "sort_type"=>"numeric", "sort_by"=>"", "visible"=>"true", "on_js_event"=>"", "true_value"=>1, "false_value"=>0),
			"bsuspended"     =>array("header"=>"Suspended","type"=>"checkbox",  "align"=>"center", "width"=>"", "wrap"=>"nowrap", "sort_type"=>"numeric", "sort_by"=>"", "visible"=>"true", "on_js_event"=>"", "true_value"=>1, "false_value"=>0),
			"iaid"=>array("header"=>"Field Agent", "type"=>"enum", "req_type"=>"sy", "width"=>"210px", "title"=>"Field Agent", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "on_js_event"=>"", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "multiple"=>false),
			"cname" =>array("header"=>"Council Name",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"caddress1" =>array("header"=>"Address 1",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"caddress2" =>array("header"=>"Address 2",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"ccity" =>array("header"=>"City",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"cstate" =>array("header"=>"State",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"5", "case"=>"normal"),
			"czip" =>array("header"=>"Zip",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"10", "case"=>"normal"),
			"meeting1" =>array("header"=>"Meeting 1",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"mtime1" =>array("header"=>"Meeting Time 1",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"meeting2" =>array("header"=>"Meeting 2",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"mtime2" =>array("header"=>"Meeting Time 2",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"officers" =>array("header"=>"Officers Meeting",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal"),
			"offtime" =>array("header"=>"Officers Meeting Time",  		"type"=>"textbox", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"20", "case"=>"normal")
    	);
    	$dgrid->SetColumnsInEditMode($em_columns);
      $auto_column_in_edit_mode = false;
	  
//"Caption_3"=>array("type"=>"dropdownlist", "table"=>"tableName_2", "field"=>"fieldName_2", "field_view"=>"", "filter_condition"=>"", "order"=>"ASC|DESC", "source"=>"self"|$fill_from_array, "condition"=>"", "show_operator"=>"false", "default_operator"=>"=", "case_sensitive"=>"false", "comparison_type"=>"string|numeric|binary", "width"=>"", "multiple"=>"false", "multiple_size"=>"4", "on_js_event"=>""),	  
	  
	  
    //  $dgrid->SetAutoColumnsInEditMode($auto_column_in_edit_mode);
    ##  *** set foreign keys for add/edit/details modes (if there are linked tables)
    ##  *** Ex.: "field_name"=>"CONCAT(field1,','field2) as field3" 
    ##  *** Ex.: "condition"=>"TableName_1.FieldName > 'a' AND TableName_1.FieldName < 'c'"
    ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
    /// $foreign_keys = array(
    ///     "ForeignKey_1"=>array("table"=>"TableName_1", "field_key"=>"FieldKey_1", "field_name"=>"FieldName_1", "view_type"=>"dropdownlist(default)|radiobutton|textbox|label", "radiobuttons_alignment"=>"horizontal|vertical", "condition"=>"", "order_by_field"=>"", "order_type"=>"ASC|DESC", "on_js_event"=>""),
    ///     "ForeignKey_2"=>array("table"=>"TableName_2", "field_key"=>"FieldKey_2", "field_name"=>"FieldName_2", "view_type"=>"dropdownlist(default)|radiobutton|textbox|label", "radiobuttons_alignment"=>"horizontal|vertical", "condition"=>"", "order_by_field"=>"", "order_type"=>"ASC|DESC", "on_js_event"=>"")
    /// ); 
    /// $dgrid->SetForeignKeysEdit($foreign_keys);
    	################################################################################   
      	## +---------------------------------------------------------------------------+
	    ## | 8. Bind the DataGrid:                                                     | 
      	## +---------------------------------------------------------------------------+
		##  *** set debug mode & messaging options

          $dgrid->Bind();        

          ob_end_flush();

      ################################################################################


	include 'closedb.php';
	

} else {
		$loc = $_SERVER['HTTP_HOST'];
		$locat = "http://$loc$installpath/scdmenu.php";
		echo "<script>location.href='$locat'</script>";
		die;
	
	
	
}

?>


</body>

