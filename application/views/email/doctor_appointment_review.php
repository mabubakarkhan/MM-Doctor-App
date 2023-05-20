<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8"> <!-- utf-8 works for most cases -->
	<meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
	<meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
	<title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

	<!-- CSS Reset : BEGIN -->
	<style>

		/* What it does: Remove spaces around the email design added by some email clients. */
		/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
		html,
		body {
			margin: 0 auto !important;
			padding: 0 !important;
			height: 100% !important;
			width: 100% !important;
			background: #f1f1f1;
		}

/* What it does: Stops email clients resizing small text. */
* {
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}

/* What it does: Centers email on Android 4.4 */
div[style*="margin: 16px 0"] {
	margin: 0 !important;
}

/* What it does: Stops Outlook from adding extra spacing to tables. */
table,
td {
	mso-table-lspace: 0pt !important;
	mso-table-rspace: 0pt !important;
}

/* What it does: Fixes webkit padding issue. */
table {
	border-spacing: 0 !important;
	border-collapse: collapse !important;
	table-layout: fixed !important;
	margin: 0 auto !important;
}

/* What it does: Uses a better rendering method when resizing images in IE. */
img {
	-ms-interpolation-mode:bicubic;
}

/* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
a {
	text-decoration: none;
}

/* What it does: A work-around for email clients meddling in triggered links. */
*[x-apple-data-detectors],  /* iOS */
.unstyle-auto-detected-links *,
.aBn {
	border-bottom: 0 !important;
	cursor: default !important;
	color: inherit !important;
	text-decoration: none !important;
	font-size: inherit !important;
	font-family: inherit !important;
	font-weight: inherit !important;
	line-height: inherit !important;
}

/* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
.a6S {
	display: none !important;
	opacity: 0.01 !important;
}

/* What it does: Prevents Gmail from changing the text color in conversation threads. */
.im {
	color: inherit !important;
}

/* If the above doesn't work, add a .g-img class to any image in question. */
img.g-img + div {
	display: none !important;
}

/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
/* Create one of these media queries for each additional viewport size you'd like to fix */

/* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
	u ~ div .email-container {
		min-width: 320px !important;
	}
}
/* iPhone 6, 6S, 7, 8, and X */
@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
	u ~ div .email-container {
		min-width: 375px !important;
	}
}
/* iPhone 6+, 7+, and 8+ */
@media only screen and (min-device-width: 414px) {
	u ~ div .email-container {
		min-width: 414px !important;
	}
}


</style>

<!-- CSS Reset : END -->

<!-- Progressive Enhancements : BEGIN -->
<style>

	.primary{
		background: #17bebb;
	}
	.bg_white{
		background: #ffffff;
	}
	.bg_light{
		background: #f7fafa;
	}
	.bg_black{
		background: #000000;
	}
	.bg_dark{
		background: rgba(0,0,0,.8);
	}
	.email-section{
		padding:2.5em;
	}

/*BUTTON*/
.btn{
	padding: 10px 15px;
	display: inline-block;
}
.btn.btn-primary{
	border-radius: 5px;
	background: #17bebb;
	color: #ffffff;
}
.btn.btn-white{
	border-radius: 5px;
	background: #ffffff;
	color: #000000;
}
.btn.btn-white-outline{
	border-radius: 5px;
	background: transparent;
	border: 1px solid #fff;
	color: #fff;
}
.btn.btn-black-outline{
	border-radius: 0px;
	background: transparent;
	border: 2px solid #000;
	color: #000;
	font-weight: 700;
}
.btn-custom{
	color: rgba(0,0,0,.3);
	text-decoration: underline;
}

h1,h2,h3,h4,h5,h6{
	font-family: 'Poppins', sans-serif;
	color: #000000;
	margin-top: 0;
	font-weight: 400;
}

body{
	font-family: 'Poppins', sans-serif;
	font-weight: 400;
	font-size: 15px;
	line-height: 1.8;
	color: rgba(0,0,0,.4);
}

a{
	color: #17bebb;
}

table{
}
/*LOGO*/

.logo h1{
	margin: 0;
}
.logo h1 a{
	color: #17bebb;
	font-size: 24px;
	font-weight: 700;
	font-family: 'Poppins', sans-serif;
}

/*HERO*/
.hero{
	position: relative;
	z-index: 0;
}

.hero .text{
	color: rgba(0,0,0,.3);
}
.hero .text h2{
	color: #000;
	font-size: 34px;
	margin-bottom: 0;
	font-weight: 200;
	line-height: 1.4;
}
.hero .text h3{
	font-size: 24px;
	font-weight: 300;
}
.hero .text h2 span{
	font-weight: 600;
	color: #000;
}

.text-author{
	bordeR: 1px solid rgba(0,0,0,.05);
	max-width: 50%;
	margin: 0 auto;
	padding: 2em;
}
.text-author img{
	border-radius: 50%;
	padding: 20px 0;
	width: 75px !important;
	height: 75px !important;
	object-fit: cover;
}
.text-author h3{
	margin-bottom: 0;
}
ul.social{
	padding: 0;
}
ul.social li{
	display: inline-block;
	margin-right: 10px;
}

