<script>
$(document).on('click','.quantity-right-plus-2',function(e){
	e.preventDefault();
	$this = $(this);
	var quantity = $(this).parent('span').parent('div').children('input[name="quantity"]').val()
	quantity = parseInt(quantity) + 1;
	$(this).parent('span').parent('div').children('input[name="quantity"]').val(quantity);
	$key = $(this).attr('data-key');
	$.post('<?=BASEURL."cart-quantity"?>', {qty: quantity, key: $key}, function(resp) {
		resp = $.parseJSON(resp);
		$(".total-cost").text(resp.total);
		$this.parent('span').parent('div').parent('div').parent('td').parent('tr').children('td.itemTotal').text(resp.itemTotal);
		nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
	});
});

$(document).on('click','.quantity-left-minus-2',function(e){
	e.preventDefault();
	$this = $(this);
	var quantity = $(this).parent('span').parent('div').children('input[name="quantity"]').val()
	quantity = parseInt(quantity);
	if(quantity>0 && quantity != 1){
		$(this).parent('span').parent('div').children('input[name="quantity"]').val(quantity - 1);
		quantity = quantity - 1;
	}
	$key = $(this).attr('data-key');
	$.post('<?=BASEURL."cart-quantity"?>', {qty: quantity, key: $key}, function(resp) {
		resp = $.parseJSON(resp);
		$(".total-cost").text(resp.total);
		$this.parent('span').parent('div').parent('div').parent('td').parent('tr').children('td.itemTotal').text(resp.itemTotal);
		nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
	});
});
$(document).on('click', '.deleteCartItem', function(event) {
	event.preventDefault();
	$this= $(this);
	ajaxBtnLoader($this);
	$.post('<?=BASEURL."delete-cart-item"?>', {key: $this.attr('data-key')}, function(resp) {
		resp = $.parseJSON(resp);
		$(".total-cost").text(resp.total);
		$this.parent('div').parent('td').parent('tr').remove();
		nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
	});
});
</script>