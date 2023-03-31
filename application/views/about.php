
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">About Us</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <a href="javascript:voide(0);" class="about-titile mb-4">About Doccure</a>
                        <h3 class="mb-4">Company Profile</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porta luctus est interdum pretium. Fusce id tortor fringilla, suscipit turpis ac, varius ex. Cras vel metus ligula. Nam enim ligula, bibendum a iaculis ut, cursus id augue. Proin vitae purus id tortor vehicula scelerisque non in libero.</p>
                        <p class="mb-0">Nulla non turpis sit amet purus pharetra sollicitudin. Proin rutrum urna ut suscipit ullamcorper. Proin sapien felis, dignissim non finibus eget, luctus vel purus. Pellentesque efficitur congue orci ornare accumsan. Nullam ultrices libero vel imperdiet scelerisque. Donec vel mauris eros.</p>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </section>
        <section class="select-category">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Visit a Doctor</h4>
                            <p>We hire the best specialists to deliver top-notch diagnostic services for you.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="<?=IMG?>icons/vect-01.png" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Find a Pharmacy</h4>
                            <p>We provide the a wide range of medical services, so every person could have the opportunity.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="<?=IMG?>icons/vect-02.png" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Find a Lab</h4>
                            <p>We use the first-class medical equipment for timely diagnostics of various diseases.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="<?=IMG?>icons/vect-03.png" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-featurebox">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Available Features in Our Clinic</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="feature-col-list">
                        <?php for ($i = 0; $i < 6; $i++): ?>
                            <div class="feature-col">
                                <div class="feature-subox d-flex flex-wrap justify-content-center">
                                    <img src="<?=IMG?>features/feature-07.jpg" class="img-fluid" alt="Features">
                                    <h4>Operation</h4>
                                </div>
                            </div>
                        <?php endfor ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-specialities">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Clinic and Specialities</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-testimonial">
            <div class="container">
                <div class="section-header text-center mb-4">
                    <h2>Testimonials</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="testimonial-slider slider">
                            <?php for ($i = 0; $i < 6; $i++): ?>
                                <div class="testimonial-item text-center">
                                    <div class="testimonial-img">
                                        <img src="<?=IMG?>patients/patient1.jpg" class="img-fluid" alt="Speciality">
                                    </div>
                                    <div class="testimonial-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <p class="user-name">- Jennifer Robinson</p>
                                        <p class="user-location mb-0">Leland, USA</p>
                                    </div>
                                </div>
                            <?php endfor ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>