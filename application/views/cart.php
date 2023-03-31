<div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Cart</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="card card-table product-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="product-description" class="avatar avatar-sm me-2"><img class="avatar-img" src="<?=IMG?>products/product.jpg" alt="User Image"></a>
                                            </h2>
                                            <a href="product-description">Benzaxapine Croplex</a>
                                        </td>
                                        <td>26565</td>
                                        <td>$19</td>
                                        <td>
                                            <div class="custom-increment cart">
                                                <div class="input-group1">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                            <span><i class="fas fa-minus"></i></span>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity1" name="quantity1" class=" input-number" value="10">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                            <span><i class="fas fa-plus"></i></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$19</td>
                                        <td class="text-end">
                                            <div class="table-action">
                                                <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-x-circle"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="card booking-card">
                            <div class="card-header">
                                <h4 class="card-title">Cart Totals</h4>
                            </div>
                            <div class="card-body">
                                <div class="booking-summary border-0">
                                    <div class="booking-item-wrap">
                                        <ul class="booking-date">
                                            <li>Subtotal <span>$5,877.00</span></li>
                                            <li>Shipping <span>$25.00<a href="#">Calculate shipping</a></span></li>
                                        </ul>
                                        <ul class="booking-fee pt-4">
                                            <li>Tax <span>$0.00</span></li>
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
                                        <li>
                                            <div class="clinic-booking pt-4">
                                                <a class="apt-btn" href="product-checkout">Proceed to checkout</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>