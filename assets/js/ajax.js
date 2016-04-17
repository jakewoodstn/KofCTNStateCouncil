
function postToModx(command,params,handlerId,callback,callbackError){
	//console.log($.extend(params,{"command":command}));

	$.ajax({
		type:'POST',
		url:'index.php?id='+handlerId,
		data:$.extend(params,{"command":command}),
		dataType: 'html',
		success: function(data){callback(command,data);},
		error: function(xhr,options,err){callbackError(command,xhr,options,err);}
	});
}

function postForValidator(button,handlerId){
	
	$.ajax({
	    type: 'POST',
		url: 'index.php?id='+handlerId,
	    data: $.extend(createMysqlParam($(button).attr('parameter-set')),{"procname":$(button).attr('mysql-proc')}),
	    dataType: 'html',
		success: function(data){callback(button, data);},
		//success: function(data){alert(data);},
		error: function(xhr,options,err){callbackError(button,xhr,options,err);}
	});

}

function bindPost(button,handlerId){

  $(button).click(
  	function(e){
        if(preclick){preclick(button)};
    	e.preventDefault();
    	console.log($.extend(createMysqlParam($(this).attr('parameter-set')),{"procname":$(this).attr('mysql-proc')}));

	    $.ajax({
    	    type: 'POST',
        	url: 'index.php?id='+handlerId,
	        data: $.extend(createMysqlParam($(this).attr('parameter-set')),{"procname":$(this).attr('mysql-proc')}),
    	    dataType: 'html',
        	success: function(data){callback(button, data,1);},
        	//success: function(data){alert(data);},
        	error: function(xhr,options,err){callbackError(button,xhr,options,err);}
    	});
  	});
}

function createMysqlParam(parameterSet){
   v=[];
   $('.mysql-parameter[parameter-set="'+parameterSet+'"]').each(
     function(){
          index=$(this).attr('mysql-sequence');
          key=$(this).attr('mysql-name');
          val=$(this).val();
          v[index]={};
          v[index][key]=val;
     });
   r={};
   for(i=0;i<v.length;i++){
      r=$.extend(r,v[i]);
   }
   return r;
}
