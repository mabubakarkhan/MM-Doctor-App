<script>
$(document).on('submit', '.register-doctor-form', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-register-form-btn"));
	return false;
	ajaxFormSubmit(form, function(resp) {	
		if(resp){
			form.find(".doctor-register-form-btn").html('redirecting...');
			window.location.replace("<?=BASEURL?>doctor/dashboard");
		}
		else{
			form.find(".doctor-register-form-btn").html('Submit');
		}
	}, function(error) {
		console.error(error);
	});//ajax function call back
});//register-doctor-form-submit
</script>