<script>
$(document).on('click', '.make-bookmark', function(event) {
        event.preventDefault();
        $this = $(this);
        $id = $this.attr('data-id');
        $.post('<?=BASEURL."make-bookmark"?>', {id: $id}, function(resp) {
            resp = $.parseJSON(resp);
            if (resp.status == true) {
                $this.css('color', 'red');
                $this.removeClass('make-bookmark');
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