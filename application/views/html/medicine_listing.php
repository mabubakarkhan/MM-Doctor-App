<?php if ($products): ?>
	<?php $productsCounter = 0; ?>
	<?php foreach ($products as $key => $q): ?>
		<?php $productsCounter++; ?>
		<div class="col-md-12 col-lg-6 col-xl-4 product-custom">
			<div class="profile-widget">
				<div class="doc-img">
					<a href="<?=BASEURL.'product/'.$q['slug'].'-'.$q['product_id']?>" tabindex="-1">
						<img class="img-fluid" alt="Product image"
							src="<?=UPLOADS.$q['image']?>">
					</a>
					<!-- <a href="javascript:void(0)" class="fav-btn" tabindex="-1">
						<i class="far fa-bookmark"></i>
					</a> -->
				</div>
				<div class="pro-content">
					<h3 class="title">
						<a href="<?=BASEURL.'product/'.$q['slug'].'-'.$q['product_id']?>" tabindex="-1"><?=$q['title']?></a>
					</h3>
					<div class="row align-items-center">
						<div class="col-8">
							<span class="price"><?=CURRENCY.' '.$q['price']?></span>
							<?php if ($q['old_price'] > 0): ?>
								<span class="price-strike"><?=CURRENCY.' '.$q['old_price']?></span>
							<?php endif ?>
						</div>
						<div class="col-4 text-end">
							<a href="javascript://" class="cart-icon"><i
									class="feather-shopping-cart"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	<input type="hidden" class="products-counter" value="<?=$productsCounter?>">
<?php else: ?>
	<input type="hidden" class="products-counter" value="0">
	<p class="alert alert-primary">No product found.</p>
<?php endif ?>