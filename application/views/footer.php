<footer class="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src="<?=IMG?>logo.png" alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="<?=$setting['facebook_link']?>" target="_blank"><i class="feather-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="<?=$setting['instagram_link']?>" target="_blank"><i class="feather-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="<?=$setting['linkedin_link']?>" target="_blank"><i class="feather-linkedin"></i></a>
                                            </li>
                                            <li>
                                                <a href="<?=$setting['twitter_link']?>" target="_blank"><i class="feather-twitter"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Patients</h2>
                                <ul>
                                    <?php if ($userSession): ?>
                                        <li><a href="<?=BASEURL.$userSession['controller']?>/dashboard">Dashboard</a></li>
                                        <li><a href="<?=BASEURL.$userSession['controller']?>/profile-settings">Profile Settings</a></li>
                                        <li><a href="<?=BASEURL.'logout'?>">Logout</a></li>
                                    <?php else: ?>
                                        <li><a href="<?=BASEURL?>login">Login</a></li>
                                        <li><a href="<?=BASEURL?>register">Register</a></li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Doctors</h2>
                                <ul>
                                    <?php if ($userSession): ?>
                                        <li><a href="<?=BASEURL.$userSession['controller']?>/dashboard">Dashboard</a></li>
                                        <li><a href="<?=BASEURL.$userSession['controller']?>/profile-settings">Profile Settings</a></li>
                                        <li><a href="<?=BASEURL.'logout'?>">Logout</a></li>
                                    <?php else: ?>
                                        <li><a href="<?=BASEURL?>login-doctor">Login</a></li>
                                        <li><a href="<?=BASEURL?>register-doctor">Register</a></li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <span><i class="feather-map-pin"></i></span>
                                        <p> <?=$setting['address']?> </p>
                                    </div>
                                    <p>
                                        <i class="feather-phone"></i>
                                        <a href="tel:<?=$setting['phone']?>" class="__cf_email__"><?=$setting['phone']?></a>
                                    </p>
                                    <p class="mb-0">
                                        <i class="feather-mail"></i>
                                        <a href="mailto:<?=$setting['email']?>" class="__cf_email__"><?=$setting['email']?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy; <?=date('Y').' '.APP_TITLE?>. All rights reserved.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="<?=BASEURL?>terms">Terms and Conditions</a></li>
                                        <li><a href="<?=BASEURL?>policy">Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- /main-wrapper -->
    <script src="<?=JS?>jquery-3.6.0.min.js"></script>
    <script src="<?=JS?>bootstrap.bundle.min.js"></script>
    <script src="<?=JS?>slick.js"></script>
    <script src="<?=JS?>profile-settings.js"></script>
    <script src="<?=PLUGINS?>dropzone/dropzone.min.js"></script>
    <script src="<?=PLUGINS?>bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
    <script src="<?=PLUGINS?>theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?=PLUGINS?>theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
    <script src="<?=PLUGINS?>select2/js/select2.min.js"></script>
    <script src="<?=JS?>moment.min.js"></script>
    <script src="<?=PLUGINS?>daterangepicker/daterangepicker.js"></script>
    <script src="<?=JS?>bootstrap-datetimepicker.min.js"></script>
    <script src="<?=PLUGINS?>fancybox/jquery.fancybox.min.js"></script>
    <script src="<?=JS?>native-toast.js"></script>
    <script src="<?=JS?>script.js"></script>
</body>
</html>

<?php if ($userSession): ?>
    <style>
        @media only screen and (min-width:576px) {
            .modal-dialog-wide{
                max-width: 90% !important;
            }
        }
    </style>
    <script>
    $(document).on('click', '.get-appointment-info', function(event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        $("#modal-appointment-info .modal-body").html('<p align="center">Loading...</p>');
        $("#modal-appointment-info").modal('show');
        $.post('<?=BASEURL?>get-appointment-info', {id: $id}, function(resp) {
            resp = $.parseJSON(resp);
            if (resp.status == true) {
                $("#modal-appointment-info .modal-body").html(resp.html);
            }
            else{
                $("#modal-appointment-info .modal-body").html('<p align="center">Nothing Found ):</p>');
            }
        });
    });//get-appointment-info
    </script>
    <div class="modal fade custom-modal" id="modal-appointment-info">
        <div class="modal-dialog modal-dialog-centered modal-dialog-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-transform: capitalize;">Appointment Detail</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div><!-- /modal-body -->
            </div>
        </div>
    </div><!-- #modal-appointment-info -->
<?php endif ?>

    <script>
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
               $('.header').addClass('fixed-header');
            } else {
               $('.header').removeClass('fixed-header');
            }
        });
    </script>
    <script>
        $(document).ready(function(){

  var sectionIds = $('.dr-nav li a');

    $(document).scroll(function(){
        sectionIds.each(function(){

            var container = $(this).attr('href');
            var containerOffset = $(container).offset().top;
            var containerHeight = $(container).outerHeight();
            var containerBottom = containerOffset + containerHeight;
            var scrollPosition = $(document).scrollTop();
    
            if(scrollPosition < containerBottom - 150 && scrollPosition >= containerOffset - 240){
                $(this).addClass('active');
            } else{
                $(this).removeClass('active');
            }
        });
    });
});
    </script>
    <script>
        var yourNavigation = $(".dr-nav .nav");
        stickyDiv = "sticky";
        yourHeader = $('.dr-nav').height();

        $(window).scroll(function() {
          if( $(this).scrollTop() > yourHeader ) {
            yourNavigation.addClass(stickyDiv);
          } else {
            yourNavigation.removeClass(stickyDiv);
          }
        });
    </script>
    <script>
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