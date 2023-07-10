<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Checkout</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
            <div class="col-md-7 col-lg-8">
                <div class="card bill-info">
                    <div class="card-header">
                        <h3 class="card-title">Billing details</h3>
                    </div>
                    <form id="payment-form">
                        <div class="card-body">
                            <div class="info-widget">
                                <h4 class="card-title">Personal Information</h4>
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
                                <div class="exist-customer">Existing Customer? <a href="#">Click here to login</a></div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="info-widget">
                                <h4 class="card-title">Shipping Address</h4>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select name="state_id" class="form-control select22" required>
                                                <option value="">Select</option>
                                                <?php foreach ($states as $key => $state): ?>
                                                    <option value="<?=$state['state_id']?>" <?=($user['state_id'] == $state['state_id']) ? 'selected' : ''?> ><?=$state['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Cities</label>
                                            <select name="city_id" class="form-control select22" required>
                                                <option value="">Select</option>
                                                <?php foreach ($cities as $key => $city): ?>
                                                    <option value="<?=$city['city_id']?>" <?=($user['city_id'] == $city['city_id']) ? 'selected' : ''?> ><?=$city['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address_line_1" value="<?=$user['address_line_1']?>" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Address Optional</label>
                                            <input class="form-control" name="address_line_2" value="<?=$user['address_line_2']?>" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="exist-customer">Existing Customer? <a href="#">Click here to login</a></div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
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
                                            <div class="form-group ">
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
                                        <input type="checkbox" id="terms_accept1" required>
                                        <label for="terms_accept1">I have read and accept <a href="<?=BASEURL.'terms'?>">Terms &amp; Conditions</a></label>
                                    </div>
                                </div>
                                <div class="submit-section mt-4">
                                    <button type="submit" class="btn btn-primary submit-btn" id="payment-form-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 col-lg-4 theiaStickySidebar">
                <div class="card booking-card">
                    <div class="card-header">
                        <h3 class="card-title">Product<span class="float-end">Total</span></h3>
                    </div>
                    <div class="total-table">
                        <div class="table-responsive">
                            <table class="table table-center mb-0">
                                <tbody>
                                    <?php $cartTotal = 0; ?>
                                    <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                                        <tr>
                                            <td><?=$item['title']?></td>
                                            <td class="text-end"><?=number_format($item['total'])?></td>
                                        </tr>
                                        <?php $cartTotal += $item['total'];  ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="booking-summary card-body">
                            <div class="booking-item-wrap">
                                <ul class="booking-date">
                                    <li>Subtotal <span><?=number_format($cartTotal)?></span></li>
                                    <li>Shipping <span>00.00</span></li>
                                </ul>
                                <ul class="booking-fee">
                                    <li>Tax <span>00.00</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="booking-total">
                                <ul class="booking-total-list">
                                    <li>
                                        <span>Total</span>
                                        <span class="total-cost"><?=number_format($cartTotal)?></span>
                                    </li>
                                    <li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>