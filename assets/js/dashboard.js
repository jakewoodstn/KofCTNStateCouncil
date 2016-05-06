/*utils*/
function formatPhones(){
$(".phoneNumber").each(function(){
	$(this).val($(this).val().replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3"));
	if($(this).val()=='-'){$(this).val('');}
});

}
/*utils end*/

/* Send Email Panel Starts*/

function dash_sendEmail(){ 	

	$("#sendmail_error").text("");
	$("#sendmail_success").text("");
	subject=$('input[email-subject]').val();
	message=$('#email-message').summernote('code');
	district=[];

	$("[name='district']:checked").each(function(){
		if ($(this).val()>0){district.push($(this).val());}
	});
	
	if (district.length==0){
		$("[name='district'][value!=0]").each(function(){district.push($(this).val());});
	}
	
	region=[];
	$("[name='region']:checked").each(function(){
		if ($(this).val()>0){region.push($(this).val());}
	});
	
	if (region.length==0){
		$("[name='region'][value!=0]").each(function(){region.push($(this).val());});
	}
	
	targetRole=[];
	$("[name='targetRole']:checked").each(function(){
		if($(this).val()>0){targetRole.push($(this).val())};
	});
	
	if (targetRole.length==0){
		$("[name='targetRole'][value!=0]").each(function(){targetRole.push($(this).val());});
	}
	
	/*
	console.log(district)
	console.log(region);
	console.log(targetRole);
	console.log(targetRole.length==0);
	*/
		
	function callback(command,data){$('input[email-subject]').val('');$('email-message').html('<p>Message</p>');$("#sendmail_error").text("");$("#sendmail_success").text(data);}
	function callbackError(command,xhr,options,err){$("#sendmail_error").text(err);}
	
	
	$("#sendmail_error").text("Queueing Messages");
	postToModx('sendmail',{"district":district,"region":region,"role":targetRole,"subject":subject,"message":message},141,callback,callbackError);	
	
}

function dash_filterDegreeList(){

	district=$('#district').val();
	degrees=$('#list_degreeLevel').val();
	
	//console.log(district);
	//console.log(district.indexOf('0'));
	
	if (district.indexOf('0')>=0){district=[];}
	if (degrees.indexOf('0')>=0){degrees=[];}
	
	savedResult = 	$("#degreeList_list tbody").html();
	$("#degreeList_list tbody").html('');

	function callback(command,data){$("#degreeList_list tbody").append(data);}
	function callbackError(command,xhr,options,err){$("#degreeList_list tbody").innerHTML(savedResult);}
	
	postToModx('degreelist',{"degrees":degrees,"district":district},141,callback,callbackError);	


}

function dash_allSelected(trigger){

	if ($(trigger).children('input').val()==0 ){
		if(!$(trigger).hasClass('active')){ //all option is selected
			$('input[type="checkbox"][value!="0"][name="'+$(trigger).children('input').attr('name')+'"]').removeAttr('checked').parent('.active').removeClass('active');
		} 
	} else {
		if(!$(trigger).hasClass('active')){ //other option is selected
		$('input[type="checkbox"][value="0"][name="'+$(trigger).children('input').attr('name')+'"]').removeAttr('checked').parent('.active').removeClass('active');
		}
	} 
}
/* Send Email Panel Ends*/ 

/* Add Meeting Panel Starts*/ 
function dash_addMeeting_test(){ 	

	hcouncil=$('#hostCouncil option:selected');
	console.log(hcouncil.attr('value'));

	targetRole='';
	$("[name='rsvpTargetRole']:checked").each(function(){targetRole+=',' +$(this).val();});
	targetRole=targetRole.substr(0, 1)==','?targetRole.substr(1, Infinity):targetRole;

	console.log(targetRole);
}

/* Add Meeting Panel Ends*/ 

