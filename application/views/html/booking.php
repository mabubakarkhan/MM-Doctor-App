<div class="row">
    <div class="col-md-12">

        <div class="card schedule-widget mb-0 flex-wrap">

            <div class="schedule-header">

                <div class="schedule-nav">
                    <ul class="nav nav-tabs nav-justified">
                        <?php foreach ($full_dates as $key => $day): ?>
                            <li class="nav-item">
                                <a class="nav-link bookingPageDaySelectTabBtn <?=($key == 0) ? 'active' : ''?>" data-date="<?=date('d F Y',strtotime($day))?>" data-day="<?=$days[$key]?>" data-bs-toggle="tab" href="#slot_<?=$day?>" style="font-weight: bold;">
                                    <?=$days[$key]?><br>
                                    <span style="font-size: 10px;font-weight: 100;"><?=date('d-M-y',strtotime($day))?></span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>

            </div><!-- /schedule-header -->


            <div class="tab-content schedule-cont">
                <?php foreach ($full_dates as $key => $day): ?>
                    <div id="slot_<?=$day?>" class="tab-pane fade <?=($key == 0) ? 'show active' : ''?> ">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                        </h4>

                        <div class="time-slot">
                            <ul class="clearfix d-flex flex-wrap">
                                <?php foreach ($slots as $key_ => $slot): ?>
                                    <?php if ($slot['day_name'] == $days[$key]): ?>
                                        <?php
                                        $checkBooked = $this->db->from('appointment')->where('time_slot_id',$slot['time_slot_id'])->where('appointment_date',date('Y-m-d',strtotime($day)))->get()->row();
                                        if ($checkBooked) {
                                        ?>
                                            <li class="mb-2">
                                                <a class="timing" style="background-color: #ff0000;color: #fff;border: 1px solid #ff0000;"  href="javascript://">
                                                    <?=date("h:i a",strtotime($slot['time_start']))?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <li class="mb-2">
                                                <a class="timing timeSlotIdSelect" data-id="<?=$slot['time_slot_id']?>" data-date="<?=$day?>" data-title="<?=$days[$key].' ('.date("h:i a",strtotime($slot['time_start'])).' - '.date("h:i a",strtotime($slot['time_end'])).')'?>" href="javascript://">
                                                    <?=date("h:i a",strtotime($slot['time_start']))?>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div><!-- /time-slot -->

                    </div><!-- /tab-pane -->
                <?php endforeach ?>

            </div><!-- .schedule-cont -->

        </div><!-- /card -->


    </div><!-- /12 -->
</div><!-- /row -->


<style>
    .daily-solts .slick-prev, 
    .daily-solts .slick-next{
        top: -20px;
        width: 20px;
        height: 20px;
        /*background: transparent;*/
    }
    .daily-solts .slick-prev{
        /*right: unset;*/
        /*left: -30px;*/
    }
    .daily-solts .slick-next{
        /*right: 10px;*/
    }
    .daily-solts .slick-prev:hover, 
    .daily-solts .slick-next:hover, 
    .daily-solts .slick-prev:active, 
    .daily-solts .slick-next:active, 
    .daily-solts .slick-prev:focus, 
    .daily-solts .slick-next:focus, 
    .daily-solts .slick-prev:hover:before, 
    .daily-solts .slick-next:hover:before{
        color: #fff;
        background-color: /*transparent*/;
    }
    @media only screen and (max-width: 575.98px){
        .booking-schedule.schedule-widget > div {
            width: 100%;
        }
    }
    .booking-schedule.schedule-widget .schedule-header {
        width: 100%;
    }
    @media only screen and (max-width: 768.98px){
        .booking-schedule .time-slot li {
            -ms-flex: 0 0 110px;
            flex: 0 0 110px;
            width: 110px;
        }
    }
    @media only screen and (max-width: 575.98px){
        .booking-schedule .time-slot li {
            -ms-flex: 0 0 130px;
            flex: 0 0 130px;
            width: 130px;
        }
    }
    .schedule-nav .nav-tabs li{
        padding: 5px;
    }
    .schedule-nav .nav-tabs .nav-link{
        border: 1px solid #0071DC !important
    }
</style>