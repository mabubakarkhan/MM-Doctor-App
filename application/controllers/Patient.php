<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

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
			if ($userChk['controller'] == 'patient') {
				$new = $this->model->get_row("
					SELECT p.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName'
					FROM `patient` AS p 
					LEFT JOIN `city` AS city ON p.city_id = city.city_id 
					LEFT JOIN `state` AS state ON p.state_id = state.state_id 
					LEFT JOIN `country` AS country ON p.country_id = country.country_id 
					WHERE p.phone = '".$userChk['phone']."' AND p.password = '".$userChk['password']."'
				;");
				if($new)
				{
					$new['controller'] = 'patient';
					return $new;
				}
				else
				{
					unset($_SESSION['user']);
					redirect('login');
				}
			}
			else{
				redirect($userChk['controller'].'/dashboard');
			}
		}
		else
		{
			unset($_SESSION['user']);
			redirect('login');
		}
	}
	/*     TEMPLATE     */
	public function template($page = '', $data = '', $jsScript = false)
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
		if ($jsScript !== false) {
			$this->load->view('patient/scripts/'.$jsScript);
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
		$user = $this->check_login();
		$data['page_title'] = 'Dashboard';
		$data['dashboard_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_appointments_by_patient($user['patient_id']);
		$this->template('patient/dashboard',$data, 'dashboard');
	}
	public function index()
	{
		$this->dashboard();
	}
	public function profile_settings()
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Profile Setting';
		$data['profile_settings_active'] = 'active';
		$data['userSession'] = $user;
		$data['states'] = $this->model->get_state_bycountry(166);
		if (isset($user['state_id'])) {
			$data['cities'] = $this->model->get_city_bystate($user['state_id']);
		}
		$this->template('patient/profile_settings',$data, 'profile_settings');
	}
	public function change_password()
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Change Password';
		$data['change_password_active'] = 'active';
		$data['userSession'] = $user;
		$this->template('patient/change_password',$data, 'change_password');
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
			$resp = $this->db->where('patient_id',$user['patient_id'])->set("img", $img)->update("patient");
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
		$this->db->where('patient_id',$user['patient_id']);
		$resp = $this->db->update('patient',$_POST);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"profile updated.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not updated, please try again.","type"=>"error"));
		}
	}
	public function update_password()
	{
		$user = $this->check_login();
		if (md5($_POST['old']) != $user['password']) {
			echo json_encode(array("status"=>false,"msg"=>"wrong old password.","type"=>"error"));
		}
		else if ($_POST['confirm'] != $_POST['new']) {
			echo json_encode(array("status"=>false,"msg"=>"new/confirm must matched.","type"=>"error"));
		}
		else{
			$resp = $this->db->set('password',md5($_POST['new']))->where('patient_id',$user['patient_id'])->update('patient');
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"password updated, now your redirecting in while.","type"=>"success"));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"password not updated, please try again or reload your web page.","type"=>"error"));
			}
		}
	}
	public function cancel_appointment()
	{
		$user = $this->check_login();
		$this->db->where('appointment_id',$_POST['id']);
		$this->db->where('patient_id',$user['patient_id']);
		$this->db->set('status','cancel');
		$this->db->set('cancel_note',$_POST['cancel_note']);
		$this->db->set('cancel_by','patient');
		$resp = $this->db->update('appointment');
		if ($resp) {
			$q = $this->model->get_appointment_by_id($_POST['id']);
			if ($q['payment_method'] == 'card') {
				$doctor = $this->model->get_doctor_byid($q['doctor_id']);
				$balance = $doctor['balance']-$q['fee'];
				$this->db->where('doctor_id',$doctor['doctor_id']);
				$this->db->set('balance',$balance);
				$this->db->update('doctor');
			}
			//email/sms
			echo json_encode(array("status"=>true,"msg"=>"appointment canceled.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not canceled, please try again or reload your web page.","type"=>"error"));
		}
	}
	/**
	*

	@Send Mail
		
	*
	*/
	protected function send_mail($subject,$content,$email,$file = false)
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
