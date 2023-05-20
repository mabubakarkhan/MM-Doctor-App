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
		$data['medical_records'] = $this->model->get_medical_records_by_patient($user['patient_id']);
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
		if ($q['payment_method'] == 'online') {
			$this->db->set('cash_back','pending');
			$this->db->set('cash_back_amount',$q['fee']);
		}
		$resp = $this->db->update('appointment');
		if ($resp) {
			$q = $this->model->get_appointment_by_id($_POST['id']);
			if ($q['payment_method'] == 'online') {
				$doctor = $this->model->get_doctor_byid($q['doctor_id']);
				$balance = $doctor['balance']-$q['fee'];
				$this->db->where('doctor_id',$doctor['doctor_id']);
				$this->db->set('balance',$balance);
				$this->db->update('doctor');
			}
			/**
			 * Email sending
			*/
			$emailData['patient'] = $user;
			$emailData['doctor'] = $doctor;
			$emailData['appointment'] = $this->model->get_appointment_by_id($_POST['id']);
			//patient
			$this->send_mail('Appointment canceled',$this->load->view('email/patient_booking_cancel',$emailData,true),$user['email'],false);
			//doctor
			$this->send_mail('Appointment canceled',$this->load->view('email/doctor_booking_cancel',$emailData,true),$doctor['email'],false);
			
			echo json_encode(array("status"=>true,"msg"=>"appointment canceled.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not canceled, please try again or reload your web page.","type"=>"error"));
		}
	}
	public function medical_records()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Medical Records';
		$data['medical_records_active'] = 'active';
		$data['userSession'] = $user;
		$resp['records'] = $this->model->get_medical_records_by_patient($user['patient_id']);
		$data['medical_records'] = $this->load->view('patient/html/medical_records',$resp, TRUE);
		if ($_SESSION['medical_records']['status'] == true) {
			$data['medical_records_msg_status'] = true;
			$data['medical_records_msg_type'] = $_SESSION['medical_records']['medical_records_type'];
			$data['medical_records_msg'] = $_SESSION['medical_records']['medical_records_msg'];
			unset($_SESSION['medical_records']);
		}
		$this->template('patient/medical_records',$data, 'medical_records');
	}
	public function search_medical_records()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Medical Records';
		$data['search_medical_records_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->appointments_by_patient($user['patient_id']);
		if ($_SESSION['medical_records']['status'] == true) {
			$resp['appointment'] = $this->model->get_appointment_by_id($_SESSION['medical_records']['appointment_id']);
			$resp['records'] = $this->model->get_medical_records($_SESSION['medical_records']['appointment_id']);
			$data['medical_records'] = $this->load->view('patient/html/search_medical_records',$resp, TRUE);
			$data['medical_records_msg_status'] = true;
			$data['medical_records_msg_type'] = $_SESSION['medical_records']['medical_records_type'];
			$data['medical_records_msg'] = $_SESSION['medical_records']['medical_records_msg'];
			unset($_SESSION['medical_records']);
		}
		$this->template('patient/search_medical_records',$data, 'search_medical_records');
	}
	public function get_medical_records()
	{
		$user = $this->check_login();
		$resp['appointment'] = $this->model->get_appointment_by_id($_POST['appointment_id']);
		$resp['records'] = $this->model->get_medical_records($_POST['appointment_id']);
		if ($resp['appointment']) {
			$html = $this->load->view('patient/html/medical_records',$resp, TRUE);
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
			$_POST['dated'] = date('Y-m-d',strtotime($_POST['dated']));
			$_POST['patient_id'] = $user['patient_id'];
			$resp = $this->db->insert('medical_record',$_POST);
			if ($resp) {
				$_SESSION['medical_records']['medical_records_type'] = true;
				$_SESSION['medical_records']['medical_records_msg'] = 'medical record uploaded.';
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
		redirect("patient/medical-records");
	}
	public function remove_record()
	{
		$user = $this->check_login();
		$resp = $this->db->where('patient_id',$user['patient_id'])->where('medical_record_id',$_POST['id'])->delete('medical_record');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Record deleted.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Record not deleted.","type"=>"error"));
		}
	}
	public function invoices($value='')
	{
		$user = $this->check_login();
		$data['page_title'] = 'Invoices';
		$data['invoices_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_appointments_by_patient($user['patient_id']);
		$this->template('patient/invoices',$data, false);
	}
	public function favourites()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Favourites';
		$data['favourites_active'] = 'active';
		$data['userSession'] = $user;
		$data['favourites'] = $this->model->get_favourites($user['patient_id']);
		$this->template('patient/favourites',$data, 'favourites');
	}
	public function remove_favourite($value='')
	{
		$user = $this->check_login();
		$resp = $this->db->where('bookmark_doctor_id',$_POST['id'])->where('patient_id',$user['patient_id'])->delete('bookmark_doctor');
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Bookmark deleted.","type"=>"success"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Bookmark not deleted.","type"=>"error"));
		}
	}
	public function reviews()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Reviews';
		$data['reviews_active'] = 'active';
		$data['userSession'] = $user;
		$data['appointments'] = $this->model->get_done_appointments_by_patient($user['patient_id']);
		$data['reviews'] = $this->load->view('patient/html/reviews.php',array("appointments"=>$data['appointments']),TRUE);
		$this->template('patient/reviews',$data, "reviews");
	}
	public function post_review()
	{
		$user = $this->check_login();
		$post = $_POST;
		$appointment_id = $post['id'];unset($post['id']);
		$appointment = $this->model->get_appointment_by_id($appointment_id);
		if ($appointment['review'] == 'pending' && $appointment['status'] == 'done' && $appointment['patient_id'] == $user['patient_id']) {
			$post['appointment_id'] = $appointment['appointment_id'];
			$post['doctor_id'] = $appointment['doctor_id'];
			$post['patient_id'] = $appointment['patient_id'];
			$resp = $this->db->insert('review',$post);
			if ($resp) {
				$this->db->where('patient_id',$user['patient_id'])->where('appointment_id',$appointment_id)->update('appointment',array("review"=>"done"));
				$doctor = $this->model->get_doctor_byid($appointment['doctor_id']);
				$ratting = $this->db->select('AVG(ratting) as average')
			    ->where('doctor_id', $doctor['doctor_id'])
			    ->from('review')
			    ->get()
			    ->row();
				$update['review_count'] = $doctor['review_count']+1;
				$update['ratting'] = $ratting->average;
				$this->db->where('doctor_id',$doctor['doctor_id'])->update('doctor',$update);
				/**
				 * Email sending
				*/
				$emailData['patient'] = $user;
				$emailData['doctor'] = $doctor;
				$emailData['appointment'] = $appointment;
				$emailData['review'] = $post['review'];
				$emailData['ratting'] = $post['ratting'];
				//doctor
				$this->send_mail('Appointment review submitted',$this->load->view('email/doctor_appointment_review',$emailData,true),$doctor['email'],false);
				$appointments = $this->model->get_done_appointments_by_patient($user['patient_id']);
				$html = $this->load->view('patient/html/reviews.php',array("appointments"=>$appointments),TRUE);
				echo json_encode(array("status"=>true,"msg"=>"Review submitted.","type"=>"success","html"=>$html));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"review not submitted, please try again or reload your web page.","type"=>"error"));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Something went wrong.","type"=>"error"));
		}
	}
	/**
	*

	@Domestic
		
	*
	*/
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
