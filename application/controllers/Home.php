<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	/*     TEMPLATE     */

	public function template($page = '', $data = '', $jsScript = false)
	{
		if (isset($_SESSION['user'])) {
			$data['userSession'] = unserialize($_SESSION['user']);
		}
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
		if ($jsScript !== false) {
			$this->load->view('scripts/'.$page);
		}
	}

	/**
		
		Login/Functions

	*
	*/
	public function logout()
	{
		unset($_SESSION['user']);
		redirect('index');
	}
	public function pre_check()
	{
		if (isset($_SESSION['user'])) {
			$userLoginCheck = unserialize($_SESSION['user']);
			redirect($userLoginCheck['controller'].'/index');
		}
		else{
			return true;
		}
	}
	public function check_login_patient($redrc = FALSE)
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
					$_SESSION['redirectUrl'] = $redrc;
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
			$_SESSION['redirectUrl'] = $redrc;
			redirect('login');
		}
	}
	/**
		
		Signup/Login/Patient

	*
	*/
	public function login()
	{
		$this->pre_check();
		$this->template('login',$data,true);
	}
	public function register()
	{
		$this->pre_check();
		$this->template('register',$data,true);
	}
	public function post_register_patient()
	{
		$this->pre_check();
		$chk = $this->model->check_dublicate(trim_phone($_POST['phone']),$_POST['email'],'patient');
		if ($chk) {
			echo json_encode(array("status"=>false,"msg"=>"phone number (".$_POST['phone'].") OR email (".$_POST['email'].") is already in use."));
		}
		else{
			$_POST['password'] = md5($_POST['password']);
			$_POST['phone'] = trim_phone($_POST['phone']);
			$this->db->insert('patient',$_POST);
			$resp = $this->model->get_patient_byid($this->db->insert_id());
			if ($resp) {
				$resp['controller'] = 'patient';
				$_SESSION['user'] = serialize($resp);
				$emailData['q'] = $resp;
				$this->send_mail('Welcome to '.APP_TITLE.'!',$this->load->view('email/patient_register',$emailData,true),$resp['email'],false);
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"something not good, please try again."));
			}
		}
	}
	public function post_login_patient()
	{
		$this->pre_check();
		$resp = $this->model->patient_login(trim_phone($_POST['key']), md5($_POST['password']));
		if ($resp) {
			$resp['controller'] = 'patient';
			$_SESSION['user'] = serialize($resp);
			echo json_encode(array("status"=>true));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"phone/password in incorrect."));
		}
	}
	/**
		
		Signup/Login/Doctor

	*
	*/
	public function login_doctor()
	{
		$this->pre_check();
		$this->template('login_doctor',$data,true);
	}
	public function register_doctor()
	{
		$this->pre_check();
		$this->template('register_doctor',$data,true);
	}
	public function post_register_doctor()
	{
		$this->pre_check();
		$chk = $this->model->check_dublicate(trim_phone($_POST['phone']),$_POST['email'],'doctor');
		if ($chk) {
			echo json_encode(array("status"=>false,"msg"=>"phone number (".$_POST['phone'].") OR email (".$_POST['email'].") is already in use."));
		}
		else{
			$_POST['password'] = md5($_POST['password']);
			$_POST['phone'] = trim_phone($_POST['phone']);
			$this->db->insert('doctor',$_POST);
			$resp = $this->model->get_doctor_byid($this->db->insert_id());
			if ($resp) {
				$resp['controller'] = 'doctor';
				$_SESSION['user'] = serialize($resp);
				$emailData['q'] = $resp;
				$this->send_mail('Welcome to '.APP_TITLE.'!',$this->load->view('email/doctor_register',$emailData,true),$resp['email'],false);
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"something not good, please try again."));
			}
		}
	}
	public function post_login_doctor()
	{
		$this->pre_check();
		$resp = $this->model->doctor_login(trim_phone($_POST['key']), md5($_POST['password']));
		if ($resp) {
			$resp['controller'] = 'doctor';
			$_SESSION['user'] = serialize($resp);
			echo json_encode(array("status"=>true));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"phone/password in incorrect."));
		}
	}
	
	/**
		
		AJAX

	*
	*/
	public function get_city_by_state_ajax()
	{
		$city = $this->model->get_city_bystate($_POST['id']);
		if ($city) {
			$resp = '<option value="">Select City</option>';
			foreach ($city as $ckey => $c) {
				$resp .= '<option value="'.$c['city_id'].'">'.$c['name'].'</option>';
			}
			echo json_encode(array("status"=>true,"type"=>"success","html"=>$resp,"msg"=>"cities loaded"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"No data found","type"=>"error"));
		}
	}
	/**
		
		Site

	*
	*/
	public function index()
	{
		$data['meta_title'] = APP_TITLE;
		$data['cities'] = $this->model->get_pak_cities();
		$data['services'] = $this->model->services();
		$this->template('index',$data,true);
	}
	public function search()
	{
		if (isset($_GET)) {
			$data['get'] = $_GET;
		}
		$data['meta_title'] = APP_TITLE;
		$data['cities'] = $this->model->get_pak_cities();
		$data['services'] = $this->model->services();
		$html['data'] = $this->model->get_search_doctor($_GET);
		$data['searchResults'] = $this->load->view('html/search',$html, TRUE);
		$data['countResults'] = count($html['data']);
		$this->template('search',$data,true);
	}
	public function search_filter()
	{
		parse_str($_POST['data'],$post);
		$html['data'] = $this->model->get_search_doctor($post);
		$html = $this->load->view('html/search',$html, TRUE);
		echo json_encode(array("status"=>true,"html"=>$html,"count"=>count($html['data'])));
	}
	public function doctor($slug)
	{
		$data['doctor'] = $this->model->get_doctor_profile($slug);
		if (!$data['doctor']) {
			redirect('index');
		}
		$data['educations'] = $this->model->all_education_by_doctor($data['doctor']['doctor_id']);
		$data['experiences'] = $this->model->all_experience_by_doctor($data['doctor']['doctor_id']);
		$data['awards'] = $this->model->all_award_by_doctor($data['doctor']['doctor_id']);
		$data['registrations'] = $this->model->all_registration_by_doctor($data['doctor']['doctor_id']);
		$data['memberships'] = $this->model->all_membership_by_doctor($data['doctor']['doctor_id']);
		$data['locations'] = $this->model->doctor_hospitals($data['doctor']['doctor_id']);
		$data['bookmark_login'] = false;
		$userChk = unserialize($_SESSION['user']);
		if ($userChk['controller'] == 'patient') {
			$data['bookmark'] = $this->model->check_bookmark($data['doctor']['doctor_id'],$userChk['patient_id']);
			$data['bookmark_login'] = true;
		}
		$data['reviews'] = $this->model->get_reviews_by_doctor($data['doctor']['doctor_id']);
		$this->template('doctor_profile',$data,true);
	}
	public function booking($slug,$doctor_hospital)
	{
		$data['doctor'] = $this->model->get_doctor_profile($slug);
		if (!$data['doctor']) {
			redirect('index');
		}
		$data['directDate'] = 'false';
		if (isset($_GET['date'])) {
			$date1 = new DateTime(date('Y-m-d'));
			$date2 = new DateTime(date('Y-m-d',strtotime($_GET['date'])));
			$interval = $date1->diff($date2);
			$data['directDate'] = $interval->days;
		}
		$data['hospital'] = $this->model->get_hospital_by_doctor_hospital_id($data['doctor']['doctor_id'],$doctor_hospital);
		$this->template('booking',$data,true);
	}
	public function booking_filter()
	{
		$dates = $_POST['date'];
		$dates = explode('-', $dates);
		// var_dump($_POST);die;
		$date1 = new DateTime($dates[0]);
		$date2 = new DateTime($dates[1]);
		$interval = $date1->diff($date2);
		$days = $interval->days;
		$bookingData['slots'] = $this->model->get_all_slots_for_doctor_hospital_by_ids($_POST['doctor'],$_POST['hospital']);
		if (date('Y-m-d',strtotime($dates[0])) > date('Y-m-d',strtotime($dates[1]))) {
			$startDate = $dates[1];
		}
		else{
			$startDate = $dates[0];
		}
		$period = new DatePeriod(
		    new DateTime($startDate), // Start date of the period
		    new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
		    $days // Apply the interval 6 times on top of the starting date
		);
		foreach ($period as $key => $day)
		{
			if ($key == 0) {
				$bookingPageSelectedDateHeading = $day->format('d F Y');
				$bookingPageSelectedDayHeading = $day->format('l');
			}
			$bookingData['days'][] = $day->format('l');
			$bookingData['full_dates'][] = $day->format('Y-m-d');
		}
		$booking = $this->load->view('html/booking',$bookingData, TRUE);
		echo json_encode(array("bookingPageSelectedDateHeading"=>$bookingPageSelectedDateHeading,"bookingPageSelectedDayHeading"=>$bookingPageSelectedDayHeading,"html"=>$booking));
	}
	public function checkout($id,$date)
	{
		$data['user'] = $this->check_login_patient(BASEURL.'checkout/'.$id.'/'.$date);
		$data['slot'] = $this->model->get_slot_byid($id);
		$data['date'] = $date;
		$data['doctor'] = $this->model->get_doctor_profile($data['slot']['doctor_id']);
		if (intval($data['slot']['hospital_id']) > 0) {
			$data['hospital'] = $this->model->get_doctor_hospital_by_ids($data['slot']['doctor_id'],$data['slot']['hospital_id']);
		}
		$this->template('checkout',$data,true);
	}
	public function submit_checkout()
	{
		$user  = $this->check_login_patient();
		if ($user) {
			parse_str($_POST['data'],$post);
			$doctor = $this->model->get_doctor_byid($post['doctor_id']);
			if ($post['payment_method'] == 'online') {
				$stripeAmount = ($post['fee']+10)*100;
				require_once('application/libraries/stripe-php/init.php');
				\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));


				$charge = \Stripe\Charge::create ([
					"amount" => $stripeAmount,
					"currency" => "pkr",
					"source" => $post['stripe_token'],
					"description" => "doctor app payment"
				]);
				$status = $charge->status;
				if ($status == 'succeeded') {
					$Update2['card_payment_status'] = 'paid';
					$post['strip_id'] = $charge->id;
					$post['strip_balance_transaction'] = $charge->balance_transaction;
					$balance = $post['fee']+$doctor['balance'];
					$this->db->where('doctor_id',$doctor['doctor_id']);
					$this->db->set('balance',$balance);
					$this->db->update('doctor');
				}
				else{
					echo json_encode(array("status"=>fasle,"msg"=>"payment process not completed, please try again or reload your web page."));
					exit;
				}
			}
			unset($post['stripe_token']);
			$post['total'] = $post['fee']+10;
			$resp = $this->db->insert('appointment',$post);
			if ($resp) {
				/**
				 * Email sending
				*/
				$emailData['patient'] = $user;
				$emailData['doctor'] = $doctor;
				$emailData['appointment'] = $this->model->get_appointment_by_id($this->db->insert_id());
				//patient
				$this->send_mail('New Appointment Created',$this->load->view('email/patient_booking',$emailData,true),$post['email'],false);
				//doctor
				$this->send_mail('New Appointment Created',$this->load->view('email/doctor_booking',$emailData,true),$doctor['email'],false);

				//chat
				$chckChat = $this->model->check_chat_group($doctor['doctor_id'],$user['patient_id']);
				if (!$chckChat) {
					$chat['doctor_id'] = $doctor['doctor_id'];
					$chat['patient_id'] = $user['patient_id'];
					$this->db->insert('chat_group',$chat);
				}

				echo json_encode(array("status"=>true,"msg"=>"Appointment created"));
			}
			else{
				echo json_encode(array("status"=>fasle,"msg"=>"Appointment not created, please try again or reload your webpage."));
			}
		}
		else{
			echo json_encode(array("status"=>fasle,"msg"=>"not login, please login first."));
		}
	}
	/**


		AJAX


	*
	*/
	public function get_appointment_info()
	{
		$user = unserialize($_SESSION['user']);
		$q = $this->model->get_appointment_by_id($_POST['id']);
		if ($q['hospital_id'] > 0) {
			$hospital = $this->model->get_doctor_hospital_by_ids($q['doctor_id'],$q['hospital_id']);
		}
		$html = '<table class="table table-hover table-center mb-0">';
			$html .= '<thead>';
				$html .= '<tr>';
					$html .= '<th>Doctor</th>';
					$html .= '<th>Appt Date</th>';
					$html .= '<th>Location</th>';
					$html .= '<th>Prescription</th>';
					$html .= '<th>Booking Date</th>';
					$html .= '<th>Amount</th>';
					$html .= '<th>Method</th>';
					$html .= '<th>Follow Up</th>';
					$html .= '<th>Cancel</th>';
					$html .= '<th>Status</th>';
					$html .= '<th>Actions</th>';
				$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';
				$html .= '<tr>';
					$html .= '<td>';
						$html .= '<h2 class="table-avatar">';
							$html .= '<a href="javascript://" class="avatar avatar-sm me-2">';
								$html .= '<img class="avatar-img rounded-circle" src="'.UPLOADS.$q['img'].'" alt="User Image">';
							$html .= '</a>';
							$html .= '<a href="doctor-profile.html">'.$q['doctorFname'].' '.$q['doctorLname'].' <span>'.$q['specialization_titles'].'</span></a>';
						$html .= '</h2>';
					$html .= '</td>';
					$html .= '<td>'.date('d M, Y',strtotime($q['appointment_date'])).' <span class="d-block text-info">'.date('h:i a',strtotime($q['time_start'])).' - '.date('h:i a',strtotime($q['time_end'])).'</span></td>';
					if ($hospital) {
						$html .= '<td>'.$hospital['address'].'<br>'.$hospital['cityName'].'</td>';
					}
					else{
						$html .= '<td>Online</td>';
					}
					$html .= '<td>'.$q['Prescription'].'</td>';
					$html .= '<td>'.date('d M, Y',strtotime($q['at'])).'</td>';
					$html .= '<td>'.CURRENCY.number_format($q['total']).'</td>';
					$html .= '<td>'.$q['payment_method'].'</td>';
					$html .= '<td>'.$q['followup_date'].'</td>';
					$html .= '<td><b>'.$q['cancel_by'].'</b><p>'.$q['cancel_note'].'</p></td>';
					$html .= '<td>';
						if ($q['status'] == 'confirm'){
							$html .= '<span class="badge rounded-pill success-status">Confirm</span>';
						}
						elseif ($q['status'] == 'done'){
							$html .= '<span class="badge rounded-pill success-status">Done</span>';
						}
						elseif ($q['status'] == 'pending'){
							$html .= '<span class="badge rounded-pill warning-status">Pending</span>';
						}
						elseif ($q['status'] == 'cancel'){
							$html .= '<span class="badge rounded-pill danger-status">Cancel</span>';
						}
					$html .= '</td>';
					$html .= '<td>';
						$html .= '<div class="table-action">';
							$html .= '<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">';
								$html .= '<i class="feather-printer"></i>';
							$html .= '</a>';
							if ($q['status'] == 'pending' && $user['doctor_id'] > 0){
								$html .= '<a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="'.$q['appointment_id'].'" title="Confirm This Appointment ?">';
									$html .= '<i class="feather-check-circle"></i>';
								$html .= '</a>';
							}
							if ($q['status'] == 'pending'){
								$html .= '<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="'.$q['appointment_id'].'" data-date="'.date('d M, Y',strtotime($q['appointment_date'])).'" data-time="'.date('h:i a',strtotime($q['time_start'])).'" title="Cancel This Appointment ?">';
	                                $html .= '<i class="feather-x-circle"></i>';
	                            $html .= '</a>';
							}
							elseif ($q['status'] != 'done' &&  $user['doctor_id'] > 0) {
								$html .= '<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="'.$q['appointment_id'].'" data-date="'.date('d M, Y',strtotime($q['appointment_date'])).'" data-time="'.date('h:i a',strtotime($q['time_start'])).'" title="Cancel This Appointment ?">';
	                                $html .= '<i class="feather-x-circle"></i>';
	                            $html .= '</a>';
							}
						$html .= '</div>';
					$html .= '</td>';
				$html .= '</tr>';
			$html .= '</tbody>';
		$html .= '</table>';
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function make_bookmark()
	{
		$user = unserialize($_SESSION['user']);
		if ($user['patient_id'] > 0) {
			$insert['patient_id'] = $user['patient_id'];
			$insert['doctor_id'] = $_POST['id'];
			$resp = $this->db->insert('bookmark_doctor',$insert);
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"bookmared.","type"=>"success"));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"not bookmarked.","type"=>"error"));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not bookmarked.","type"=>"error"));
		}
	}
	/**


		MAIL


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
	/**


		TEST


	*
	*/
	public function test()
	{
		$html = $this->load->view('email/patient_booking',$data,true);
		echo ($html);
	}
}