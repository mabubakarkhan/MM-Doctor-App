  <!-- End Page -->
  <!-- Core  -->
  <script src="<?=GLOBAL_?>vendor/jquery/jquery.js"></script>
  <script src="<?=GLOBAL_?>vendor/bootstrap/bootstrap.js"></script>
  <script src="<?=GLOBAL_?>vendor/animsition/animsition.js"></script>
  <script src="<?=GLOBAL_?>vendor/asscroll/jquery-asScroll.js"></script>
  <script src="<?=GLOBAL_?>vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?=GLOBAL_?>vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="<?=GLOBAL_?>vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <script src="<?=GLOBAL_?>vendor/waves/waves.js"></script>
  <!-- Plugins -->
  <script src="<?=GLOBAL_?>vendor/switchery/switchery.min.js"></script>
  <script src="<?=GLOBAL_?>vendor/intro-js/intro.js"></script>
  <script src="<?=GLOBAL_?>vendor/screenfull/screenfull.js"></script>
  <script src="<?=GLOBAL_?>vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="<?=GLOBAL_?>vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <script type="text/javascript" src="<?=GLOBAL_?>js/jquery.validate.min.js" ></script>
  <!-- Scripts -->
  <script src="<?=GLOBAL_?>js/core.js"></script>
  <script src="<?=GLOBAL_?>assets/js/site.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/menu.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/menubar.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/gridmenu.js"></script>
  <script src="<?=GLOBAL_?>assets/js/sections/sidebar.js"></script>
  <script src="<?=GLOBAL_?>js/configs/config-colors.js"></script>
  <script src="<?=GLOBAL_?>assets/js/configs/config-tour.js"></script>
  <script src="<?=GLOBAL_?>js/components/asscrollable.js"></script>
  <script src="<?=GLOBAL_?>js/components/animsition.js"></script>
  <script src="<?=GLOBAL_?>js/components/slidepanel.js"></script>
  <script src="<?=GLOBAL_?>js/components/switchery.js"></script>
  <script src="<?=GLOBAL_?>js/components/tabs.js"></script>
  <script src="<?=GLOBAL_?>js/components/jquery-placeholder.js"></script>
  <script src="<?=GLOBAL_?>js/components/material.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>


<!-- 

<script type="text/javascript">
  $(document).ready(function(e){
    $("#form-login").validate({
    errorElement: "div",
        wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertBefore(element)
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('margin-left', 10);
            error.css('margin-top', 50);
      error.css('border-radius','4px');
      error.css('border','1px solid #b2b2b2');
      error.css('padding','0 5px');
      error.css('color','#fff');
        }
  });
    
  });
</script> -->

<script type="text/javascript">
$.extend($.validator.messages, {
    required: "",
    minlength: "",
    maxlength: ""
});
</script>
