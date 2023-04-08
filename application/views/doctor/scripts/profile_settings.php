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

$(document).on('submit', 'form.profile-form-2', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-dashboard-submit-btn"));
	ajaxFormSubmit(form, function(resp) {	
		form.find(".doctor-dashboard-submit-btn").html('Save');
		form.children('div.info-wrap').children('div.cont-wrap').each(function(index, el) {
			$(el).find('input[name="id[]"]').val(resp.ids[index]);
		});
		nativeToast({
			message: resp.msg,
			edge: true,
			position: 'bottom',
			type: resp.type
		})
	}, function(error) {
		console.error(error);
	});//ajax function call back
});//profile-form-2


$(document).on('submit', 'form.profile-form-3', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-dashboard-submit-btn"));
	ajaxFormSubmit(form, function(resp) {	
		form.find(".doctor-dashboard-submit-btn").html('Save');
		if (resp.status == true) {
			$(".profile_clinic_lisitng tbody").append(resp.html);
			if (resp.hospitalChk == 'old') {
				$("select[name='hospital_id'] :selected").remove();
			}
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
});//profile-form-3


$(document).on('click', '.delete-doctor-hospital', function(event) {
	event.preventDefault();
	$this = $(this);
	$this.parent('div').parent('td').parent('tr').hide();
	$.post('delete-doctor-hospital', {
		id: $this.attr('data-id'),
		hospital_id: $this.attr('data-hospital-id'),
		name: $this.attr('data-name')
	}, function(resp) {
		resp = $.parseJSON(resp);
		if (resp.status == true) {
			$("select[name='hospital_id']").append(resp.option);
			$this.parent('div').parent('td').parent('tr').remove();
		}
		else{
			$this.parent('div').parent('td').parent('tr').show();
		}
		nativeToast({
			message: resp.msg,
			edge: true,
			position: 'bottom',
			type: resp.type
		})
	});
});


$(".select2").select2({
    tags: true
})
$(".select22").select2()

</script>