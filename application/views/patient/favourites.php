<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title"><?=$page_title?></h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$page_title?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">

            <?php require_once('menu.php'); ?>

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="row row-grid">
                    <?php foreach ($favourites as $key => $q): ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="doctor-profile.html">
                                        <img class="img-fluid" alt="User Image" src="<?=UPLOADS.$q['img']?>">
                                    </a>
                                    <a href="javascript:void(0)" class="fav-btn remove-bookmark" data-id="<?=$q['bookmark_doctor_id']?>">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>
                                <div class="pro-content">
                                    <h3 class="title">
                                        <a href="doctor-profile.html"><?=$q['fname'].' '.$q['lname']?></a>
                                        <!-- <i class="fas fa-check-circle verified"></i> -->
                                    </h3>
                                    <p class="speciality"><?=$q['specialization_titles']?></p>
                                    <div class="rating">
                                        <?php
                                        for ($i=1; $i < 6; $i++) { 
                                            if ($q['ratting'] >= $i) {
                                                echo '<i class="fas fa-star filled"></i>';
                                            }
                                            else{
                                                echo '<i class="fas fa-star"></i>';
                                            }
                                        }
                                        ?>
                                        <span class="d-inline-block average-rating">(<?=$q['review_count']?>)</span>
                                    </div>
                                    <ul class="available-info">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i> <?=$q['address_line_1'].' '.$q['cityName']?>
                                        </li>
                                    </ul>
                                    <div class="profile-btn-list">
                                        <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>" class="btn btn-primary view-btn">View
                                            Profile</a>
                                        <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>" class="btn book-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>






