<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<h2 class="breadcrumb-title"><?=$page_title?></h2>
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?=$page_title?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>


<div class="content">
	<div class="container-fluid">
		<div class="row">

			<?php require_once('menu.php'); ?>


			<div class="col-md-7 col-lg-8 col-xl-9 basic-info">

				<h4 class="sub-heading"><?=$page_title?></h4>
				<div class="card">
					<div class="card-body">
						<form action="update-profile" method="post">
							<div class="row form-row">
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Facebook URL</label>
										<input type="text" name="facebook" value="<?=$userSession['facebook']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Twitter URL</label>
										<input type="text" name="twitter" value="<?=$userSession['twitter']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Instagram URL</label>
										<input type="text" name="instagram" value="<?=$userSession['instagram']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Pinterest URL</label>
										<input type="text" name="pinterest" value="<?=$userSession['pinterest']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Linkedin URL</label>
										<input type="text" name="linkedin" value="<?=$userSession['linkedin']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Youtube URL</label>
										<input type="text" name="youtube" value="<?=$userSession['youtube']?>" class="form-control">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div>
							</div><!-- /row -->
						</form>

					</div><!-- /card-body -->
				</div><!-- /card -->


			</div>




		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->