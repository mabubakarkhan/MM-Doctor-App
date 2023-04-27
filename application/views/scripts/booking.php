<script>
	$(document).on('click', '.timeSlotIdSelect', function(event) {
		event.preventDefault();
		$(".timeSlotIdSelect").removeClass('selected');
		$this = $(this);
		$this.addClass('selected');
		$("#timeSlotId").val($this.attr('data-id'));
		$("#timeSlotDate").val($this.attr('data-date'));
		$(".timeSlotSelectedTitle").text($this.attr('data-title'));
		$(".timeSlotSelectedTitle").show();
	});
	$(document).on('click', '.timeSlotSubmitBtn', function (event) {
		event.preventDefault();
		$this = $(this);
		ajaxBtnLoader($('.timeSlotSubmitBtn span'));
		$check = $("#timeSlotId").val();
		$date = $("#timeSlotDate").val();
		if(parseInt($check) > 0){
			window.location.replace("<?=BASEURL?>checkout/"+$check+'/'+$date);
		}
		else{
			$('.timeSlotSubmitBtn span').html('');
		}
	});
</script>