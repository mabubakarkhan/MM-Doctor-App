<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Checkout</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 theiaStickySidebar">
                <div class="card booking-card">
                    <div class="card-header">
                        <h4 class="card-title">Booking Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($doctor['username']) > 1) ? $doctor['username'] : $doctor['doctor_id']?>" class="booking-doc-img">
                                <img src="<?=UPLOADS.$doctor['img']?>" class="img-fluid" alt="<?=$doctor['fname'].' '.$doctor['lname']?>">
                            </a>
                            <div class="booking-info">
                                <h4 class="doc-name"><a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($doctor['username']) > 1) ? $doctor['username'] : $doctor['doctor_id']?>"><?=$doctor['fname'].' '.$doctor['lname']?></a></h4>
                                <?php if (isset($doctor['specialization_titles']) && strlen($doctor['specialization_titles']) > 1): ?>
                                    <p class="doc-speciality"><?=$doctor['specialization_titles']?></p>
                                <?php endif ?>
                                <div class="rating">
                                    <?php
                                    for ($i=1; $i < 6; $i++) { 
                                        if ($doctor['ratting'] >= $i) {
                                            echo '<i class="fas fa-star filled"></i>';
                                        }
                                        else{
                                            echo '<i class="fas fa-star"></i>';
                                        }
                                    }
                                    ?>
                                    <span class="d-inline-block average-rating"><?=$doctor['ratting']?> ( <?=$doctor['review_count']?> )</span>
                                </div>
                                <div class="clinic-details">
                                    <?php if (strlen($doctor['cityName']) > 1): ?>
                                        <p class="doc-location"><i class="feather-map-pin"></i> <?=$doctor['cityName']?>, <?=$doctor['countryName']?></p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="booking-summary border-0">
                            <div class="booking-item-wrap">
                                <ul class="booking-date">
                                    <li>Date <span><?=date('D d F, Y',strtotime($date))?></span></li>
                                    <li>Star <span><?=date('h:i a',strtotime($slot['time_start']))?></span></li>
                                    <li>End <span><?=date('h:i a',strtotime($slot['time_end']))?></span></li>
                                </ul>
                                <ul class="booking-fee">
                                    <?php if ($hospital): ?>
                                        <?php $doctorFee = $hospital['fee']; ?>
                                        <li>Consulting Fee <span><?=CURRENCY?><?=$hospital['fee']?></span></li>
                                    <?php else: ?>
                                        <?php
                                        if ($doctor['fee_type'] != 'free') {
                                        ?>
                                            <?php $doctorFee = $doctor['fee']; ?>
                                            <li>Consulting Fee <span><?=CURRENCY?><?=$doctor['fee']?></span></li>
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <?php $doctorFee = 0; ?>
                                            <li>Consulting Fee <span><?=CURRENCY?>0</span></li>
                                        <?php
                                        }
                                        ?>
                                    <?php endif ?>
                                    <li>Booking Fee <span><?=CURRENCY?>10</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="booking-total">
                            <ul class="booking-total-list">
                                <li>
                                    <span>Total</span>
                                    <span class="total-cost"><?=CURRENCY?><?=$doctorFee+10?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
                <div class="card book-info">
                    <form class="checkout-form" action="#"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                    id="payment-form">
                    <input type="hidden" name="time_slot_id" value="<?=$slot['time_slot_id']?>">
                    <input type="hidden" name="doctor_id" value="<?=$doctor['doctor_id']?>">
                    <input type="hidden" name="hospital_id" value="<?=(isset($hospital['hospital_id'])) ? $hospital['hospital_id'] : 0?>">
                    <input type="hidden" name="patient_id" value="<?=$user['patient_id']?>">
                    <input type="hidden" name="fee" value="<?=$doctorFee?>">
                    <input type="hidden" name="time_start" value="<?=$slot['time_start']?>">
                    <input type="hidden" name="time_end" value="<?=$slot['time_end']?>">
                    <input type="hidden" name="appointment_date" value="<?=$date?>">
                        <div class="info-widget">
                            <div class="card-header">
                                <h4 class="card-title">Personal Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="fname" value="<?=$user['fname']?>" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="lname" value="<?=$user['lname']?>" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" value="<?=$user['email']?>" type="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" value="<?=$user['phone']?>" type="text" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body inf-widget">
                                <div class="payment-widget">
                                    <h4 class="card-title">Payment Method</h4>
                                    <div class="payment-list">
                                        <label class="payment-radio credit-card-option">
                                            <input type="radio" name="payment_method" value="online" checked>
                                            <span class="checkmark"></span>
                                            Credit card
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="card_name">Name on Card</label>
                                                    <input class="form-control card-input" id="card-name" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="card_number">Card Number</label>
                                                    <input class="form-control card-input" id="card-number" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expiry_month">Expiry Month</label>
                                                    <input class="form-control card-input" id="card-expiry-month" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expiry_year">Expiry Year</label>
                                                    <input class="form-control card-input" id="card-expiry-year" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cvv">CVV</label>
                                                    <input class="form-control card-input" id="card-cvc" type="text" required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="stripe_token" id="stripe_token">
                                        </div>
                                    </div>
                                    <div class="payment-list">
                                        <label class="payment-radio paypal-option">
                                            <input type="radio" name="payment_method" value="cash">
                                            <span class="checkmark"></span>
                                            Cash on delivery
                                        </label>
                                    </div>
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="terms_accept">
                                            <label for="terms_accept"> I have read and accept <a href="term-condition">Terms &amp; Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="submit-section mt-4">
                                        <button type="submit" class="btn btn-primary submit-btn checkout-form-btn">Confirm and Pay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>