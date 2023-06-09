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
		$data['cats'] = $this->model->cats('active');
		$data['services'] = $this->model->services();
		$data['specializations'] = $this->model->specializations();
		$data['featured_hospitals'] = $this->model->featured_hospitals();
		$data['conditions_featured'] = $this->model->conditions_featured();
		$data['setting'] = $this->model->setting(1);
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
		$data['page'] = $this->model->get_page_byid(1);
		$data['meta_title'] = $data['page']['meta_title'];
		$data['meta_key'] = $data['page']['meta_key'];
		$data['meta_desc'] = $data['page']['meta_desc'];
		$data['cities'] = $this->model->get_pak_cities();
		$data['featured_doctors_for_home'] = $this->model->featured_doctors_for_home();
		$html['specializations_featured'] = $this->model->specializations_featured();
		$html['specializations_featured_doctors'] = $this->model->specializations_featured_doctors();
		$data['specializations_featured'] = $this->load->view('html/doctors-specialities-wrap',$html, TRUE);
		$data['blogs'] = $this->model->blog_home();
		$this->template('index',$data,true);
	}
	public function specializations_featured_ajax()
	{
		$data['specializations_featured'] = $this->model->specializations_featured();
		$data['specializations_featured_doctors'] = $this->model->specializations_featured_doctors();
		$html = $this->load->view('html/doctors-specialities-wrap',$data, TRUE);
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function blog()
	{
		$data['meta_title'] = "The Blog";
		$data['meta_key'] = "The Blog";
		$data['meta_desc'] = "The Blog";
		$data['home_blogs'] = $this->model->blog_home();
		$data['blogs'] = $this->model->blog();
		$this->template('blog', $data);
	}
	public function post($slug)
	{
		$data['post'] = $this->model->get_blog_by_slug($slug);
		$data['meta_title'] = $data['post']['meta_title'];
		$data['meta_key'] = $data['post']['meta_key'];
		$data['meta_desc'] = $data['post']['meta_desc'];
		$data['home_blogs'] = $this->model->blog_home();
		$this->template('post', $data);
	}
	public function search()
	{
		if (isset($_GET)) {
			$data['get'] = $_GET;
		}
		$data['meta_title'] = APP_TITLE;
		$data['cities'] = $this->model->get_pak_cities();
		$data['specializations'] = $this->model->specializations();
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

		if (date('Y-m-d',strtotime($dates[0])) == date('Y-m-d',strtotime($dates[1]))) {
			$single = true;
		}
		else{
			$period = new DatePeriod(
			    new DateTime($startDate), // Start date of the period
			    new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
			    $days // Apply the interval 6 times on top of the starting date
			);
			$single = false;
		}

		if ($single) {
			$bookingPageSelectedDateHeading = date('d F Y',strtotime($startDate));
			$bookingPageSelectedDayHeading = date('l',strtotime($startDate));
			$bookingData['days'][] = date('l',strtotime($startDate));
			$bookingData['full_dates'][] = date('Y-m-d',strtotime($startDate));
		}
		else{
			foreach ($period as $key => $day)
			{
				if ($key == 0) {
					$bookingPageSelectedDateHeading = $day->format('d F Y');
					$bookingPageSelectedDayHeading = $day->format('l');
				}
				$bookingData['days'][] = $day->format('l');
				$bookingData['full_dates'][] = $day->format('Y-m-d');
			}
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
	public function hospital($id)
	{
		$data['hospital'] = $this->model->hospital_byid($id);
		$data['photos'] = $this->model->photos('hospital',$id);
		$data['faqs'] = $this->model->faqs('hospital',$id);
		$html['data'] = $this->model->doctors_by_hospital($id);
		$data['doctors'] = $this->load->view('html/search',$html, TRUE);
		$data['specialities'] = $this->model->get_results("SELECT `specialization_id`,`title`,`image` FROM `specialization` WHERE FIND_IN_SET(`specialization_id`, '".$data['hospital']['specialities']."'); ");
		$data['services'] = $this->model->get_results("SELECT `service_id`,`title` FROM `service` WHERE FIND_IN_SET(`service_id`, '".$data['hospital']['services']."'); ");
		$data['facilities'] = $this->model->get_results("SELECT `facility_id`,`title` FROM `facility` WHERE FIND_IN_SET(`facility_id`, '".$data['hospital']['facilities']."'); ");
		$data['meta_title'] = $data['hospital']['name'];
		$data['meta_key'] = $data['hospital']['name'];
		$data['meta_desc'] = $data['hospital']['name'];
		$this->template('hospital', $data);
	}
	public function policy()
	{
		$data['page'] = $this->model->get_page_byid(3);
		$data['meta_title'] = $data['page']['meta_title'];
		$data['meta_key'] = $data['page']['meta_key'];
		$data['meta_desc'] = $data['page']['meta_desc'];
		$this->template('page', $data);
	}
	public function terms()
	{
		$data['page'] = $this->model->get_page_byid(4);
		$data['meta_title'] = $data['page']['meta_title'];
		$data['meta_key'] = $data['page']['meta_key'];
		$data['meta_desc'] = $data['page']['meta_desc'];
		$this->template('page', $data);
	}
	public function medicine($slug)
	{
		$data['cat'] = $this->model->get_cat_byslug($slug);
		$data['page_title'] = $data['cat']['title'];
		$data['meta_title'] = $data['cat']['meta_title'];
		$data['meta_key'] = $data['cat']['meta_key'];
		$data['meta_desc'] = $data['cat']['meta_desc'];
		$html['products'] = $this->model->get_products_by_cat($data['cat']['category_id']);
		$data['products'] = $this->load->view('html/medicine_listing',$html, TRUE);
		$data['productCounter'] = count($html['products']);
		$this->template('medicine_listing',$data,true);
	}
	public function product($slug)
	{
		$slug = explode('-', $slug);
		$id = $slug[count($slug)-1];
		$data['product'] = $this->model->get_product($id);
		$data['photos'] = $this->model->photos('product',$id);
		$this->template('product',$data,true);
	}
	public function cart()
	{
		$data['meta_title'] = 'Cart';
		$this->template('cart',$data,true);
	}
	public function cart_checkout($id,$date)
	{
		$data['user'] = $this->check_login_patient(BASEURL.'cart-checkout/');
		$data['states'] = $this->model->get_state_bycountry(166);
		$data['cities'] = $this->model->get_pak_cities();
		$this->template('cart_checkout',$data,true);
	}
	public function submit_cart_checkout()
	{
		$user  = $this->check_login_patient();
		if ($user) {
			parse_str($_POST['data'],$post);
			$total = 0;
			foreach ($_SESSION['cart'] as $key => $item) {
				$total += $item['total'];
			}
			$items = $_SESSION['cart'];
			$post['patient_id'] = $user['patient_id'];
			$post['total'] = $total;
			$post['sub_total'] = $total;
			$post['items'] = count($_SESSION['cart']);
			if ($post['payment_method'] == 'online') {
				$stripeAmount = ($total+10)*100;
				require_once('application/libraries/stripe-php/init.php');
				\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));


				$charge = \Stripe\Charge::create ([
					"amount" => $stripeAmount,
					"currency" => "pkr",
					"source" => $post['stripe_token'],
					"description" => "new medicine order"
				]);
				$status = $charge->status;
				if ($status == 'succeeded') {
					$post['strip_id'] = $charge->id;
					$post['strip_balance_transaction'] = $charge->balance_transaction;
				}
				else{
					echo json_encode(array("status"=>fasle,"msg"=>"payment process not completed, please try again or reload your web page."));
					exit;
				}
			}
			unset($post['stripe_token']);
			$resp = $this->db->insert('order',$post);
			$order_id = $this->db->insert_id();
			if ($resp) {
				foreach ($_SESSION['cart'] as $key => $q) {
					$insert = $q;
					$insert['order_id'] = $order_id;
					$this->db->insert('order_item',$insert);
				}
				unset($_SESSION['cart']);
				unset($_SESSION['cart_ids']);
				/**
				 * Email sending
				*/
				$emailData['order'] = $post;
				$emailData['items'] = $items;
				$emailData['patient'] = $user;
				//patient
				$this->send_mail('New Appointment Created',$this->load->view('email/patient_medicine_order',$emailData,true),$post['email'],false);

				echo json_encode(array("status"=>true,"msg"=>"Order created"));
			}
			else{
				echo json_encode(array("status"=>fasle,"msg"=>"Order not created, please try again or reload your webpage."));
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
	public function live_search()
	{
		$key = trim($_POST['key']);
		$html = '';
		$status = false;
		// Doctor
		$doctors = $this->model->get_results("SELECT `doctor_id`,`username`,`fname`,`lname`,`img`,`specialization_titles`  FROM `doctor` WHERE (`fname` LIKE '%$key%' OR `lname` LIKE '%$key%') AND `status` = 'active' ORDER BY `fname`,`lname` ASC;");
		if ($doctors) {
			$status = true;
			$html .= '<div class="listHeading">Doctors</div>';
			foreach ($doctors as $key_ => $q) {
				$html .= '<div class="listResult">';
					if(strlen($q['username']) > 1){ $slug = $q['username']; }else{ $slug = $q['doctor_id'];}
		            $html .= '<a href="'.BASEURL.'doctor-profile/'.$slug.'">';
						$html .= '<div class="listImage">';
			                $html .= '<img width="100" alt="User Image" src="'.UPLOADS.$q['img'].'">';
		        		$html .= '</div>';
						$html .= '<div class="listData">';
							$html .= '<p>';
				                $html .= $q['fname'].' '.$q['lname'];
							$html .= '</p>';
							$html .= '<p>';
				                $html .= $q['specialization_titles'];
							$html .= '</p>';
		        		$html .= '</div>';
		            $html .= '</a>';
		        $html .= '</div>';
			}
		}
		// Specialization
		$specializations = $this->model->get_results("SELECT `specialization_id`,`title`  FROM `specialization` WHERE `title` LIKE '%$key%' ORDER BY `title` ASC;");
		if ($specializations) {
			$status = true;
			$html .= '<div class="listHeading">Speciality</div>';
			foreach ($specializations as $key_ => $q) {
				$html .= '<div class="listResult">';
					$html .= '<a href="'.BASEURL.'search?specialization='.$q['specialization_id'].'&direct=true">';
						$html .= '<div class="listImage">';
			                $html .= '<i class="fas fa-search"></i>';
		        		$html .= '</div>';
						$html .= '<div class="listData">';
							$html .= '<p>';
								$html .= $q['title'];
							$html .= '</p>';
						$html .= '</div>';
					$html .= '</a>';
				$html .= '</div>';
			}
		}
		// Service
		$services = $this->model->get_results("SELECT `service_id`,`title`  FROM `service` WHERE `title` LIKE '%$key%' ORDER BY `title` ASC;");
		if ($services) {
			$status = true;
			$html .= '<div class="listHeading">Service</div>';
			foreach ($services as $key_ => $q) {
				$html .= '<div class="listResult">';
					$html .= '<a href="'.BASEURL.'search?service='.$q['service_id'].'&direct=true">';
						$html .= '<div class="listImage">';
			                $html .= '<i class="fas fa-search"></i>';
		        		$html .= '</div>';
						$html .= '<div class="listData">';
							$html .= '<p>';
								$html .= $q['title'];
							$html .= '</p>';
						$html .= '</div>';
					$html .= '</a>';
				$html .= '</div>';
			}
		}
		// Hospital
		$hospitals = $this->model->get_results("SELECT `hospital_id`,`name`,`address`  FROM `hospital` WHERE `name` LIKE '%$key%' ORDER BY `name` ASC;");
		if ($hospitals) {
			$status = true;
			$html .= '<div class="listHeading">Hospitals</div>';
			foreach ($hospitals as $key_ => $q) {
				$html .= '<div class="listResult">';
					$html .= '<a href="'.BASEURL.'hospital/'.$q['hospital_id'].'">';
						$html .= '<div class="listImage">';
			                $html .= '<img width="100" alt="Hospital Image" src="'.IMG.'hospital.png">';
		        		$html .= '</div>';
						$html .= '<div class="listData">';
							$html .= '<p>';
								$html .= $q['name'];
							$html .= '</p>';
							$html .= '<p>';
								$html .= $q['address'];
							$html .= '</p>';
						$html .= '</div>';
					$html .= '</a>';
				$html .= '</div>';
			}
		}
		echo json_encode(array("status"=>$status,"html"=>$html));
	}
	public function get_products_by_ajax()
	{
		parse_str($_POST['data'],$post);
		$sort = $_POST['sort'];
		if (!(empty($post['category_id']))) {
			$data['products'] = $this->model->get_products_by_cats(implode(',', $post['category_id']),$sort);
		}
		else{
			$data['products'] = $this->model->get_products_by_cats(false,$sort);
		}
		$html = $this->load->view('html/medicine_listing',$data, TRUE);
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function add_to_cart()
	{
		$product = $this->model->get_product_byid($_POST['id']);
		if ($_POST['key'] == 'false') {
			$cart['product_id'] = $_POST['id'];
			$cart['title'] = $product['title'];
			$cart['image'] = $product['image'];
			$cart['qty'] = $_POST['qty'];
			$cart['price'] = $product['price'];
			$cart['total'] = $product['price']*$_POST['qty'];
			$_SESSION['cart'][] = $cart;
			$key = $_SESSION['cart'][count($_SESSION['cart'])-1];
			$msg = "product added to the cart successfully";
		}
		else{
			$_SESSION['cart'][$_POST['key']]['qty'] = $_POST['qty'];
			$_SESSION['cart'][$_POST['key']]['total'] = $product['price']*$_POST['qty'];
			$key = $_POST['key'];
			$msg = "Quantity Updated successfully";
		}
		$total = 0;
		foreach ($_SESSION['cart'] as $k => $q) {
			$total += $q['total'];
			$_SESSION['cart_ids'][$k] = $q['product_id'];
		}
		echo json_encode(array("status"=>true,"total"=>$total,"key"=>$key,"msg"=>$msg,"type"=>"success","count"=>count($_SESSION['cart'])));
	}
	public function cart_quantity()
	{
		$_SESSION['cart'][$_POST['key']]['qty'] = $_POST['qty'];
		$_SESSION['cart'][$_POST['key']]['total'] = $_SESSION['cart'][$_POST['key']]['price']*$_POST['qty'];
		$msg = "Quantity Updated successfully";
		$total = 0;
		foreach ($_SESSION['cart'] as $k => $q) {
			$total += $q['total'];
			$_SESSION['cart_ids'][$k] = $q['product_id'];
		}
		echo json_encode(array("status"=>true,"total"=>$total,"msg"=>$msg,"type"=>"success","count"=>count($_SESSION['cart']),"itemTotal"=>number_format($_SESSION['cart'][$_POST['key']]['total'])));
	}
	public function delete_cart_item()
	{
		unset($_SESSION['cart'][$_POST['key']]['product_id']);
		unset($_SESSION['cart'][$_POST['key']]['title']);
		unset($_SESSION['cart'][$_POST['key']]['image']);
		unset($_SESSION['cart'][$_POST['key']]['qty']);
		unset($_SESSION['cart'][$_POST['key']]['price']);
		unset($_SESSION['cart'][$_POST['key']]['total']);
		unset($_SESSION['cart'][$_POST['key']]);
		$total = 0;
		foreach ($_SESSION['cart'] as $k => $q) {
			$total += $q['total'];
			$_SESSION['cart_ids'][$k] = $q['product_id'];
		}
		echo json_encode(array("status"=>true,"total"=>$total,"msg"=>'product deleted from cart.',"type"=>"success","count"=>count($_SESSION['cart'])));
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