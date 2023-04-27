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
						<form action="update-password" method="post">
							<div class="row form-row">
								<div class="col-md-6">
								
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" name="old" class="form-control" required>
									</div>

									<div class="form-group">
										<label>New Password</label>
										<input type="password" name="new" class="form-control" required>
									</div>
									<small class="form-text text-muted">use a combination of at least 5 alpha-numeric & capital characters.</small>
									<div class="form-group mt-3">
										<label>Confirm Password</label>
										<input type="password" name="confirm" class="form-control" required>
									</div>

									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Change</button>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
						</form>


					</div><!-- /card-body -->
				</div><!-- /card -->


			</div>




		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->