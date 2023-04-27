<script>
$(document).on('submit', '.register-patient-form', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".patient-register-form-btn"));
	ajaxFormSubmit(form, function(resp) {	
		if(resp){
			form.find(".patient-register-form-btn").html('redirecting...');
			window.location.replace("<?=BASEURL?>patient/dashboard");
		}
		else{
			form.find(".patient-register-form-btn").html('Submit');
		}
	}, function(error) {
		console.error(error);
	});//ajax function call back
});//register-doctor-form-submit
</script>