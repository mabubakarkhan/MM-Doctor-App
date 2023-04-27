<script>
	$(document).on('submit', '.login-patient-form', function(event) {
		event.preventDefault();
		let form = $(this);
		ajaxBtnLoader(form.find(".doctor-login-form-btn"));
		ajaxFormSubmit(form, function(resp) {	
			if(resp){
				form.find(".login-form-btn").html('redirecting...');
				if ("<?=$_SESSION['redirectUrl']?>".length > 3) {
					window.location.replace("<?=$_SESSION['redirectUrl']?>");
				}
				else{
					window.location.replace("<?=BASEURL?>patient/dashboard");
				}
			}
			else{
				form.find(".login-form-btn").html('Login');
			}
		}, function(error) {
			console.error(error);
	});//ajax function call back
});//login-doctor-form-submit
</script>