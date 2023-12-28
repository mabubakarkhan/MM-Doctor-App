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
				<form action="update-profile" method="post" class="profile-form">
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


				<?php if (1==2): ?>
					<h4 class="sub-heading">Clinic Info</h4>
					<form action="update-profile" method="post" class="profile-form">
					<!-- <form action="update-profile" method="post" class="dropzone profile-form"> -->
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
				<?php endif ?>


				<h4 class="sub-heading">Clinic Info</h4>
				<div class="card contact-card">
					<div class="card-body">

						<div class="table-responsive">
                            <table class="table table-hover table-center mb-5 profile_clinic_lisitng">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Fee</th>
                                        <th>Timing Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php if ($doctor_hospitals): ?>
                                		<?php foreach ($doctor_hospitals as $key => $doctor_hospital): ?>
                                				<?php $hospital_ids[] = $doctor_hospital['hospital_id']; ?>
			                                    <tr id="doctor_hospital_<?=$doctor_hospital['doctor_hospital_id']?>">
			                                        <td><?=$doctor_hospital['name']?></td>
			                                        <td><?=$doctor_hospital['address']?></td>
			                                        <td><?=$doctor_hospital['cityName']?></td>
			                                        <td><?=$doctor_hospital['fee']?></td>
			                                        <td><?=$doctor_hospital['timing_note']?></td>
			                                        <td>
			                                            <div class="table-action">
			                                            	<a href="javascript://" class="btn btn-sm bg-info-light edit-clinic" data-id="<?=$doctor_hospital['doctor_hospital_id']?>" data-name="<?=$doctor_hospital['name']?>" data-fee="<?=$doctor_hospital['fee']?>" data-timing_note="<?=$doctor_hospital['timing_note']?>">
			                                            		<i class="feather-edit"></i>
			                                            	</a>
			                                                <a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital" data-id="<?=$doctor_hospital['doctor_hospital_id']?>" data-hospital-id="<?=$doctor_hospital['hospital_id']?>" data-name="<?=$doctor_hospital['name']?>">
			                                                    <i class="feather-x-circle"></i>
			                                                </a>
			                                            </div>
			                                        </td>
			                                    </tr>
                                		<?php endforeach ?>
                                	<?php endif ?>
                                </tbody>
                            </table>
                        </div><!-- /table-responsive -->

						<form action="add-clinic" method="post" class="profile-form-3">
							<div class="row form-row">
								<div class="col-md-9">
									<div class="form-group">
										<?php var_dump($hospitals); ?>
										<label>Clinic</label>
										<select name="hospital_id" class="form-control select22" required>
											<?php if ($hospitals): ?>
												<option value="">Select Clinic</option>
												<?php foreach ($hospitals as $key => $hospital): ?>
													<?php if (!(in_array($hospital['hospital_id'], $hospital_ids))): ?>
														<option value="<?=$hospital['hospital_id']?>"><?=$hospital['name']?></option>
													<?php endif ?>
												<?php endforeach ?>
											<?php else: ?>
												<option value="">No Clinic Found</option>
											<?php endif ?>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Fee <span class="text-danger">*</span></label>
										<input type="text" name="fee" class="form-control" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Timing Note <span class="text-danger">*</span></label>
										<textarea name="timing_note" id="timing_note_ck_id_2" class="form-control" rows="2" required></textarea>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mt-4">
										<button class="btn btn-primary doctor-dashboard-submit-btn">Add</button>
									</div>
								</div>
							</div>
						</form>
						<p class="alert alert-primary" style="text-align: center;text-transform: capitalize;">or create new</p>
						<form action="add-clinic" method="post" class="profile-form-3">
							<div class="row form-row">
								<input type="hidden" name="country_id" value="166">
								<div class="col-md-9">
									<div class="form-group">
										<label>Clinic Name (add new)</label>
										<input type="text" name="name" class="form-control" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Fee <span class="text-danger">*</span></label>
										<input type="text" name="fee" class="form-control" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Timing Note <span class="text-danger">*</span></label>
										<textarea name="timing_note" id="timing_note_ck_id" class="form-control" rows="2" required></textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Address <span class="text-danger">*</span></label>
										<input type="text" name="address" value="<?=$userSession['address']?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">State / Province <span class="text-danger">*</span></label>
										<select name="state_id" data-city="city_id_clinic_wrap" class="form-control select22" required>
											<option value="">Select State</option>
											<?php foreach ($states as $key => $state): ?>
												<option value="<?=$state['state_id']?>"><?=$state['name']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">City <span class="text-danger">*</span></label>
										<select name="city_id" class="form-control city_id_clinic_wrap select22" required>
											<option value="">Select City</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
						</form>
					</div><!-- /card-body -->
				</div><!-- /contact-card -->


				<h4 class="sub-heading">Contact Details</h4>
				<form action="update-profile" method="post" class="profile-form">
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
								<div class="col-md-6">
									<div class="form-group">
										<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
						</div><!-- /card-body -->
					</div><!-- /card -->
				</form>


				<h4 class="sub-heading">Online Consulting Fee</h4>
				<form action="update-profile" method="post" class="profile-form">
					<div class="card">
						<div class="card-body">
							<div class="form-group mb-0">
								<div id="pricing_select">
									<label class="payment-radio credit-card-option custom-control-inline mb-0">
										<input type="radio" id="price_free" name="fee_type" value="free" <?=($userSession['fee_type'] == 'free') ? 'checked' : ''?> >
										<span class="checkmark"></span>
										Free
									</label>
									<label class="payment-radio credit-card-option mb-0">
										<input type="radio" id="price_custom" name="fee_type" value="custom" <?=($userSession['fee_type'] == 'custom') ? 'checked' : ''?> >
										<span class="checkmark"></span>
										Custom Price (per slot)
									</label>
								</div>
							</div>
							<div class="row custom_price_cont" id="custom_price_cont" <?=($userSession['fee_type'] == 'free') ? 'style="display: none;"' : ''?> >
								<div class="col-md-4">
									<input type="text" class="form-control" id="custom_rating_input" name="fee" value="<?=$userSession['fee']?>" placeholder="Enter Custom Fee">
									<small class="form-text text-muted">Custom price you can add</small>
								</div>
							</div>
							<div class="form-group mt-3">
								<label>Timing Slot Duration <span class="text-danger">*</span></label>
								<select class="form-select form-control mb-0" name="timing_slot_duration">
									<option value="15" <?=('5' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >5 mins</option>
									<option value="15" <?=('10' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >10 mins</option>
									<option value="15" <?=('15' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >15 mins</option>
									<option value="30" <?=('30' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >30 mins</option>
									<option value="45" <?=('45' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >45 mins</option>
									<option value="60" <?=('60' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >1 Hour</option>
								</select>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Online Consulting Timiing Note <span class="text-danger">*</span></label>
										<textarea name="online_consulting_timiing_note" id="timing_note_ck_id_4" class="form-control" rows="2" required><?=$userSession['online_consulting_timiing_note']?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group mt-3">
								<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
							</div>
						</div>
					</div>
				</form>


				<h4 class="sub-heading">Services and Specialization</h4>
				<form action="update-profile" method="post" class="profile-form">
					<div class="card services-card">
						<div class="card-body">
							<!-- <div class="form-group">
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
							</div> -->
							<div class="form-group">
								<label>Specializations</label>
								<?php $specialization_ids = explode(',', $userSession['specialization_ids']); ?>
								<select class="form-control select2 input-tags" name="specializations[]" multiple="multiple">
									<?php foreach ($specializations as $key => $specialization): ?>
										<option value="<?=$specialization['specialization_id'].'%'.$specialization['title']?>" <?=(in_array($specialization['specialization_id'], $specialization_ids)) ? 'selected="selected"' : ''?> ><?=$specialization['title']?></option>
									<?php endforeach ?>
								</select>
								<small class="form-text text-muted">Note : Type & Press enter to add new specialization & you can add multiple specializations at once.</small>
							</div>
							<div class="form-group">
								<label>Services</label>
								<?php $service_ids = explode(',', $userSession['service_ids']); ?>
								<select class="form-control select2 input-tags" name="services[]" multiple="multiple">
									<?php foreach ($services as $key => $service): ?>
										<option value="<?=$service['service_id'].'%'.$service['title']?>" <?=(in_array($service['service_id'], $service_ids)) ? 'selected="selected"' : ''?> ><?=$service['title']?></option>
									<?php endforeach ?>
								</select>
								<small class="form-text text-muted">Note : Type & Press enter to add new service & you can add multiple services at once.</small>
							</div>
							<div class="form-group mt-3">
								<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
							</div>
						</div>
					</div>
				</form>


				<h4 class="sub-heading">Education</h4>
				<div class="card">
					<div class="card-body">
						<form action="update-education" method="post" class="profile-form-2">
							<div class="education-info info-wrap">
								<?php if ($educations): ?>
									<?php foreach ($educations as $key => $education): ?>
										<div class="row form-row education-cont cont-wrap">
											<input type="hidden" name="id[]" value="<?=$education['education_id']?>" value="0" required>
											<input type="hidden" name="delete[]" value="no" required>
											<div class="col-12 col-md-10 col-lg-11">
												<div class="row form-row">
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Degree</label>
															<input type="text" name="degree[]" value="<?=$education['degree']?>" class="form-control" required>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>College/Institute</label>
															<input type="text" name="institute[]" value="<?=$education['institute']?>" class="form-control" required>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Year of Completion</label>
															<input type="text" name="year[]" value="<?=$education['year']?>" class="form-control" required>
														</div>
													</div>
												</div>
											</div>
											<?php if ($key != 0): ?>
												<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>
											<?php endif ?>
										</div><!-- /education-cont -->
									<?php endforeach ?>
								<?php else: ?>
									<div class="row form-row education-cont cont-wrap">
										<input type="hidden" name="id[]" value="0" required>
										<input type="hidden" name="delete[]" value="no" required>
										<div class="col-12 col-md-10 col-lg-11">
											<div class="row form-row">
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Degree</label>
														<input type="text" name="degree[]"  class="form-control" required>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>College/Institute</label>
														<input type="text" name="institute[]" class="form-control" required>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Year of Completion</label>
														<input type="text" name="year[]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /education-cont -->
								<?php endif ?>

							</div><!-- /education-info -->
							<div class="row">
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
								</div>
							</div>
						</form>
						<div class="add-more">
							<a href="javascript://" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
						</div>
					</div>
				</div><!-- /card -->


				<h4 class="sub-heading">Experience</h4>
				<div class="card">
					<div class="card-body">
						<form action="update-experience" method="post" class="profile-form-2">
							<div class="experience-info info-wrap">

								<?php if ($experiences): ?>
									<?php foreach ($experiences as $key => $experience): ?>
										<div class="row form-row experience-cont cont-wrap">
											<input type="hidden" name="id[]" value="<?=$experience['experience_id']?>" value="0" required>
											<input type="hidden" name="delete[]" value="no" required>
											<div class="col-12 col-md-10 col-lg-11">
												<div class="row form-row">
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Hospital Name</label>
															<input type="text" name="hospital[]" value="<?=$experience['hospital']?>" class="form-control" required>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Designation</label>
															<input type="text" name="designation[]" value="<?=$experience['designation']?>" class="form-control" required>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-2">
														<div class="form-group">
															<label>From</label>
															<input type="text" name="from[]" value="<?=$experience['from']?>" class="form-control" required>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-2">
														<div class="form-group">
															<label>To</label>
															<input type="text" name="to[]" value="<?=$experience['to']?>" class="form-control" required>
														</div>
													</div>
												</div>
											</div>
											<?php if ($key != 0): ?>
												<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>
											<?php endif ?>
										</div><!-- /experience-cont -->
									<?php endforeach ?>
								<?php else: ?>
									<div class="row form-row experience-cont cont-wrap">
										<input type="hidden" name="id[]" value="0" required>
										<input type="hidden" name="delete[]" value="no" required>
										<div class="col-12 col-md-10 col-lg-11">
											<div class="row form-row">
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Hospital Name</label>
														<input type="text" name="hospital[]"  class="form-control" required>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Designation</label>
														<input type="text" name="designation[]" class="form-control" required>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-2">
													<div class="form-group">
														<label>From</label>
														<input type="text" name="from[]" class="form-control" required>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-2">
													<div class="form-group">
														<label>To</label>
														<input type="text" name="to[]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /experience-cont -->
								<?php endif ?>

							</div><!-- /experience-info -->
							<div class="row">
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
								</div>
							</div>
						</form>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Awards</h4>
				<div class="card">
					<div class="card-body">
						<form action="update-award" method="post" class="profile-form-2">
							<div class="awards-info info-wrap">

								<?php if ($awards): ?>
									<?php foreach ($awards as $key => $award): ?>
										<div class="row form-row award-cont cont-wrap">
											<input type="hidden" name="id[]" value="<?=$award['award_id']?>" value="0" required>
											<input type="hidden" name="delete[]" value="no" required>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Award</label>
													<input type="text" name="title[]" value="<?=$award['title']?>" class="form-control" required>
												</div>
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" name="year[]" value="<?=$award['year']?>" class="form-control" required>
												</div>
											</div>
											<?php if ($key != 0): ?>
												<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>
											<?php endif ?>
										</div><!-- /award-cont -->
									<?php endforeach ?>
								<?php else: ?>
									<div class="row form-row awards-cont cont-wrap">
										<input type="hidden" name="id[]" value="0" required>
										<input type="hidden" name="delete[]" value="no" required>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Awards</label>
												<input type="text" name="title[]" class="form-control" required>
											</div>
										</div>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Year</label>
												<input type="text" name="year[]" class="form-control" required>
											</div>
										</div>
									</div><!-- /awards-cont -->
								<?php endif ?>


							</div><!-- /awards-info -->
							<div class="row">
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
								</div>
							</div>
						</form>
						<div class="add-more">
							<a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i>
								Add More</a>
						</div>
					</div>
				</div>


				<h4 class="sub-heading">Memberships</h4>
				<div class="card">
					<div class="card-body">
						
						<form action="update-membership" method="post" class="profile-form-2">
							<div class="memberships-info info-wrap">

								<?php if ($memberships): ?>
									<?php foreach ($memberships as $key => $membership): ?>
										<div class="row form-row membership-cont cont-wrap">
											<input type="hidden" name="id[]" value="<?=$membership['membership_id']?>" value="0" required>
											<input type="hidden" name="delete[]" value="no" required>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Membership</label>
													<input type="text" name="title[]" value="<?=$membership['title']?>" class="form-control" required>
												</div>
											</div>
											<?php if ($key != 0): ?>
												<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>
											<?php endif ?>
										</div><!-- /membership-cont -->
									<?php endforeach ?>
								<?php else: ?>
									<div class="row form-row memberships-cont cont-wrap">
										<input type="hidden" name="id[]" value="0" required>
										<input type="hidden" name="delete[]" value="no" required>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Memberships</label>
												<input type="text" name="title[]" class="form-control" required>
											</div>
										</div>
									</div><!-- /memberships-cont -->
								<?php endif ?>

							</div><!-- /awards-info -->
							<div class="row">
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
								</div>
							</div>
						</form>

						<div class="add-more">
							<a href="javascript:void(0);" class="add-membership"><i class="fa fa-plus-circle"></i> Add More</a>
						</div>

					</div>
				</div>


				<h4 class="sub-heading">Registrations</h4>
				<div class="card">
					<div class="card-body">

						<form action="update-registration" method="post" class="profile-form-2">
							<div class="registrations-info info-wrap">

								<?php if ($registrations): ?>
									<?php foreach ($registrations as $key => $registration): ?>
										<div class="row form-row registration-cont cont-wrap">
											<input type="hidden" name="id[]" value="<?=$registration['registration_id']?>" value="0" required>
											<input type="hidden" name="delete[]" value="no" required>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>registration</label>
													<input type="text" name="title[]" value="<?=$registration['title']?>" class="form-control" required>
												</div>
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" name="year[]" value="<?=$registration['year']?>" class="form-control" required>
												</div>
											</div>
											<?php if ($key != 0): ?>
												<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>
											<?php endif ?>
										</div><!-- /registration-cont -->
									<?php endforeach ?>
								<?php else: ?>
									<div class="row form-row registrations-cont cont-wrap">
										<input type="hidden" name="id[]" value="0" required>
										<input type="hidden" name="delete[]" value="no" required>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>registrations</label>
												<input type="text" name="title[]" class="form-control" required>
											</div>
										</div>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Year</label>
												<input type="text" name="year[]" class="form-control" required>
											</div>
										</div>
									</div><!-- /registrations-cont -->
								<?php endif ?>

							</div><!-- /registrations-info -->
							<div class="row">
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary doctor-dashboard-submit-btn" type="submit">Save</button>
								</div>
							</div>
						</form>




						<div class="add-more">
							<a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add
								More</a>
						</div>
					</div>
				</div>

				<!-- <div class="submit-section submit-btn-bottom">
					<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
				</div> -->
			</div>




		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->
