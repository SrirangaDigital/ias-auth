function submitLoginForm(event){

	event.preventDefault();

	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
	
	$.post( base_url + "api/login", $('#loginForm').serialize(), function( data ) {
	 	
		if(data.match(/^http[s]*:\/\/.*\/$/)) {

			window.top.location.href = data;
		}
		else{

			$( "#result" ).html( data ).removeClass( 'hide' );
			$('#submit').html('Submit').prop('disabled', false);
		}
	});
}

function logout(returnUrl){

	event.preventDefault();

	$.post( base_url + "api/logout", function( data ) {
	 	
		window.top.location.href = returnUrl;
	});
}

function submitPasswordResetForm(event){

	event.preventDefault();

	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
	
	$.post( base_url + "api/initiateResetPassword", $('#passwordResetForm').serialize(), function( data ) {
	 
		if(data.match(/^http[s]*:\/\/.*$/))
			
			// Mail will be sent here
			$( "#result" ).html( 'An email has been sent to your address. Click the link there. ' + data ).removeClass('alert-danger').addClass('alert-success').removeClass( 'hide' );
			// window.location.replace(data);
		else{

			$( "#result" ).html( data ).removeClass( 'hide' );
		}
		$('#submit').html('Submit').prop('disabled', false);
	});
}

function submitgetResetPasswordForm(event){

	event.preventDefault();

	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
	
	$.post( base_url + "api/resetPassword", $('#getResetPasswordForm').serialize(), function( data ) {
	 
		$('#submit').html('Submit').prop('disabled', false);
		$( "#result" ).html( data ).removeClass( 'hide' );

		if(data === success_phrase) {

			$( "#result" ).html( 'Password successfully reset.' ).removeClass('alert-danger').addClass('alert-success');
			$("#getResetPasswordForm").hide();
		}
	});
}