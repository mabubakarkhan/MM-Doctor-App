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


$(document).on('click', '.edit-clinic', function(event) {
	event.preventDefault();
	$("#modal-edit-client input[name='id']").val($(this).attr('data-id'));
	$("#modal-edit-client input[name='fee']").val($(this).attr('data-fee'));
	$("#modal-edit-client .modal-title").text($(this).attr('data-name'));
	$("#modal-edit-client").modal('show');
});

$(document).on('submit', 'form.clinic_editing', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find("button"));
	ajaxFormSubmit(form, function(resp) {	
		form.find("button").html('Update');
		if (resp.status == true) {
			$("#doctor_hospital_"+resp.id).html(resp.html);
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

$(document).on('click', '.close-modal-edit-client', function(event) {
	event.preventDefault();
	$("#modal-edit-client").modal('hide');
});

$(".select2").select2({
    tags: true
})
$(".select22").select2()

</script>


<div id="modal-edit-client" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-modal-edit-client" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div><!-- /modal-header -->
			<div class="modal-body">
				
				<form class="clinic_editing" action="update-clinic" method="post">
					<input type="hidden" name="id">
					<div class="form-group">
						<label for="">Fee</label>
						<input type="text" name="fee" required class="form-control">
					</div><!-- /form-group -->
					<div class="form-group">
						<button class="btn btn-primary ">Update</button>
					</div><!-- /form-group -->
				</form>

			</div><!-- /modal-body -->
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-secondary close-modal-edit-client" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- #modal-edit-client -->