<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
        parent::__construct();
        error_reporting(0);
        $this->load->database();
        $this->load->model('Model_functions','model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
	}


	/**
	*

		@HATH NA LAIE

	*
	*/
	/*     Check LOGIN     */
	public function check_login($redrc = FALSE)
	{
		if(isset($_SESSION['user']) && $_SESSION['user']!= "")
		{
			$userChk = unserialize($_SESSION['user']);
			if ($userChk['controller'] == 'doctor') {
				$new = $this->model->get_row("SELECT * FROM `doctor` WHERE `phone` = '".$userChk['phone']."' AND `password` = '".$userChk['password']."';");
				if($new)
				{
					$new['controller'] = 'doctor';
					return $new;
				}
				else
				{
					unset($_SESSION['user']);
					redirect('login-doctor');
				}
			}
			else{
				redirect($userChk['controller'].'/dashboard');
			}
		}
		else
		{
			unset($_SESSION['user']);
			redirect('login-doctor');
		}
	}
	/*     TEMPLATE     */
	public function template($page = '', $data = '', $jsScript = false)
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
		if ($jsScript !== false) {
			$this->load->view('doctor/scripts/'.$jsScript);
		}
	}
	/**
	*

	@Strip Payment
		
	*
	*/
	public function submit_payment()
	{
		$user = $this->check_login();
		$plan = $this->model->get_plan_byid($_POST['plan_id']);
		$_POST['company_id'] = $user['company_id'];
		if ($_POST['price_type'] == 'year') {
			$_POST['amount'] = $plan['yearly'];
			$_POST['emails'] = $plan['emails']*12;
		}
		else{
			$_POST['amount'] = $plan['price'];
			$_POST['emails'] = $plan['emails'];
		}
		if ($plan) {
			require_once('application/libraries/stripe-php/init.php');
			\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
	    	$charge = \Stripe\Charge::create ([
	                "amount" => $_POST['amount']*100,
	                "currency" => "usd",
	                "source" => $_POST['stripe_token'],
	                "description" => "review payment" 
	        ]);
	        $status = $charge->status;
	        if ($status == 'succeeded') {
	        	$_POST['card_payment_status'] = 'paid';
	        	$_POST['strip_id'] = $charge->id;
	        	$_POST['strip_balance_transaction'] = $charge->balance_transaction;
	        	$this->db->insert('order',$_POST);
	        	$orderID = $this->db->insert_id();
	        	$update['plan_id'] = $plan['plan_id'];
	        	$update['varified_company_review'] = $plan['varified_company_review'];
	        	$update['product_review_allow'] = $plan['product_review_allow'];
	        	$update['services_allow'] = $plan['services_allow'];
	        	$update['multi_reviews'] = $plan['multi_reviews'];
	        	if ($_POST['price_type'] == 'month') {
	        		$update['expiry'] = date('Y-m-d H:i:s', strtotime('+1 months'));
	        	}
	        	else{
	        		$update['expiry'] = date('Y-m-d H:i:s', strtotime('+1 years'));
	        	}
	        	$update['account_type'] = 'paid';
	        	$update['product_review_allow'] = 'yes';
	        	$update['gallery_allow'] = 'yes';
	        	$update['ask_user_ref'] = 'yes';
	        	$update['email_balance'] = $_POST['emails']+$user['email_balance'];
	        	$this->db->where('company_id',$user['company_id']);
	        	$this->db->update('company',$update);
	        	$this->order_mail($_POST,$orderID);
				$data['msg'] = 'success: Payment made successfully :)';
				$data['error'] = false;
	        }
	        else{
	        	$data['msg'] = 'fail: Payment not submitted successfully :(';
				$data['error'] = true;
	        }
		}
		else{
			$data['msg'] = 'fail: something wrong :( please try again';
			$data['error'] = true;
		}
		$data['meta_title'] = 'Submit Payment';
		$data['index_page_active'] = 'active';
		$this->template('company/submit_payment',$data);
	}

	/**
	*

	@Main Functions Starts From Here
		
	*
	*/
	public function dashboard()
	{
		$this->profile_settings();
	}
	public function index()
	{
		$this->profile_settings();
	}
	public function profile_settings()
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['profile_settings_active'] = 'active';
		$data['userSession'] = $user;
		$data['states'] = $this->model->get_state_bycountry(166);
		if (isset($user['state_id'])) {
			$data['cities'] = $this->model->get_city_bystate($user['state_id']);
		}
		$this->template('doctor/profile_settings',$data, 'profile_settings');
	}
	/**
	*
	*
	*	@AJX Photo Upload
	*
	*
	**/
	private function photo_upload($file)
	{
		$config['upload_path'] = 'uploads/';
    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
    	$config['encrypt_name'] = TRUE;
    	$ext = pathinfo($file["img"]['name'], PATHINFO_EXTENSION);
		$new_name = md5(time().$file["img"]['name']).'.'.$ext;
		$config['file_name'] = $new_name;
    	$resp = $this->load->library('upload', $config);
    	if ($resp) {
        	$this->upload->do_upload('img');
			$FileName = $this->upload->data()['file_name'];
			return $FileName;
    	}
    	else{
			return false;
    	}
	}
	public function upload_profile_image()
	{
		$user = $this->check_login();
		$img = $this->photo_upload($_FILES);
		if ($img) {
			$resp = $this->db->where('doctor_id',$user['doctor_id'])->set("img", $img)->update("doctor");
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"profile image updated","img"=>$img,"type"=>"success"));
			}
			else{
				echo json_encode(array("status"=>fasle,"msg"=>"not updated, please try again.","type"=>"error"));
			}
		}
		else{
			echo json_encode(array("status"=>fasle,"msg"=>"not uploaded please try again.","type"=>"error"));
		}
	}
	/**
	*
	*
	*	@AJX
	*
	*
	**/
	public function update_profile()
	{
		$user = $this->check_login();
		$this->db->where('doctor_id',$user['doctor_id']);
		$resp = $this->db->update('doctor',$_POST);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"profile updated.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not updated, please try again.","type"=>"error"));
		}
	}
	/**
	*
	*
	*	@Domestic Functions
	*
	*
	**/
	protected function order_mail($post,$orderId)
	{
		$planName = $this->model->get_row("SELECT `title` FROM `plan` WHERE `plan_id` = '".$post['plan_id']."';");
		$planName = $planName['title'];
		$order = $this->model->get_order_byid($orderId);
		$mail = '<!DOCTYPE html>
				<html lang="en">
				<head>
				  <title>Smart Review</title>
				  <meta charset="utf-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1">
				  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
				</head>
				<body>

					<table style="max-width: 650px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto 10px; border: 1px solid #acacac; box-sizing: border-box; padding: 0 0 30px; display: block;">
						<tbody style="width: 100%; display: block;">
							<tr style="width: 100%; display: block;">
								<td style="width: 90%; display: block; margin: 0 auto; text-align: center; padding: 20px;">
									<img src="'.IMG.'logo-2.png" alt="logo">
								</td>
							</tr>

							<tr style="background: #283749;width: 94%;margin: 0 auto; border-bottom: 1px solid #999999; overflow: hidden; display: block;">
								<td style="color: #fff; font-size: 15px; padding: 12px 18px; box-sizing: border-box; font-family: \'Open Sans\' , sans-serif; width: 70%;">Invoice 270901</td>
								<td style="color: #fff; font-size: 15px; box-sizing: border-box; padding: 12px 18px; font-family: \'Open Sans\' , sans-serif;">Billed On '.date('M d, Y',strtotime($order['at'])).'</td>
							</tr>

							<tr style="width: 100%; display: block;">
								<td style="text-align: center; width: 90%; margin: 0 auto; background: #323232; padding: 12px; display: block;">
									<span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">'.$post['bill_fname'].' '.$post['bill_lname'].'</span><span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">'.$post['bill_address_line_1'].'</span>
									<span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">';
										if(strlen($post['bill_address_line_1']) > 1){
											$mail .= $post['bill_address_line_1'];
										}
									$mail .= ' '.$post['bill_city'].'.</span>
								</td>
							</tr>

							<tr style="width: 100%; display: block;">
								<td style="text-align: center; width: 90%; margin: 0 auto; background: #transparent; padding: 20px 10px; display: block;">
									<span style="display: block; color: #000; font-size: 18px; font-weight: bold; padding: 2px; font-family: \'Open Sans\' , sans-serif;">We received your payment</span>
									<span style="display: block; color: #000; font-size: 12px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">Thank you for your business. Enclosed is an invoice receipt for your records.</span>
									<span style="display: block; color: #000; font-size: 12px; padding: 2px; font-family: \'Open Sans\' , sans-serif; margin: 0 0 14px;">This email confirms your recent payment of $'.$post['amount'].'. Here are the details of your payment:</span>
									<a href="#" style="font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif;">View your invoice online</a>
								</td>
							</tr>

							<tr style="padding: 0 20px; display: flex; justify-content: space-between;">
								<td style="background: #fff;box-sizing: border-box; border: 1px solid #999; text-align: center; padding: 20px 5px; width: 49%;">
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif;">Your plan:</span>
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif;">'.$planName.'</span>
								</td>
								<td style="background: #fff;box-sizing: border-box; border: 1px solid #999; text-align: center; padding: 10px 5px; width: 49%;">
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif; padding: 16px 0 3px;">Next invoice date:</span>
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif; padding: 3px 0;">July 1, 2021</span>
								</td>
							</tr>

							<tr style="width: 94%; margin: 0 auto; display: block; box-sizing: border-box;">
								<td style="width: 100%; display: block; box-sizing: border-box;">
									<table style="width: 100%; margin: 20px 0 0; border-collapse: collapse;">
										<thead style="background: #323232;">
											<th style="color: #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: left	; border-right: 4px solid #fff;">Date</th>
											<th style="color: #fff; border-right: 4px solid #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: left	;">Description</th>
											<th style="color: #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: right;">Amount</th>
										</thead>
										<tbody>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;">'.date('M d, Y',strtotime($order['at'])).'</span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;">'.$planName.'</span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">$'.$order['amount'].'</span>
												</td>
											</tr>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Subtotal: $'.$order['amount'].'</span>
												</td>
											</tr>

											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Total: $'.$order['amount'].'</span>
												</td>
											</tr>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Paid: $13.96</span>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>

					</table>

					<table style="max-width: 650px; padding: 20px; border-collapse: collapse; margin: 0 auto; border: 1px solid #acacac; box-sizing: border-box; display: block; background: #283749;">
							<tbody style="width: 100%; display: block;">
								<tr style="display: block; width: 100%; overflow: hidden;">
									<td style="float: left;">
										<span style="color: #fff; font-size: 14px; font-family: \'Open Sans\' , sans-serif; display: block;">Contact</span>
										<a href="tel:03455555613" style="text-decoration: none; color: #fff; font-size: 20px; font-weight: bold; font-family: \'Open Sans\' , sans-serif; display: block;"><img src="'.IMG.'bg-phone.png" alt="image" style="display: inline-block; margin: 10px 10px 0 0;">0345 5555 613</a>
										<a href="mailto:info@sms2connect" style="text-decoration: none; color: #fff; font-size: 20px; font-weight: bold; font-family: \'Open Sans\' , sans-serif; display: block;"><img src="'.IMG.'bg-mail.png" alt="image" style="display: inline-block; margin: 10px 10px 0 0;">info@sms2connect</a>
									</td>
									<td style="float: right;">
										<img src="'.IMG.'bg-sms.png" alt="image">
									</td>
								</tr>
							</tbody>
					</table>

				</body>	
				</html>
				';
		$to      = $post['bill_email'];
		$subject = 'Payment On Review';
		$from = EMAIL_FROM;

		$headers = '';
	    $headers .= "From: ".$from."" ."\r\n" .
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

		//mail($to, $subject, $mail, $headers);
		$this->send_mail($subject,$mail,$to,false);
		return true;
	}
	/**
	*

	@Send Mail
		
	*
	*/
	public function send_mail($subject,$content,$email,$file = false)
	{
		$this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = EMAIL_SERVER;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_FROM;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom(EMAIL_FROM, EMAIL_TITLE);
        $mail->addReplyTo(EMAIL_FROM, EMAIL_TITLE);
        
        // Add a recipient
        $mail->addAddress($email);
        
        // Add cc or bcc 
        /*$mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');*/
        
        // Email subject
        $mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mail->Body = $content;

        if ($file != false) {
        	$mail->AddAttachment("uploads/".$file);
        }
        
        // Send email
        $mail->send();
        unset($file);
        return true;
	}
	public function get_time_difference_php($created_time)
	{
	    $timezone = (DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, "PK"));
	    date_default_timezone_set($timezone[0]); //Change as per your default time
	    $str = strtotime($created_time);
	    $today = strtotime(date('Y-m-d H:i:s'));

	    // It returns the time difference in Seconds...
	    $time_differnce = $today-$str;

	    // To Calculate the time difference in Years...
	    $years = 60*60*24*365;

	    // To Calculate the time difference in Months...
	    $months = 60*60*24*30;

	    // To Calculate the time difference in Days...
	    $days = 60*60*24;

	    // To Calculate the time difference in Hours...
	    $hours = 60*60;

	    // To Calculate the time difference in Minutes...
	    $minutes = 60;

	    if(intval($time_differnce/$years) > 1)
	    {
	        return intval($time_differnce/$years)." years ago";
	    }else if(intval($time_differnce/$years) > 0)
	    {
	        return intval($time_differnce/$years)." year ago";
	    }else if(intval($time_differnce/$months) > 1)
	    {
	        return intval($time_differnce/$months)." months ago";
	    }else if(intval(($time_differnce/$months)) > 0)
	    {
	        return intval(($time_differnce/$months))." month ago";
	    }else if(intval(($time_differnce/$days)) > 1)
	    {
	        return intval(($time_differnce/$days))." days ago";
	    }else if (intval(($time_differnce/$days)) > 0) 
	    {
	        return intval(($time_differnce/$days))." day ago";
	    }else if (intval(($time_differnce/$hours)) > 1) 
	    {
	        return intval(($time_differnce/$hours))." hours ago";
	    }else if (intval(($time_differnce/$hours)) > 0) 
	    {
	        return intval(($time_differnce/$hours))." hour ago";
	    }else if (intval(($time_differnce/$minutes)) > 1) 
	    {
	        return intval(($time_differnce/$minutes))." minutes ago";
	    }else if (intval(($time_differnce/$minutes)) > 0) 
	    {
	        return intval(($time_differnce/$minutes))." minute ago";
	    }else if (intval(($time_differnce)) > 1) 
	    {
	        return intval(($time_differnce))." seconds ago";
	    }else
	    {
	        // return "few seconds ago";
	        return "Just Now";
	    }
	}
}
