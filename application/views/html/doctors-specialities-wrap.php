<div class="col-md-12">
    <ul class="nav nav-tabs nav-tabs-solid">
            <li class="nav-item"><a class="nav-link active" href="#all" data-bs-toggle="tab">All</a></li>
        <?php foreach ($specializations_featured as $key => $sf): ?>
            <li class="nav-item"><a class="nav-link" href="#<?=$sf['slug']?>" data-bs-toggle="tab"><?=$sf['title']?></a></li>
        <?php endforeach ?>
    </ul>
    <div class="tab-content">
            
        <div class="tab-pane show active" id="all">
            <div class="doctor-slider slider">
                <?php foreach ($specializations_featured_doctors as $key => $q): ?>
                    <div class="profile-widget">
                        <div class="doc-img">
                            <a href="doctor-profile.html">
                                <img class="img-fluid" alt="User Image" src="<?=UPLOADS.$q['img']?>">
                            </a>
                            <!-- <a href="javascript:void(0)" class="fav-btn remove-bookmark" data-id="<?=$q['bookmark_doctor_id']?>">
                                <i class="far fa-bookmark"></i>
                            </a> -->
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
                    </div><!-- /profile-widget -->
                <?php endforeach ?>
            </div>
        </div><!-- #all -->


        <?php foreach ($specializations_featured as $key => $sf): ?>

            <div class="tab-pane" id="<?=$sf['slug']?>">
                <div class="doctor-slider slider">
                    <?php foreach ($specializations_featured_doctors as $key => $q): ?>
                        <?php $arr = explode(',', $q['specialization_ids']); ?>
                        <?php if (in_array($sf['specialization_id'], $arr)): ?>
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="doctor-profile.html">
                                        <img class="img-fluid" alt="User Image" src="<?=UPLOADS.$q['img']?>">
                                    </a>
                                    <!-- <a href="javascript:void(0)" class="fav-btn remove-bookmark" data-id="<?=$q['bookmark_doctor_id']?>">
                                        <i class="far fa-bookmark"></i>
                                    </a> -->
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
                            </div><!-- /profile-widget -->
                        <?php endif ?>
                    <?php endforeach ?>
                </div> 
            </div> 
        <?php endforeach ?>




    </div>
</div>