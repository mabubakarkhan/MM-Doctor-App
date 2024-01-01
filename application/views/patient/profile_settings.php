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

				<div class="card">
					<div class="card-body">
						<div class="row form-row">
							<div class="col-lg-8 col-xl-6">
								<div class="form-group">
									<div class="change-avatar pro-setting">
										<div class="profile-img">
											<img src="<?=UPLOADS.$userSession['img']?>" class="user-profile-image" alt="User Image">
										</div>
										<div class="custom-file" id="customFile1">
											<label class="custom-file-upload">
												<input type="file" id="profile-img">
												<span class="change-user">
													<i class="feather-upload"></i> choose-file
												</span>
											</label>
											<p class="mb-0">Recommended image size is 512px x 512px</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<form action="update-profile" method="post" class="profile-form">
							<div class="row form-row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone Number <span class="text-danger">*</span></label>
										<input type="number" value="<?=$userSession['phone']?>" class="form-control" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email <span class="text-danger">*</span></label>
										<input type="email" name="email" value="<?=$userSession['email']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name <span class="text-danger">*</span></label>
										<input type="text" name="fname" value="<?=$userSession['fname']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name <span class="text-danger">*</span></label>
										<input type="text" name="lname" value="<?=$userSession['lname']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Gender <span class="text-danger">*</span></label>
										<select class="form-select form-control" name="gender" required>
											<option value="">Select</option>
											<option value="male" <?=($userSession['gender'] == 'male') ? 'selected="selected"' : ''?>>Male</option>
											<option value="female" <?=($userSession['gender'] == 'female') ? 'selected="selected"' : ''?>>Female</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Date of Birth <span class="text-danger">*</span></label>
										<input type="date" name="dob" value="<?=$userSession['dob']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Blood Group <span class="text-danger">*</span></label>
										<select class="form-select form-control" name="blood_group" required>
											<option value="A-" <?=($userSession['blood_group'] == 'A-') ? "selected" : ""?> >A-</option>
											<option value="A+" <?=($userSession['blood_group'] == 'A+') ? "selected" : ""?> >A+</option>
											<option value="B-" <?=($userSession['blood_group'] == 'B-') ? "selected" : ""?> >B-</option>
											<option value="B+" <?=($userSession['blood_group'] == 'B+') ? "selected" : ""?> >B+</option>
											<option value="AB-" <?=($userSession['blood_group'] == 'AB-') ? "selected" : ""?> >AB-</option>
											<option value="AB+" <?=($userSession['blood_group'] == 'AB+') ? "selected" : ""?> >AB+</option>
											<option value="O-" <?=($userSession['blood_group'] == 'O-') ? "selected" : ""?> >O-</option>
											<option value="O+" <?=($userSession['blood_group'] == 'O+') ? "selected" : ""?> >O+</option>
										</select>
									</div>
								</div>
								<input type="hidden" name="country_id" value="166">
								<div class="col-md-6">
									<div class="form-group">
										<label>Address Line 1 <span class="text-danger">*</span></label>
										<input type="text" name="address_line_1" value="<?=$userSession['address_line_1']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Address Line 2</label>
										<input type="text" name="address_line_2" value="<?=$userSession['address_line_2']?>" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">State / Province <span class="text-danger">*</span></label>
										<select name="state_id" data-city="city_id_contact_wrap" class="form-control select22" required>
											<option value="">Select State</option>
											<?php foreach ($states as $key => $state): ?>
												<option value="<?=$state['state_id']?>" <?=($state['state_id'] == $userSession['state_id']) ? "selected='selected'" : ''?> ><?=$state['name']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">City <span class="text-danger">*</span></label>
										<select name="city_id" class="form-control select22 city_id_contact_wrap" required>
											<option value="">Select City</option>
											<?php foreach ($cities as $key => $city): ?>
												<option value="<?=$city['city_id']?>" <?=($city['city_id'] == $userSession['city_id']) ? "selected='selected'" : ''?> ><?=$city['name']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Postal Code <span class="text-danger">*</span></label>
										<input type="text" name="postcode" value="<?=$userSession['postcode']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div>
							</div><!-- /row -->
						</form>

					</div><!-- /card-body -->
				</div><!-- /card -->

			</div><!-- /7 -->




		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->



