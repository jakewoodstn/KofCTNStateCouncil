<?php

include("config.php");

$loc = $_SERVER['HTTP_HOST'];


#Check Cookie and see if the user actually Logged in or is trying to navigate here directly

# If they didn't go through the login page, then Kick them back there

if ($_COOKIE['validlogin']=='true' || $_COOKIE["adminlogin"]=="true"){

    #Good the User has logged in. Lets See who they are

    $ipi = getenv("REMOTE_ADDR"); 

    $httprefi = getenv ("HTTP_REFERER");

    $httpagenti = getenv ("HTTP_USER_AGENT");

    $logseclevel = $_COOKIE['logID'];

    $scdform = $_COOKIE['scdform'];

    ?>



      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 

               "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

      <html>

        <head>

          <title>State Council Directory</title>


        </head>

      

      <body>

    

<?php

      # Define Form Specific Variables

      switch ($scdform){

        case 'edcouncil':

          $sql=" SELECT "

           ." council.recid, "

           ." council.ccouncil, "

           ." council.tdistrict, "

           ." council.cGKEmail, "

           ." council.iaid, "

           ." council.icercons, "

		   ." council.bcouncil "

           ."FROM council ";

          $default_order_field = "ccouncil";

          $dg_caption = '<b>Edit/Update Councils</b>';

          $table_name = "council";

          $primary_key = "recid";

          $default_page_size = 25;

          break;

        case 'edagents':

          $sql=" SELECT "  

           ." insagents.recid, "

           ." insagents.iaid, "

           ." insagents.cagentname, "

           ." insagents.cagentemail "

           ."FROM insagents ";

          $default_order_field = "iaid";

          $dg_caption = '<b>Edit/Update Field Agent Info</b>';

          $table_name = "insagents";

          $primary_key = "recid";

          $default_page_size = 15;

          break;

        case 'edusers':

          $sql=" SELECT "  

           ." members.recid, "

           ." members.cuserid, "

           ." members.cusername, "

           ." members.icouncil, "

           ." members.tseclevel "

           ."FROM members ";

          $default_order_field = "cuserid";

          $dg_caption = '<b>Edit/Update Users</b>';

          $table_name = "members";

          $primary_key = "recid";

          $default_page_size = 25;

          break;

        case 'ednotify':

          $sql=" SELECT "  

           ." notify.trecid, "

           ." notify.tdistrict, "

           ." notify.tneighbor "

           ."FROM notify ";

          $default_order_field = "tdistrict";

          $dg_caption = '<b>Edit/Update Notification Zones</b>';

          $table_name = "notify";

          $primary_key = "trecid";

          $default_page_size = 25;

          break;

        case 'eddegree':

            $sql=" SELECT "  

           ." degreeinfo.recid, "

           ." degreeinfo.cguid, "

           ." degreeinfo.cdegree, "

           ." degreeinfo.cdate, "

           ." degreeinfo.cstarttime, "

           ." degreeinfo.ccouncil, "

           ." degreeinfo.clocation, "

           ." degreeinfo.ccontact "

           ."FROM degreeinfo ";

          $default_order_field = "cdate";

          $dg_caption = '<b>Degree Maintenance</b>';

          $table_name = "degreeinfo";

          $primary_key = "recid";

          $default_page_size = 25;

          break;

     }

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

      

      ## +---------------------------------------------------------------------------+

      ## | 6. View Mode Settings:                                                    | 

      ## +---------------------------------------------------------------------------+

      ##  *** set columns in view mode

         $dgrid->SetAutoColumnsInViewMode(true);

      switch ($adminform){

        case 'edcouncil':

          $dgrid->columnsViewMode["recid"]["visible"]="false";

          $dgrid->columnsViewMode["recid"]["width"]="2px";

          $dgrid->columnsViewMode["ccouncil"]["header"]="Council";

          $dgrid->columnsViewMode["ccouncil"]["width"]="75px";

          $dgrid->columnsViewMode["tdistrict"]["header"]="District";

          $dgrid->columnsViewMode["tdistrict"]["width"]="75px";

          $dgrid->columnsViewMode["cGKEmail"]["header"]="GK Email Address";

          break;

        case 'edagents':

          $dgrid->columnsViewMode["recid"]["visible"]="false";

          $dgrid->columnsViewMode["recid"]["width"]="2px";

          $dgrid->columnsViewMode["iaid"]["header"]="Agent ID";

          $dgrid->columnsViewMode["iaid"]["width"]="100px";

          $dgrid->columnsViewMode["cagentname"]["header"]="Agent Name";

          $dgrid->columnsViewMode["cagentemail"]["header"]="Agent Email Address";

          break;

        case 'edusers':

          $dgrid->columnsViewMode["recid"]["visible"]="false";

          $dgrid->columnsViewMode["recid"]["width"]="2px";

          $dgrid->columnsViewMode["cuserid"]["header"]="Membership Number";

          $dgrid->columnsViewMode["cuserid"]["width"]="150px";

          $dgrid->columnsViewMode["cusername"]["header"]="User Name";

          $dgrid->columnsViewMode["cusername"]["width"]="210px";

          $dgrid->columnsViewMode["icouncil"]["header"]="Council Number";

          $dgrid->columnsViewMode["icouncil"]["width"]="100px";

          $dgrid->columnsViewMode["iseclevel"]["header"]="Security Level";

          $dgrid->columnsViewMode["iseclevel"]["width"]="100px";

          break;

        case 'ednotify':

          $dgrid->columnsViewMode["trecid"]["visible"]="false";

          $dgrid->columnsViewMode["trecid"]["width"]="2px";

          $dgrid->columnsViewMode["tdistrict"]["header"]="District Number";

          $dgrid->columnsViewMode["tdistrict"]["width"]="75px";

          $dgrid->columnsViewMode["tneighbor"]["header"]="Neighboring District";

          $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          break;

        case 'eddegree':

          $dgrid->columnsViewMode["recid"]["visible"]="false";

          $dgrid->columnsViewMode["recid"]["width"]="2px";

          $dgrid->columnsViewMode["cguid"]["header"]="ID";

#          $dgrid->columnsViewMode["cguid"]["width"]="75px";

          $dgrid->columnsViewMode["cdegree"]["header"]="Degree";

#          $dgrid->columnsViewMode["tdistrict"]["width"]="75px";

          $dgrid->columnsViewMode["cdate"]["header"]="Date";

#          $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          $dgrid->columnsViewMode["cstarttime"]["header"]="Time";

#          $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          $dgrid->columnsViewMode["ccouncil"]["header"]="Council";

#          $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          $dgrid->columnsViewMode["clocation"]["header"]="Location";

#          $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          $dgrid->columnsViewMode["ccontact"]["header"]="Contact";

 #         $dgrid->columnsViewMode["tneighbor"]["width"]="100px";

          $modes = array(

            "add"     =>array("view"=>false, "edit"=>false, "type"=>"link"),

           "edit"    =>array("view"=>true, "edit"=>true, "type"=>"link"),

            "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"link"),

            "details" =>array("view"=>true, "edit"=>false, "type"=>"link"),

            "delete"  =>array("view"=>true, "edit"=>true, "type"=>"image")

          );

          $dgrid->SetModes($modes);      

          break;

      }

      

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

        $dgrid->SetAutoColumnsInEditMode(true);

        

        if ($adminform=='edusers'){

          

#           print_r($dgrid->columnsEditMode["cpasshash"]);

#           $arapp = array("cryptography"=>"true", "cryptography_type"=> "md5");

#           $dgrid->columnsEditMode["cpasshash"]["header"]="Password";

#           $dgrid->columnsEditMode["cpasshash"]["type"]="password";

#           $dgrid->columnsEditMode["cpasshash"] = $dgrid->columnsEditMode["cpasshash"]+$arapp;

           $dgrid->columnsEditMode["cpasshash"]=array("header"=>"Password", "type"=>"password", "req_type"=>"rp", "width"=>"210px",

                                                      "title"=>"","readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true",

                                                      "on_js_event"=>"", "hide"=>"false", "generate"=>"false","cryptography"=>"true","cryptography_type"=>"md5");

        }

        

      ## +---------------------------------------------------------------------------+

      ## | 8. Bind the DataGrid:                                                     | 

      ## +---------------------------------------------------------------------------+

      ##  *** set debug mode & messaging options

          $dgrid->Bind();        

          ob_end_flush();

      ################################################################################

     echo "<button onclick=location.href='$locat1'>Return to Admin Menu </button>";

     echo "<button onclick=location.href='$locat2'>Return to Managment Menu </button>";



} else {

    $loc = $_SERVER['HTTP_HOST'];

    $locat = "http://$loc$installpath/login.php";

    echo "<script>location.href='$locat'</script>";

    die;

}

?>



</body>

</html>