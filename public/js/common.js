function submitLoginForm(event){

	event.preventDefault();

	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
	
	$.post( base_url + "api/login", $('#loginForm').serialize(), function( data ) {
	 
		if(data.match(/^https:\/\/.*\/$/))
			window.location.replace(data);
		else{

			$( "#result" ).html( data ).removeClass( 'hide' );
			$('#submit').html('Submit').prop('disabled', false);
		}
	});
}