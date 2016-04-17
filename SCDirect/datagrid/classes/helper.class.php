<?php



################################################################################

##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #

## --------------------------------------------------------------------------- #

##  PHP DataGrid Helper Class 0.0.1 (24.06.2009)                               #

##  Developed by:  ApPhp <info@apphp.com>                                      # 

##  License:       GNU LGPL v.3                                                #

##  Site:          http://www.apphp.com/php-datagrid/                          #

##  Copyright:     PHP DataGrid (c) 2006-2009. All rights reserved.            #

##                                                                             #

##  This class contains auxiliary methods for DataGrid class                   #

##                                                                             #

################################################################################



Class Helper

{

    

    // PUBLIC METHODS:

    // ------------------------

    // GetRandomString

    // SetBrowserDefinitions

    // GetLangVacabulary

    

    //--------------------------------------------------------------------------

    // Default class constructor 

    //--------------------------------------------------------------------------

    function __construct()

    {

        

    }



    //--------------------------------------------------------------------------

    // Class destructor

    //--------------------------------------------------------------------------    

    function __destruct()

    {

		// echo 'this object has been destroyed';

    }



    //--------------------------------------------------------------------------

    // Get random string

    //--------------------------------------------------------------------------

    static function GetRandomString($length = 20) {

        $template_alpha = "abcdefghijklmnopqrstuvwxyz";

        $template_alphanumeric = "1234567890abcdefghijklmnopqrstuvwxyz";

        settype($template, "string");

        settype($length, "integer");

        settype($rndstring, "string");

        settype($a, "integer");

        settype($b, "integer");

        $b = rand(0, strlen($template_alpha) - 1);

        $rndstring .= $template_alpha[$b];        

        for ($a = 0; $a < $length-1; $a++) {

            $b = rand(0, strlen($template_alphanumeric) - 1);

            $rndstring .= $template_alphanumeric[$b];

        }       

        return $rndstring;       

    }



    //--------------------------------------------------------------------------

    // Set browser definitions

    //--------------------------------------------------------------------------

    static public function SetBrowserDefinitions()

    {

        $bd = array();

        

        $agent = $_SERVER['HTTP_USER_AGENT'];

        // initialize properties

        $bd['platform'] = "Windows";

        $bd['browser'] = "MSIE";

        $bd['version'] = "6.0";    

          

        // find operating system

        if (eregi("win", $agent))       $bd['platform'] = "Windows";

        elseif (eregi("mac", $agent))   $bd['platform'] = "MacIntosh";

        elseif (eregi("linux", $agent)) $bd['platform'] = "Linux";

        elseif (eregi("OS/2", $agent))  $bd['platform'] = "OS/2";

        elseif (eregi("BeOS", $agent))  $bd['platform'] = "BeOS";

        

        // test for Opera

        if (eregi("opera",$agent)){

            $val = stristr($agent, "opera");

            if (eregi("/", $val)){

                $val = explode("/",$val); $bd['browser'] = $val[0]; $val = explode(" ",$val[1]); $bd['version'] = $val[0];

            }else{

                $val = explode(" ",stristr($val,"opera")); $bd['browser'] = $val[0]; $bd['version'] = $val[1];

            }

        // test for MS Internet Explorer version 1

        }elseif(eregi("microsoft internet explorer", $agent)){

            $bd['browser'] = "MSIE"; $bd['version'] = "1.0"; $var = stristr($agent, "/");

            if (ereg("308|425|426|474|0b1", $var)) $bd['version'] = "1.5";

        // test for MS Internet Explorer

        }elseif(eregi("msie",$agent) && !eregi("opera",$agent)){

            $val = explode(" ",stristr($agent,"msie")); $bd['browser'] = $val[0]; $bd['version'] = $val[1];

        // test for MS Pocket Internet Explorer

        }elseif(eregi("mspie",$agent) || eregi('pocket', $agent)){

            $val = explode(" ",stristr($agent,"mspie")); $bd['browser'] = "MSPIE"; $bd['platform'] = "WindowsCE";

            if (eregi("mspie", $agent)){

                $bd['version'] = $val[1];

            }else{

                $val = explode("/",$agent);     $bd['version'] = $val[1];

            }

        // test for Firebird

        }elseif(eregi("firebird", $agent)){

            $bd['browser']="Firebird"; $val = stristr($agent, "Firebird"); $val = explode("/",$val); $bd['version'] = $val[1];

        // test for Firefox

        }elseif(eregi("Firefox", $agent)){

            $bd['browser']="Firefox"; $val = stristr($agent, "Firefox"); $val = explode("/",$val); $bd['version'] = $val[1];

        // test for Mozilla Alpha/Beta Versions

        }elseif(eregi("mozilla",$agent) && eregi("rv:[0-9].[0-9][a-b]",$agent) && !eregi("netscape",$agent)){

            $bd['browser'] = "Mozilla"; $val = explode(" ",stristr($agent,"rv:")); eregi("rv:[0-9].[0-9][a-b]",$agent,$val); $bd['version'] = str_replace("rv:","",$val[0]);

        // test for Mozilla Stable Versions

        }elseif(eregi("mozilla",$agent) && eregi("rv:[0-9]\.[0-9]",$agent) && !eregi("netscape",$agent)){

            $bd['browser'] = "Mozilla"; $val = explode(" ",stristr($agent,"rv:")); eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent,$val); $bd['version'] = str_replace("rv:","",$val[0]);

        // remaining two tests are for Netscape

        }elseif(eregi("netscape",$agent)){

            $val = explode(" ",stristr($agent,"netscape")); $val = explode("/",$val[0]); $bd['browser'] = $val[0]; $bd['version'] = $val[1];

        }elseif(eregi("mozilla",$agent) && !eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent)){

            $val = explode(" ",stristr($agent,"mozilla")); $val = explode("/",$val[0]); $bd['browser'] = "Netscape"; $bd['version'] = $val[1];

        }

        // clean up extraneous garbage that may be in the name

        $bd['browser'] = ereg_replace("[^a-z,A-Z]", "", $bd['browser']);

        $bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);

        

        return $bd;

    }



    //--------------------------------------------------------------------------

    // Get language vocabulary

    //--------------------------------------------------------------------------

    static public function GetLangVacabulary()

    {    

        $lang = array();

        

        $lang['='] = "=";  // "equal"; 

        $lang['>'] = ">";  // "bigger"; 

        $lang['<'] = "<";  // "smaller";            

        $lang['add'] = "Add";

        $lang['add_new'] = "+ Add New";

        $lang['add_new_record'] = "Add new record"; 

        $lang['add_new_record_blocked'] = "Security check: attempt of adding a new record! Check your settings, the operation is not allowed!";

        $lang['adding_operation_completed'] = "The adding operation completed successfully!";

        $lang['adding_operation_uncompleted'] = "The adding operation uncompleted!";

        $lang['and'] = "and";

        $lang['any'] = "any";                         

        $lang['ascending'] = "Ascending"; 

        $lang['back'] = "Back";

        $lang['cancel'] = "Cancel";

        $lang['cancel_creating_new_record'] = "Are you sure you want to cancel creating new record?";

        $lang['check_all'] = "Check All";

        $lang['clear'] = "Clear";                

        $lang['create'] = "Create";

        $lang['create_new_record'] = "Create new record";            

        $lang['current'] = "current";

        $lang['delete'] = "Delete";

        $lang['delete_record'] = "Delete record";

        $lang['delete_record_blocked'] = "Security check: attempt of deleting a record! Check your settings, the operation is not allowed!";

        $lang['delete_selected'] = "Delete selected";

        $lang['delete_selected_records'] = "Are you sure you want to delete the selected records?";

        $lang['delete_this_record'] = "Are you sure you want to delete this record?";                             

        $lang['deleting_operation_completed'] = "The deleting operation completed successfully!";

        $lang['deleting_operation_uncompleted'] = "The deleting operation uncompleted!";                                    

        $lang['descending'] = "Descending";

        $lang['details'] = "Details";

        $lang['details_selected'] = "View selected";                                    

        $lang['edit'] = "Edit";                

        $lang['edit_selected'] = "Edit selected";

        $lang['edit_record'] = "Edit record"; 

        $lang['edit_selected_records'] = "Are you sure you want to edit the selected records?";               

        $lang['errors'] = "Errors";            

        $lang['export_to_excel'] = "Export to Excel";

        $lang['export_to_pdf'] = "Export to PDF";

        $lang['export_to_xml'] = "Export to XML";

        $lang['field'] = "Field";

        $lang['field_value'] = "Field Value";

        $lang['file_find_error'] = "Cannot find file: <b>_FILE_</b>. <br>Check if this file exists and you use a correct path!";                                                

        $lang['file_opening_error'] = "Cannot open a file. Check your permissions.";            

        $lang['file_writing_error'] = "Cannot write to file. Check writing permissions.";

        $lang['file_invalid file_size'] = "Invalid file size: ";

        $lang['file_uploading_error'] = "There was an error while uploading, please try again!";

        $lang['file_deleting_error'] = "There was an error while deleting!";

        $lang['first'] = "first";

        $lang['generate'] = "generate";

        $lang['handle_selected_records'] = "Are you sure you want to handle the selected records?";

        $lang['hide_search'] = "Hide Search";            

        $lang['last'] = "last";

        $lang['like'] = "like";

        $lang['like%'] = "like%";  // "begins with"; 

        $lang['%like'] = "%like";  // "ends with";

        $lang['%like%'] = "%like%";  // "ends with";

        $lang['loading_data'] = "loading data...";            

        $lang['max'] = "max";                            

        $lang['next'] = "next";

        $lang['no'] = "No";

        $lang['no_data_found'] = "No data found";

        $lang['no_data_found_error'] = "No data found! Please, check carefully your code syntax!<br>It may be case sensitive or there are some unexpected symbols.";                                

        $lang['no_image'] = "No Image";

        $lang['not_like'] = "not like";

        $lang['of'] = "of";

        $lang['operation_was_already_done'] = "The operation was already completed! You cannot retry it again.";            

        $lang['or'] = "or";            

        $lang['pages'] = "Pages";                    

        $lang['page_size'] = "Page size";

        $lang['previous'] = "previous";

        $lang['printable_view'] = "Printable View";

        $lang['print_now'] = "Print Now";            

        $lang['print_now_title'] = "Click here to print this page";

        $lang['record_n'] = "Record # ";

        $lang['refresh_page'] = "Refresh Page";

        $lang['remove'] = "Remove";

        $lang['reset'] = "Reset";                        

        $lang['results'] = "Results";

        $lang['required_fields_msg'] = "<font color='#cd0000'>*</font> Items marked with an asterisk are required";            

        $lang['search'] = "Search";

        $lang['search_d'] = "Search"; // (description)

        $lang['search_type'] = "Search type";

        $lang['select'] = "select";

        $lang['set_date'] = "Set date";

        $lang['sort'] = "Sort";

        $lang['test'] = "Test";

        $lang['total'] = "Total";

        $lang['turn_on_debug_mode'] = "For more information, turn on debug mode.";

        $lang['uncheck_all'] = "Uncheck All";

        $lang['unhide_search'] = "Unhide Search";

        $lang['unique_field_error'] = "The field _FIELD_ allows only unique values - please reenter!";

        $lang['update'] = "Update";

        $lang['update_record'] = "Update record";

        $lang['update_record_blocked'] = "Security check: attempt of updating a record! Check your settings, the operation is not allowed!";

        $lang['updating_operation_completed'] = "The updating operation completed successfully!";

        $lang['updating_operation_uncompleted'] = "The updating operation uncompleted!";                                    

        $lang['upload'] = "Upload";            

        $lang['view'] = "View";

        $lang['view_details'] = "View details";

        $lang['warnings'] = "Warnings";

        $lang['with_selected'] = "With selected";

        $lang['wrong_field_name'] = "Wrong field name";

        $lang['wrong_parameter_error'] = "Wrong parameter in [<b>_FIELD_</b>]: _VALUE_";

        $lang['yes'] = "Yes";

        // date-time

        $lang['day']    = "day";

        $lang['month']  = "month";

        $lang['year']   = "year";

        $lang['hour']   = "hour";

        $lang['min']    = "min";

        $lang['sec']    = "sec";

        $lang['months'][1] = "January";

        $lang['months'][2] = "February";

        $lang['months'][3] = "March";

        $lang['months'][4] = "April";

        $lang['months'][5] = "May";

        $lang['months'][6] = "June";

        $lang['months'][7] = "July";

        $lang['months'][8] = "August";

        $lang['months'][9] = "September";

        $lang['months'][10] = "October";

        $lang['months'][11] = "November";

        $lang['months'][12] = "December";

        

        return $lang;

    }



    //--------------------------------------------------------------------------

    // Convert case for strings  lower/upper/camel

    //--------------------------------------------------------------------------

    static public function ConvertCase($str, $case="", $lang_name="en"){

        if($lang_name == "en"){

			if($case == "lower") return strtolower($str);

			else if($case == "upper") return strtoupper($str);

            else if($case == "camel") return mb_convert_case($str, MB_CASE_TITLE, mb_detect_encoding($str));

        }else{

			if($case == "lower" && function_exists("mb_strtolower")) return mb_strtolower($str, mb_detect_encoding($str));

			else if($case == "upper" && function_exists("mb_strtoupper")) return mb_strtoupper($str, mb_detect_encoding($str));

            else if($case == "camel" && mb_convert_case("mb_strtoupper")) return mb_convert_case($str, MB_CASE_TITLE, mb_detect_encoding($str));

			else return $str;

        }

    }





}// end class



?>     