<section class="section section-search">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-wrapper">
                    <div class="banner-header">
                        <h1 class="mb-0">Search Doctor,</h1>
                        <h1 class="text-blue">Make an Appointment</h1>
                        <p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
                    </div>
                    <div class="search-box">
                        <form action="<?=BASEURL.'search'?>" method="GET">
                            <input type="hidden" name="direct" value="true">
                            <div class="search-item">
                                <div class="form-group search-location">
                                    <select name="city_id" id="" class="select2" required>
                                        <option value="">Select City</option>
                                        <?php foreach ($cities as $key => $c): ?>
                                            <option value="<?=$c['city_id']?>"><?=$c['name']?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="form-text">Based on your Location</span>
                                </div>
                                <div class="form-group search-info">
                                    <input type="text" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc" id="homeSearchBar">
                                    <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                                    <div id="searchResp"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary search-btn mt-0">Make Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 banner-img">
                <img src="<?=IMG?>banner.png" class="img-fluid" alt="Logo">
            </div>
        </div>
    </div>
</section>
<section class="section home-tile-section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-md-6">
                <div class="doctor-book-card">
                    <div class="doctor-book-card-icon">
                        <img src="<?=IMG?>icon-04.png" alt="" class="img-fluid">
                    </div>
                    <div class="doctor-book-card-content tile-card-content-1">
                        <h3 class="card-title">Visit a Doctor</h3>
                        <p>We hire the best specialists to deliver top-notch diagnostic services for you.</p>
                        <a href="search">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="doctor-book-card">
                    <div class="doctor-book-card-icon">
                        <img src="<?=IMG?>icon-05.png" alt="" class="img-fluid">
                    </div>
                    <div class="doctor-book-card-content tile-card-content-1">
                        <h3 class="card-title">Find a Pharmacy</h3>
                        <p>We provide the a wide range of medical services, so every person could have the opportunity.</p>
                        <a href="pharmacy-search">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="doctor-book-card">
                    <div class="doctor-book-card-icon">
                        <img src="<?=IMG?>icon-06.png" alt="" class="img-fluid">
                    </div>
                    <div class="doctor-book-card-content tile-card-content-1">
                        <h3 class="card-title">Find a Lab</h3>
                        <p>We use the first-class medical equipment for timely diagnostics of various diseases.</p>
                        <a href="pharmacy-search">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-specialities">
    <div class="container">
        <div class="section-header">
            <h2>Doctors and <span>Specialities</span></h2>
        </div>
        <div class="row">
           <div class="row" id="doctors-specialities-wrap">
                <?=$specializations_featured?>
            </div><!-- #doctors-specialities-wrap -->
        </div>
    </div>
</section>

<section class="section section-features">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-header ">
                    <h2>Available Services in <span>Our Clinic</span></h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
                <div class="about-content">
                    <img src="<?=IMG?>feature.png" class="img-fluid" alt="feature">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="feature-list">
                    <div class="row">
                        <?php foreach ($services as $key => $s): ?>
                            <?php if ($key < 6): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="feature-box">
                                        <div class="feature-img">
                                            <a href="<?=BASEURL.'search?service='.$s['service_id'].'&direct=true'?>">
                                                <img class="img-fluid" alt="Feature Image" src="<?=UPLOADS.$s['image']?>">
                                            </a>
                                        </div>
                                        <div class="feature-content">
                                            <h3><a href="<?=BASEURL.'search?service='.$s['service_id'].'&direct=true'?>"><?=$s['title']?></a></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php break; ?>
                            <?php endif ?>
                        <?php endforeach ?>
                        <div class="col-lg-12">
                            <a href="search" class="btn btn-primary see-more">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-doctor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header">
                    <h2>Book <span>Our Doctor</span></h2>
                </div>
                <div class="our-doctor">
                    <div class="row">
                        <?php foreach ($featured_doctors_for_home as $key => $q): ?>
                            <div class="col-lg-3 col-md-6">
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
                                            <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"><?=$q['fname'].' '.$q['lname']?></a>
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
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-blogs">
    <div class="container">
        <div class="section-header">
            <h2>Blogs and <span>News</span></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="row blog-grid-row">
            <?php foreach ($blogs as $key => $blog): ?>
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="blog grid-blog">
                        <div class="blog-image">
                            <a href="<?=BASEURL.'post/'.$blog['slug']?>"><img class="img-fluid" src="<?=UPLOADS.$blog['image']?>" alt="<?=$blog['title']?>"></a>
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title"><a href="<?=BASEURL.'post/'.$blog['slug']?>"><?=$blog['title']?></a></h3>
                            <p><?=$blog['short']?></p>
                            <a href="<?=BASEURL.'post/'.$blog['slug']?>" class="read-link">Read More</a>
                            <ul class="entry-meta meta-item">
                                <li>
                                    <div class="post-author">
                                        <a href="doctor-profile"><span>By Admin</span></a>
                                    </div>
                                </li>
                                <li><i class="far fa-clock"></i> <?=date('d M, Y',strtotime($blog['updated_at']))?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="view-all">
            <a href="<?=BASEURL?>blog" class="btn btn-secondary see-more">View All</a>
        </div>
    </div>
</section>
<section class="section section-newsletter">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 col-md-8">
                <div class="newsletter-detail">
                    <div class="section-header">
                        <h2><span>Grab Our</span> Newsletter</h2>
                        <p>To receive latest offers and discounts from the shop.</p>
                    </div>
                    <form action="#">
                        <div class="newsletter">
                            <div class="form-group mail-box">
                                <input type="email" class="form-control" placeholder="Enter Your Email Address">
                            </div>
                            <button type="submit" class="btn btn-primary subscribe-btn">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <img src="<?=IMG?>newsletter.png" class="img-fluid" alt="feature">
            </div>
        </div>
    </div>
</section>