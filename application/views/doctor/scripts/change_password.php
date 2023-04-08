<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
<script>
$(document).on('submit', 'form', function(event) {
	event.preventDefault();
	let form = $(this);
	let oldPassword = CryptoJS.MD5($("input[name='old']").val());
	let newPassword = $("input[name='new']").val();
	let confirmPassword = $("input[name='confirm']").val();
	if (oldPassword != "<?=$userSession['password']?>") {
		nativeToast({
			message: 'wrong old password.',
			edge: false,
			position: 'bottom',
			type: 'error'
		})
	}
	else{
		var strength = 1;
		var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
		$.map(arr, function(regexp) {
		  if(newPassword.match(regexp))
		     strength++;
		});
		if (strength < 5) {
			nativeToast({
				message: 'ensure password strength.',
				edge: false,
				position: 'bottom',
				type: 'error'
			})
		}
		else{
			if(confirmPassword != newPassword) {
				nativeToast({
					message: 'new/confirm must matched.',
					edge: false,
					position: 'bottom',
					type: 'error'
				})
			}
			else{
				ajaxBtnLoader(form.find(".doctor-dashboard-submit-btn"));
				ajaxFormSubmit(form, function(resp) {
					if (resp.status == true) {
						form.find(".doctor-dashboard-submit-btn").html('Redirecting..');
						window.location.replace("<?=BASEURL?>doctor/logout");
					}
					else{
						form.find(".doctor-dashboard-submit-btn").html('Change');
					}
					nativeToast({
						message: resp.msg,
						edge: true,
						position: 'bottom',
						type: resp.type
					})
				}, function(error) {
					console.error(error);
				});//ajax function call back
			}
		}
	}
});//register-doctor-form-submit

</script>