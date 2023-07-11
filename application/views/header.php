<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?=$meta_title?></title>
    <meta name="keywords" content="<?=$meta_key?>">
    <meta name="description" content="<?=$meta_desc?>">
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

<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">
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
                                <a href="<?=BASEURL?>">Home</a>
                            </li>
                            <li class="has-submenu has-magamenu">
                                <a href="#" class="mobile-menu-btn"><i class="fas fa-plus"></i> Doctors</a>
                                <div class="mega-menu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <ul>
                                                    <h6>Find Doctor By Service</h6>
                                                    <?php foreach ($services as $key => $s): ?>
                                                        <li><a href="<?=BASEURL.'search?service='.$s['service_id'].'&direct=true'?>"><?=$s['title']?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <ul>
                                                    <h6>Find Doctor By Specialist</h6>
                                                    <?php foreach ($specializations as $key => $s): ?>
                                                        <li><a href="<?=BASEURL.'search?specialization='.$s['specialization_id'].'&direct=true'?>"><?=$s['title']?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <ul>
                                                    <h6>Find Doctor By Conditions</h6>
                                                    <?php foreach ($conditions_featured as $key => $c): ?>
                                                        <li><a href="<?=BASEURL.'search?specialization='.$c['specialization_id'].'&direct=true'?>"><?=$c['title']?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <ul>
                                                    <h6>Find Hospitals</h6>
                                                    <?php foreach ($featured_hospitals as $key => $h): ?>
                                                        <li><a href="<?=BASEURL.'hospital/'.$h['hospital_id']?>"><?=$h['name']?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="has-submenu has-magamenu">
                                <a href="#" class="mobile-menu-btn"><i class="fas fa-plus"></i> medicine</a>
                                <div class="mega-menu">
                                    <div class="container">
                                        <div class="row">
                                            <h6>Find Medicine By Category</h6>
                                            <?php foreach ($cats as $key => $q): ?>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li><a href="<?=BASEURL.'category/'.$q['slug']?>"><?=$q['title']?></a></li>
                                                    </ul>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
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