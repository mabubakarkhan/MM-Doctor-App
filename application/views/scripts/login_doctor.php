<script>
$(document).on('submit', '.login-doctor-form', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-login-form-btn"));
	ajaxFormSubmit(form, function(resp) {	
		if(resp){
			form.find(".doctor-login-form-btn").html('redirecting...');
			window.location.replace("<?=BASEURL?>doctor/dashboard");
		}
		else{
			form.find(".doctor-login-form-btn").html('Login');
		}
	}, function(error) {
		console.error(error);
	});//ajax function call back
});//login-doctor-form-submit
</script>