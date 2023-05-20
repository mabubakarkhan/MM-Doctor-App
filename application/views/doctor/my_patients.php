				<div class="breadcrumb-bar">
					<div class="container-fluid">
						<div class="row align-items-center">
							<div class="col-md-12 col-12">
								<h2 class="breadcrumb-title">My Patients</h2>
								<nav aria-label="breadcrumb" class="page-breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">My Patients</li>
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
									<?php foreach ($patients as $key => $q): ?>
										<div class="col-md-12 col-sm-6 col-lg-4">
											<div class="card widget-profile pat-widget-profile">
												<div class="card-body">
													<div class="pro-widget-content">
														<div class="profile-info-widget">
															<a href="patient-profile.html" class="booking-doc-img">
																<img src="<?=UPLOADS.$q['img']?>" alt="User Image">
															</a>
															<div class="profile-det-info">
																<h3><a href="patient-profile.html"><?=$q['fname'].' '.$q['lname']?></a></h3>
																<div class="patient-details">
																	<h5 class="pat-id">Patient ID : <span><?=$q['patient_id']?></span></h5>
																	<h5 class="mb-0"><i class="feather-map-pin"></i> <?=$q['cityName']?></h5>
																</div>
															</div>
														</div>
													</div>
													<div class="patient-info">
														<ul>
															<li>Phone <span><?=$q['phone']?></span></li>
															<li>Gender <span><?=$q['gender']?></span></li>
															<li>Blood Group <span><?=$q['blood_group']?></span></li>
														</ul>
													</div>
												</div>
											</div>
										</div><!-- /12 -->
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>