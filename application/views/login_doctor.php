<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="<?=IMG?>login-banner.png" class="img-fluid" alt="Doccure Login">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Login <span>Doctor</span></h3>
                            </div>
                            <form action="post-login-doctor" class="login-doctor-form">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="key" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" required class="form-control">
                                </div>
                                <div class="text-start">
                                    <a class="forgot-link" href="forgot-password/doctor">Forgot Password ?</a>
                                </div>
                                <button class="btn btn-primary btn-lg login-btn doctor-login-form-btn" type="submit">Login</button>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">OR</span>
                                </div>
                                <div class="row form-row social-login">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-facebook w-100"><img src="<?=IMG?>fb.png" class="img-fluid" alt="Logo"> Login</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-google w-100"><img src="<?=IMG?>google.png" class="img-fluid" alt="Logo"> Login</a>
                                    </div>
                                </div>
                                <div class="text-center dont-have">Don’t have an account? <a href="register-doctor">Register</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>