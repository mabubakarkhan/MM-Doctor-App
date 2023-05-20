<script>
$(document).on('click', '.remove-bookmark', function(event) {
	event.preventDefault();
	$this = $(this);
	$.post('<?=BASEURL."patient/remove-favourite"?>', {id: $this.attr('data-id')}, function(resp) {
		resp = $.parseJSON(resp);
		if (resp.status == true) {
			$this.parent('div').parent('div').parent('div').remove();
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