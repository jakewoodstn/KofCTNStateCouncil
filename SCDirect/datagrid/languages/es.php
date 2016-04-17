<?php 

//------------------------------------------------------------------------------ 

//*** Espanol (es)

//------------------------------------------------------------------------------ 

function setLanguage(){ 

    $lang['='] = "=";  // "equal"; 

    $lang['>'] = ">";  // "bigger"; 

    $lang['<'] = "<";  // "smaller"; 

    $lang['add'] = "A&ntilde;adir"; 

    $lang['add_new'] = "+ A&ntilde;adir Nuevo"; 

    $lang['add_new_record'] = "A&ntilde;adir nuevo registro";

    $lang['add_new_record_blocked'] = "Security check: attempt of adding a new record! Check your settings, the operation is not allowed!";    

    $lang['adding_operation_completed'] = "A&ntilde;adido correctamente!"; 

    $lang['adding_operation_uncompleted'] = "Error al a&ntildeadir registro!";

    $lang['and'] = "y"; 

    $lang['any'] = "cualquiera"; 

    $lang['ascending'] = "Ascendente"; 

    $lang['back'] = "Volver"; 

    $lang['cancel'] = "Cancelar"; 

    $lang['cancel_creating_new_record'] = "Est&aacute; Ud. seguro de querer cancelar la creaci&oacute;n del nuevo registro ?"; 

    $lang['check_all'] = "Seleccionar todo";

    $lang['clear'] = "Clear";    

    $lang['create'] = "Crear"; 

    $lang['create_new_record'] = "Crear nuevo registro"; 

    $lang['current'] = "actual"; 

    $lang['delete'] = "Eliminar"; 

    $lang['delete_record'] = "Eliminar registro";

    $lang['delete_record_blocked'] = "Security check: attempt of deleting a record! Check your settings, the operation is not allowed!";    

    $lang['delete_selected'] = "Eliminar seleccionados"; 

    $lang['delete_selected_records'] = "Est&aacute; Ud. seguro de eliminar los registros seleccionados?"; 

    $lang['delete_this_record'] = "Est&aacute; Ud. seguro de querer eliminar este registro ?"; 

    $lang['deleting_operation_completed'] = "Operaci&oacute;n de borrado concluida satisfactoriamente!"; 

    $lang['deleting_operation_uncompleted'] = "Operaci&oacute;n de borrado incorrecta!"; 

    $lang['descending'] = "Descendente"; 

    $lang['details'] = "Detalles"; 

    $lang['details_selected'] = "Ver Seleccionados";

    $lang['edit'] = "Editar"; 

    $lang['edit_selected'] = "Editar Seleccionados";

    $lang['edit_record'] = "Editar registro"; 

    $lang['edit_selected_records'] = "Esta seguro que desea editar los registros seleccionados?";   

    $lang['errors'] = "Errores"; 

    $lang['export_to_excel'] = "Exportar a Excel"; 

    $lang['export_to_pdf'] = "Exportar a PDF";

    $lang['export_to_xml'] = "Exportar a XML";     

    $lang['export_message'] = "<label class=\"default_dg_label\">El archivo _FILE_ est&aacute; listo. Despu&eacute;s de que usted termine la descarga</label> <a class=\"default_dg_error_message\" href=\"javascript: window.close();\">Cierre la ventana</a>."; 

    $lang['field'] = "Campo"; 

    $lang['field_value'] = "Valor del campo"; 

    $lang['file_find_error'] = "No se puede encontrar el archivo: <b>_FILE_</b>. <br>Verifique que el archivo existe y ud. esta usando el camino correcto!";

    $lang['file_opening_error'] = "No se puede abrir el archivo. Comprueba tus permisos!";

    $lang['file_writing_error'] = "No se puede guardar el archivo. Comprueba tus permisos!"; 

    $lang['file_invalid file_size'] = "Tama�o de archivo incorrecto"; 

    $lang['file_uploading_error'] = "Hubo un error mientras actualizaba, por favor int&eacute;ntenlo de nuevo!"; 

    $lang['file_deleting_error'] = "Hubo un error mientras se borraba!";

    $lang['first'] = "primero";

    $lang['generate'] = "Generate";

    $lang['handle_selected_records'] = "Esta seguro que quiere manipular los registros seleccionados?";

    $lang['hide_search'] = "Ocultar Buscar"; 

    $lang['last'] = "&uacute;ltimo"; 

    $lang['like'] = "like"; 

    $lang['like%'] = "like%";  // "begins with"; 

    $lang['%like'] = "%like";  // "ends with";

    $lang['%like%'] = "%like%";  

    $lang['loading_data'] = "Cargando informacion...";

    $lang['max'] = "max";        

    $lang['next'] = "siguiente"; 

    $lang['no'] = "No"; 

    $lang['no_data_found'] = "No se han encontrado datos"; 

    $lang['no_data_found_error'] = "No se han encontrado datos! Por favor, comprueba atentamente la sintaxis de tu c&oacute;digo!<br>Puede ser debido al uso incorrecto de May&uacute;sculas/min&uacute;sculas o a s&iacute;mbolos inesperados."; 

    $lang['no_image'] = "No hay Imagen";

    $lang['not_like'] = "not like"; 

    $lang['of'] = "of";

    $lang['or'] = "or";        

    $lang['operation_was_already_done'] = "The operation was already completed! You cannot retry it again.";            

    $lang['or'] = "o"; 

    $lang['pages'] = "P&aacute;ginas"; 

    $lang['page_size'] = "Registros por p&aacute;gina"; 

    $lang['previous'] = "Anterior"; 

    $lang['printable_view'] = "Vista imprimible"; 

    $lang['print_now'] = "Imprimir";    

    $lang['print_now_title'] = "Pulse aqu&iacute; para imprimir esta p&aacute;gina"; 

    $lang['record_n'] = "Registro #";

    $lang['refresh_page'] = "Refresh Page";

    $lang['remove'] = "Borrar";

    $lang['reset'] = "Reset";

    $lang['results'] = "Resultados"; 

    $lang['required_fields_msg'] = "Registros marcados con un <font color='#cd0000'>*</font> son requeridos";    

    $lang['search'] = "Buscar"; 

    $lang['search_d'] = "Buscar"; // (description) 

    $lang['search_type'] = "Tipo de b&uacute;squeda"; 

    $lang['select'] = "seleccionar"; 

    $lang['set_date'] = "Setee la fecha";

    $lang['sort'] = "Sort";    

    $lang['test'] = "Test";

    $lang['total'] = "Total";

    $lang['turn_on_debug_mode'] = "Para mas informacion habilite el modo debug.";

    $lang['uncheck_all'] = "Desmarcar todos";

    $lang['unhide_search'] = "Mostrar Busqueda";

    $lang['unique_field_error'] = "El campo _FIELD_ permite solamente valores enteros - por favor reingrese!";

    $lang['update'] = "Actualizar"; 

    $lang['update_record'] = "Actualizar registro";

    $lang['update_record_blocked'] = "Security check: attempt of updating a record! Check your settings, the operation is not allowed!";    

    $lang['updating_operation_completed'] = "Operaci&oacute;n de actualizar completada correctamente!"; 

    $lang['updating_operation_uncompleted'] = "Operaci&oacute;n de actualizar incorrecta!";

    $lang['upload'] = "Actualizar";    

    $lang['view'] = "Vista"; 

    $lang['view_details'] = "Detalles de la vista"; 

    $lang['warnings'] = "Advertencias"; 

    $lang['with_selected'] = "Con los seleccionados";

    $lang['wrong_field_name'] = "nombre de campo incorrecto"; 

    $lang['wrong_parameter_error'] = "Parametro incorrecto <b>_FIELD_</b>: _VALUE_";

    $lang['yes'] = "S&iacute;";    



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