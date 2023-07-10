<script>
$(document).on('click', '.add-to-cart-btn', function(event) {
	event.preventDefault();
	$this = $(this);
	$qty = $("#quantity").val();
	$key = $("#cartItemKey").val();
	ajaxBtnLoader($this);
	$.post('<?=BASEURL."add-to-cart"?>', {id: $this.attr('data-id'), qty: $qty,key: $key}, function(resp) {
		resp = jQuery.parseJSON(resp);
		if (resp.status == true) {
			$this.text('Update Quantity');
			$("#cartItemKey").val(resp.key);
			$(".cartMenuLink").html('<i class="fa-solid fa-cart-plus" style="color:red;font-size: 15px;"></i> Cart');
		}
		else{
			$this.text('Add To Cart');
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