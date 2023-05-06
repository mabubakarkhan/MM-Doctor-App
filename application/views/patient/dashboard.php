<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<h2 class="breadcrumb-title">
					<?=$page_title?>
				</h2>
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?=$page_title?>
						</li>
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

			<div class="col-md-7 col-lg-8 col-xl-9">
				<?php if (1==2): ?>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
						<div class="card">
							<div class="card-body text-center">
								<div class="mb-3">
									<img src="<?=IMG?>specialities/pt-dashboard-01.png" alt="" width="55">
								</div>
								<h5>Heart Rate</h5>
								<h6>12 bpm</h6>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
						<div class="card">
							<div class="card-body text-center">
								<div class="mb-3">
									<img src="<?=IMG?>specialities/pt-dashboard-02.png" alt="" width="55">
								</div>
								<h5>Body Temperature</h5>
								<h6>18 C</h6>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
						<div class="card">
							<div class="card-body text-center">
								<div class="mb-3">
									<img src="<?=IMG?>specialities/pt-dashboard-03.png" alt="" width="55">
								</div>
								<h5>Glucose Level</h5>
								<h6>70 - 90</h6>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
						<div class="card">
							<div class="card-body text-center">
								<div class="mb-3">
									<img src="<?=IMG?>specialities/pt-dashboard-04.png" alt="" width="55">
								</div>
								<h5>Blood Pressure</h5>
								<h6>202/90 <sub>mg/dl</sub></h6>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4 class="sub-heading mb-4">Patient Appoinment</h4>
					</div>
				</div>
				<div class="row patient-graph-col">
					<div class="col-12">
						<div class="">
							<div class="row">
								<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
									<div class="graph-box">
										<div>
											<h4>BMI Status</h4>
										</div>
										<div class="graph-img">
											<img src="<?=IMG?>specialities/pt-dashboard-04.png" alt="" width="55">
										</div>
										<div class="graph-status-result">
											<span class="graph-update-date">Last Update 6d</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
									<div class="graph-box">
										<div>
											<h4>Heart Rate Status</h4>
										</div>
										<div class="graph-img">
											<img src="<?=IMG?>specialities/pt-dashboard-01.png" alt="" width="55">
										</div>
										<div class="graph-status-result">
											<span class="graph-update-date">Last Update 2d</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
									<div class="graph-box">
										<div>
											<h4>FBC Status</h4>
										</div>
										<div class="graph-img">
											<img src="<?=IMG?>specialities/pt-dashboard-06.png" alt="" width="55">
										</div>
										<div class="graph-status-result">
											<span class="graph-update-date">Last Update 5d</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
									<div class="graph-box">
										<div>
											<h4>Weight Status</h4>
										</div>
										<div class="graph-img">
											<img src="<?=IMG?>specialities/pt-dashboard-07.png" alt="" width="55">
										</div>
										<div class="graph-status-result">
											<span class="graph-update-date">Last Update 3d</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>
				<div class="card">
					<div class="card-header dct-appoinment">

						<nav class="user-tabs mb-0">
							<ul class="nav nav-tabs nav-tabs-bottom">
								<li class="nav-item">
									<a class="nav-link active" href="#pat_appointments"
										data-bs-toggle="tab">Appointments</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#pat_prescriptions" data-bs-toggle="tab">Prescriptions</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#pat_medical_records" data-bs-toggle="tab"><span
											class="med-records">Medical Records</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#pat_billing" data-bs-toggle="tab">Billing</a>
								</li>
							</ul>
						</nav>

					</div>
					<div class="card-body p-0">

						<div class="tab-content pt-0">

							<div id="pat_appointments" class="tab-pane fade show active">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Doctor</th>
														<th>Appt Date</th>
														<th>Booking Date</th>
														<th>Amount</th>
														<th>Follow Up</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($appointments as $key => $q): ?>
														<tr>
															<td>
																<h2 class="table-avatar">
																	<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"
																		class="avatar avatar-sm me-2">
																		<img class="avatar-img rounded-circle"
																			src="<?=UPLOADS.$q['img']?>"
																			alt="User Image">
																	</a>
																	<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"><?=$q['doctorFname'].' '.$q['doctorLname']?>
																		<span><?=$q['specialization_titles']?></span></a>
																</h2>
															</td>
															<td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
															<td><?=date('d M, Y',strtotime($q['at']))?></td>
															<td><?=CURRENCY.number_format($q['total'])?></td>
															<td><?=$q['followup_date']?></td>
															<td>
																<?php if ($q['status'] == 'confirm'): ?>
																	<span class="badge rounded-pill success-status">Confirm</span>
																<?php elseif ($q['status'] == 'done'): ?>
																	<span class="badge rounded-pill success-status">Done</span>
																<?php elseif ($q['status'] == 'pending'): ?>
																	<span class="badge rounded-pill warning-status">Pending</span>
																<?php elseif ($q['status'] == 'cancel'): ?>
																	<span class="badge rounded-pill danger-status">Cancel</span>
																<?php endif ?>
															</td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																		<i class="feather-printer"></i>
																	</a>
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- #pat_appointments -->


							<div class="tab-pane fade" id="pat_prescriptions">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Date </th>
														<th>Name</th>
														<th>Prescription</th>
														<th>Created by </th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($appointments as $key => $q): ?>
														<?php if (strlen($q['prescription_title']) > 1): ?>
															<tr>
																<td><?=date('d M, Y',strtotime($q['appointment_date']))?></td>
																<td><?=$q['prescription_title']?></td>
																<td><?=$q['prescription']?></td>
																<td>
																	<h2 class="table-avatar">
																		<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"
																			class="avatar avatar-sm me-2">
																			<img class="avatar-img rounded-circle"
																				src="<?=UPLOADS.$q['img']?>"
																				alt="User Image">
																		</a>
																		<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"><?=$q['doctorFname'].' '.$q['doctorLname']?>
																			<span><?=$q['specialization_titles']?></span></a>
																	</h2>
																</td>
																<td>
																	<div class="table-action">
																		<a href="javascript:void(0);"
																			class="btn btn-sm bg-primary-light">
																			<i class="feather-printer"></i>
																		</a>
																	</div>
																</td>
															</tr>
														<?php endif ?>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div><!-- /pat_prescriptions -->


							<div id="pat_medical_records" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>ID</th>
														<th>Date </th>
														<th>Description</th>
														<th>Attachment</th>
														<th>Created</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><a href="javascript:void(0);">#MR-0010</a></td>
														<td>14 Nov 2021</td>
														<td>Dental Filling</td>
														<td><a href="#">dental-test.pdf</a></td>
														<td>
															<h2 class="table-avatar">
																<a href="doctor-profile.html"
																	class="avatar avatar-sm me-2">
																	<img class="avatar-img rounded-circle"
																		src="<?=IMG?>doctors/doctor-thumb-01.jpg"
																		alt="User Image">
																</a>
																<a href="doctor-profile.html">Dr. Ruby Perrin
																	<span>Dental</span></a>
															</h2>
														</td>
														<td>
															<div class="table-action">
																<a href="javascript:void(0);"
																	class="btn btn-sm bg-info-light">
																	<i class="feather-eye"></i>
																</a>
																<a href="javascript:void(0);"
																	class="btn btn-sm bg-primary-light">
																	<i class="feather-printer"></i>
																</a>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>


							<div id="pat_billing" class="tab-pane fade">
								<div class="card-table mb-0">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>Invoice No</th>
														<th>Doctor</th>
														<th>Amount</th>
														<th>Paid On</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($appointments as $key => $q): ?>
														<tr>
															<td><?=$q['appointment_id']?></td>
															<td>
																<h2 class="table-avatar">
																	<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"
																		class="avatar avatar-sm me-2">
																		<img class="avatar-img rounded-circle"
																			src="<?=UPLOADS.$q['img']?>"
																			alt="User Image">
																	</a>
																	<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"><?=$q['doctorFname'].' '.$q['doctorLname']?>
																		<span><?=$q['specialization_titles']?></span></a>
																</h2>
															</td>
															<td><?=CURRENCY.number_format($q['total'])?></td>
															<td><?=date('d M, Y',strtotime($q['at']))?></td>
															<td>
																<div class="table-action">
																	<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																		<i class="feather-printer"></i>
																	</a>
																	<a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'pending'): ?>
																		<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
						                                                    <i class="feather-x-circle"></i>
						                                                </a>
																	<?php endif ?>
																</div>
															</td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>