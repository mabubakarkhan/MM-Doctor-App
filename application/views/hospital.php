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
                <h2 class="breadcrumb-title"><?=$hospital['name']?></h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$hospital['name']?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-lg">
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left align-items-center">
                        <div class="doctor-img hospital-image ">
                            <img src="<?=UPLOADS.$hospital['image']?>" class="img-fluid" alt="<?=$hospital['name']?>">
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">
                                <?=$hospital['name']?>
                            </h4>
                            <p class="doc-speciality"><?=$hospital['address']?></p>
                            <div class="clinic-details">
                                <a href="tel:<?=$hospital['phone']?>" class="btn btn-primary"> 
                                    <i class="feather-phone"></i> 
                                    Call Helpline
                                </a>
                                <a class="mb-0 btn btn-outline-secondary" title="Google Map" href="<?=$hospital['google_map']?>">
                                    <i class="feather-map-pin"></i> 
                                </a>
                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                if ($specialities) {
                    ?>
                    <div class="service-list hospital-specialities-list">
                        <h4>Specialities</h4>
                        <ul class="clearfix">
                            <?php foreach ($specialities as $spe): ?>
                                <li>
                                    <img src="<?=UPLOADS.$spe['image']?>" width="70" alt="">
                                    <p>
                                        <?=$spe['title']?>
                                    </p>
                                </li>
                                <li>
                                    <img src="<?=UPLOADS.$spe['image']?>" width="70" alt="">
                                    <p>
                                        <?=$spe['title']?>
                                    </p>
                                </li>
                                <li>
                                    <img src="<?=UPLOADS.$spe['image']?>" width="70" alt="">
                                    <p>
                                        <?=$spe['title']?>
                                    </p>
                                </li>
                                <li>
                                    <img src="<?=UPLOADS.$spe['image']?>" width="70" alt="">
                                    <p>
                                        <?=$spe['title']?>
                                    </p>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                DOCTOR DATA
            </div>
        </div> 
       
        <div class="card">
            <div class="card-body">
                <?php
                if ($services) {
                    ?>
                    <div class="service-list hospital-service-list">
                        <h4>Services</h4>
                        <ul class="clearfix">
                            <?php
                                foreach($services as $service){
                                    echo '<li>'.$service['title'].'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                if ($facilities) {
                    ?>
                    <div class="service-list">
                        <h4>Facilities</h4>
                        <ul class="clearfix">
                            <?php
                                foreach($facilities as $f){
                                    echo '<li>'.$f['title'].'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Contact & Location</h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="clinic-content">
                            <div class="clinic-details mb-0">
                                <h5 class="clinic-direction mb-md-0"> <i class="feather-map-pin"></i> <?=$hospital['address']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="clinic-timing">
                            <h5 class="clinic-direction mb-md-0"> 
                                <i class="feather-clock"></i> 
                                24 Hours Emergency
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="consult-price">
                            <h5 class="clinic-direction mb-md-0"> 
                                <i class="feather-phone"></i> <?=$hospital['phone']?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="widget about-widget">
                        <h4 class="widget-title">About <?=$hospital['name']?></h4>
                    </div>
                    <div class="about-widget mb-5">
                        <?=$hospital['detail']?>
                    </div>
                    <h4 class="widget-title mb-5">Images and videos about <?=$hospital['name']?></h4>
                    <div class="clinic-details">
                        <ul class="ps-0 clinic-gallery hospital-images-gallery">
                            <?php foreach ($photos as $key => $p): ?>
                                <li>
                                    <a href="<?=UPLOADS.$p['img']?>" data-fancybox="gallery">
                                        <img src="<?=UPLOADS.$p['img']?>" alt="<?=$p['type']?>">
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="widget about-widget">
                        <h4 class="widget-title mb-5">Frequently Asked Questions</h4>
                    </div>
                    <div class="accordion faq_accordion" id="faqAccordion">
                        <?php foreach ($faqs as $key => $faq): ?>
                            <div class="accordion-item faq-accordion-card">
                                <h2 class="accordion-header accordion-qus" data-bs-toggle="collapse" data-bs-target="#faq-<?=$faq['faq_id']?>" aria-expanded="true" aria-controls="faq-<?=$faq['faq_id']?>" id="headingOne">
                                    <?=$faq['title']?>
                                </h2>
                                <div id="faq-<?=$faq['faq_id']?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-answer px-0 accordion-body text-sm">
                                        <?=$faq['detail']?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

<style>
    .hospital-image{
        height: 150px;
    }
    .hospital-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 100%;

    }
    @media (min-width: 991px) {
        .hospital-specialities-list ul li{
            width: 25%;
        }
    }
    @media (max-width: 600px) {
        .hospital-specialities-list ul li{
            width: 50%;
            padding-left: 0;
        }
    }
    .hospital-specialities-list ul li::before{
        display: none;
    }
    .hospital-specialities-list ul li{
        justify-content: center;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
    }
    .hospital-specialities-list ul li img{
        width: 60px;
        height: 60px;
        border-radius: 100%;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .hospital-specialities-list ul li p{
        font-weight: 600;
    }
    .hospital-images-gallery .slick-prev, 
    .hospital-images-gallery .slick-next{
        top: 10px;
        width: 0;
        height: 0;
        background: transparent;
    }
    .hospital-images-gallery .slick-prev{
        right: unset;
        left: -30px;
    }
    .hospital-images-gallery .slick-next{
        right: 10px;
    }
    .hospital-images-gallery .slick-prev:hover:before, 
    .hospital-images-gallery .slick-next:hover:before{
        color: #000;
    }
    .faq-accordion-card {
        background: #F7F8FB;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        border: none;
    }
    .faq_accordion h2 {
        font-size: 16px;
        font-weight: 600;
        color: #000066;
        cursor: pointer;
    }
    .faq-accordion-card .accordion-answer {
        color: #46484B;
    }
    .faq-accordion-card .accordion-qus:before {
        float: right !important;
        font-family: FontAwesome;
        content:"\f068";
        padding-right: 5px;
    }
    .faq-accordion-card .accordion-qus.collapsed:before {
        float: right !important;
        content:"\f067";
    }
</style>