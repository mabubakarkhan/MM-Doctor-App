<script>
$(document).on('submit', '#categorySearchForm', function(event) {
	event.preventDefault();
	$this = $(this);
	$(".products-wrap").html('<p>Loading...</p>');
	$sort = $("#productSorting").val();
	let checked = [];
	let checkedCheck = false;
	$('input[name="category_id[]"]').each(function(index, val) {
		if ($(val).is(':checked')) {
			checked.push($(val).parent('.custom_check').text().trim());
			checkedCheck = true;
		}
	});
	if (checkedCheck) {
		$('.categoryTitle').text(checked);
	}
	else{
		$('.categoryTitle').text('All Categories');
	}
	$("span.products-counter").text(0);
	$.post('<?=BASEURL."get-products-by-cat"?>', {data: $this.serialize(),sort: $sort}, function(resp) {
		resp = $.parseJSON(resp);
		$(".products-wrap").html(resp.html);
		$("span.products-counter").text($("input.products-counter").val());
	});
});

$(document).on('change', '#productSorting', function(event) {
	event.preventDefault();
	$sort = $(this);
	let checked = [];
	let checkedCheck = false;
	$('input[name="category_id[]"]').each(function(index, val) {
		if ($(val).is(':checked')) {
			checked.push($(val).parent('.custom_check').text().trim());
			checkedCheck = true;
		}
	});
	if (checkedCheck) {
		$('.categoryTitle').text(checked);
	}
	else{
		$('.categoryTitle').text('All Categories');
	}
	$("span.products-counter").text(0);

	$.post('<?=BASEURL."get-products-by-cat"?>', {data: $("#categorySearchForm").serialize(),sort: $sort.val()}, function(resp) {
		resp = $.parseJSON(resp);
		$(".products-wrap").html(resp.html);
		$("span.products-counter").text($("input.products-counter").val());
	});
});
</script>