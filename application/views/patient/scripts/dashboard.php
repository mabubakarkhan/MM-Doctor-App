<style>
	@media only screen and (min-width:576px) {
		.modal-dialog-wide{
			max-width: 90% !important;
		}
	}
</style>
<script>
	$(document).on('click', '.get-appointment-info', function(event) {
		event.preventDefault();
		$id = $(this).attr('data-id');
		$("#modal-appointment-info .modal-body").html('<p align="center">Loading...</p>');
		$("#modal-appointment-info").modal('show');
		$.post('<?=BASEURL?>get-appointment-info', {id: $id}, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$("#modal-appointment-info .modal-body").html(resp.html);
			}
			else{
				$("#modal-appointment-info .modal-body").html('<p align="center">Nothing Found ):</p>');
			}
		});
	});//get-appointment-info
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
	});//profile-form
</script>


<div class="modal fade custom-modal" id="modal-appointment-info">
	<div class="modal-dialog modal-dialog-centered modal-dialog-wide">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Appointment Detail</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
			</div><!-- /modal-body -->
		</div>
	</div>
</div><!-- #modal-appointment-info -->

<div class="modal fade custom-modal" id="modal-cancel-appointment">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Appointment Cancel Note</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=BASEURL.'patient/cancel-appointment'?>">
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