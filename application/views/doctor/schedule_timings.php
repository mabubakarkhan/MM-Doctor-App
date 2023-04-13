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
					<div class="col-sm-12">
						<h4 class="sub-heading">Schedule Timings</h4>
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group duration-slot">
											<label>Timing Slot Duration</label>
											<select class="form-select form-control mb-0 time-slot-duration">
												<option value="15" <?=('5' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >5 mins</option>
												<option value="15" <?=('10' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >10 mins</option>
												<option value="15" <?=('15' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >15 mins</option>
												<option value="30" <?=('30' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >30 mins</option>
												<option value="45" <?=('45' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >45 mins</option>
												<option value="60" <?=('60' == $userSession['timing_slot_duration']) ? 'selected' : ''?> >1 Hour</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="card schedule-widget mb-0">

											<div class="schedule-header">

												<div class="schedule-nav">
													<ul class="nav nav-tabs nav-justified">
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Sunday">Sunday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link active" data-bs-toggle="tab"
																href="#slot_Monday">Monday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Tuesday">Tuesday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Wednesday">Wednesday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Thursday">Thursday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Friday">Friday</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab"
																href="#slot_Saturday">Saturday</a>
														</li>
													</ul>
												</div>

											</div><!-- /schedule-header -->


											<div class="tab-content schedule-cont">

												<?php for ($i=1; $i < 8; $i++) { ?>
													<?php $dayNames = array("", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); ?>
													<div id="slot_<?=$dayNames[$i]?>" class="tab-pane fade <?=($activeDay == $i) ? 'show active' : ''?> ">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span>
															<a class="edit-link time-slots-modal-btn" data-day="<?=$i?>" data-title="Add Time Slots From <?=$dayNames[$i]?>" href="javascript://"><i class="fa fa-plus-circle"></i></a>
														</h4>

														<div class="doc-times">
															<?php foreach ($slots as $key => $slot): ?>
																<?php if ($slot['day_number'] == $i): ?>
																	<div class="doc-slot-list">
																		<?=date("h:i a",strtotime($slot['time_start'])).' - '.date("h:i a",strtotime($slot['time_end']))?>
																		<a href="javascript:void(0)" class="delete_schedule doctor-dashboard-submit-btn" data-id="<?=$slot['time_slot_id']?>"><i class="fa fa-times"></i></a>
																	</div>
																<?php endif ?>
															<?php endforeach ?>

														</div><!-- /doc-times -->

													</div><!-- /tab-pane -->
												<?php } ?>

											</div><!-- .schedule-cont -->

										</div><!-- /card -->
									</div><!-- /12 -->
								</div><!-- /row -->
							</div><!-- /card-body -->
						</div><!-- /card -->
					</div><!-- /12 -->
				</div><!-- /row -->
			</div><!-- /7 -->
		</div><!-- /row -->
	</div><!-- /container-fluid -->
</div><!-- /content -->