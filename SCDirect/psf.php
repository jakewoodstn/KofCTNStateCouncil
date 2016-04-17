<?php
   ## $userid is set in the calling program

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
           ." recid, "
           ." cuserid, "
           ." cposition, "
           ." cfratyear, "
           ." dirgroup, "
           ." secorder "
           ."FROM fratpos "
		   ."Where cuserid = '" .$userid ."'";
          $default_order_field = "cuserid";
          //$dg_caption = '<b>Edit/Update Councils</b>';
          $table_name = "fratpos";
          $primary_key = "recid";
          $default_page_size = 20;

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
            $layouts = array("view"=>"0", "edit"=>"0", "details"=>"1", "filter"=>"1"); 
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
    		"edit"	  =>array("view"=>false, "edit"=>true,  "type"=>"link", "byFieldValue"=>""),
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
			"cuserid"=>array("header"=>"userid", "visible"=>"false"),
			"cposition"=>array("header"=>"Position",  	"type"=>"label", "align"=>"left",  "wrap"=>"nowrap",   "text_length"=>"40", "case"=>"normal"),
			"cfratyear" =>array("header"=>"Frat Year",  		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"15", "case"=>"normal"),
			"dirgroup"     =>array("header"=>"Directory Group", "type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"15", "case"=>"normal"),
			"secorder" =>array("header"=>"Section Order",		"type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"15", "case"=>"normal")
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
    	     "cposition"  =>array("header"=>"Position", "type"=>"textbox",    "req_type"=>"rt", "width"=>"210px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
    		"cfratyear"  =>array("header"=>"Fraternal year", "type"=>"textbox",   "req_type"=>"rn", "width"=>"110px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
    		"dirgroup"  =>array("header"=>"Directory Group", "type"=>"textbox",   "req_type"=>"sn", "width"=>"110px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>""),
    		"secorder"  =>array("header"=>"Section Position", "type"=>"textbox",   "req_type"=>"sn", "width"=>"110px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"")
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

?>
