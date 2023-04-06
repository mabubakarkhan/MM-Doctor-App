<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<h2 class="breadcrumb-title">Profile Settings</h2>
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
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

				<h4 class="sub-heading">Basic Information</h4>
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
						<form action="update-profile" method="post">
							<div class="row form-row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Username <span class="text-danger">*</span></label>
										<input type="text" value="<?=$userSession['username']?>" class="form-control" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Email <span class="text-danger">*</span></label>
										<input type="email" value="<?=$userSession['email']?>" class="form-control" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name <span class="text-danger">*</span></label>
										<input type="text" name="lname" value="<?=$userSession['lname']?>" class="form-control" required>
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
										<label>Phone Number <span class="text-danger">*</span></label>
										<input type="number" name="phone" value="<?=$userSession['phone']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label>Gender <span class="text-danger">*</span></label>
										<select class="form-select form-control" name="gender" required>
											<option value="">Select</option>
											<option value="male" <?=($userSession['gender'] == 'male') ? 'selected="selected"' : ''?>>Male</option>
											<option value="female" <?=($userSession['gender'] == 'female') ? 'selected="selected"' : ''?>>Female</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label>Date of Birth <span class="text-danger">*</span></label>
										<input type="date" name="dob" value="<?=$userSession['dob']?>" class="form-control" required>
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


				<h4 class="sub-heading">About Me</h4>
				<form action="update-profile" method="post">
					<div class="card">
						<div class="card-body">
							<div class="form-group mb-3">
								<label>Biography</label>
								<textarea class="form-control" name="biography" rows="5"><?=$userSession['biography']?></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
							</div>
						</div>
					</div><!-- /card -->
				</form>


				<h4 class="sub-heading">Clinic Info</h4>
				<form action="update-profile" method="post">
					<div class="card">
						<div class="card-body">
							<div class="row form-row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Clinic Name</label>
										<input type="text" name="clinic_name" value="<?=$userSession['clinic_name']?>" class="form-control">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Clinic Address</label>
										<input type="text"name="clinic_address" value="<?=$userSession['clinic_address']?>"  class="form-control">
									</div>
								</div><!-- /6 -->
								<div class="col-md-12">
									<div class="form-group">
										<label>Clinic Images</label>
										<form action="#" class="dropzone"></form>
									</div>
									<div class="upload-wrap">
										<div class="upload-images">
											<img src="<?=IMG?>icons/feature-01.png" alt="Upload Image">
											<a href="javascript:void(0);" class="btn btn-icon btn-danger btn-sm"><i
													class="far fa-trash-alt"></i></a>
										</div>
										<div class="upload-images">
											<img src="<?=IMG?>icons/feature-01.png" alt="Upload Image">
											<a href="javascript:void(0);" class="btn btn-icon btn-danger btn-sm"><i
													class="far fa-trash-alt"></i></a>
										</div>
									</div>
								</div><!-- /12 -->
								<div class="col-md-6 mt-3">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
						</div><!-- /card-body -->
					</div><!-- /card -->
				</form>


				<h4 class="sub-heading">Contact Details</h4>
				<form action="update-profile" method="post">
					<div class="card contact-card">
						<div class="card-body">
							<div class="row form-row">
								<input type="hidden" name="country_id" value="166">
								<div class="col-md-12">
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
										<select name="state_id" class="form-control" required>
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
										<select name="city_id" class="form-control" required>
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
								<div class="col-md-6">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
						</div><!-- /card-body -->
					</div><!-- /card -->
				</form>


				<h4 class="sub-heading">Pricing</h4>
				<div class="card">
					<div class="card-body">
						<div class="form-group mb-0">
							<div id="pricing_select">
								<label class="payment-radio credit-card-option custom-control-inline mb-0">
									<input type="radio" id="price_free" name="price" value="0" <?=($userSession['price'] == 0) ? 'checked' : ''?> >
									<span class="checkmark"></span>
									Free
								</label>
								<label class="payment-radio credit-card-option mb-0">
									<input type="radio" id="price_custom" name="price" value="1" <?=($userSession['price'] == 1) ? 'checked' : ''?> >
									<span class="checkmark"></span>
									Custom Price (per hour)
								</label>
							</div>
						</div>
						<div class="row custom_price_cont" id="custom_price_cont" style="display: none;">
							<div class="col-md-4">
								<input type="text" class="form-control" id="custom_rating_input"
									name="custom_rating_count" value="" placeholder="20">
								<small class="form-text text-muted">Custom price you can add</small>
							</div>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Services and Specialization</h4>
				<div class="card services-card">
					<div class="card-body">
						<div class="form-group">
							<label>Services</label>
							<input type="text" data-role="tagsinput" class="input-tags form-control"
								placeholder="Enter Services" name="services" value="Tooth cleaning "
								id="services">
							<small class="form-text text-muted">Note : Type & Press enter to add new
								services</small>
						</div>
						<div class="form-group mb-0">
							<label>Specialization </label>
							<input class="input-tags form-control" type="text" data-role="tagsinput"
								placeholder="Enter Specialization" name="specialist"
								value="Children Care,Dental Care" id="specialist">
							<small class="form-text text-muted">Note : Type & Press enter to add new
								specialization</small>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Education</h4>
				<div class="card">
					<div class="card-body">
						<div class="education-info">
							<div class="row form-row education-cont">
								<div class="col-12 col-md-10 col-lg-11">
									<div class="row form-row">
										<div class="col-12 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Degree</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-4">
											<div class="form-group">
												<label>College/Institute</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Year of Completion</label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-education"><i
									class="fa fa-plus-circle"></i> Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Experience</h4>
				<div class="card">
					<div class="card-body">
						<div class="experience-info">
							<div class="row form-row experience-cont">
								<div class="col-12 col-md-10 col-lg-11">
									<div class="row form-row">
										<div class="col-12 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Hospital Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Designation</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-2">
											<div class="form-group">
												<label>From</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-2">
											<div class="form-group">
												<label>To</label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-experience"><i
									class="fa fa-plus-circle"></i> Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Awards</h4>
				<div class="card">
					<div class="card-body">
						<div class="awards-info">
							<div class="row form-row awards-cont">
								<div class="col-12 col-md-5">
									<div class="form-group">
										<label>Awards</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-12 col-md-5">
									<div class="form-group">
										<label>Year</label>
										<input type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i>
								Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Memberships</h4>
				<div class="card">
					<div class="card-body">
						<div class="membership-info">
							<div class="row form-row membership-cont">
								<div class="col-12 col-md-10 col-lg-5">
									<div class="form-group">
										<label>Memberships</label>
										<input type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-membership"><i
									class="fa fa-plus-circle"></i> Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Registrations</h4>
				<div class="card">
					<div class="card-body">
						<div class="registrations-info">
							<div class="row form-row reg-cont">
								<div class="col-12 col-md-5">
									<div class="form-group">
										<label>Registrations</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-12 col-md-5">
									<div class="form-group">
										<label>Year</label>
										<input type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add
								More</a>
						</div>
					</div>
				</div>

				<div class="submit-section submit-btn-bottom">
					<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
				</div>
			</div>




		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->