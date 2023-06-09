<script>
$(".select2").select2({
    tags: true
})
$(".select22").select2();


$(document).on('keyup', "#homeSearchBar", function(event) {
    event.preventDefault();
    $this = $(this);
    $key = $this.val();
    if ($key.length > 2) {
        $.post('live-search', {key: $key}, function(resp) {
            resp = $.parseJSON(resp);
            $("#searchResp").html(resp.html);
        });
    }
});
</script>