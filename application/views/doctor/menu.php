<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
	<div class="profile-sidebar">
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a href="doctor-profile.html" class="booking-doc-img">
					<img src="<?=UPLOADS.$userSession['img']?>" alt="User Image">
				</a>
				<div class="profile-det-info">
					<h3><?=$userSession['fname'].' '.$userSession['lname']?></h3>
					<div class="patient-details">
						<h5 class="mb-0">BDS, MDS - Oral & Maxillofacial Surgery</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-widget">
			<nav class="dashboard-menu">
				<ul>
					<li>
						<a href="doctor-dashboard.html">
							<span>Dashboard</span>
							<i class="feather-airplay"></i>
						</a>
					</li>
					<li>
						<a href="appointments.html">
							<span>Appointments</span>
							<i class="feather-calendar"></i>
						</a>
					</li>
					<li>
						<a href="my-patients.html">
							<span>My Patients</span>
							<i class="fas fa-user-injured"></i>
						</a>
					</li>
					<li class="<?=$schedule_timings_active?>">
						<a href="schedule-timings">
							<span>Schedule Timings</span>
							<i class="far fa-hourglass"></i>
						</a>
					</li>
					<li>
						<a href="available-timings.html">
							<span>Available Timings</span>
							<i class="feather-clock"></i>
						</a>
					</li>
					<li>
						<a href="invoices.html">
							<span>Invoices</span>
							<i class="feather-file-text"></i>
						</a>
					</li>
					<li>
						<a href="accounts.html">
							<span>Accounts</span>
							<i class="fas fa-file-invoice-dollar"></i>
						</a>
					</li>
					<li>
						<a href="reviews.html">
							<span>Reviews</span>
							<i class="feather-star"></i>
						</a>
					</li>
					<li>
						<a href="chat-doctor.html">
							<span>Message</span>
							<i class="feather-message-circle"></i>
						</a>
					</li>
					<li class="<?=$profile_settings_active?>">
						<a href="profile-settings">
							<span>Profile Settings</span>
							<i class="feather-user"></i>
						</a>
					</li>
					<li class="<?=$social_links_active?>">
						<a href="social-links">
							<span>Social Media</span>
							<i class="feather-share-2"></i>
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