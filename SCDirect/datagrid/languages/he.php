<?php

//------------------------------------------------------------------------------             

//*** English (he)

//------------------------------------------------------------------------------

function setLanguage(){ 

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

    $lang['export_message'] = "<label class=\"default_dg_label\">The file _FILE_ is ready. After you finish downloading,</label> <a class=\"default_dg_error_message\" href=\"javascript: window.close();\">close this window</a>.";

    $lang['field'] = "Field"; 

    $lang['field_value'] = "Field Value";

    $lang['file_find_error'] = "Cannot find file: <b>_FILE_</b>. <br>Check if this file exists and you use a correct path!";                                    

    $lang['file_opening_error'] = "Cannot open a file. Check your permissions.";                        

    $lang['file_writing_error'] = "Cannot write to file. Check writing permissions!";

    $lang['file_invalid file_size'] = "Invalid file size";

    $lang['file_uploading_error'] = "There was an error while uploading, please try again!";

    $lang['file_deleting_error'] = "There was an error while deleting!";

    $lang['first'] = "first";

    $lang['generate'] = "Generate";

    $lang['handle_selected_records'] = "Are you sure you want to handle the selected records?";

    $lang['hide_search'] = "Hide Search";

    $lang['last'] = "last";

    $lang['like'] = "like";

    $lang['like%'] = "like%";  // "begins with"; 

    $lang['%like'] = "%like";  // "ends with";

    $lang['%like%'] = "%like%";  

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

    $lang['record_n'] = "Record #";

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

?>