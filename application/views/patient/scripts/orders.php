<style>
	@media only screen and (min-width:576px) {
		.modal-dialog-wide{
			max-width: 90% !important;
		}
	}
</style>
<script type="text/javascript">
    function del_q(id) {
        cnfr = confirm("Are you sure you want to delete this Order");
        if (cnfr) {
            $.post('<?=BASEURL."patient/delete-order"?>', {order: id}, function(resp) {
            	resp = $.parseJSON(resp);
            	if (resp.status == true) {
            		$row = "#order-row-"+id;
            		$($row).remove();
            	}
            });
        }
    }
    $(document).on('click', '.get-order-info', function(event) {
    	event.preventDefault();
    	$id = $(this).attr('data-id');
		$("#modal-order-detail table tbody").html('<tr><td colspan="5">loading...</td></tr>');
		$("#modal-order-detail").modal('show');
    	$.post('<?=BASEURL."patient/get-order-detail"?>', {order: $id}, function(resp) {
        	resp = $.parseJSON(resp);
        	console.log(resp.html);
			$("#modal-order-detail table tbody").html(resp.html);
        });
    });
</script>


<div class="modal fade custom-modal" id="modal-order-detail">
	<div class="modal-dialog modal-dialog-centered modal-dialog-wide">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform: capitalize;">Order Detail</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Product</th>
							<th>Title</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>

			</div><!-- /modal-body -->
		</div>
	</div>
</div><!-- #modal-order-detail -->
