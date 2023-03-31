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
                                    <a href="doctor-profile" class="booking-doc-img">
                                        <img src="<?=IMG?>doctors/doctor-thumb-02.jpg" alt="User Image">
                                    </a>
                                    <div class="booking-info">
                                        <h4><a href="doctor-profile">Dr. Darren Elder</a></h4>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="clinic-details">
                                            <p class="doc-location"><i class="feather-map-pin"></i> Newyork, USA</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-summary border-0">
                                    <div class="booking-item-wrap">
                                        <ul class="booking-date">
                                            <li>Date <span>16 Nov 2019</span></li>
                                            <li>Time <span>10:00 AM</span></li>
                                        </ul>
                                        <ul class="booking-fee">
                                            <li>Consulting Fee <span>$100</span></li>
                                            <li>Booking Fee <span>$10</span></li>
                                            <li class="mb-0">Video Call <span>$50</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li>
                                            <span>Total</span>
                                            <span class="total-cost">$160</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <div class="card book-info">
                            <form action="https://doccure.dreamguystech.com/html/template2/booking-success">
                                <div class="info-widget">
                                    <div class="card-header">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="exist-customer">Existing Customer? <a href="login">Click here to login</a></div>
                                    </div>
                                    <div class="card-body inf-widget">
                                        <div class="payment-widget">
                                            <h4 class="card-title">Payment Method</h4>
                                            <div class="payment-list">
                                                <label class="payment-radio credit-card-option">
                                                    <input type="radio" name="radio" checked>
                                                    <span class="checkmark"></span>
                                                    Credit card
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="card_name">Name on Card</label>
                                                            <input class="form-control" id="card_name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="card_number">Card Number</label>
                                                            <input class="form-control" id="card_number" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="expiry_month">Expiry Month</label>
                                                            <input class="form-control" id="expiry_month" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="expiry_year">Expiry Year</label>
                                                            <input class="form-control" id="expiry_year" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="cvv">CVV</label>
                                                            <input class="form-control" id="cvv" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="payment-list">
                                                <label class="payment-radio paypal-option">
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                    Paypal
                                                </label>
                                            </div>
                                            <div class="terms-accept">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="terms_accept">
                                                    <label for="terms_accept"> I have read and accept <a href="term-condition">Terms &amp; Conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="submit-section mt-4">
                                                <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
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