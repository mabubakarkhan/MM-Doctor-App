		<div class="breadcrumb-bar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12 col-12">
						<h2 class="breadcrumb-title">Products</h2>
						<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
								<li class="breadcrumb-item active categoryTitle" aria-current="page"><?=$cat['title']?></li>
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
							<div class="card-header">
								<h4 class="card-title mb-0">Filter</h4>
							</div>
							<form id="categorySearchForm">
								<div class="card-body">
									<div class="filter-widget">
										<h4>Categories</h4>
										<?php foreach ($cats as $key => $q): ?>
											<div>
												<label class="custom_check">
													<input type="checkbox" name="category_id[]" value="<?=$q['category_id']?>" <?=($q['category_id'] == $cat['category_id']) ? 'checked' : ''?>>
													<span class="checkmark"></span> <?=$q['title']?>
												</label>
											</div>
										<?php endforeach ?>
									</div>
									<div class="btn-search">
										<button type="submit" class="btn w-100">Search</button>
									</div>
								</div>
							</form>
						</div>

					</div>
					<div class="col-md-7 col-lg-9 col-xl-9">
						<div class="row align-items-center pb-3">
							<div class="col-md-5 col-12 d-md-block d-none custom-short-by">
								<h3 class="title pharmacy-title text-info categoryTitle"><?=$cat['title']?></h3>
								<p class="doc-location mb-2 text-ellipse pharmacy-location"><i class="feather-eye me-1"></i> Showing <span class="products-counter"><?=$productCounter?></span> products</p>
							</div>
							<div class="col-md-7 col-12 d-md-block d-none custom-short-by">
								<div class="sort-by pb-3">
									<span class="sort-title">Sort by</span>
									<span class="sortby-fliter">
										<select class="form-select" id="productSorting">
											<option>Select</option>
											<option value="title-asc" selected>A-Z</option>
											<option value="title-desc">Z-A</option>
											<option value="price-asc">Price low to high</option>
											<option value="price-desc">Price high to low</option>
										</select>
									</span>
								</div>
							</div>
						</div>
						<div class="row products-wrap">

							<?=$products?>

						</div><!-- /row -->
					</div>
				</div>
			</div>
		</div>