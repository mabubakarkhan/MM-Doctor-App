<div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Blog</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
                        <div class="card search-widget">
                            <div class="card-body">
                                <form class="search-form">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." class="form-control">
                                        <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card post-widget">
                            <div class="card-header">
                                <h4 class="card-title">Latest Posts</h4>
                            </div>
                            <div class="card-body">
                                <ul class="latest-posts">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <li>
                                            <div class="post-thumb">
                                                <a href="<?=BASEURL?>blog-details">
                                                    <img class="img-fluid" src="assets/img/blog/blog-thumb-01.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <h4>
                                                    <a href="<?=BASEURL?>blog-details">Doccure – Making your clinic painless visit?</a>
                                                </h4>
                                                <p>4 Dec 2021</p>
                                            </div>
                                        </li>
                                    <?php endfor ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card category-widget">
                            <div class="card-header">
                                <h4 class="card-title">Blog Categories</h4>
                            </div>
                            <div class="card-body">
                                <ul class="categories">
                                    <li><a href="#">Cardiology <span>(62)</span></a></li>
                                    <li><a href="#">Health Care <span>(27)</span></a></li>
                                    <li><a href="#">Nutritions <span>(41)</span></a></li>
                                    <li><a href="#">Health Tips <span>(16)</span></a></li>
                                    <li><a href="#">Medical Research <span>(55)</span></a></li>
                                    <li><a href="#">Health Treatment <span>(07)</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card tags-widget">
                            <div class="card-header">
                                <h4 class="card-title">Tags</h4>
                            </div>
                            <div class="card-body">
                                <ul class="tags">
                                    <li><a href="#" class="tag">Children</a></li>
                                    <li><a href="#" class="tag">Disease</a></li>
                                    <li><a href="#" class="tag">Appointment</a></li>
                                    <li><a href="#" class="tag">Booking</a></li>
                                    <li><a href="#" class="tag">Dentists</a></li>
                                    <li><a href="#" class="tag">Specialist</a></li>
                                    <li><a href="#" class="tag">Doccure</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="row blog-grid-row">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <div class="col-md-6 col-sm-12">
                                    <div class="blog grid-blog grid-box">
                                        <div class="blog-image">
                                            <a href="<?=BASEURL?>blog-details"><img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt="Post Image"></a>
                                        </div>
                                        <div class="blog-content">
                                            <ul class="entry-meta meta-item">
                                                <li>
                                                    <div class="post-author">
                                                        <a href="doctor-profile"><img src="assets/img/doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>Dr. Ruby Perrin</span></a>
                                                    </div>
                                                </li>
                                                <li><i class="far fa-clock"></i> 4 Dec 2021</li>
                                            </ul>
                                            <h3 class="blog-title"><a href="<?=BASEURL?>blog-details">Doccure – Making your clinic painless visit?</a></h3>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="blog-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>