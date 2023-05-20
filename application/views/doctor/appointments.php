				<div class="breadcrumb-bar">
					<div class="container-fluid">
						<div class="row align-items-center">
							<div class="col-md-12 col-12">
								<h2 class="breadcrumb-title">Appointments</h2>
								<nav aria-label="breadcrumb" class="page-breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Appointments</li>
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
								<div class="row">
									<?php foreach ($appointments as $key => $q): ?>
										<div class="col-md-12 col-sm-6 col-lg-4 ">
											<div class="card widget-profile pat-widget-profile">
												<div class="card-body">
													<div class="pro-widget-content">
														<div class="profile-info-widget">
															<a href="patient-profile.html" class="booking-doc-img">
																<img src="<?=UPLOADS.$q['patientImg']?>" alt="User Image">
															</a>
															<div class="profile-det-info">
																<h3><a href="javascript://"><?=$q['patientFname'].' '.$q['patientLname']?> </a></h3>
																<div class="appointment-action">
																	<a href="#" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>">
																		<i class="feather-eye"></i>
																	</a>
																	<?php if ($q['status'] == 'confirm'): ?>
																		<span class="badge rounded-pill success-status">Confirm</span>
																	<?php elseif ($q['status'] == 'done'): ?>
																		<span class="badge rounded-pill success-status">Done</span>
																	<?php elseif ($q['status'] == 'pending'): ?>
																		<span class="badge rounded-pill warning-status">Pending</span>
																	<?php elseif ($q['status'] == 'cancel'): ?>
																		<span class="badge rounded-pill danger-status">Cancel</span>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>
													<div class="patient-info">
														<div class="patient-details">
															<h5><i class="fas fa-user-clock"></i> <?=date('d M Y',strtotime($q['appointment_date'])).', '.date('H:i A',strtotime($q['time_start']))?></h5>
															<?php if (isset($q['hospitalName']) && strlen($q['hospitalName']) > 0): ?>
																<h5><i class="fas fa-map-marker-alt"></i> <?=$q['hospitalName']?></h5>
															<?php else: ?>
																<h5><i class="fas fa-map-marker-alt"></i> Online</h5>
															<?php endif ?>
															<h5><i class="fas fa-envelope"></i> <a href="mailto:<?=$q['email']?>" class="__cf_email__"><?=$q['email']?></a></h5>
															<h5 class="mb-0"><i class="fas fa-phone"></i> <?=$q['phone']?></h5>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>