<div class="row">
    <div class="col-md-12">

        <div class="card schedule-widget mb-0">

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
                            <ul class="clearfix">
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
