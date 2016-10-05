/***** Ajax login script ******/

jQuery(document).ready(function( $ ){
	$('#devn-form-user .btn-login').click(function(){
		$('#devn-form p.status').show().text(ajax_user_object.loadingmessage);
		$.ajax({
			url: ajax_user_object.ajaxurl,
			data: $('#devn-form').serialize(),
			type: 'POST',
			dataType: 'json',
			success: function(response){
				$('#devn-form p.status').show().text(response.message);
				if (response.loggedin == true){
	                document.location.href = ajax_user_object.redirecturl;
	            }
			}
		});
	});
	
	$('#devn-form-user .btn-resetpwd').click(function(){
		$('#devn-form p.status').show().text(ajax_user_object.loadingmessage);
		$.ajax({
			url: ajax_user_object.ajaxurl,
			data: $('#devn-form').serialize(),
			type: 'POST',
			dataType: 'json',
			success: function(response){
				$('#devn-form p.status').show().text(response.message);
				if(response.status){
					$('input[name="email"]').val('');
				}
			}
		});
	});
	
	$('#devn-form-user .btn-register').click(function(){
		$('#devn-form p.status').show().text(ajax_user_object.loadingmessage);
		$.ajax({
			url: ajax_user_object.ajaxurl,
			data: $('#devn-form').serialize(),
			type: 'POST',
			dataType: 'json',
			success: function(response){
				$('#devn-form p.status').show().text(response.message);
				if (response.loggedin == true){
	                document.location.href = ajax_user_object.redirecturl;
	            }
			}
		});
	});
});