/*FOOTER*/

.footer{
	border-top: 1px solid rgba(0,0,0,.05);
	color: rgba(0,0,0,.5);
}
.footer .heading{
	color: #000;
	font-size: 20px;
}
.footer ul{
	margin: 0;
	padding: 0;
}
.footer ul li{
	list-style: none;
	margin-bottom: 10px;
}
.footer ul li a{
	color: rgba(0,0,0,1);
}


@media screen and (max-width: 500px) {


}


</style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<center style="width: 100%; background-color: #f1f1f1;">
		<div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
			&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
		</div>
		<div style="max-width: 600px; margin: 0 auto;" class="email-container">
			<!-- BEGIN BODY -->
			<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
				<tr>
					<td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td class="logo" style="text-align: center;">
									<h1><a href="#"><?=APP_TITLE?></a></h1>
								</td>
							</tr>
						</table>
					</td>
				</tr><!-- end tr -->
				<tr>
					<td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
									<div class="text">
										<h2>Appointment Review Submitted</h2>

										<p><strong>Dear <?=$doctor['fname'].' '.$doctor['lname']?>,</strong></p>


										<p>I hope this email finds you well. I am writing to inform you that <b><?=$patient['fname'].' '.$patient['lname']?></b> has submitted a review for the recent appointment on <b><?=$appointment['appointment_date']?></b> at <b><?=$appointment['time_star']?></b> they had with you. The patient has taken the time to share their feedback and experience, which I believe you would find valuable.</p>

										<p>Here are the details of the patient's review:</p>

										<p>
											Patient Name: <b><?=$patient['fname'].' '.$patient['lname']?></b> <br>
											Appointment Date: <b><?=$appointment['appointment_date']?></b> at <b><?=$appointment['time_star']?></b> <br>
											Rating: <b><?=$ratting?></b>
										</p>
										<p>
											Review Content: <br>
											<?=$review?>
										</p>

										<p>The patient's feedback can provide valuable insights into their experience with you and the quality of care provided. It is an opportunity for reflection and understanding how your interactions impact patients' well-being.</p>

										<p>I encourage you to review the patient's feedback and take note of any positive aspects or areas that may require attention. Patient feedback is crucial for continuous improvement and ensuring the highest level of patient satisfaction.</p>

										<p>If you wish to respond directly to the patient's review, please consider offering your appreciation for their feedback and addressing any specific concerns they may have raised. This can demonstrate your commitment to patient care and reinforce a positive doctor-patient relationship.</p>

										<p>Thank you for your dedication and commitment to providing exceptional care to our patients. If you have any questions or need further assistance, please do not hesitate to reach out to me.</p>

										<p>Sincerely,</p>

										<p><strong>Team <?=APP_TITLE?></strong></p>
									</div>
								</td>
							</tr>
							<tr>
								<td style="text-align: center;">
									<div class="text-author">
										<img src="<?=UPLOADS.$doctor['img']?>" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
										<h3 class="name"><?=$doctor['fname'].' '.$doctor['lname']?></h3>
										<span class="position"><?=$doctor['specialization_titles']?></span>
										<p><a href="<?=BASEURL.'doctor/dashboard'?>" class="btn btn-primary">Your All Appointments</a></p>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr><!-- end tr -->
				<!-- 1 Column Text + Button : END -->
			</table>
			<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
				<tr>
					<td valign="middle" class="bg_light footer email-section">
						<table>
							<tr>
								<td valign="top" width="33.333%" style="padding-top: 20px;">
									<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											<td style="text-align: left; padding-right: 10px;">
												<h3 class="heading">About</h3>
												<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
											</td>
										</tr>
									</table>
								</td>
								<td valign="top" width="33.333%" style="padding-top: 20px;">
									<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											<td style="text-align: left; padding-left: 5px; padding-right: 5px;">
												<h3 class="heading">Contact Info</h3>
												<ul>
													<li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
													<li><span class="text">+2 392 3929 210</span></a></li>
												</ul>
											</td>
										</tr>
									</table>
								</td>
								<td valign="top" width="33.333%" style="padding-top: 20px;">
									<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											<td style="text-align: left; padding-left: 10px;">
												<h3 class="heading">Useful Links</h3>
												<ul>
													<li><a href="#">Home</a></li>
													<li><a href="#">About</a></li>
													<li><a href="#">Services</a></li>
													<li><a href="#">Work</a></li>
												</ul>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr><!-- end: tr -->
				<tr>
					<td class="bg_light" style="text-align: center;">
						<p>&copy; <?=date('Y')?> <a href="<?=BASEURL?>" style="color: rgba(0,0,0,.8);"><?=APP_TITLE?></a></p>
					</td>
				</tr>
			</table>

		</div>
	</center>
</body>
</html>