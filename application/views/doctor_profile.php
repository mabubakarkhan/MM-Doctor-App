<style>
.bookmark-icon{
    margin-left: 10px;
}
.bookmark-icon:hover{
    color: red;
    cursor: pointer;
}
</style>

<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Doctor Profile</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="<?=UPLOADS.$doctor['img']?>" class="img-fluid" alt="<?=$doctor['fname'].' '.$doctor['lname']?>">
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">
                                <?=$doctor['fname'].' '.$doctor['lname']?>
                                <?php if ($bookmark_login === true): ?>
                                    <?php if ($bookmark): ?>
                                        <i class="far fa-bookmark bookmark-icon" style="color: red;"></i>
                                    <?php else: ?>
                                        <i class="far fa-bookmark bookmark-icon make-bookmark" data-id="<?=$doctor['doctor_id']?>"></i>
                                    <?php endif ?>
                                <?php endif ?>
                            </h4>
                            <?php if (isset($doctor['specialization_titles']) && strlen($doctor['specialization_titles']) > 1): ?>
                            <p class="doc-speciality"><?=$doctor['specialization_titles']?></p>
                        <?php endif ?>
                        <!-- <p class="doc-department"><img src="<?=IMG?>specialities/specialities-05.png" class="img-fluid" alt="Speciality">Dentist</p> -->
                        <div class="rating">
                             <?php
                            for ($i=1; $i < 6; $i++) { 
                                if ($doctor['ratting'] >= $i) {
                                    echo '<i class="fas fa-star filled"></i>';
                                }
                                else{
                                    echo '<i class="fas fa-star"></i>';
                                }
                            }
                            ?>
                            <span class="d-inline-block average-rating"><?=$doctor['ratting']?> ( <?=$doctor['review_count']?> )</span>
                        </div>
                        <div class="clinic-details">
                            <?php if (strlen($doctor['cityName']) > 1): ?>
                                <p class="doc-location"><i class="feather-map-pin"></i> <?=$doctor['cityName']?>, <?=$doctor['countryName']?><!--  - <a href="javascript:void(0);">Get Directions</a> --></p>
                            <?php endif ?>
                                        <!-- <ul class="clinic-gallery">
                                            <li>
                                                <a href="<?=IMG?>features/feature-01.jpg" data-fancybox="gallery">
                                                    <img src="<?=IMG?>features/feature-01.jpg" alt="Feature">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=IMG?>features/feature-02.jpg" data-fancybox="gallery">
                                                    <img src="<?=IMG?>features/feature-02.jpg" alt="Feature Image">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=IMG?>features/feature-03.jpg" data-fancybox="gallery">
                                                    <img src="<?=IMG?>features/feature-03.jpg" alt="Feature">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=IMG?>features/feature-04.jpg" data-fancybox="gallery">
                                                    <img src="<?=IMG?>features/feature-04.jpg" alt="Feature">
                                                </a>
                                            </li>
                                        </ul> -->
                                    </div>
                                    <?php if (strlen($doctor['service_titles']) > 1): ?>
                                        <div class="clinic-services">
                                            <?php
                                            $services = explode(',', $doctor['service_titles']);
                                            foreach($services as $service){
                                                echo '<span>'.$service.'</span>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="doc-info-right">
                                <!-- <div class="clini-infos">
                                    <ul>
                                        <li><i class="far fa-thumbs-up"></i> 99%</li>
                                        <?php if (strlen($doctor['cityName']) > 1): ?>
                                            <li><i class="feather-map-pin"></i> <?=$doctor['cityName']?>, <?=$doctor['countryName']?></li>
                                        <?php endif ?>
                                        <li><i class="feather-calendar"></i> Available on Fri, 20 Mar</li>
                                        <li><i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i> </li>
                                    </ul>
                                </div>
                                <div class="clinic-booking">
                                    <a class="view-pro-btn" href="doctor-profile">View Profile</a>
                                    <a class="apt-btn" href="booking">Book Now</a>
                                </div> -->
                            </div><!-- /doc-info-right -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <nav class="dr-nav">
                            <ul class="nav">
                                <li><a href="#Education">Education</a></li>
                                <li><a href="#Work-Experience">Work & Experience</a></li>
                                <li><a href="#awards">Awards</a></li>
                                <li><a href="#Registrations">Registrations</a></li>
                                <li><a href="#Memberships">Memberships</a></li>
                                <li><a href="#Services">Services</a></li>
                                <li><a href="#Specializations">Specializations</a></li>
                            </ul>
                        </nav>
                        <nav class="user-tabs mb-4">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#doc_overview" data-bs-toggle="tab">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#doc_locations" data-bs-toggle="tab">Locations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#doc_reviews" data-bs-toggle="tab">Reviews</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab">Business Hours</a>
                                </li> -->
                            </ul>
                        </nav>
                        
                        <div class="tab-content pt-0">
                            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <?php if (strlen($doctor['biography']) > 2): ?>

                                            <div class="widget about-widget">
                                                <h4 class="widget-title">About Me</h4>
                                                <p><?=$doctor['biography']?></p>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <?php if ($educations): ?>
                                            <div class="widget education-widget" id="Education">
                                                <h4 class="widget-title">Education</h4>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <?php foreach ($educations as $key => $education): ?>
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="javascript://" class="name"><?=$education['institute']?></a>
                                                                        <div><?=$education['degree']?></div>
                                                                        <span class="time"><?=$education['year']?></span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif ?>

                                        <?php if ($experiences): ?>
                                            <div class="widget experience-widget" id="Work-Experience">
                                                <h4 class="widget-title">Work & Experience</h4>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <?php foreach ($experiences as $key => $experience): ?>
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="javascript://" class="name"><?=$experience['hospital']?></a>
                                                                        <span class="time"><?=$experience['from'].' - '.$experience['to']?></span>
                                                                        <p><?=$experience['designation']?></p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif ?>

                                        <?php if ($awards): ?>
                                            <div class="widget awards-widget" id="awards">
                                                <h4 class="widget-title">Awards</h4>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <?php foreach ($awards as $key => $award): ?>
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <p class="exp-year"><?=$award['year']?></p>
                                                                        <h4 class="exp-title"><?=$award['title']?></h4>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <?php if ($registrations): ?>
                                            <div class="widget awards-widget" id="Registrations">
                                                <h4 class="widget-title">Registrations</h4>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <?php foreach ($registrations as $key => $registration): ?>
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <p class="exp-year"><?=$registration['year']?></p>
                                                                        <h4 class="exp-title"><?=$registration['title']?></h4>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif ?>

                                        <?php if ($memberships): ?>
                                            <div class="widget awards-widget" id="Memberships">
                                                <h4 class="widget-title">Memberships</h4>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <?php foreach ($memberships as $key => $membership): ?>
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <h4 class="exp-title"><?=$membership['title']?></h4>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <?php
                                        $services = explode(',', $doctor['service_titles']);
                                        if ($services) {
                                            ?>
                                            <div class="service-list" id="Services">
                                                <h4>Services</h4>
                                                <ul class="clearfix">
                                                    <?php
                                                    foreach($services as $service){
                                                        echo '<li>'.$service.'</li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 col-lg-12">
                                        <?php
                                        $specializations = explode(',', $doctor['specialization_titles']);
                                        if ($specializations) {
                                            ?>
                                            <div class="service-list" id="Specializations">
                                                <h4>Specializations</h4>
                                                <ul class="clearfix">
                                                    <?php
                                                    foreach($specializations as $specialization){
                                                        echo '<li>'.$specialization.'</li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="doc_locations" class="tab-pane fade">
                                <div class="location-list">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="clinic-content">
                                                <h4 class="clinic-name"><a href="javascript://">Online Consultancy</a></h4>
                                                <p class="doc-speciality"><?=$doctor['service_titles']?></p>
                                                <p class="doc-speciality"><?=$doctor['specialization_titles']?></p>
                                                <!-- <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">(4)</span>
                                                </div> -->
                                                <div class="clinic-details mb-0">
                                                    <h5 class="clinic-direction"> <i class="feather-map-pin"></i> Online</h5>
                                                    <!-- <ul>
                                                        <li>
                                                            <a href="<?=IMG?>features/feature-01.jpg" data-fancybox="gallery2">
                                                                <img src="<?=IMG?>features/feature-01.jpg" alt="Feature Image">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=IMG?>features/feature-02.jpg" data-fancybox="gallery2">
                                                                <img src="<?=IMG?>features/feature-02.jpg" alt="Feature Image">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=IMG?>features/feature-03.jpg" data-fancybox="gallery2">
                                                                <img src="<?=IMG?>features/feature-03.jpg" alt="Feature Image">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=IMG?>features/feature-04.jpg" data-fancybox="gallery2">
                                                                <img src="<?=IMG?>features/feature-04.jpg" alt="Feature Image">
                                                            </a>
                                                        </li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="clinic-timing">
                                                <?=$doctor['online_consulting_timiing_note']?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="consult-price">
                                                <?php if ($doctor['fee_type'] == 'free'): ?>
                                                    free
                                                <?php else: ?>
                                                    <?=CURRENCY?><?=$doctor['fee']?>
                                                <?php endif ?>
                                            </div>
                                            <div class="clinic-booking">
                                                <a class="apt-btn" href="<?=BASEURL?>booking/<?=(strlen($doctor['username']) > 0) ? $doctor['username'] : $doctor['doctor_id'] ?>/0">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /location-list -->
                                <?php if ($locations): ?>
                                    <?php foreach ($locations as $key => $location): ?>
                                        <div class="location-list">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="clinic-content">
                                                        <h4 class="clinic-name"><a href="javascript://"><?=$location['name']?></a></h4>
                                                        <p class="doc-speciality"><?=$doctor['service_titles']?></p>
                                                        <p class="doc-speciality"><?=$doctor['specialization_titles']?></p>
                                                        <!-- <div class="rating">
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                            <span class="d-inline-block average-rating">(4)</span>
                                                        </div>
                                                        <div class="clinic-details mb-0">
                                                            <h5 class="clinic-direction"> <i class="feather-map-pin"></i> <?=$location['address_line_1'].' '.$location['cityName'].', '.$location['countryName']?></h5>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="clinic-timing">
                                                        <?=$location['timing_note']?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="consult-price">
                                                        <?=CURRENCY?><?=$location['fee']?>
                                                    </div>
                                                    <div class="clinic-booking">
                                                        <a class="apt-btn" href="<?=BASEURL?>booking/<?=(strlen($doctor['username']) > 0) ? $doctor['username'] : $doctor['doctor_id'] ?>/<?=$location['doctor_hospital_id']?>">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /location-list -->
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div><!-- #doc_locations -->
                            <div role="tabpanel" id="doc_reviews" class="tab-pane fade">
                                <div class="widget review-listing">
                                    <ul class="comments-list">

                                        <?php foreach ($reviews as $key => $review): ?>
                                            <li>
                                                <div class="comment">
                                                    <img class="avatar avatar-sm rounded-circle" alt="User Image" src="<?=UPLOADS.$review['img']?>">
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span class="comment-author"><?=$review['fname'].' '.$review['lname']?></span>
                                                            <span class="comment-date"><?=date('d M, Y',strtotime($review['at']))?></span>
                                                            <div class="review-count rating">
                                                                <?php
                                                                for ($i=1; $i < 6; $i++) { 
                                                                    if ($review['ratting'] >= $i) {
                                                                        echo '<i class="fas fa-star filled"></i>';
                                                                    }
                                                                    else{
                                                                        echo '<i class="fas fa-star"></i>';
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <p class="comment-content">
                                                            <?=$review['review']?>
                                                        </p>
                                                        <!-- <div class="comment-reply">
                                                            <a class="comment-btn" href="#">
                                                                <i class="fas fa-reply"></i> Reply
                                                            </a>
                                                            <p class="recommend-btn">
                                                                <span>Recommend?</span>
                                                                <a href="#" class="like-btn">
                                                                    <i class="far fa-thumbs-up"></i> Yes
                                                                </a>
                                                                <a href="#" class="dislike-btn">
                                                                    <i class="far fa-thumbs-down"></i> No
                                                                </a>
                                                            </p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach ?>


                                    </ul>
                                    <!-- <div class="all-feedback load-more mb-0">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            Show all feedback
                                        </a>
                                    </div> -->
                                </div>
                                <!-- <div class="write-review">
                                    <h4>Write a review for <span class="text-info"><strong>Dr. Darren Elder</strong></span></h4>
                                    <form>
                                        <div class="form-group">
                                            <label>Review</label>
                                            <div class="star-rating">
                                                <input id="star-5" type="radio" name="rating" value="star-5">
                                                <label for="star-5" title="5 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-4" type="radio" name="rating" value="star-4">
                                                <label for="star-4" title="4 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-3" type="radio" name="rating" value="star-3">
                                                <label for="star-3" title="3 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-2" type="radio" name="rating" value="star-2">
                                                <label for="star-2" title="2 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-1" type="radio" name="rating" value="star-1">
                                                <label for="star-1" title="1 star">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Title of your review</label>
                                            <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
                                        </div>
                                        <div class="form-group">
                                            <label>Your review</label>
                                            <textarea id="review_desc" maxlength="100" class="form-control"></textarea>
                                            <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="terms-accept">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="terms_accept">
                                                    <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                        </div>
                                    </form>
                                </div> -->
                            </div>
                            <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="widget business-widget">
                                            <div class="widget-content">
                                                <div class="listing-hours">
                                                    <div class="card-header">
                                                        <div class="listing-day current mb-0 pb-0">
                                                            <div class="day">Today <span class="mt-2">5 Nov 2019</span></div>
                                                            <div class="time-items">
                                                                <span class="open-status"><span class="badge success-status mb-1">Open Now</span></span>
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="listing-day">
                                                            <div class="day">Monday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day">
                                                            <div class="day">Tuesday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day">
                                                            <div class="day">Wednesday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day">
                                                            <div class="day">Thursday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day">
                                                            <div class="day">Friday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day">
                                                            <div class="day">Saturday</div>
                                                            <div class="time-items">
                                                                <span class="time">07:00 AM - 09:00 PM</span>
                                                            </div>
                                                        </div>
                                                        <div class="listing-day closed">
                                                            <div class="day">Sunday</div>
                                                            <div class="time-items">
                                                                <span class="time"><span class="badge danger-status">Closed</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade call-modal" id="voice_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img alt="User Image" src="<?=IMG?>doctors/doctor-thumb-02.jpg" class="call-avatar">
                                        <h4>Dr. Darren Elder</h4>
                                        <span>Connecting...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="voice-call" class="btn call-item call-start"><i class="material-icons">call</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade call-modal" id="video_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img class="call-avatar" src="<?=IMG?>doctors/doctor-thumb-02.jpg" alt="User Image">
                                        <h4>Dr. Darren Elder</h4>
                                        <span>Calling ...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="video-call" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>