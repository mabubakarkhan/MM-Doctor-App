        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="<?=IMG?>login-banner.png" class="img-fluid" alt="Doccure Register">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Doctor Register <a href="register">Are you a Patient?</a></h3>
                                    </div>
                                    <form action="post-register-doctor" class="register-doctor-form">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" name="phone" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Create Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="text-start">
                                            <a class="forgot-link" href="login-doctor">Already have an account?</a>
                                        </div>
                                        <button class="btn btn-primary btn-lg login-btn register-form-btn" type="submit">Submit</button>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <span class="span-or">or</span>
                                        </div>
                                        <div class="row form-row social-login">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-facebook w-100"><img src="<?=IMG?>fb.png" class="img-fluid" alt="fb"> Login</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-google w-100"><img src="<?=IMG?>google.png" class="img-fluid" alt="Logo"> Login</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>