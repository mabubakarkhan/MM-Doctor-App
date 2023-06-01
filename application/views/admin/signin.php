<!-- 
<?php
if($error):
?>
<div class="form-message error">
    <p>Username and Password combination is not valid according to our record</p>
</div>
<?php
endif;
?> -->
<div class="page animsition" style="background: #000;" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
        <div class="page-brand-info">
            <div class="brand">
                <!-- <img class="brand-img" src="<?=IMG?>logo.png" style="border-radius: 5px;" width="150" alt="..."> -->
                <h2 class="brand-text font-size-40"><?=APP_TITLE?></h2>
            </div><!-- /brand -->
        </div><!-- /page-brand-info -->
        <div class="page-login-main">
            <div class="brand visible-xs">
                <!-- <img class="brand-img" src="<?=IMG?>logo-login.png" style="border-radius: 5px;" width="100" alt="..."> -->
                <h3 class="brand-text font-size-25"><?=APP_TITLE?></h3>
            </div><!-- /brand -->
            <h3 class="font-size-24">Sign In</h3>
            <form method="post" action="<?=BASEURL?>admin/process_login" id="form-login" class="formBox" autocomplete="off">
                <div class="form-group form-material floating">
                    <input type="text" class="form-control empty" required id="inputUsername" name="username">
                    <label class="floating-label" for="inputUsername">Username</label>
                </div><!-- /form-group -->
                <div class="form-group form-material floating">
                    <input type="password" class="form-control empty" required id="inputPassword" name="password">
                    <label class="floating-label" for="inputPassword">Password</label>
                </div><!-- /form-group -->
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
                        <input type="checkbox" id="remember" name="checkbox">
                        <label for="inputCheckbox">Remember me</label>
                    </div><!-- /checkbox-custom -->
                </div><!-- /form-group -->
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
            <footer class="page-copyright">
                <p>WEBSITE BY <a href="javascript://"><strong><?=APP_TITLE?></strong></a></p>
                <p>© <?=date('Y')?>. All RIGHT RESERVED.</p>
                <div class="social">
                    <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)"><i class="icon bd-twitter" aria-hidden="true"></i></a>
                    <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)"><i class="icon bd-facebook" aria-hidden="true"></i></a>
                    <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)"><i class="icon bd-google-plus" aria-hidden="true"></i></a>
                </div><!-- /social -->
            </footer>
        </div><!-- /page-login-main -->
    </div><!-- /page-content -->
</div><!-- /page animsition -->