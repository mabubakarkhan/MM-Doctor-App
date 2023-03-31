<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	public function check_login_old($redrc = FALSE)
	{
		if(isset($_SESSION['User']) && $_SESSION['User']!= "")
		{
			$email = $_SESSION['User']['email'];
			$phone = $_SESSION['User']['phone'];
			$password = $_SESSION['User']['password'];
			$new = $this->model->get_row("SELECT * FROM `user` WHERE (`email` = '$email' OR `phone` = '$phone') AND `password` = '$password';");
			if($new)
			{
				$_SESSION['User'] = $new;
				return $new;
			}
			else
			{
				unset($_SESSION['User']);
				unset($_SESSION['User']);
				redirect('user-login');
			}
		}
		else
		{
			redirect('user-login');
		}
	}
	public function check_login($redrc = FALSE)
	{
		if(isset($_SESSION['User']) && $_SESSION['User']!= "")
		{
			$user = $_SESSION['User'];
			$id = $_SESSION['User']['user_id'];
			$email = $_SESSION['User']['email'];
			$phone = $_SESSION['User']['phone'];
			$password = $_SESSION['User']['password'];

			if ($user['signup_type'] == 'facebook') {
				$id = $user['fb_id'];
				$resp = $this->model->get_row("SELECT * FROM `user` WHERE `fb_id` = '$id'");
			}
			else if ($user['signup_type'] == 'google') {
				$id = $user['fb_id'];
				$resp = $this->model->get_row("SELECT * FROM `user` WHERE `google_id` = '$id'");
			}
			else if ($user['account_type'] == 'quick') {
				$resp = $this->model->get_row("SELECT * FROM `user` WHERE `email` = '$email' AND `user_id` = '$id';");
			}
			else{
				$resp = $this->model->get_row("SELECT * FROM `user` WHERE (`email` = '$email' OR `phone` = '$phone') AND `password` = '$password';");
			}
			if ($resp)
			{
				$_SESSION['User'] = $resp;
				return $resp;
			}
			else
			{
				unset($_SESSION['User']);
				unset($_SESSION['user']);
				redirect('user-login');
			}
		}
		else 
		{
			redirect('user-login');
		}
	}
	/*     TEMPLATE     */
	public function template($page = '', $data = '')
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
	}
	/**
	*

	@Main Functions Starts From Here
		
	*
	*/
	public function dashboard()
	{
		$user = $this->check_login();
		$this->index();
	}
	public function index()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['country'] = $this->model->get_country_byid($user['country_id']);
		$data['countries'] = $this->model->countries();
		$data['meta_title'] = 'Dashboard';
		$this->template('user/index',$data);
	}
	public function reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'My Reviews';
		if (strlen($user['review_tables']) > 1) {
			$data['reviews'] = $this->model->user_reviews($user['user_id'],$user['review_tables']);
		}
		else{
			$data['reviews'] = false;
		}
		$this->template('user/reviews',$data);
	}

	/**
	*

	@AJAX Functions
		
	*
	*/
	public function post_photo_ajax()
	{
		if ($_FILES){
			$config['upload_path'] = 'uploads/';
        	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES["img"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["img"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
        	$resp = $this->load->library('upload', $config);
        	if ($resp) {
	        	$this->upload->do_upload('img');
				$FileName = $this->upload->data()['file_name'];
				echo json_encode(array("status"=>true,"data"=>$FileName));
        	}
        	else{
				echo json_encode(array("status"=>false,"data"=>'File Must be an image file.'));
        	}
		}
		else{
			redirect('logout');
		}
	}
	public function update_user_profile()
	{
		$user = $this->check_login();
		if ($_POST) {
			parse_str($_POST['data'],$post);
			if (!(isset($post['invite_to_review']))) {
				$post['invite_to_review'] = 'no';
			}
			if (!(isset($post['general_updates']))) {
				$post['general_updates'] = 'no';
			}
			if (!(isset($post['inspiration']))) {
				$post['inspiration'] = 'no';
			}
			if (!(isset($post['new_features']))) {
				$post['new_features'] = 'no';
			}
			if (!(isset($post['account_related_emails']))) {
				$post['account_related_emails'] = 'no';
			}
			$this->db->where('user_id',$user['user_id']);
			$resp = $this->db->update('user',$post);
			if ($resp) {
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"profile not updated, please try again or reload your webpage."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"data missing"));
		}
	}
	public function delete_review()
	{
		$user = $this->check_login();
		if ($_POST) {
			$update['status'] = 'delete';
			$this->db->where('company_review_id', $_POST['id']);
   			$resp = $this->db->update($_POST['tbl'],$update);
   			if ($resp) {
   				$tbl = $_POST['tbl'];
   				$check = $this->model->get_row("SELECT `company_review_id` FROM `$tbl` WHERE `status` = 'aprove' AND `user_id` = '".$user['user_id']."';");
   				if ($check) {
   					echo json_encode(array("status"=>true));
   				}
   				else{
   					$tblz = explode(',', $user['review_tables']);
   					$UPDATE['review_tables'] = false;
   					$Count = 0;
   					for ($i=0; $i < count($tblz); $i++) { 
   						if ($tblz[$i] == $tbl) {
							unset($tblz[$i]);
							break;
   						}
   					}
   					$UPDATE['review_tables'] = implode(',', $tblz);
   					$this->db->where('user_id', $user['user_id']);
   					$resp = $this->db->update('user',$UPDATE);
   					echo json_encode(array("status"=>true));
   				}
   			}
   			else{
   				echo json_encode(array("status"=>false,"msg"=>"not deleted, please try again or reload your web page"));
   			}
		}
	}
	public function update_review()
	{
		$user = $this->check_login();
		if ($_POST) {
			parse_str($_POST['data'],$post);
			$update['review_text'] = $post['review_text'];
			$this->db->where('company_review_id', $post['id']);
			$resp = $this->db->update($post['ref'], $update);
			if ($resp) {
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"not updated, please try again or reload your web page."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>":)"));
		}
	}
	public function delete_profile()
	{
		$user = $this->check_login();
		$this->db->where('user_id', $user['user_id']);
   		$resp = $this->db->delete('user');
   		if ($resp) {
			unset($_SESSION['Company']);
			unset($_SESSION['User']);
			redirect('home');
   		}
   		else{
   			redirect('user/dashboard');
   		}
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
}
