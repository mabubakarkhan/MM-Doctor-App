<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?=$meta_title?></title>
    <link type="image/x-icon" href="<?=IMG?>favicon.png" rel="icon">
    <link rel="stylesheet" href="<?=CSS?>bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<?=PLUGINS?>fontawesome/css/fontawesome.min.css"> -->
    <!-- <link rel="stylesheet" href="<?=PLUGINS?>fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="<?=CSS?>bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?=PLUGINS?>select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=PLUGINS?>fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?=PLUGINS?>daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?=PLUGINS?>bootstrap-tagsinput/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?=PLUGINS?>dropzone/dropzone.min.css">
    <link rel="stylesheet" href="<?=CSS?>feather.css">
    <link rel="stylesheet" href="<?=CSS?>native-toast.css">
    <link rel="stylesheet" href="<?=CSS?>style.css">
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <header class="header min-header">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="container">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="<?=BASEURL?>" class="navbar-brand logo">
                            <img src="<?=IMG?>logo.png" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="<?=BASEURL?>" class="menu-logo">
                                <img src="<?=IMG?>logo.png" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <li class="active">
                                <a href="<?=BASEURL?>"><i class="fas fa-plus"></i> Home</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fas fa-plus"></i> Doctors</a>
                                <ul class="submenu">
                                    <li><a href="doctor-dashboard">Doctor Dashboard</a></li>
                                    <li><a href="appointments">Appointments</a></li>
                                    <li><a href="schedule-timings">Schedule Timing</a></li>
                                    <li><a href="my-patients">Patients List</a></li>
                                    <li><a href="patient-profile">Patients Profile</a></li>
                                    <li><a href="chat-doctor">Chat</a></li>
                                    <li><a href="invoices">Invoices</a></li>
                                    <li><a href="doctor-profile-settings">Profile Settings</a></li>
                                    <li><a href="reviews">Reviews</a></li>
                                    <li><a href="doctor-register">Doctor Register</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fas fa-plus"></i> Patients</a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">Doctors</a>
                                        <ul class="submenu">
                                            <li><a href="map-grid">Map Grid</a></li>
                                            <li><a href="map-list">Map List</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="search">Search Doctor</a></li>
                                    <li><a href="doctor-profile">Doctor Profile</a></li>
                                    <li><a href="booking">Booking</a></li>
                                    <li><a href="checkout">Checkout</a></li>
                                    <li><a href="booking-success">Booking Success</a></li>
                                    <li><a href="patient-dashboard">Patient Dashboard</a></li>
                                    <li><a href="favourites">Favourites</a></li>
                                    <li><a href="chat">Chat</a></li>
                                    <li><a href="profile-settings">Profile Settings</a></li>
                                    <li><a href="change-password">Change Password</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fas fa-plus"></i> Pharmacy</a>
                                <ul class="submenu">
                                    <li><a href="pharmacy-details">Pharmacy Details</a></li>
                                    <li><a href="pharmacy-search">Pharmacy Search</a></li>
                                    <li><a href="product-all">Product</a></li>
                                    <li><a href="product-description">Product Description</a></li>
                                    <li><a href="cart">Cart</a></li>
                                    <li><a href="product-checkout">Product Checkout</a></li>
                                    <li><a href="payment-success">Payment Success</a></li>
                                    <li><a href="pharmacy-register">Pharmacy Register</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fas fa-plus"></i> Pages</a>
                                <ul class="submenu">
                                    <li><a href="about-us">About Us</a></li>
                                    <li><a href="contact-us">Contact Us</a></li>
                                </li>
                                <li><a href="<?=BASEURL?>login">Login</a></li>
                                <li><a href="<?=BASEURL?>register">Register</a></li>
                                <li><a href="forgot-password">Forgot Password</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-plus"></i> Blog</a>
                            <ul class="submenu">
                                <li><a href="blog-list">Blog List</a></li>
                                <li><a href="blog-grid">Blog Grid</a></li>
                                <li><a href="blog-details">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#" target="_blank"><i class="fas fa-plus"></i> Admin</a>
                            <ul class="submenu">
                                <li><a href="admin/index" target="_blank">Admin</a></li>
                                <li><a href="pharmacy/index" target="_blank">Pharmacy Admin</a></li>
                            </ul>
                        </li>
                        <li class="login-link">
                            <a href="login">Login / Signup</a>
                        </li>
                        </ul>
                    </div>
                    <?php if ($userSession): ?>
                        <ul class="nav header-navbar-rht">
                            <li class="nav-item dropdown has-arrow logged-item">
                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                    <span class="user-img">
                                        <img class="rounded-circle user-profile-image" src="<?=UPLOADS.$userSession['img']?>" width="31" alt="<?=$userSession['fname'].' '.$userSession['lname']?>">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="user-header">
                                        <?php if (isset($userSession['img']) && strlen($userSession['img']) > 4): ?>
                                            <div class="avatar avatar-sm">
                                                <img src="<?=UPLOADS.$userSession['img']?>" alt="<?=$userSession['fname'].' '.$userSession['lname']?>" class="avatar-img rounded-circle">
                                            </div>
                                        <?php endif ?>
                                        <div class="user-text">
                                            <h6><?=$userSession['fname'].' '.$userSession['lname']?></h6>
                                            <p class="text-muted mb-0"><?=$userSession['controller']?></p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="<?=BASEURL.$userSession['controller']?>/dashboard">Dashboard</a>
                                    <a class="dropdown-item" href="<?=BASEURL.$userSession['controller']?>/profile-settings">Profile Settings</a>
                                    <a class="dropdown-item" href="<?=BASEURL.'logout'?>">Logout</a>
                                </div>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="nav header-navbar-rht">
                            <li class="nav-item">
                                <a class="nav-link header-login" href="<?=BASEURL?>login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link header-login login" href="<?=BASEURL?>register">Sign Up</a>
                            </li>
                        </ul>
                    <?php endif ?>
                </div>
            </nav>
        </header>