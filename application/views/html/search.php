<?php if ($data): ?>
<?php foreach ($data as $key => $q): ?>
    <?php $doctorId = $q['doctor_id']; ?>
    <div class="card">
        <div class="card-body">
            <div class="doctor-widget">
                <div class="doc-info-left">
                    <div class="doctor-img">
                        <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>">
                            <img src="<?=UPLOADS.$q['img']?>" class="img-fluid" alt="User Image">
                        </a>
                    </div>
                    <div class="doc-info-cont">
                        <h4 class="doc-name"><a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"> <?=$q['fname'].' '.$q['lname']?> <!-- <i class="feather-check-circle verified ms-2"></i> --></a></h4>
                        <p class="doc-speciality"><?=$q['specialization_titles']?></p>
                        <p><i class="feather-map-pin"></i> Florida, USA</p>
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
                            <span class="d-inline-block average-rating"><?=$q['ratting']?> ( <?=$q['review_count']?> )</span>
                        </div>
                        <!-- <h5 class="doc-department"><img src="<?=IMG?>specialities/specialities-05.png" class="img-fluid" alt="Speciality">Dentist</h5> -->
                        <?php if (1==2): ?>
                        <div class="clinic-details">
                            <ul class="clinic-gallery">
                                <li>
                                    <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">
                                        <img src="<?=IMG?>features/feature-01.jpg" alt="Feature">
                                    </a>
                                </li>
                                <li>
                                    <a href="assets/img/features/feature-02.jpg" data-fancybox="gallery">
                                        <img src="<?=IMG?>features/feature-02.jpg" alt="Feature">
                                    </a>
                                </li>
                                <li>
                                    <a href="assets/img/features/feature-03.jpg" data-fancybox="gallery">
                                        <img src="<?=IMG?>features/feature-03.jpg" alt="Feature">
                                    </a>
                                </li>
                                <li>
                                    <a href="assets/img/features/feature-04.jpg" data-fancybox="gallery">
                                        <img src="<?=IMG?>features/feature-04.jpg" alt="Feature">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php endif ?>
                        <div class="clinic-services">
                            <?php
                            $services_ = explode(',', $q['service_titles']);
                            foreach ($services_ as $keyService => $service_) {
                                echo '<span>'.$service_.'</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="doc-info-right">
                    <div class="clinic-booking">
                        <a class="view-pro-btn" href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>">View Profile</a>
                        <a class="apt-btn" href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>">Book Now</a>
                    </div>
                </div>
                <hr>
                <style>
                    .dd-hospital-carddetails {
/*                        display: flex;*/
/*                        flex-wrap: nowrap;*/
                    }
                    .dd-hospital-carddetails>div{
                        width: 100%;
                    }
                    .dd-hospital-carddetails>div a{
                        border: 1px solid #006;
                        position: relative;
                        display: block;
                        overflow: visible;
                        border-radius: 10px;
                        width: 100%;
                    }
                    .listing-locations{
                        padding: 12px !important;
                        width: 100%;
                    }
                    .dd-hospital-carddetails .slick-dots{
                        margin-bottom: 0;
                        bottom: -15px;
                    }
                </style>
            </div>
            <div class="dd-hospital-carddetails testimonial-slider">
                <?php
                $todayDate = date('Y-m-d');
                $finalSlots = array();
                $availableDate = false;
                $hospitalId = 0;
                $currentDay = date('N');
                $slots = $this->db->query("
                    SELECT DISTINCT(`day_number`) AS 'dayNumber' 
                    FROM `time_slot`
                    WHERE `hospital_id` = '$hospitalId' AND `doctor_id` = '$doctorId' 
                    ORDER BY `day_number` ASC
                ;");
                if ($slots->num_rows()>0) {
                    foreach ($slots->result_array() as $slot) {
                        $finalSlots[] = $slot['dayNumber'];
                    }
                    for ($i=0; $i < 7; $i++) {
                        if ($currentDay == 8) { $currentDay = 1; } //reset week
                        if (in_array($currentDay, $finalSlots)) {
                            $checkAvailableDay = $this->db->query("
                                SELECT ts.time_slot_id, ts.day_name, a.appointment_id 
                                FROM `time_slot` AS ts 
                                INNER JOIN `appointment` AS a ON ts.time_slot_id = a.time_slot_id 
                                WHERE ts.hospital_id = '$hospitalId' AND ts.doctor_id = '$doctorId' AND ts.day_number = '$currentDay' AND a.appointment_date = '$todayDate'
                            ;");
                            if (!($checkAvailableDay->num_rows()>0)) {
                                $availableDate = true;
                                break;
                            }
                        }
                        if ($i == 6) { $i = 0; } //reset loop
                        $currentDay++;
                        $todayDate = date('Y-m-d', strtotime($todayDate . ' +1 day'));
                    }
                }//check slots created for Day Number
                ?>
                <div>
                    <?php
                    $redirectUrl = 'javascript://';
                    if ($availableDate) {
                        $userName = (strlen($q['username']) > 0) ? $q['username'] : $q['doctor_id'];
                        $redirectUrl = BASEURL.'booking/'.$userName.'/0?date='.$todayDate;
                    }
                    ?>
                    <a href="<?=$redirectUrl?>">
                        <div class="p-2 listing-locations">
                            <div class="d-flex font-size-14 font-weight-medium align-items-center">
                                <span class="text-truncate d-block mb-1 font-weight-medium">Online Consultation</span>
                            </div>
                            <div class="d-flex justify-content-between font-size-11-2">
                                <div class="px-2 text-truncate font-weight-medium">
                                    <div class="row align-items-center text-available text-decoration-none">
                                        <span class="mr-2 icon-available"></span>
                                        <?php if ($availableDate): ?>
                                            <span class="col pl-0 text-truncate font-size-14 font-weight-normal" style="color: green">Available <?=date('D,j M, Y',strtotime($todayDate))?></span>
                                        <?php else: ?>
                                            <span class="col pl-0 text-truncate font-size-14 font-weight-normal" style="color: red">Not Available</span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="d-inline-flex flex-shrink-0 ml-auto font-size-14 font-weight-medium">
                                    <span class="doctor-fee">
                                        <?php if ($q['fee_type'] == 'free'): ?>
                                            free
                                        <?php else: ?>
                                            <?=CURRENCY?><?=$q['fee']?>
                                        <?php endif ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                $todayDate = date('Y-m-d');
                $doctorHospitals = $this->db->query("
                    SELECT dh.doctor_hospital_id, dh.hospital_id, dh.fee, dh.timing_note, h.name, h.address, c.name AS cityName 
                    FROM `doctor_hospital` AS dh 
                    INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
                    INNER JOIN `city` AS c ON h.city_id = c.city_id 
                    WHERE dh.doctor_id = '$doctorId' 
                    ORDER BY h.name ASC 
                ;");
                if ($doctorHospitals->num_rows()>0){
                    foreach ($doctorHospitals->result_array() as $dh) {
                        $finalSlots = array();
                        $availableDate = false;
                        $hospitalId = $dh['hospital_id'];
                        $currentDay = date('N');
                        $slots = $this->db->query("
                            SELECT DISTINCT(`day_number`) AS 'dayNumber' 
                            FROM `time_slot`
                            WHERE `hospital_id` = '$hospitalId' AND `doctor_id` = '$doctorId' 
                            ORDER BY `day_number` ASC
                        ;");
                        if ($slots->num_rows()>0) {
                            foreach ($slots->result_array() as $slot) {
                                $finalSlots[] = $slot['dayNumber'];
                            }
                            for ($i=0; $i < 7; $i++) {
                                if ($currentDay == 8) { $currentDay = 1; } //reset week
                                if (in_array($currentDay, $finalSlots)) {
                                    $checkAvailableDay = $this->db->query("
                                        SELECT ts.time_slot_id, ts.day_name, a.appointment_id 
                                        FROM `time_slot` AS ts 
                                        INNER JOIN `appointment` AS a ON ts.time_slot_id = a.time_slot_id 
                                        WHERE ts.hospital_id = '$hospitalId' AND ts.doctor_id = '$doctorId' AND ts.day_number = '$currentDay' AND a.appointment_date = '$todayDate'
                                    ;");
                                    if (!($checkAvailableDay->num_rows()>0)) {
                                        $availableDate = true;
                                        break;
                                    }
                                }
                                if ($i == 6) { $i = 0; } //reset loop
                                $currentDay++;
                                $todayDate = date('Y-m-d', strtotime($todayDate . ' +1 day'));
                            }
                        }//check slots created for Day Number
                ?>
                        <div>
                            <?php
                            $redirectUrl = 'javascript://';
                            if ($availableDate) {
                                $userName = (strlen($q['username']) > 0) ? $q['username'] : $q['doctor_id'];
                                $redirectUrl = BASEURL.'booking/'.$userName.'/'.$dh['doctor_hospital_id'].'?date='.$todayDate;
                            }
                            ?>
                            <a href="<?=$redirectUrl?>">
                                <div class="p-2 listing-locations">
                                    <div class="d-flex font-size-14 font-weight-medium align-items-center">
                                        <span class="text-truncate d-block mb-1 font-weight-medium"><?=$dh['name']?></span>
                                    </div>
                                    <div class="d-flex justify-content-between font-size-11-2">
                                        <div class="px-2 text-truncate font-weight-medium">
                                            <div class="row align-items-center text-available text-decoration-none">
                                                <span class="mr-2 icon-available"></span>
                                                <?php if ($availableDate): ?>
                                                    <span class="col pl-0 text-truncate font-size-14 font-weight-normal" style="color: green">Available <?=date('D,j M, Y',strtotime($todayDate))?></span>
                                                <?php else: ?>
                                                    <span class="col pl-0 text-truncate font-size-14 font-weight-normal" style="color: red">Not Available</span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="d-inline-flex flex-shrink-0 ml-auto font-size-14 font-weight-medium">
                                            <span class="doctor-fee">
                                                <?=CURRENCY?><?=$dh['fee']?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    }//foreach
                }//main IF
                ?>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php else: ?>
    <p class="alert alert-danger">No doctor found</p>
<?php endif ?>