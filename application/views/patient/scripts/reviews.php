<script>
$(document).on('click', '.make-review', function(event) {
	event.preventDefault();
	$this = $(this);
	$("#modal-review input[name='id']").val($this.attr('data-id'));
	$("#modal-review").modal('show');
});
$(document).on('submit', '#modal-review form', function(event) {
	event.preventDefault();
	var form = $(this);
	ajaxBtnLoader(form.find(".form-btn"));
	ajaxFormSubmit(form, function(resp) {	
		form.find(".form-btn").html('Post');
		if (resp.status == true) {
			$class = '.tr-appointment-'+$("#modal-review input[name='id']").val();
			$("#modal-review textarea[name='review']").val('');
			$($class).remove();
			$("#modal-review").modal('hide');
			$("tbody.show-reviews").html(resp.html);
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
});
</script>

<div class="modal fade custom-modal" id="modal-review">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Appointment Detail</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?=BASEURL.'patient/post-review'?>">
					<input type="hidden" name="id" value="">
					<div class="form-group">
						<label>Review</label>
						<textarea name="review" class="form-control" rows="5" required></textarea>
					</div><!-- /form-group -->
					<div class="form-group">
						<label>Ratting</label>
						<select name="ratting" class="form-control" required>
							<option value="1">1 star</option>
							<option value="2">2 star</option>
							<option value="3" selected>3 star</option>
							<option value="4">4 star</option>
							<option value="5">5 star</option>
						</select>
					</div><!-- /form-group -->
					<div class="form-group">
						<button class="btn btn-primary form-btn">Post</button>
					</div><!-- /form-group -->
				</form>
				
			</div><!-- /modal-body -->
		</div>
	</div>
</div><!-- #modal-cancel-appointment -->