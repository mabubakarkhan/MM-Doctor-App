<script>
	// Date Range Picker
	if($('.bookingrange').length > 0) {
		if ('<?=$directDate?>' != 'false') {
			if ('<?=$directDate?>' == 0) {
				var start = moment();
				var end = moment();
			}
			else{
				var start = moment().add('<?=$directDate?>', 'days');
				var end = moment().add('<?=$directDate?>', 'days');
			}
		}
		else{
			var start = moment().add(6, 'days');
			var end = moment();
		}
		/*var start = moment().add(6, 'days');
			var end = moment();*/

		function booking_range(start, end) {
			$('.bookingrange span').html(end.format('MMMM D, YYYY') + ' - ' + start.format('MMMM D, YYYY'));
			$newDate = end.format('MMMM D, YYYY') + ' - ' + start.format('MMMM D, YYYY');
			$("#booking-schedule-section").html('<p style="text-align: center;"><i class="fas fa-spinner fa-spin"></i></p>');
			$.post('<?=BASEURL."booking-filter"?>', {
				date: $newDate,
				doctor: "<?=$doctor['doctor_id']?>",
				hospital: "<?=$hospital['hospital_id']?>"
			}, function(resp) {
				resp = $.parseJSON(resp);
				$(".bookingPageSelectedDateHeading").text(resp.bookingPageSelectedDateHeading);
				$(".bookingPageSelectedDayHeading").text(resp.bookingPageSelectedDayHeading);
				$("#booking-schedule-section").html(resp.html);
				//Daily Solts slider
				if($('.daily-solts').length > 0) {
					$('.daily-solts').slick({
						dots: false,
						autoplay:false,
						infinite: false,
						arrows: true,
						slidesToShow: 6,
						slidesToScroll: 1,
						responsive: [{
							breakpoint: 992,
							settings: {
								slidesToShow: 5
							}
						},
						{
							breakpoint: 800,
							settings: {
								slidesToShow: 4
							}
						},
						{
							breakpoint: 776,
							settings: {
								slidesToShow: 3
							}
						},
						{
							breakpoint: 567,
							settings: {
								slidesToShow: 2
							}
						},
						{
							breakpoint: 450,
							settings: {
								slidesToShow: 1
							}
						}
						]
					});
				}
			});
		}

		$('.bookingrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
				'Next 7 Days': [moment().add(6, 'days'), moment()],
				'Next 14 Days': [moment().add(13, 'days'), moment()],
				'Next 21 Days': [moment().add(20, 'days'), moment()],
				'Next 30 Days': [moment().add(29, 'days'), moment()],
				// 'This Month': [moment().startOf('month'), moment().endOf('month')],
			}
		}, booking_range);

		booking_range(start, end);
	}


	$(document).on('click', '.bookingPageDaySelectTabBtn', function () {
		$(".bookingPageSelectedDateHeading").text($(this).attr('data-date'));
		$(".bookingPageSelectedDayHeading").text($(this).attr('data-day'));
	});
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