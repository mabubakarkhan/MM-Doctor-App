<script>
$(document).on('submit', '#searchForm', function(event) {
	event.preventDefault();
	$form = $(this);
	$("#searchParent").html('<p>loading, please wait..</p>');
	if ($("select[name='sort']").val().length > 0) {
		$sort = $("select[name='sort']").val();
	}
	else{
		$sort = 'null';
	}
	$.post('<?=BASEURL."search-filter"?>', {data: $form.serialize(), sort: $sort}, function(resp) {
		resp = $.parseJSON(resp);
		$("#searchParent").html(resp.html);
		$("#searchResultsCount").text(resp.count);
		if($('.testimonial-slider').length > 0) {
			$('.testimonial-slider').slick({
				dots: true,
				autoplay:false,
				infinite: true,
				prevArrow: false,
				nextArrow: false,
				slidesToShow: 3,
				slidesToScroll: 1,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 776,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 567,
					settings: {
						slidesToShow: 1
					}
				}]
			});
		}
	});
});
</script>