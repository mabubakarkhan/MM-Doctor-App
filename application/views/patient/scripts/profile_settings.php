<script>
$("#profile-img").on('change',function(){
	var data = new FormData();
	data.append('img', $(this).prop('files')[0]);
	$.ajax({
		type: 'POST',
		processData: false,
		contentType: false,
		data: data,
		url: 'upload-profile-image',
		dataType : 'json',
		success: function(resp){
			if (resp.status == true)
			{
				$img = "<?=UPLOADS?>"+resp.img;
				$(".user-profile-image").prop('src',$img);
			}
			nativeToast({
				message: resp.msg,
				edge: true,
				position: 'bottom',
				type: resp.type
			})
		}
	});
})//input-file-now

$(document).on('submit', 'form.profile-form', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-dashboard-submit-btn"));
	ajaxFormSubmit(form, function(resp) {	
		form.find(".doctor-dashboard-submit-btn").html('Save');
		nativeToast({
			message: resp.msg,
			edge: true,
			position: 'bottom',
			type: resp.type
		})
	}, function(error) {
		console.error(error);
	});//ajax function call back
});//profile-form


$(".select2").select2({
    tags: true
})
$(".select22").select2()

</script>