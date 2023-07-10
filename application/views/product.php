<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<h2 class="breadcrumb-title"><?=$product['title']?></h2>
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?=$product['title']?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>


		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">

						<div class="card search-filter">
							<div class="card-body">
								<div class="clini-infos mt-0">
									<h2>
										<?=CURRENCY.' '.$product['price']?> 
										<?php if ($product['old_price'] > 0): ?>
											<b class="text-lg strike"><?=CURRENCY.' '.$product['old_price']?></b> 
										<?php endif ?>
									</h2>
								</div>
								<span class="badge success-status">In stock</span>
								<?php
								$btnText = 'Add To Cart';
								$key = 'false';
								$item['qty'] = 1;
								?>
								<?php if (in_array($product['product_id'], $_SESSION['cart_ids'])): ?>
									<?php
									$btnText = 'Update Quantity';
									?>
									<?php foreach ($_SESSION['cart'] as $key => $item): ?>
										<?php if ($item['product_id'] == $product['product_id']): ?>
											<?php break; ?>
										<?php endif ?>
									<?php endforeach ?>
									<input type="hidden" id="cartItemKey" value="<?=$key?>">
									<div class="custom-increment pt-4">
										<div class="input-group1">
											<span class="input-group-btn float-start">
												<button type="button" class="quantity-left-minus btn btn-danger btn-number"
													data-type="minus" data-field="">
													<span><i class="fas fa-minus"></i></span>
												</button>
											</span>
											<input type="text" id="quantity" name="quantity" class=" input-number"
												value="<?=$item['qty']?>">
											<span class="input-group-btn float-end">
												<button type="button" class="quantity-right-plus btn btn-success btn-number"
													data-type="plus" data-field="">
													<span><i class="fas fa-plus"></i></span>
												</button>
											</span>
										</div>
									</div>
									<div class="clinic-details mt-4">
										<div class="clinic-booking">
											<a class="apt-btn add-to-cart-btn" href="javascript://" data-id="<?=$product['product_id']?>"><?=$btnText?></a>
										</div>
									</div>
								<?php else: ?>
									<input type="hidden" id="cartItemKey" value="<?=$key?>">
									<div class="custom-increment pt-4">
										<div class="input-group1">
											<span class="input-group-btn float-start">
												<button type="button" class="quantity-left-minus btn btn-danger btn-number"
													data-type="minus" data-field="">
													<span><i class="fas fa-minus"></i></span>
												</button>
											</span>
											<input type="text" id="quantity" name="quantity" class=" input-number"
												value="1">
											<span class="input-group-btn float-end">
												<button type="button" class="quantity-right-plus btn btn-success btn-number"
													data-type="plus" data-field="">
													<span><i class="fas fa-plus"></i></span>
												</button>
											</span>
										</div>
									</div>
									<div class="clinic-details mt-4">
										<div class="clinic-booking">
											<a class="apt-btn add-to-cart-btn" href="javascript://" data-id="<?=$product['product_id']?>">Add To Cart</a>
										</div>
									</div>
								<?php endif ?>
								<!-- <div class="flex-fill mt-4 mb-0">
									<ul class="list-group clinic-group">
										<li class="list-group-item">SKU <span class="float-end">201902-0057</span></li>
										<li class="list-group-item">Pack Size <span class="float-end">100g</span></li>
										<li class="list-group-item">Unit Count <span class="float-end">200ml</span></li>
										<li class="list-group-item">Country <span class="float-end">Japan</span></li>
									</ul>
								</div> -->
							</div>
						</div>
						<div class="search-filter">
							<div class="">
								<div class="flex-fill mt-0 mb-0">
									<ul class="list-group benifits-col">
										<li class="list-group-item d-flex align-items-center">
											<div>
												<i class="feather-truck"></i>
											</div>
											<div>
												Free Shipping<br><span class="text-sm">For orders from $50</span>
											</div>
										</li>
										<li class="list-group-item d-flex align-items-center">
											<div>
												<i class="feather-help-circle"></i>
											</div>
											<div>
												Support 24/7<br><span class="text-sm">Call us anytime</span>
											</div>
										</li>
										<li class="list-group-item d-flex align-items-center">
											<div>
												<i class="feather-shield"></i>
											</div>
											<div>
												100% Safety<br><span class="text-sm">Only secure payments</span>
											</div>
										</li>
										<li class="list-group-item d-flex align-items-center">
											<div>
												<i class="feather-tag"></i>
											</div>
											<div>
												Hot Offers<br><span class="text-sm">Discounts up to 90%</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-7 col-lg-9 col-xl-9">

						<div class="card">
							<div class="card-body product-description">
								<div class="doctor-widget">
									<div class="doc-info-left w-100">
										<div class="doctor-img1">
											<div>
												<img src="<?=UPLOADS.$product['image']?>" class="img-fluid" alt="<?=$product['title']?>">
											</div>
											<div class="mt-4">
												<div class="clinic-details">
							                        <ul class="ps-0 clinic-gallery pharmacy-product-images-gallery">
							                        	<li>
						                                    <a href="<?=UPLOADS.$product['image']?>" data-fancybox="gallery">
						                                        <img src="<?=UPLOADS.$product['image']?>" alt="<?=$product['title']?>">
						                                    </a>
						                                </li>
							                            <?php foreach ($photos as $key => $p): ?>
							                                <li>
							                                    <a href="<?=UPLOADS.$p['img']?>" data-fancybox="gallery">
							                                        <img src="<?=UPLOADS.$p['img']?>" alt="<?=$product['title']?>">
							                                    </a>
							                                </li>
							                            <?php endforeach ?>
							                        </ul>
							                    </div>
											</div>
										</div>
										<div class="doc-info-cont">
											<h4 class="doc-name"><?=$product['title']?></h4>
											<p><span class="text-muted">Category </span> <a href="<?=BASEURL.'category/'.$product['categorySlug']?>"><?=$product['category']?></a></p>
											<p><?=$product['tag_line']?></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-body">

								<h3 class="sub-heading">Product Details</h3>


								<div class="product-infos">

									<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
										<div class="row">
											<div class="col-md-12">
												<?=$product['detail']?>
											</div><!-- /12 -->
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>


<style>

    .clinic-details ul.pharmacy-product-images-gallery li a{
    	width: 100%;
    }
    .clinic-details ul.pharmacy-product-images-gallery li a img{
    	width: 100%;
    	height: 50px;
    	padding: 5px;
    	border-radius: 10px;
    } 
    .pharmacy-product-images-gallery .slick-prev, 
    .pharmacy-product-images-gallery .slick-next{
        top: 16px;
        width: 0;
        height: 0;
        background: transparent;
    }
    .pharmacy-product-images-gallery .slick-prev{
        right: unset;
        left: -10px;
    }
    .pharmacy-product-images-gallery .slick-next{
        right: 0px;
    }
    .pharmacy-product-images-gallery .slick-prev:hover:before, 
    .pharmacy-product-images-gallery .slick-next:hover:before{
        color: #000;
    }

</style>