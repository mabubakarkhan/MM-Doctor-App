<?php $dayNames = array("", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); ?>
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Booking</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <img src="<?=UPLOADS.$doctor['img']?>" class="img-fluid" alt="<?=$doctor['fname'].' '.$doctor['lname']?>">
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name"><?=$doctor['fname'].' '.$doctor['lname']?></h4>
                                    <?php if (isset($doctor['specialization_titles']) && strlen($doctor['specialization_titles']) > 1): ?>
                                        <p class="doc-speciality"><?=$doctor['specialization_titles']?></p>
                                    <?php endif ?>
                                
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                    </div>
                                    <div class="clinic-details">
                                        <?php if (strlen($doctor['cityName']) > 1): ?>
                                            <p class="doc-location"><i class="feather-map-pin"></i> <?=$doctor['cityName']?>, <?=$doctor['countryName']?></p>
                                        <?php endif ?>
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
                            <div class="doc-info-right"></div><!-- /doc-info-right -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /row -->
        <div class="card booking-schedule schedule-widget">
            <div class="schedule-header">
                <div class="date-booking">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                            <h4 class="mb-0"><?=date('d F Y')?></h4>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 col-lg-4 text-sm-center">
                            <p class="text-muted mb-0"><?=date('l')?></p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6 col-lg-4 text-md-end">
                            <div class="bookingrange btn btn-white btn-sm">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span></span>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="schedule-cont">
                <div class="row">
                    <div class="col-md-12">



                        <div class="card schedule-widget mb-0">

                            <div class="schedule-header">

                                <div class="schedule-nav">
                                    <ul class="nav nav-tabs nav-justified">
                                        <?php foreach ($days as $key => $day): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?=(date('l') == $day) ? 'active' : ''?>" data-bs-toggle="tab"
                                                href="#slot_<?=$day?>"><?=$day?></a>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>

                            </div><!-- /schedule-header -->


                            <div class="tab-content schedule-cont">
                                <?php foreach ($days as $key => $day): ?>
                                    <div id="slot_<?=$day?>" class="tab-pane fade <?=(date('l') == $day) ? 'show active' : ''?> ">
                                        <h4 class="card-title d-flex justify-content-between">
                                            <span>Time Slots</span>
                                        </h4>

                                        <div class="time-slot">
                                            <ul class="clearfix">
                                                <?php foreach ($slots as $key_ => $slot): ?>
                                                    <?php if ($slot['day_name'] == $day): ?>
                                                        <li class="mb-2">
                                                            <a class="timing timeSlotIdSelect" data-id="<?=$slot['time_slot_id']?>" data-date="<?=$full_dates[$key]?>" data-title="<?=$day.' ('.date("h:i a",strtotime($slot['time_start'])).' - '.date("h:i a",strtotime($slot['time_end'])).')'?>" href="javascript://">
                                                                <?=date("h:i a",strtotime($slot['time_start']))?>
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div><!-- /time-slot -->

                                    </div><!-- /tab-pane -->
                                <?php endforeach ?>

                            </div><!-- .schedule-cont -->

                        </div><!-- /card -->



                    </div>
                </div>
            </div>
        </div>
        <div class="submit-section proceed-btn text-start">
            <a href="<?=BASEURL?>checkout" class="btn btn-primary submit-btn timeSlotSubmitBtn">Proceed to Pay <span></span></a> <span class="btn btn-success submit-btn timeSlotSelectedTitle" style="display:none;">hello world</span>
        </div>
    </div><!-- /container -->
</div><!-- /content -->
<input type="hidden" name="" id="timeSlotId">
<input type="hidden" name="" id="timeSlotDate">