$(document).ready(function() {

	// Start of Login
	$(document).on('click', '#login', function(){
		var inputEmail 		= 	$('#inputEmail').val();
		var inputPassword   = 	$('#inputPassword').val();
		var allowLogin 		=	1;
		var login_data = { 'uname' : inputEmail, 'password' : inputPassword };

		if(inputEmail.length < 4 || inputPassword < 4){
			allowLogin = 0;
		}

		if(allowLogin){
			$.ajax({
			type: 'POST',
			url: 'api/v1/users/login',
			data: login_data,
			dataType: 'html',
		    timeout: 10000,
		    async: false,
				success: function (data) {
					var xhr_data = jQuery.parseJSON(data);
						if(xhr_data.status=='error'){
							$('.response-msg').html(xhr_data.message).css({'color':'red'});
						}
						else{
							$('.response-msg').html(xhr_data.message).css({'color':'green'});
							localStorage.removeItem('auth_token');
							localStorage.removeItem('full_name');
							localStorage.removeItem('uname');
							localStorage.setItem('auth_token', xhr_data.data.auth_token);
							localStorage.setItem('full_name', xhr_data.data.full_name);
							localStorage.setItem('uname', xhr_data.data.uname+'@xyz.com');
							window.location='inbox';
						}
					},
			    error: function(jqXHR, textStatus, errorThrown) {
			        if(textStatus==="timeout") {
			        	$('.response-msg').html('Sorry! Network timeout').css({'color':'red'});
			        } else {

			        }
			   	}
			});
		}
		else{
			$('.response-msg').html('Please check the input!!').css({'color':'red'});
		}
	});
	// End of Login
});