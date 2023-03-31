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
                                <form action="https://doccure.dreamguystech.com/html/template2/search">
                                    <div class="search-item">
                                        <div class="form-group search-location">
                                            <input type="text" class="form-control" placeholder="Search Location">
                                            <span class="form-text">Based on your Location</span>
                                        </div>
                                        <div class="form-group search-info">
                                            <input type="text" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                                            <span class="form-text">Ex : Dental or Sugar Check up etc</span>
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
                    <h2>Clinic and <span>Specialities</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" href="#all" data-bs-toggle="tab">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#neurology" data-bs-toggle="tab">Neurology</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#orthopedic" data-bs-toggle="tab">Orthopedic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#cardiologist" data-bs-toggle="tab">Cardiologist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#dentist" data-bs-toggle="tab">Dentist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#urology" data-bs-toggle="tab">Urology</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="all">
                                <div class="doctor-slider slider">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-03.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Deborah Angel</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-04.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Sofia Brient</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MS - General Surgery, MCh - Urology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Louisiana, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $150 - $250
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-05.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Marvin Campbell</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MD - Ophthalmology, DNB - Ophthalmology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Michigan, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $50 - $700
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-06.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Katharine Berthold</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MS - Orthopaedics, MBBS, M.Ch - Orthopaedics</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Texas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $500
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-07.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Linda Tobin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DM - Neurology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Kansas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $1000
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="search" class="btn btn-secondary see-more">See More</a>
                            </div>
                            <div class="tab-pane" id="neurology">
                                <div class="doctor-slider slider">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-01.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Ruby Perrin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-02.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Darren Elder</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-03.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Deborah Angel</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-04.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Sofia Brient</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MS - General Surgery, MCh - Urology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Louisiana, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $150 - $250
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-07.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Linda Tobin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DM - Neurology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Kansas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $1000
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="search" class="btn btn-secondary see-more">See More</a>
                            </div>
                            <div class="tab-pane" id="orthopedic">
                                <div class="doctor-slider slider">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-04.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Sofia Brient</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MS - General Surgery, MCh - Urology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Louisiana, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $150 - $250
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-05.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Marvin Campbell</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MD - Ophthalmology, DNB - Ophthalmology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Michigan, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $50 - $700
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-03.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Deborah Angel</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-06.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Katharine Berthold</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MS - Orthopaedics, MBBS, M.Ch - Orthopaedics</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Texas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $500
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-07.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Linda Tobin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DM - Neurology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Kansas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $1000
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="search" class="btn btn-secondary see-more">See More</a>
                            </div>
                            <div class="tab-pane" id="cardiologist">
                                <div class="doctor-slider slider">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-05.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Marvin Campbell</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality"> MD - Ophthalmology, DNB - Ophthalmology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Michigan, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $50 - $700
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-03.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Deborah Angel</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-06.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Katharine Berthold</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MS - Orthopaedics, MBBS, M.Ch - Orthopaedics</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Texas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $500
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-07.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Linda Tobin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DM - Neurology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Kansas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $1000
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-04.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Sofia Brient</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MS - General Surgery, MCh - Urology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Louisiana, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $150 - $250
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="search" class="btn btn-secondary see-more">See More</a>
                            </div>
                            <div class="tab-pane" id="urology">
                                <div class="doctor-slider slider">
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-03.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Deborah Angel</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DNB - Cardiology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Georgia, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $400
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-05.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Marvin Campbell</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MD - Ophthalmology, DNB - Ophthalmology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Michigan, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $50 - $700
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-06.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Katharine Berthold</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MS - Orthopaedics, MBBS, M.Ch - Orthopaedics</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Texas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $500
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-07.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Linda Tobin</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MD - General Medicine, DM - Neurology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Kansas, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $100 - $1000
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget">
                                        <div class="doc-img">
                                            <a href="doctor-profile">
                                                <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-04.jpg">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn">
                                                <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <h3 class="title">
                                                <a href="doctor-profile">Sofia Brient</a>
                                                <i class="feather-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">MBBS, MS - General Surgery, MCh - Urology</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <ul class="available-info">
                                                <li>
                                                    <i class="feather-map-pin"></i> Louisiana, USA
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                </li>
                                                <li>
                                                    <i class="far fa-money-bill-alt"></i> $150 - $250
                                                    <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="profile-btn-list">
                                                <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                <a href="booking" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="search" class="btn btn-secondary see-more">See More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-header ">
                            <h2>Available Features in <span>Our Clinic</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        </div>
                        <div class="about-content">
                            <img src="<?=IMG?>feature.png" class="img-fluid" alt="feature">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="feature-list">
                            <div class="row">
                                <?php for ($i = 0; $i < 6; $i++): ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="feature-box">
                                            <div class="feature-img">
                                                <a href="search">
                                                    <img class="img-fluid" alt="Feature Image" src="<?=IMG?>features/feature-05.jpg">
                                                </a>
                                            </div>
                                            <div class="feature-content">
                                                <h3><a href="search">Operation</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor ?>
                                <div class="col-lg-4">
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
                                <?php for ($i = 0; $i < 4; $i++): ?>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="profile-widget">
                                            <div class="doc-img">
                                                <a href="doctor-profile">
                                                    <img class="img-fluid" alt="User Image" src="<?=IMG?>doctors/doctor-08.jpg">
                                                </a>
                                                <a href="javascript:void(0)" class="fav-btn">
                                                    <i class="far fa-bookmark"></i>
                                                </a>
                                            </div>
                                            <div class="pro-content">
                                                <h3 class="title">
                                                    <a href="doctor-profile">Paul Richard</a>
                                                    <i class="feather-check-circle verified"></i>
                                                </h3>
                                                <p class="speciality">MBBS, MD - Dermatology , Venereology & Lepros</p>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                                </div>
                                                <ul class="available-info">
                                                    <li>
                                                        <i class="feather-map-pin"></i> Georgia, USA
                                                    </li>
                                                    <li>
                                                        <i class="far fa-calendar"></i> Available on Fri, 22 Mar
                                                    </li>
                                                    <li>
                                                        <i class="far fa-money-bill-alt"></i> $100 - $400
                                                        <i class="feather-info" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                    </li>
                                                </ul>
                                                <div class="profile-btn-list">
                                                    <a href="doctor-profile" class="btn btn-primary view-btn">View Profile</a>
                                                    <a href="booking" class="btn book-btn">Book Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor ?>
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
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="blog grid-blog">
                                <div class="blog-image">
                                    <a href="<?=BASEURL?>blog-details"><img class="img-fluid" src="<?=IMG?>blog/blog-01.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <h3 class="blog-title"><a href="<?=BASEURL?>blog-details">Doccure – Making your clinic painless visit?</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                    <a href="<?=BASEURL?>blog-details" class="read-link">Read More</a>
                                    <ul class="entry-meta meta-item">
                                        <li>
                                            <div class="post-author">
                                                <a href="doctor-profile"><img src="<?=IMG?>doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>Dr. Ruby Perrin</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-clock"></i> 4 Dec 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>
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