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
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="product-description" class="avatar avatar-sm me-2"><img class="avatar-img" src="<?=UPLOADS.$item['image']?>" alt="User Image"></a>
                                        </h2>
                                        <a href="product-description"><?=$item['title']?></a>
                                    </td>
                                    <td><?=number_format($item['price'])?></td>
                                    <td>
                                        <div class="custom-increment cart">
                                            <div class="input-group1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus-2 btn btn-danger btn-number" data-key="<?=$key?>">
                                                        <span><i class="fas fa-minus"></i></span>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class=" input-number" value="<?=$item['qty']?>">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus-2 btn btn-success btn-number" data-key="<?=$key?>">
                                                        <span><i class="fas fa-plus"></i></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="itemTotal"><?=number_format($item['price']*$item['qty'])?></td>
                                    <td class="text-end">
                                        <div class="table-action">
                                            <a href="javascript:void(0);" class="btn btn-sm bg-danger-light deleteCartItem" data-key="<?=$key?>">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $total = $total + ($item['price']*$item['qty']); ?>
                            <?php endforeach ?>
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
                                    <li>Subtotal <span class="total-cost"><?=number_format($total)?></span></li>
                                    <li>Shipping <span>00.00<!-- <a href="#">Calculate shipping</a> --></span></li>
                                </ul>
                                <ul class="booking-fee pt-4">
                                    <li>Tax <span>00.00</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="booking-total">
                            <ul class="booking-total-list">
                                <li>
                                    <span>Total</span>
                                    <span class="total-cost"><?=number_format($total)?></span>
                                </li>
                                <li>
                                    <div class="clinic-booking pt-4">
                                        <a class="apt-btn" href="<?=BASEURL?>cart-checkout">Proceed to checkout</a>
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