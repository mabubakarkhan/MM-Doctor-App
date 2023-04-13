<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
$(document).on('click','.time-slots-modal-btn', function (event) {
	event.preventDefault();
	$("#add_time_slot .modal-title").text($(this).attr('data-title'));
	$("#add_time_slot input[name='day_number']").val($(this).attr('data-day'));
	$(".time-slot-form input[name='end[]']").val(moment.utc($(".time-slot-form input[name='start[]']").val(),'hh:mm').add($(".time-slot-duration").val(),'minutes').format('hh:mm'));
	$("#add_time_slot").modal('show');
});
$(document).on('click','#add_time_slot .trash', function () {
	$(this).closest('.hours-cont').remove();
	return false;
});
$(document).on('change', '.time-slot-duration', function(event) {
	event.preventDefault();
	$(".hours-cont-runtime").remove();
});
$(document).on('click', '#add_time_slot .add-hours', function () {
	$start = $(".time-slot-form input[name='end[]']:last").val();
	$end = moment.utc($start,'HH:mm').add($(".time-slot-duration").val(),'minutes').format('HH:mm');
	var hourscontent = '<div class="row form-row hours-cont hours-cont-runtime">' +
		'<div class="col-12 col-md-10">' +
			'<div class="row form-row">' +
				'<div class="col-12 col-md-6">' +
					'<div class="form-group">' +
						'<label>Start Time</label>' +
						'<input type="time" name="start[]" value="'+$start+'" class="form-control" required>' +
					'</div>' +
				'</div>' +
				'<div class="col-12 col-md-6">' +
					'<div class="form-group">' +
						'<label>End Time</label>' +
						'<input type="time" name="end[]" value="'+$end+'" class="form-control" required>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
	'</div>';
	
    $("#add_time_slot .hours-info").append(hourscontent);
    return false;
});
$(document).on('submit', 'form.time-slot-form', function(event) {
	event.preventDefault();
	let form = $(this);
	ajaxBtnLoader(form.find(".doctor-dashboard-submit-btn"));
	ajaxFormSubmit(form, function(resp) {	
		form.find(".doctor-dashboard-submit-btn").html('Save Changes');
		$(resp.divID).children('.doc-times').html(resp.html);
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
$(document).on('click', '.delete_schedule', function(event) {
	event.preventDefault();
	$this = $(this);
	ajaxBtnLoader($this);
	$.post('delete-schedule', {id: $this.attr('data-id')}, function(resp) {
		resp = $.parseJSON(resp);
		if (resp.status == true) {
			$this.parent('.doc-slot-list').remove();
		}
		else{
			$this.html('<i class="fa fa-times"></i>');
		}
		nativeToast({
			message: resp.msg,
			edge: true,
			position: 'bottom',
			type: resp.type
		})
	});
});
</script>

<div class="modal fade custom-modal" id="add_time_slot">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Add Time Slots</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="time-slot-form" action="submit-time-slots">
					<input type="hidden" name="day_number">
					<div class="hours-info">
						<div class="row form-row hours-cont">
							<div class="col-12 col-md-10">
								<div class="row form-row">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label>Start Time</label>
											<input type="time" name="start[]" value="<?=date("H:m")?>" class="form-control" required>
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label>End Time</label>
											<input type="time" name="end[]" class="form-control" required>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="add-more mb-3">
						<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle me-1"></i> Add More</a>
					</div>
					<div class="submit-section text-center">
						<button type="submit" class="btn btn-primary submit-btn doctor-dashboard-submit-btn">Save Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- #add_time_slot -->