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


			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="row">
					<div class="col-md-12">
						<div class="dash-card">
							<div class="">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget dct-border-rht">
											<div class="dash-widget-info">
												<h6 class="text-success">Earned</h6>
												<div class="dash-widget-count">
													<h3><?=number_format($userSession['earned'])?></h3>
												</div>
											</div>
											<div class="graph">
												<img src="<?=IMG?>icons/icon-02.png" class="img-fluid"
													alt="patient">
											</div>
										</div>
									</div>
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget">
											<div class="dash-widget-info">
												<h6 class="text-info">Balance</h6>
												<div class="dash-widget-count">
													<h3><?=number_format($userSession['balance'])?></h3>
												</div>
											</div>
											<div class="graph">
												<img src="<?=IMG?>icons/icon-03.png" class="img-fluid"
													alt="patient">
											</div>
										</div>
									</div>
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget">
											<div class="dash-widget-info">
												<h6 class="text-danger">PayAble</h6>
												<div class="dash-widget-count">
													<h3><?=number_format($userSession['payable'])?></h3>
												</div>
											</div>
											<div class="graph">
												<img src="<?=IMG?>icons/icon-01.png" class="img-fluid"
													alt="patient">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4 class="sub-heading">Patient Appoinment</h4>
						<div class="appointment-tab">

							<ul class="nav nav-tabs nav-tabs-solid">
								<li class="nav-item">
									<a class="nav-link active" href="#today-appointments"
										data-bs-toggle="tab">Today</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#upcoming-appointments"
										data-bs-toggle="tab">Upcoming</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#missed-appointments"
										data-bs-toggle="tab">Missed</a>
								</li>
							</ul>

							<div class="tab-content">

								<div class="tab-pane show active" id="today-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Patient</th>
															<th>Appt Date</th>
															<th>Hospital</th>
															<th>Payment</th>
															<th>Paid Amount</th>
															<th>Status</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($appointments as $key => $q): ?>
															<?php if ($q['appointment_date'] == date('Y-m-d') && $q['status'] != 'cancel' && $q['status'] != 'done'): ?>
																<tr class="tr-appointment-<?=$q['appointment_id']?>">
																	<td>
																		<h2 class="table-avatar">
																			<a href="javascript://"
																				class="avatar avatar-sm me-2">
																				<img class="avatar-img rounded-circle"
																					src="<?=UPLOADS.$q['img']?>"
																					alt="User Image">
																			</a>
																			<a href="javascript://"><?=$q['doctorFname'].' '.$q['doctorLname']?></a>
																		</h2>
																	</td>
																	<td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
																	<td><?=$q['hospitalName']?></td>
																	<td><?=$q['payment_method']?></td>
																	<td><?=CURRENCY.number_format($q['total'])?></td>
																	<td class="status">
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
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="<?=$q['appointment_id']?>" title="Confirm This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php elseif ($q['status'] == 'confirm'): ?>
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light done-appointment" data-id="<?=$q['appointment_id']?>" title="Complete This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php endif ?>
																			<?php if ($q['status'] == 'pending'): ?>
																				<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
								                                                    <i class="feather-x-circle"></i>
								                                                </a>
																			<?php endif ?>
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
								</div><!-- #today-appointments -->
								
								<div class="tab-pane" id="upcoming-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Patient</th>
															<th>Appt Date</th>
															<th>Hospital</th>
															<th>Payment</th>
															<th>Paid Amount</th>
															<th>Status</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($appointments as $key => $q): ?>
															<?php if ($q['appointment_date'] > date('Y-m-d') && $q['status'] != 'cancel' && $q['status'] != 'done'): ?>
																<tr class="tr-appointment-<?=$q['appointment_id']?>">
																	<td>
																		<h2 class="table-avatar">
																			<a href="javascript://"
																				class="avatar avatar-sm me-2">
																				<img class="avatar-img rounded-circle"
																					src="<?=UPLOADS.$q['img']?>"
																					alt="User Image">
																			</a>
																			<a href="javascript://"><?=$q['doctorFname'].' '.$q['doctorLname']?></a>
																		</h2>
																	</td>
																	<td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
																	<td><?=$q['hospitalName']?></td>
																	<td><?=$q['payment_method']?></td>
																	<td><?=CURRENCY.number_format($q['total'])?></td>
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
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="<?=$q['appointment_id']?>" title="Confirm This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php elseif ($q['status'] == 'confirm'): ?>
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light done-appointment" data-id="<?=$q['appointment_id']?>" title="Complete This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php endif ?>
																			<?php if ($q['status'] != 'done'): ?>
																				<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
								                                                    <i class="feather-x-circle"></i>
								                                                </a>
																			<?php endif ?>
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
								</div><!-- /upcoming-appointments -->

								<div class="tab-pane" id="missed-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Patient</th>
															<th>Appt Date</th>
															<th>Hospital</th>
															<th>Payment</th>
															<th>Paid Amount</th>
															<th>Status</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($appointments as $key => $q): ?>
															<?php if ($q['appointment_date'] < date('Y-m-d') && $q['status'] != 'cancel' && $q['status'] != 'done'): ?>
																<tr class="tr-appointment-<?=$q['appointment_id']?>">
																	<td>
																		<h2 class="table-avatar">
																			<a href="javascript://"
																				class="avatar avatar-sm me-2">
																				<img class="avatar-img rounded-circle"
																					src="<?=UPLOADS.$q['img']?>"
																					alt="User Image">
																			</a>
																			<a href="javascript://"><?=$q['doctorFname'].' '.$q['doctorLname']?></a>
																		</h2>
																	</td>
																	<td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
																	<td><?=$q['hospitalName']?></td>
																	<td><?=$q['payment_method']?></td>
																	<td><?=CURRENCY.number_format($q['total'])?></td>
																	<td class="status">
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
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="<?=$q['appointment_id']?>" title="Confirm This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php elseif ($q['status'] == 'confirm'): ?>
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light done-appointment" data-id="<?=$q['appointment_id']?>" title="Complete This Appointment ?">
																					<i class="feather-check-circle"></i>
																				</a>
																			<?php endif ?>
																			<?php if ($q['status'] == 'pending'): ?>
																				<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
								                                                    <i class="feather-x-circle"></i>
								                                                </a>
																			<?php endif ?>
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
								</div><!-- #missed-appointments -->

							</div>
						</div>
					</div>
				</div><!-- /row -->
			</div><!-- /7 -->

		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->