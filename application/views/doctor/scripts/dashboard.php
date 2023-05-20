
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
	$(document).on('click', '.cancel-appointment', function(event) {
		event.preventDefault();
		$("input[name='id']").val($(this).attr('data-id'));
		$("#modal-cancel-appointment").modal('show');
	});//.cancel-appointment
	$(document).on('submit', '#modal-cancel-appointment form', function(event) {
		event.preventDefault();
		let form = $(this);
		ajaxBtnLoader(form.find(".form-btn"));
		ajaxFormSubmit(form, function(resp) {	
			if (resp.status == true) {
				location.reload();
			}
			else{
				form.find(".form-btn").html('Submit');
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
	});//modal-cancel-appointment form
	$(document).on('click', '.make-appointment-confirm',function (e) {
		e.preventDefault();
		$this = $(this);
		ajaxBtnLoader($this);
		$.post('appointment-confirm', {id: $this.attr('data-id')}, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$(".tr-appointment-"+$this.attr('data-id')).remove();
			}
			else{
				$this.html('<i class="feather-check-circle"></i>')
			}
			nativeToast({
				message: resp.msg,
				edge: true,
				position: 'bottom',
				type: resp.type
			})
		});
	});
	$(document).on('click', '.done-appointment', function(event) {
		event.preventDefault();
		$(".complete_appointment input[name='id']").val($(this).attr('data-id'));
		CKEDITOR.replace('prescription_id');
		$("#modal-prescription").modal('show');
	});
	$(document).on('submit', '#modal-prescription form', function(event) {
		event.preventDefault();
		let form = $(this);
		$id = $("#modal-prescription input[name='id']").val();
		ajaxBtnLoader(form.find(".form-btn"));
		ajaxFormSubmit(form, function(resp) {	
			if (resp.status == true) {
				$(".tr-appointment-"+$id).remove();
				$("#modal-prescription").modal('hide');
			}
			else{
				form.find(".form-btn").html('Complete');
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
	});//modal-cancel-appointment form
</script>

<div class="modal fade custom-modal" id="modal-cancel-appointment">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Appointment Detail</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=BASEURL.'doctor/cancel-appointment'?>">
					<input type="hidden" name="id" value="">
					<div class="form-group">
						<label>Note</label>
						<textarea name="cancel_note" class="form-control" rows="5"></textarea>
					</div><!-- /form-group -->
					<div class="form-group">
						<button class="btn btn-primary form-btn">Submit</button>
					</div><!-- /form-group -->
				</form>
				
			</div><!-- /modal-body -->
		</div>
	</div>
</div><!-- #modal-cancel-appointment -->



<div id="modal-prescription" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-wide">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-modal-prescription" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Complete Appointment</h4>
			</div><!-- /modal-header -->
			<div class="modal-body">
				
				<form class="complete_appointment" action="complete-appointment" method="post">
					<input type="hidden" name="id">
					<div class="form-group">
						<label for="">Prescription Title</label>
						<input type="text" name="prescription_title" class="form-control">
					</div><!-- /form-group -->
					<div class="form-group">
						<label for="">Prescription</label>
						<textarea id="prescription_id" name="prescription" class="form-control"></textarea>
					</div><!-- /form-group -->
					<div class="form-group">
						<button class="btn btn-success form-btn">Complete</button>
					</div><!-- /form-group -->
				</form>

			</div><!-- /modal-body -->
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-secondary close-modal-prescription" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- #modal-prescription -->