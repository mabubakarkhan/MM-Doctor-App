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
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Social Media';
		$data['dashboard_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments_count'] = $this->db->where('doctor_id',$user['doctor_id'])->from("appointment")->count_all_results();
		$data['appointments'] = $this->model->get_appointments_by_doctor($user['doctor_id']);
		$this->template('doctor/dashboard',$data, 'dashboard');
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
		$data['services'] = $this->model->services();
		$data['specializations'] = $this->model->specializations();
		$data['educations'] = $this->model->all_education_by_doctor($user['doctor_id']);
		$data['experiences'] = $this->model->all_experience_by_doctor($user['doctor_id']);
		$data['awards'] = $this->model->all_award_by_doctor($user['doctor_id']);
		$data['memberships'] = $this->model->all_membership_by_doctor($user['doctor_id']);
		$data['registrations'] = $this->model->all_registration_by_doctor($user['doctor_id']);
		$data['doctor_hospitals'] = $this->model->doctor_hospitals($user['doctor_id']);
		$data['hospitals'] = $this->model->hospitals();
		$data['states'] = $this->model->get_state_bycountry(166);
		if (isset($user['state_id'])) {
			$data['cities'] = $this->model->get_city_bystate($user['state_id']);
		}
		$this->template('doctor/profile_settings',$data, 'profile_settings');
	}
	public function social_links()
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Social Media';
		$data['social_links_active'] = 'active';
		$data['userSession'] = $user;
		$this->template('doctor/social_links',$data, 'profile_settings');
	}
	public function change_password()
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Change Password';
		$data['change_password_active'] = 'active';
		$data['userSession'] = $user;
		$this->template('doctor/change_password',$data, 'change_password');
	}
	public function schedule_timings($activeDay = '1')
	{
		$user = $this->check_login();
		// $data['meta_title'] = 'Dashboard';
		$data['page_title'] = 'Schedule Timings';
		$data['schedule_timings_active'] = 'active';
		$data['userSession'] = $user;
		$data['activeDay'] = $activeDay;
		$data['slots'] = $this->model->get_all_slots_for_doctor($user['doctor_id']);
		$data['doctor_hospitals'] = $this->model->doctor_hospitals($user['doctor_id']);
		$this->template('doctor/schedule_timings',$data, 'schedule_timings');
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
	private function file_upload($file)
	{
		$config['upload_path'] = 'uploads/';
    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG|PDF|pdf';
    	$config['encrypt_name'] = TRUE;
    	$ext = pathinfo($file["file"]['name'], PATHINFO_EXTENSION);
		$new_name = md5(time().$file["file"]['name']).'.'.$ext;
		$config['file_name'] = $new_name;
    	$resp = $this->load->library('upload', $config);
    	if ($resp) {
        	$this->upload->do_upload('file');
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
		if (isset($_POST['services'])) {
			foreach ($_POST['services'] as $key => $q) {
				$temp = explode('%',$q);
				if ($key == 0) {
					$_POST['service_ids'] = $temp[0];	
					$_POST['service_titles'] = $temp[1];
				}
				else{
					$_POST['service_ids'] .= ','.$temp[0];	
					$_POST['service_titles'] .= ','.$temp[1];
				}
			}
			unset($_POST['services']);
		}
		if (isset($_POST['specializations'])) {
			foreach ($_POST['specializations'] as $key => $q) {
				$temp = explode('%',$q);
				if ($key == 0) {
					$_POST['specialization_ids'] = $temp[0];
					$_POST['specialization_titles'] = $temp[1];
				}
				else{
					$_POST['specialization_ids'] .= ','.$temp[0];
					$_POST['specialization_titles'] .= ','.$temp[1];
				}
			}
			unset($_POST['specializations']);
			$_POST['service_ids'] = trim($_POST['service_ids'],",");
			$_POST['service_titles'] = trim($_POST['service_titles'],",");
		}
		$this->db->where('doctor_id',$user['doctor_id']);
		$resp = $this->db->update('doctor',$_POST);
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
			$resp = $this->db->set('password',md5($_POST['new']))->where('doctor_id',$user['doctor_id'])->update('doctor');
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"password updated, now your redirecting in while.","type"=>"success"));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"password not updated, please try again or reload your web page.","type"=>"error"));
			}
		}
	}
	public function update_education()
	{
		$user = $this->check_login();
		$ids = array();
		foreach ($_POST['id'] as $key => $q) {
			if ($q > 0 && $_POST['delete'][$key] == 'no') {
				$update['degree'] = $_POST['degree'][$key];
				$update['institute'] = $_POST['institute'][$key];
				$update['year'] = $_POST['year'][$key];
				$this->db->where('education_id',$q)->where('doctor_id',$user['doctor_id'])->update('education',$update);
				$ids[] = $q;
			}
			else if ($q == 0 && $_POST['delete'][$key] == 'no') {
				$insert['doctor_id'] = $user['doctor_id'];
				$insert['degree'] = $_POST['degree'][$key];
				$insert['institute'] = $_POST['institute'][$key];
				$insert['year'] = $_POST['year'][$key];
				$this->db->insert('education',$insert);
				$ids[] = $this->db->insert_id();
			}
			else{
				$this->db->where('education_id',$q)->where('doctor_id',$user['doctor_id'])->delete('education');
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Education updated.","type"=>"success","ids"=>$ids));
	}
	public function update_experience()
	{
		$user = $this->check_login();
		$ids = array();
		foreach ($_POST['id'] as $key => $q) {
			if ($q > 0 && $_POST['delete'][$key] == 'no') {
				$update['hospital'] = $_POST['hospital'][$key];
				$update['designation'] = $_POST['designation'][$key];
				$update['from'] = $_POST['from'][$key];
				$update['to'] = $_POST['to'][$key];
				$this->db->where('experience_id',$q)->where('doctor_id',$user['doctor_id'])->update('experience',$update);
				$ids[] = $q;
			}
			else if ($q == 0 && $_POST['delete'][$key] == 'no') {
				$insert['doctor_id'] = $user['doctor_id'];
				$insert['hospital'] = $_POST['hospital'][$key];
				$insert['designation'] = $_POST['designation'][$key];
				$insert['from'] = $_POST['from'][$key];
				$insert['to'] = $_POST['to'][$key];
				$this->db->insert('experience',$insert);
				$ids[] = $this->db->insert_id();
			}
			else{
				$this->db->where('experience_id',$q)->where('doctor_id',$user['doctor_id'])->delete('experience');
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Experience updated.","type"=>"success","ids"=>$ids));
	}
	public function update_award()
	{
		$user = $this->check_login();
		$ids = array();
		foreach ($_POST['id'] as $key => $q) {
			if ($q > 0 && $_POST['delete'][$key] == 'no') {
				$update['title'] = $_POST['title'][$key];
				$update['year'] = $_POST['year'][$key];
				$this->db->where('award_id',$q)->where('doctor_id',$user['doctor_id'])->update('award',$update);
				$ids[] = $q;
			}
			else if ($q == 0 && $_POST['delete'][$key] == 'no') {
				$insert['doctor_id'] = $user['doctor_id'];
				$insert['title'] = $_POST['title'][$key];
				$insert['year'] = $_POST['year'][$key];
				$this->db->insert('award',$insert);
				$ids[] = $this->db->insert_id();
			}
			else{
				$this->db->where('award_id',$q)->where('doctor_id',$user['doctor_id'])->delete('award');
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Award updated.","type"=>"success","ids"=>$ids));
	}
	public function update_registration()
	{
		$user = $this->check_login();
		$ids = array();
		foreach ($_POST['id'] as $key => $q) {
			if ($q > 0 && $_POST['delete'][$key] == 'no') {
				$update['title'] = $_POST['title'][$key];
				$update['year'] = $_POST['year'][$key];
				$this->db->where('registration_id',$q)->where('doctor_id',$user['doctor_id'])->update('registration',$update);
				$ids[] = $q;
			}
			else if ($q == 0 && $_POST['delete'][$key] == 'no') {
				$insert['doctor_id'] = $user['doctor_id'];
				$insert['title'] = $_POST['title'][$key];
				$insert['year'] = $_POST['year'][$key];
				$this->db->insert('registration',$insert);
				$ids[] = $this->db->insert_id();
			}
			else{
				$this->db->where('registration_id',$q)->where('doctor_id',$user['doctor_id'])->delete('registration');
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Registration updated.","type"=>"success","ids"=>$ids));
	}
	public function update_membership()
	{
		$user = $this->check_login();
		$ids = array();
		foreach ($_POST['id'] as $key => $q) {
			if ($q > 0 && $_POST['delete'][$key] == 'no') {
				$update['title'] = $_POST['title'][$key];
				$this->db->where('membership_id',$q)->where('doctor_id',$user['doctor_id'])->update('membership',$update);
				$ids[] = $q;
			}
			else if ($q == 0 && $_POST['delete'][$key] == 'no') {
				$insert['doctor_id'] = $user['doctor_id'];
				$insert['title'] = $_POST['title'][$key];
				$this->db->insert('membership',$insert);
				$ids[] = $this->db->insert_id();
			}
			else{
				$this->db->where('membership_id',$q)->where('doctor_id',$user['doctor_id'])->delete('membership');
			}
		}
		echo json_encode(array("status"=>true,"msg"=>"Membership updated.","type"=>"success","ids"=>$ids));
	}
	public function add_clinic()
	{
		$user = $this->check_login();
		if (isset($_POST['hospital_id']) && intval($_POST['hospital_id']) > 0) {
			$chk = $this->model->get_row("SELECT * FROM `doctor_hospital` WHERE `doctor_id` = '' AND `hospital_id` = '';");
			if (!($chk)) {
				$insert['fee'] = $_POST['fee'];
				$insert['hospital_id'] = $_POST['hospital_id'];
				$insert['doctor_id'] = $user['doctor_id'];
				$this->db->insert('doctor_hospital',$insert);
				$resp = $this->model->get_doctor_hospital_by_ids($user['doctor_id'],$_POST['hospital_id']);
				$hospitalChk = 'old';
			}
		}
		else{
			$fee = $_POST['fee'];unset($_POST['fee']);
			$_POST['doctor_id'] = $user['doctor_id'];
			$this->db->insert('hospital',$_POST);
			$hospitalId = $this->db->insert_id();
			$insert['hospital_id'] = $hospitalId;
			$insert['doctor_id'] = $user['doctor_id'];
			$insert['fee'] = $fee;
			$this->db->insert('doctor_hospital',$insert);
			$resp = $this->model->get_doctor_hospital_by_ids($user['doctor_id'],$hospitalId);
			$hospitalChk = 'new';
		}
		if ($resp) {
			$html = '<tr id="doctor_hospital_'.$resp['doctor_hospital_id'].'">';
                $html .= '<td>'.$resp['name'].'</td>';
                $html .= '<td>'.$resp['address'].'</td>';
                $html .= '<td>'.$resp['cityName'].'</td>';
                $html .= '<td>'.$resp['fee'].'</td>';
                $html .= '<td>'.$resp['timing_note'].'</td>';
                $html .= '<td>';
                    $html .= '<div class="table-action">';
	                    $html .= '<a href="javascript://" class="btn btn-sm bg-info-light edit-clinic" data-id="'.$doctor_hospital['doctor_hospital_id'].'" data-name="'.$resp['name'].'" data-fee="'.$resp['fee'].'" data-timing_note="'.$resp['timing_note'].'">';
	                		$html .= '<i class="feather-edit"></i>';
	                	$html .= '</a>';
                    	$html .= '<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital" data-id="'.$resp['doctor_hospital_id'].'" data-hospital-id="'.$resp['hospital_id'].'" data-name="'.$resp['name'].'">';
                        $html .= '    <i class="feather-x-circle"></i>';
                        $html .= '</a>';
                    $html .= '</div>';
                $html .= '</td>';
            $html .= '</tr>';
			echo json_encode(array("status"=>true,"msg"=>"Clinic added.","type"=>"success","html"=>$html,"hospitalChk"=>$hospitalChk));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Clinic not added, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function delete_doctor_hospital()
	{
		$user = $this->check_login();
		$this->db->where('doctor_hospital_id',$_POST['id']);
		$this->db->where('doctor_id',$user['doctor_id']);
		$resp = $this->db->delete('doctor_hospital');
		if ($resp) {
			$this->db->where('doctor_id',$user['doctor_id'])->where('hospital_id',$_POST['hospital_id'])->delete('time_slot');
			$option = '<option value="'.$_POST['hospital_id'].'">'.$_POST['name'].'</option>';
			echo json_encode(array("status"=>true,"msg"=>"Clinic deleted.","type"=>"success","option"=>$option));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Clinic not deleted, please try again or reload your web page.","type"=>"error"));
		}

	}
	public function update_clinic()
	{
		$user = $this->check_login();
		$this->db->where('doctor_id',$user['doctor_id']);
		$this->db->where('doctor_hospital_id',$_POST['id']);
		$this->db->set('fee',$_POST['fee']);
		$this->db->set('timing_note',$_POST['timing_note']);
		$resp = $this->db->update('doctor_hospital');
		if ($resp) {
			$resp = $this->model->get_doctor_hospital_by_id($user['doctor_id'],$_POST['id']);
            $html = '<td>'.$resp['name'].'</td>';
            $html .= '<td>'.$resp['address'].'</td>';
            $html .= '<td>'.$resp['cityName'].'</td>';
            $html .= '<td>'.$resp['fee'].'</td>';
            $html .= '<td>'.$resp['timing_note'].'</td>';
            $html .= '<td>';
                $html .= '<div class="table-action">';
                	$html .= '<a href="javascript://" class="btn btn-sm bg-info-light edit-clinic" data-id="'.$doctor_hospital['doctor_hospital_id'].'" data-name="'.$resp['name'].'" data-fee="'.$resp['fee'].'" data-timing_note="'.$resp['timing_note'].'">';
                		$html .= '<i class="feather-edit"></i>';
                	$html .= '</a>';
                	$html .= '<a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital" data-id="'.$resp['doctor_hospital_id'].'" data-hospital-id="'.$resp['hospital_id'].'" data-name="'.$resp['name'].'">';
                    $html .= '    <i class="feather-x-circle"></i>';
                    $html .= '</a>';
                $html .= '</div>';
            $html .= '</td>';
			echo json_encode(array("status"=>true,"msg"=>"Clinic updated.","type"=>"success","html"=>$html,"id"=>$_POST['id']));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Clinic not updated, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function submit_time_slots()
	{
		$user = $this->check_login();
		$dates = array("", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		$insert['doctor_id'] = $user['doctor_id'];
		$insert['day_number'] = $_POST['day_number'];
		$insert['day_name'] = $dates[$_POST['day_number']];
		$insert['hospital_id'] = $_POST['hospital_id'];
		foreach ($_POST['start'] as $key => $q) {
			$insert['time_start'] = $q;
			$insert['time_end'] = $_POST['end'][$key];
			$this->db->insert('time_slot',$insert);
		}
		$slots = $this->model->get_slots_by_day_number($user['doctor_id'],$_POST['day_number']);
		$html = '';
		foreach ($slots as $key => $slot){
			$html .= '<div class="doc-slot-list">';
				$html .=date("h:i a",strtotime($slot['time_start'])).' - '.date("h:i a",strtotime($slot['time_end']));
				$html .= '<a href="javascript:void(0)" class="delete_schedule doctor-dashboard-submit-btn" data-id="'.$slot['time_slot_id'].'"><i class="fa fa-times"></i></a>';
			$html .= '</div>';
		}
		$divID = "#slot_".$insert['day_name'];
		echo json_encode(array("status"=>true,"msg"=>"Time slot(s) added.","type"=>"success","html"=>$html,"divID"=>$divID));
	}
	public function delete_schedule()
	{
		$user = $this->check_login();
		$resp = $this->db->where('doctor_id',$user['doctor_id'])->where('time_slot_id',$_POST['id'])->delete('time_slot');
		if ($resp) {
			$data = $this->model->get_appointments_by_slot($_POST['id'],$user['doctor_id']);
			foreach ($data as $key => $q) {
				$patient = $this->model->get_patient_byid($q['patient_id']);
				$this->db->where('appointment_id',$_POST['id']);
				$this->db->where('patient_id',$q['patient_id']);
				$this->db->where('doctor_id',$q['doctor_id']);
				$this->db->set('status','cancel');
				$this->db->set('cancel_note','Time Slot Deleted by the doctor');
				$this->db->set('cancel_by','doctor');
				if ($q['payment_method'] == 'online') {
					$this->db->set('cash_back','pending');
					$this->db->set('cash_back_amount',$q['fee']);
				}
				$resp2 = $this->db->update('appointment');
				if ($resp2) {
					if ($q['payment_method'] == 'online') {
						$balance = $doctor['balance']-$q['fee'];
						$this->db->where('doctor_id',$user['doctor_id']);
						$this->db->set('balance',$balance);
						$this->db->update('doctor');
					}
					/**
					 * Email sending
					*/
					$emailData['patient'] = $patient;
					$emailData['doctor'] = $user;
					$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['id']);
					//patient
					$this->send_mail('Appointment canceled',$this->load->view('email/patient_booking_cancel',$emailData,true),$patient['email'],false);
					//doctor
					$this->send_mail('Appointment canceled',$this->load->view('email/doctor_booking_cancel',$emailData,true),$user['email'],false);
				}
			}
			echo json_encode(array("status"=>true,"msg"=>"Time slot deleted.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Time slot not deleted, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function cancel_appointment()
	{
		$user = $this->check_login();
		$q = $this->model->get_appointment_by_id($_POST['id']);
		$patient = $this->model->get_patient_byid($q['patient_id']);
		$this->db->where('appointment_id',$_POST['id']);
		$this->db->where('patient_id',$q['patient_id']);
		$this->db->where('doctor_id',$q['doctor_id']);
		$this->db->set('status','cancel');
		$this->db->set('cancel_note',$_POST['cancel_note']);
		$this->db->set('cancel_by','doctor');
		if ($q['payment_method'] == 'online') {
			$this->db->set('cash_back','pending');
			$this->db->set('cash_back_amount',$q['fee']);
		}
		$resp = $this->db->update('appointment');
		if ($resp) {
			if ($q['payment_method'] == 'online') {
				$balance = $doctor['balance']-$q['fee'];
				$this->db->where('doctor_id',$user['doctor_id']);
				$this->db->set('balance',$balance);
				$this->db->update('doctor');
			}
			/**
			 * Email sending
			*/
			$emailData['patient'] = $patient;
			$emailData['doctor'] = $user;
			$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['id']);
			//patient
			$this->send_mail('Appointment canceled',$this->load->view('email/patient_booking_cancel',$emailData,true),$patient['email'],false);
			//doctor
			$this->send_mail('Appointment canceled',$this->load->view('email/doctor_booking_cancel',$emailData,true),$user['email'],false);
			
			echo json_encode(array("status"=>true,"msg"=>"appointment canceled.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not canceled, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function appointment_confirm()
	{
		$user = $this->check_login();
		$q = $this->model->get_appointment_by_id($_POST['id']);
		$patient = $this->model->get_patient_byid($q['patient_id']);
		$this->db->where('appointment_id',$_POST['id']);
		$this->db->where('patient_id',$q['patient_id']);
		$this->db->where('doctor_id',$q['doctor_id']);
		$this->db->set('status','confirm');
		$resp = $this->db->update('appointment');
		if ($resp) {
			/**
			 * Email sending
			*/
			$emailData['patient'] = $patient;
			$emailData['doctor'] = $user;
			$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['id']);
			//patient
			$this->send_mail('Appointment Confirmed',$this->load->view('email/patient_booking_confirm',$emailData,true),$patient['email'],false);
			//doctor
			$this->send_mail('Appointment Confirmed',$this->load->view('email/doctor_booking_confirm',$emailData,true),$user['email'],false);
			
			echo json_encode(array("status"=>true,"msg"=>"appointment confirmed.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not confirmed, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function complete_appointment()
	{
		$user = $this->check_login();
		$q = $this->model->get_appointment_by_id($_POST['id']);
		$patient = $this->model->get_patient_byid($q['patient_id']);
		$this->db->where('appointment_id',$_POST['id']);
		$this->db->where('patient_id',$q['patient_id']);
		$this->db->where('doctor_id',$q['doctor_id']);
		$this->db->set('status','done');
		$this->db->set('prescription_title',$_POST['prescription_title']);
		$this->db->set('prescription',$_POST['prescription']);
		$resp = $this->db->update('appointment');
		if ($resp) {
			if ($q['payment_method'] == 'cash') {
				$earned = $user['earned'] + $q['fee'];
				$payable = $user['payable'] + ($q['total'] - $q['fee']);
				$this->db->where('doctor_id',$user['doctor_id']);
				$this->db->set('earned',$earned);
				$this->db->set('payable',$payable);
				$this->db->update('doctor');
			}
			/**
			 * Email sending
			*/
			$emailData['patient'] = $patient;
			$emailData['doctor'] = $user;
			$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['id']);
			//patient
			$this->send_mail('Appointment Completed',$this->load->view('email/patient_booking_complete',$emailData,true),$patient['email'],false);
			//doctor
			$this->send_mail('Appointment Completed',$this->load->view('email/doctor_booking_complete',$emailData,true),$user['email'],false);
			
			echo json_encode(array("status"=>true,"msg"=>"appointment completed.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not completed, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function appointments()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Appointments';
		$data['appointments_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_appointments_by_doctor($user['doctor_id']);
		$this->template('doctor/appointments',$data, 'appointments');
	}
	public function my_patients()
	{
		$user = $this->check_login();
		$data['page_title'] = 'My Patients';
		$data['my_patients_active'] = 'active';
		$data['userSession'] = $user;
		$data['patients'] = $this->model->get_patients_by_doctor($user['doctor_id']);
		$this->template('doctor/my_patients',$data, false);
	}
	public function accounts()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Accounts';
		$data['accounts_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_done_appointments_by_doctor($user['doctor_id']);
		$this->template('doctor/accounts',$data, 'accounts');
	}
	public function invoices($value='')
	{
		$user = $this->check_login();
		$data['page_title'] = 'Invoices';
		$data['invoices_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_done_appointments_by_doctor($user['doctor_id']);
		$this->template('doctor/invoices',$data, false);
	}
	public function update_account()
	{
		$user = $this->check_login();
		$this->db->where('doctor_id',$user['doctor_id']);
		$resp = $this->db->update('doctor',$_POST);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"account updated.","type"=>"success","data"=>$_POST));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not updated, please try again.","type"=>"error"));
		}
	}
	public function medical_records()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Medical Records';
		$data['medical_records_active'] = 'active';
		$data['userSession'] = $user;
		$data['patients'] = $this->model->get_patients_by_doctor($user['doctor_id']);
		if ($_SESSION['medical_records']['status'] == true) {
			$data['patient_id'] = $_SESSION['medical_records']['patient_id'];
			$resp['appointment'] = $this->model->get_appointment_by_id($_SESSION['medical_records']['appointment_id']);
			$resp['records'] = $this->model->get_medical_records($_SESSION['medical_records']['appointment_id']);
			$data['medical_records'] = $this->load->view('doctor/html/medical_records',$resp, TRUE);
			$data['appointments'] = $this->model->appointments_by_patient($_SESSION['medical_records']['patient_id']);
			$data['medical_records_msg_status'] = true;
			$data['medical_records_msg_type'] = $_SESSION['medical_records']['medical_records_type'];
			$data['medical_records_msg'] = $_SESSION['medical_records']['medical_records_msg'];
			unset($_SESSION['medical_records']);
		}
		$this->template('doctor/medical_records',$data, 'medical_records');
	}
	public function get_appointments_by_patient()
	{
		$user = $this->check_login();
		$resp = $this->model->appointments_by_patient($_POST['id']);
		if ($resp) {
			$html = '<option value="">Select Appointment</option>';
			foreach ($resp as $key => $q) {
				$html .= '<option value="'.$q['appointment_id'].'">'.$q['appointment_id'].'</option>';
			}
			echo json_encode(array("status"=>true,"msg"=>"Appointments loaded.","type"=>"success","html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"No appointment found for this patient.","type"=>"error"));
		}
	}
	public function get_medical_records()
	{
		$user = $this->check_login();
		$resp['appointment'] = $this->model->get_appointment_by_id($_POST['appointment_id']);
		$resp['records'] = $this->model->get_medical_records($_POST['appointment_id']);
		if ($resp['appointment']) {
			$html = $this->load->view('doctor/html/medical_records',$resp, TRUE);
			echo json_encode(array("status"=>true,"msg"=>"Appointment record loaded.","type"=>"success","html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"No medical record found.","type"=>"error"));
		}
	}
	public function post_medical_record()
	{
		$user = $this->check_login();
		$file = $this->file_upload($_FILES);
		if ($file) {
			$_SESSION['medical_records']['status'] = true;
			$_POST['file'] = $file;
			$_POST['doctor_id'] = $user['doctor_id'];
			$_POST['dated'] = date('Y-m-d',strtotime($_POST['dated']));
			$resp = $this->db->insert('medical_record',$_POST);
			if ($resp) {
				$_SESSION['medical_records']['medical_records_type'] = true;
				$_SESSION['medical_records']['medical_records_msg'] = 'medical record uploaded.';
				/**
				* Email sending
				*/
				$emailData['patient'] = $this->model->get_patient_byid($_POST['patient_id']);
				$emailData['doctor'] = $user;
				$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['appointment_id']);
				//patient
				$this->send_mail('Medical Record Uploaded',$this->load->view('email/patient_medical_record_uploaded',$emailData,true),$patient['email'],false);
			}
			else{
				$_SESSION['medical_records']['medical_records_type'] = false;
				$_SESSION['medical_records']['medical_records_msg'] = 'file not uploaded, please upload an image or pdf file.';
			}
		}
		else{
			$_SESSION['medical_records']['medical_records_type'] = false;
			$_SESSION['medical_records']['medical_records_msg'] = 'file not uploaded, please upload an image or pdf file.';
		}
		$_SESSION['medical_records']['patient_id'] = $_POST['patient_id'];
		$_SESSION['medical_records']['appointment_id'] = $_POST['appointment_id'];
		redirect("doctor/medical-records");
	}
	public function reviews()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Reviews';
		$data['reviews_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_done_appointments_by_doctor($user['doctor_id']);
		$this->template('doctor/reviews',$data, false);
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
