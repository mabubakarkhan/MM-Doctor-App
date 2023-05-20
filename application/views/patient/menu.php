<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
	<div class="profile-sidebar">
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a href="doctor-profile.html" class="booking-doc-img">
					<img src="<?=UPLOADS.$userSession['img']?>" class="user-profile-image" alt="User Image">
				</a>
				<div class="profile-det-info">
					<h3><?=$userSession['fname'].' '.$userSession['lname']?></h3>
					<div class="patient-details info-loc">
						<?php if (isset($userSession['dob']) && strlen($userSession['dob']) > 1): ?>
							<h5><i class="feather-gift"></i> <?=date('d F, Y',strtotime($userSession['dob']))?>, <?=date_diff(date_create($userSession['dob']), date_create('today'))->y?> years</h5>
						<?php endif ?>
						<?php if (isset($userSession['stateName']) && strlen($userSession['stateName']) > 1): ?>
							<h5 class="mb-0"><i class="feather-map-pin"></i> <?=$userSession['cityName'].', '.$userSession['countryName']?></h5>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-widget">
			<nav class="dashboard-menu">
				<ul>
					<li class="<?=$dashboard_active?>">
						<a href="dashboard">
							<span>Dashboard</span>
							<i class="feather-airplay"></i>
						</a>
					</li>
					<li class="<?=$favourites_active?>">
						<a href="favourites">
							<span>Favourites</span>
							<i class="feather-bookmark"></i>
						</a>
					</li>
					<!-- <li>
						<a href="dependent.html">
							<span>Dependent</span>
							<i class="feather-users"></i>
						</a>
					</li> -->
					<li>
						<a href="chat.html">
							<span>Message</span>
							<i class="feather-message-circle"></i>
						</a>
					</li>
					<li class="<?=$invoices_active?>">
						<a href="invoices">
							<span>Invoices</span>
							<i class="fas fa-file-invoice-dollar"></i>
						</a>
					</li>
					<!-- <li>
						<a href="orders-list.html">
							<span>Orders</span>
							<i class="feather-file-text"></i>
						</a>
					</li> -->
					<li class="<?=$reviews_active?>">
						<a href="reviews">
							<span>Reviews</span>
							<i class="feather-star"></i>
						</a>
					</li>
					<li class="<?=$medical_records_active?>">
						<a href="medical-records">
							<span>Medical Records</span>
							<i class="feather-paperclip"></i>
						</a>
					</li>
					<li class="<?=$search_medical_records_active?>">
						<a href="search-medical-records">
							<span>Medical Records Search</span>
							<i class="feather-paperclip"></i>
						</a>
					</li>
					<li class="<?=$profile_settings_active?>">
						<a href="profile-settings">
							<span>Profile Settings</span>
							<i class="feather-user"></i>
						</a>
					</li>
					<li class="<?=$change_password_active?>">
						<a href="change-password">
							<span>Change Password</span>
							<i class="feather-lock"></i>
						</a>
					</li>
					<li>
						<a href="logout">
							<span>Logout</span>
							<i class="feather-log-out"></i>
						</a>
					</li>

				</ul>
			</nav>
		</div>
	</div>
</div><!-- /5/theiaStickySidebar -->