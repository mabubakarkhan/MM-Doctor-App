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
                <?php if (1==2): ?>
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
                <?php endif ?>
                <div class="card post-widget">
                    <div class="card-header">
                        <h4 class="card-title">Latest Posts</h4>
                    </div>
                    <div class="card-body">
                        <ul class="latest-posts">
                            <?php foreach ($home_blogs as $key => $blog_): ?>
                                <li>
                                    <div class="post-thumb">
                                        <a href="<?=BASEURL.'post/'.$blog_['slug']?>">
                                            <img class="img-fluid" src="<?=UPLOADS.$blog_['image']?>" alt="<?=$blog_['title']?>">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
                                            <a href="<?=BASEURL.'post/'.$blog_['slug']?>"><?=$blog_['title']?></a>
                                        </h4>
                                        <p><?=date('d M, Y',strtotime($blog_['updated_at']))?></p>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <?php if (1==2): ?>
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
                <?php endif ?>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row blog-grid-row">
                    <?php foreach ($blogs as $key => $blog): ?>
                        <div class="col-md-6 col-sm-12">
                            <div class="blog grid-blog grid-box">
                                <div class="blog-image">
                                    <a href="<?=BASEURL.'post/'.$blog['slug']?>"><img class="img-fluid" src="<?=UPLOADS.$blog['image']?>" alt="<?=$blog['title']?>"></a>
                                </div>
                                <div class="blog-content">
                                    <ul class="entry-meta meta-item">
                                        <li>
                                            <div class="post-author">
                                                <a href="doctor-profile"><span>By Admin</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-clock"></i> <?=date('d M, Y',strtotime($blog['updated_at']))?></li>
                                    </ul>
                                    <h3 class="blog-title"><a href="<?=BASEURL.'post/'.$blog['slug']?>"><?=$blog['title']?></a></h3>
                                    <p class="mb-0"><?=$blog['short']?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <?php if (1==2): ?>
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
                <?php endif ?>
            </div>
        </div>
    </div>
</div>