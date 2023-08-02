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
    $(".dr-nav ul li a[href^='#']").on('click', function(e) {
   // prevent default anchor click behavior
     e.preventDefault();

   // store hash
     var hash = this.hash;

   // animate
     $('html, body').animate({
         scrollTop: $(hash).offset().top-220
     }, 1000, function(){

       // when done, add hash to url
       // (default click behaviour)
      // window.location.hash = hash;
     });

 });
</script>