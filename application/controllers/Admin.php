<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	        $this->load->library('session');
	}

	/**
	*

		@HATH NA LAIE

	*
	*/
	public function template($page = '', $data = '')
	{
		if (isset($_SESSION['admin']))
		{
			$data['admin'] = unserialize($_SESSION['admin']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('admin/header',$data);
		$this->load->view($page,$data);
		$this->load->view('admin/footer',$data);
	}
	public function login_template($page = '', $data = '')
	{
		if (isset($_SESSION['admin']))
		{
			$data['admin'] = unserialize($_SESSION['admin']);
			$data['login'] = true;
		}
		else
		{
			$data['login'] = false;
		}
		$this->load->view('admin/new_login_header',$data);
		$this->load->view($page,$data);
		$this->load->view('admin/new_login_footer',$data);

	}




	/**
	
	@Login Randi-Rona

	*/
	
	public function login()
	{
		if (isset($_SESSION['admin']))
		{
			redirect('admin/index');
			return;
		}
		$data['title'] = 'Login';
		$this->login_template('admin/signin', $data);
	}
	public function check_login()
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin']!= "")
		{
			$user = unserialize($_SESSION['admin']);
			$username = $user['username'];
			$password = $user['password'];
			$resp = $this->model->get_row("SELECT * FROM `admin` WHERE `username` = '$username'  AND `password` =  '$password'");
			if ($resp)
			{
				return $user;
			}
			else
			{
				redirect('admin/login');
			}
		}
		else 
		{
			redirect('admin/login');
		}
	}
	public function change_password()
	{
		$user = $this->check_login();
		$data['signin'] = FALSE;
		$username = $user['username'];
		if (isset($_POST['password']) && strlen($_POST['password']) > 0 && isset($_POST['re_password']) && strlen($_POST['re_password']) > 0) 
		{
			$password = md5($_POST['password']);
			$re_password = md5($_POST['re_password']);
			if ($password === $re_password) 
			{
				if ($this->db->update('admin', array("password"=>$password), array("username"=>$username))) 
				{
					redirect("admin/logout");
				}
			}
			else
			{
				redirect("admin/change_password?error=1&msg='Your Provided Passwords are not matched, please try with correct password'");
			}
		}
		$data['username'] = $username;
		$this->template("admin/change_password", $data);
	}

	public function logout()
	{
		unset($_SESSION['admin']);
		redirect("admin/login");
	}
	/**
	@Login Ajax
	*/
	public function process_login()
	{
		if ($_POST)
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$resp = $this->model->get_row("SELECT * FROM `admin` WHERE `username` = '$username'  AND `password` =  '$password';");
			if ($resp)
			{
				$_SESSION['admin'] = serialize($resp);
				redirect('admin/index');
				return;
			}
			else
			{
				redirect('admin/login');
				return;
			}
		}
		else
		{
			redirect('admin');
		}
	}
	

	/***************************************
	*	callling main index function here 
	****************************************/
	public function doctors($status='all')
	{
		$this->index($status);
	}
	public function index($status = 'all')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['page_title'] = $status.' doctors';
		$data['menu'] = $status.'_doctors';
		$data['doctors'] = $this->model->admin_doctors($status);
		$this->template('admin/doctors', $data);
	}
	public function patients($status = 'all')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['page_title'] = $status.' patients';
		$data['menu'] = $status.'_patients';
		$data['patients'] = $this->model->admin_patients($status);
		$this->template('admin/patients', $data);
	}
	public function appointments()
	{
		$user = $this->check_login();
		$data['title'] = $by.' '.$status.' appointments';
		$data['get'] = $_GET;
		$this->template('admin/appointments', $data);
	}
	public function get_appointments_ajax()
	{
		// error_reporting(E_ALL);
		$user = $this->check_login();
		parse_str($_POST['data'],$get);
		$data['appointments'] = $this->model->get_appointments_admin($get);
		$html = $this->load->view('admin/html/appointments',$data,TRUE);
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function appointment_cancel()
	{
		// error_reporting(E_ALL);
		$user = $this->check_login();
		parse_str($_POST['form'],$form);
		$q = $this->model->get_appointment_by_id($form['id']);
		$patient = $this->model->get_patient_byid($q['patient_id']);
		$doctor = $this->model->get_doctor_byid($q['doctor_id']);
		$this->db->where('appointment_id',$form['id']);
		$this->db->where('patient_id',$q['patient_id']);
		$this->db->where('doctor_id',$q['doctor_id']);
		$this->db->set('status','cancel');
		$this->db->set('cancel_note',$form['cancel_note']);
		$this->db->set('cancel_by','admin');
		if ($q['payment_method'] == 'online') {
			$this->db->set('cash_back','pending');
			$this->db->set('cash_back_amount',$q['fee']);
		}
		$resp = $this->db->update('appointment');
		if ($resp) {
			if ($q['payment_method'] == 'online') {
				$balance = $doctor['balance']-$q['fee'];
				$this->db->where('doctor_id',$doctor['doctor_id']);
				$this->db->set('balance',$balance);
				$this->db->update('doctor');
			}
			/**
			 * Email sending
			*/
			$emailData['patient'] = $patient;
			$emailData['doctor'] = $doctor;
			$emailData['appointment'] = $this->model->get_appointment_by_id($form['id']);
			//patient
			$this->send_mail('Appointment canceled',$this->load->view('email/patient_booking_cancel',$emailData,true),$patient['email'],false);
			//doctor
			$this->send_mail('Appointment canceled',$this->load->view('email/doctor_booking_cancel',$emailData,true),$doctor['email'],false);

			parse_str($_POST['data'],$get);
			$data['appointments'] = $this->model->get_appointments_admin($get);
			$html = $this->load->view('admin/html/appointments',$data,TRUE);
			
			echo json_encode(array("status"=>true,"msg"=>"appointment canceled.","html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"appointment not canceled, please try again or reload your web page."));
		}
	}
	public function appointment_medical_records()
	{
		$user = $this->check_login();
		$resp = $this->model->get_medical_records($_POST['id']);
		if ($resp) {
			$html = '';
			foreach ($resp as $key => $q) {
				$html .= '<tr>';
                    $html .= '<td>'.($key+1).'</td>';
                    $html .= '<td>'.$q['patientFname'].' '.$q['patientLname'].'</td>';
                    $html .= '<td>'.date('d M Y',strtotime($q['dated'])).'</span></td>';
                    $html .= '<td>'.$q['detail'].'</td>';
                    $html .= '<td>';
                        $html .= '<a href="'.UPLOADS.$q['file'].'" title="Download attachment" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>';
                    $html .= '</td>';
                $html .= '</tr>';
			}
		}
		else{
			$html = '<td colspan="5">No record found yet.</td>';
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function cats($status = 'all')
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['page_title'] = $status.' categories';
		$data['menu'] = $status.'_cats';
		$data['cats'] = $this->model->cats($status);
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/cats', $data);
	}
	public function photos($product)
	{
		$user = $this->check_login();
		$data['product'] = $this->model->get_product_byid($product);
		$data['page_title'] = $data['product']['title']." -> Photos";
		$data['photos'] = $this->model->photos($product);
		$this->template('admin/photos',$data);
	}
	public function offers()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['page_title'] = 'Offers';
		$data['menu'] = 'offers';
		$data['products'] = $this->model->offers();
		$this->template('admin/offers', $data);
	}
	public function sliders()
	{
		$user = $this->check_login();
		$data['page_title'] = "Slider";
		$data['photos'] = $this->model->slider();
		$data['menu'] = 'sliders';
		$this->template('admin/sliders',$data);
	}

	public function pages()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['signin'] = FALSE;
		$data['page_title'] = 'All Pages';
		$data['menu'] = 'pages';
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];
		$data['pages'] = $this->model->pages();
		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/pages', $data);
	}
	
	public function setting()
	{
		$user = $this->check_login();
		$data['q'] = $this->model->setting(1);
		$data['page_title'] = "Edit: Setting";
		$data['mode'] = "edit";
		$data['signin'] = FALSE;
		$data['menu'] = 'setting';
		$this->template('admin/setting', $data);
	}
	public function blog()
	{
		$user = $this->check_login();
		$data['title'] = "Admin Panel";
		$data['page_title'] = 'All Posts';
		$data['menu'] = 'blog';
		$data['blog'] = $this->model->blog();
		$this->template('admin/blog', $data);
	}
	public function reviews()
	{
		$user = $this->check_login();
		$data['data'] = $this->model->reviews();
		$data['page_title'] = "Testimonials";
		$data['mode'] = "edit";
		$data['signin'] = FALSE;
		$data['menu'] = 'reviews';
		$this->template('admin/reviews', $data);
	}
	public function contact_forms($status = 'all')
	{
		$user = $this->check_login();
		$data['data'] = $this->model->contact_form($status);
		$data['page_title'] = $status." contact forms";
		$data['mode'] = "edit";
		$data['signin'] = FALSE;
		$data['menu'] = $status.'_form';
		$this->template('admin/contact_forms', $data);
	}
	public function newsletters()
	{
		$user = $this->check_login();
		$data['data'] = $this->model->newsletters();
		$data['page_title'] = "Newsletters";
		$data['mode'] = "edit";
		$data['signin'] = FALSE;
		$data['menu'] = 'newsletters';
		$this->template('admin/newsletters', $data);
	}
	/**********************************************
	*	starting Add functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/

	public function add_product()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Product';
		$data['menu'] = 'add_product';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];

		$data['cats'] = $this->model->cats('all');

		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_product', $data);
	}
	public function add_offer()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Offer';
		$data['menu'] = 'offers';
		$this->template('admin/add_offer', $data);
	}
	public function add_cat()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Category';
		$data['menu'] = 'add_cat';
		$data['signin'] = FALSE;
		$data['username'] = $user['username'];
		$data['password'] = $user['password'];

		$data['msg_code'] = isset($_GET['msg']) && $_GET['msg'] != '' ? $_GET['msg'] : FALSE;
		$data['error'] = isset($_GET['error']) && $_GET['error'] != '' ? 'error' : 'correct';
		$this->template('admin/add_cat', $data);
	}
	public function add_blog()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Blog Post';
		$data['menu'] = 'blog';
		$this->template('admin/add_blog', $data);
	}

	/**********************************************
	*	starting insert functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	************************************************/

	public function post_product()
	{
		$user = $this->check_login();
		$resp = $this->db->insert("product", $_POST);
		redirect("admin/products/".$_POST['status']."/?msg=Property Added!");
	}
	public function post_offer()
	{
		$user = $this->check_login();
		$resp = $this->db->insert("offer", $_POST);
		redirect("admin/offers/?msg=Offer Added!");
	}
	public function post_photos()
	{
		$user = $this->check_login();
		foreach($_FILES["image"]["tmp_name"] as $key => $img) {

			$_FILES['file']['name']       = $_FILES['image']['name'][$key];
            $_FILES['file']['type']       = $_FILES['image']['type'][$key];
            $_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$key];
            $_FILES['file']['error']      = $_FILES['image']['error'][$key];
            $_FILES['file']['size']       = $_FILES['image']['size'][$key];

			$config['upload_path'] = 'uploads/';
	    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
	    	$config['encrypt_name'] = TRUE;
	    	$ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["file"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
	    	$resp = $this->load->library('upload', $config);
	    	if ($resp) {
	        	$this->upload->do_upload('file');
				$insert['product_id'] = $_POST['product_id'];
				$insert['img'] = $this->upload->data()['file_name'];
				$this->db->insert("photo", $insert);
	    	}
		}
		redirect("admin/photos/".$_POST['product_id']."/?msg=Photos Added!");
	}
	public function post_cat()
	{
		$user = $this->check_login();
		$resp = $this->db->insert("category", $_POST);
		redirect("admin/cats/?msg=Category Added!");
	}
	public function post_blog()
	{
		$user = $this->check_login();
		$resp = $this->db->insert("blog", $_POST);
		redirect("admin/blog/?msg=Blog Post Added!");
	}
	public function post_sliders()
	{
		$user = $this->check_login();
		foreach($_FILES["image"]["tmp_name"] as $key => $img) {

			$_FILES['file']['name']       = $_FILES['image']['name'][$key];
            $_FILES['file']['type']       = $_FILES['image']['type'][$key];
            $_FILES['file']['tmp_name']   = $_FILES['image']['tmp_name'][$key];
            $_FILES['file']['error']      = $_FILES['image']['error'][$key];
            $_FILES['file']['size']       = $_FILES['image']['size'][$key];

			$config['upload_path'] = 'uploads/';
	    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
	    	$config['encrypt_name'] = TRUE;
	    	$ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["file"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
	    	$resp = $this->load->library('upload', $config);
	    	if ($resp) {
	        	$this->upload->do_upload('file');
				$insert['image'] = $this->upload->data()['file_name'];
				$this->db->insert("slider", $insert);
	    	}
		}
		redirect("admin/sliders/?msg=Slider Added!");
	}
	public function post_review()
	{
		$user = $this->check_login();
		$resp = $this->db->insert("review", $_POST);
		redirect("admin/reviews/?msg=Testimonial Added!");
	}

	/**********************************************
	*	starting edit functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo
	************************************************/
	public function edit_product()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo ("Wrong Product ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_product_byid($new_id);
			$data['cats'] = $this->model->cats('all');
			$data['page_title'] = "Edit: Product";
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['menu'] = 'all_products';
			$this->template('admin/add_product', $data);
		}
	}
	public function edit_offer()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo ("Wrong Offer ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_offer_byid($new_id);
			$data['page_title'] = "Edit: Offer";
			$data['mode'] = "edit";
			$data['menu'] = 'offers';
			$this->template('admin/add_offer', $data);
		}
	}
	public function edit_cat()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo ("Wrong Category ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_cat_byid($new_id);
			$data['page_title'] = "Edit: Category";
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['menu'] = 'all_cats';
			$this->template('admin/add_cat', $data);
		}
	}
	public function edit_blog()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo ("Wrong Blog ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_blog_byid($new_id);
			$data['page_title'] = "Edit: Blog Post";
			$data['mode'] = "edit";
			$data['menu'] = 'blog';
			$this->template('admin/add_blog', $data);
		}
	}
	public function edit_page()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo ("Wrong Page ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_page_byid($new_id);
			$data['page_title'] = "Edit: Page";
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['menu'] = 'pages';
			$this->template('admin/add_page', $data);
		}
	}
	
	/**********************************************
	*	starting update functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	
	************************************************/

	public function update_product()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where("product_id",$aid);
		$data = $this->db->update("product", $_POST);
		if($data)
		{
			redirect("admin/products/".$_POST['status']."?msg=Edited Product");
		}
		else
		{
			redirect("admin/products/".$_POST['status']."?error=1&msg=Error occured while Editing Product");
		}
	}
	public function update_offer()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where("offer_id",$aid);
		$data = $this->db->update("offer", $_POST);
		if($data)
		{
			redirect("admin/offers/?msg=Edited Offer");
		}
		else
		{
			redirect("admin/offers/?error=1&msg=Error occured while Editing Offer");
		}
	}
	public function update_cat()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where("category_id",$aid);
		$data = $this->db->update("category", $_POST);
		if($data)
		{
			redirect("admin/cats/?msg=Edited Category");
		}
		else
		{
			redirect("admin/cats/?error=1&msg=Error occured while Editing Category");
		}
	}
	public function update_blog()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$_POST['updated_by'] = $user['admin_id'];
		$_POST['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where("blog_id",$aid);
		$data = $this->db->update("blog", $_POST);
		if($data)
		{
			redirect("admin/blog/?msg=Edited Blog Post");
		}
		else
		{
			redirect("admin/blog/?error=1&msg=Error occured while Editing Blog Post");
		}
	}
	public function update_page()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where("page_id",$aid);
		$data = $this->db->update("page", $_POST);
		if($data)
		{
			redirect("admin/pages/?msg=Edited Page");
		}
		else
		{
			redirect("admin/pages/?error=1&msg=Error occured while Editing Page");
		}
	}
	public function update_setting()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where("setting_id",1);
		$data = $this->db->update("setting", $_POST);
		if($data)
		{
			redirect("admin/setting/?msg=Edited Setting");
		}
		else
		{
			redirect("admin/setting/?error=1&msg=Error occured while Editing Setting");
		}
	}
	

	/**********************************************
	*	starting delete functions from here for:
	*	company, News&Events, Home, Collection, Albums And Photo 	
	************************************************/
	public function delete_product()
	{
		$user = $this->check_login();
		$product = $this->model->get_product_byid($_GET['id']);
		$this->db->where('product_id', $_GET['id']);
		$resp = $this->db->delete('product');
		if($resp)
		{
			unlink('uploads/'.$product['image']);
			$photos = $this->model->photos($_GET['id']);
			foreach ($photos as $key => $photo) {
				unlink('uploads/'.$photo['img']);
			}
			$this->db->where('product_id',$_GET['id']);
			$this->db->delete('photo');
			redirect("admin/products/all/?msg=Product has Deleted");
		}
		else
		{
			redirect("admin/products/all/?error=1&msg=Product has failed to delete. Try Again!");
		}
	}
	public function delete_offer()
	{
		$user = $this->check_login();
		$product = $this->model->get_offer_byid($_GET['id']);
		$this->db->where('offer_id', $_GET['id']);
		$resp = $this->db->delete('offer');
		if($resp)
		{
			unlink('uploads/'.$product['image']);
			redirect("admin/offers/?msg=Offer has Deleted");
		}
		else
		{
			redirect("admin/offers/?error=1&msg=Offer has failed to delete. Try Again!");
		}
	}
	public function delete_product_photo($product)
	{
		$user = $this->check_login();
		$photo = $this->model->get_row("SELECT `img` FROM `photo` WHERE `photo_id` = '".$_GET['id']."';");
		$this->db->where('photo_id', $_GET['id']);
		$resp = $this->db->delete('photo');
		if($resp)
		{
			unlink('uploads/'.$photo['img']);
			redirect("admin/photos/".$product."/?msg=Product Photo has Deleted");
		}
		else
		{
			redirect("admin/photos/".$product."/?error=1&msg=Product Photo has failed to delete. Try Again!");
		}
	}
	public function delete_slider()
	{
		$user = $this->check_login();
		$slider = $this->model->get_row("SELECT `image` FROM `slider` WHERE `slider_id` = '".$_GET['id']."';");
		$this->db->where('slider_id', $_GET['id']);
		$resp = $this->db->delete('slider');
		if($resp)
		{
			unlink('uploads/'.$slider['image']);
			redirect("admin/sliders/?msg=Slider has Deleted");
		}
		else
		{
			redirect("admin/sliders/?error=1&msg=Slider has failed to delete. Try Again!");
		}
	}
	public function delete_blog()
	{
		$user = $this->check_login();
		$this->db->where('blog_id', $_GET['id']);
		$resp = $this->db->delete('blog');
		if($resp)
		{
			redirect("admin/blog/?msg=News has Deleted");
		}
		else
		{
			redirect("admin/blog/?error=1&msg=News has failed to delete. Try Again!");
		}
	}
	public function delete_review()
	{
		$user = $this->check_login();
		$this->db->where('review_id', $_GET['id']);
		$resp = $this->db->delete('review');
		if($resp)
		{
			redirect("admin/reviews/?msg=Testimonial has Deleted");
		}
		else
		{
			redirect("admin/reviews/?error=1&msg=Testimonial has failed to delete. Try Again!");
		}
	}
	public function delete_form()
	{
		$user = $this->check_login();
		$this->db->where('contact_form_id', $_GET['id']);
		$resp = $this->db->delete('contact_form');
		if($resp)
		{
			redirect("admin/contact-forms/?msg=Contact Form has Deleted");
		}
		else
		{
			redirect("admin/contact-forms/?error=1&msg=Contact Form has failed to delete. Try Again!");
		}
	}
	public function delete_newsletter()
	{
		$user = $this->check_login();
		$this->db->where('newsletter_id', $_GET['id']);
		$resp = $this->db->delete('newsletter');
		if($resp)
		{
			redirect("admin/newsletters/?msg=Email has Deleted");
		}
		else
		{
			redirect("admin/newsletters/?error=1&msg=Email has failed to delete. Try Again!");
		}
	}

	/**
	*

	@AJAX PHOTO
		
	*
	*/
	public function post_photo_ajax()
	{
		$user = $this->check_login();
		if ($_FILES){
			$config['upload_path'] = 'uploads/';
        	$config['allowed_types'] = 'gif|jpeg|jpg|png|PNG|JPEG|JPG|GIF';
        	$config['encrypt_name'] = TRUE;
        	$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES['img']['name']).'.'.$ext;
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
        	if ($this->upload->do_upload('img'))
        	{
	        	$img = $this->upload->data()['file_name'];
	        	echo json_encode(array("status"=>true,"data"=>$img));
        	}
        	else{
        		#error
	        	echo json_encode(array("status"=>false));
        	}

		}
		else{
			redirect('admin/logout');
		}
	}
	/**
	*

	@AJAX
		
	*
	*/

	public function get_doctor_detail()
	{
		$user = $this->check_login();
		$doctor = $this->model->get_doctor_profile($_POST['id']);
		if ($doctor) {
			$data['appointments_count'] = $this->db->where('doctor_id',$_POST['id'])->from("appointment")->count_all_results();
			$data['appointments_count_pending'] = $this->db->where('doctor_id',$_POST['id'])->where('status','pending')->from("appointment")->count_all_results();
			$data['appointments_count_done'] = $this->db->where('doctor_id',$_POST['id'])->where('status','done')->from("appointment")->count_all_results();
			$data['appointments_count_cancel'] = $this->db->where('doctor_id',$_POST['id'])->where('status','cancel')->from("appointment")->count_all_results();
			$data['appointments_count_confirm'] = $this->db->where('doctor_id',$_POST['id'])->where('status','confirm')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_doctor'] = $this->db->where('doctor_id',$_POST['id'])->where('cancel_by','doctor')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_patient'] = $this->db->where('doctor_id',$_POST['id'])->where('cancel_by','patient')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_admin'] = $this->db->where('doctor_id',$_POST['id'])->where('cancel_by','admin')->from("appointment")->count_all_results();
			$data['appointments_medical_record'] = $this->db->where('doctor_id',$_POST['id'])->from("medical_record")->count_all_results();

			$data['q'] = $doctor;
			$data['hospitals'] = $this->model->doctor_hospitals($_POST['id']);
			$data['awards'] = $this->model->all_award_by_doctor($_POST['id']);
			$data['educations'] = $this->model->all_education_by_doctor($_POST['id']);
			$data['experiences'] = $this->model->all_experience_by_doctor($_POST['id']);
			$data['memberships'] = $this->model->all_membership_by_doctor($_POST['id']);
			$data['registrations'] = $this->model->all_registration_by_doctor($_POST['id']);

			$html = $this->load->view('admin/html/doctor',$data,TRUE);
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function get_patient_detail()
	{
		error_reporting(E_ALL);
		$user = $this->check_login();
		$patient = $this->model->get_patient_profile($_POST['id']);
		if ($patient) {
			$data['appointments_count'] = $this->db->where('patient_id',$_POST['id'])->from("appointment")->count_all_results();
			$data['appointments_count_pending'] = $this->db->where('patient_id',$_POST['id'])->where('status','pending')->from("appointment")->count_all_results();
			$data['appointments_count_done'] = $this->db->where('patient_id',$_POST['id'])->where('status','done')->from("appointment")->count_all_results();
			$data['appointments_count_cancel'] = $this->db->where('patient_id',$_POST['id'])->where('status','cancel')->from("appointment")->count_all_results();
			$data['appointments_count_confirm'] = $this->db->where('patient_id',$_POST['id'])->where('status','confirm')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_doctor'] = $this->db->where('patient_id',$_POST['id'])->where('cancel_by','doctor')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_patient'] = $this->db->where('patient_id',$_POST['id'])->where('cancel_by','patient')->from("appointment")->count_all_results();
			$data['appointments_cancel_by_admin'] = $this->db->where('patient_id',$_POST['id'])->where('cancel_by','admin')->from("appointment")->count_all_results();
			$data['appointments_medical_record'] = $this->db->where('patient_id',$_POST['id'])->from("medical_record")->count_all_results();

			$data['q'] = $patient;

			$html = $this->load->view('admin/html/patient',$data,TRUE);
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function update_doctor()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$this->db->where('doctor_id',$id);
		$resp = $this->db->update('doctor',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"profile updated :)"));
		}
		else{
			echo json_encode(array("status"=>true,"msg"=>"profile not updated :( please try again or reload your webpage."));
		}
	}
	public function update_patient()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$id = $post['id'];unset($post['id']);
		$resp = $this->db->where('patient_id',$id)->update('patient',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"profile updated :)"));
		}
		else{
			echo json_encode(array("status"=>true,"msg"=>"profile not updated :( please try again or reload your webpage."));
		}
	}


	public function change_product_status()
	{
		if ($_POST) {
			$user = $this->check_login();
			$this->db->where('product_id',$_POST['id']);
			$resp  = $this->db->update('product',array("status"=>$_POST['status']));
			if ($resp) {
				echo json_encode(array("msg"=>"Saved"));
			}
			else{
				echo json_encode(array("msg"=>"Not Saved"));
			}
		}
	}
	public function change_cat_status()
	{
		if ($_POST) {
			$user = $this->check_login();
			$this->db->where('category_id',$_POST['id']);
			$resp  = $this->db->update('category',array("status"=>$_POST['status']));
			if ($resp) {
				echo json_encode(array("msg"=>"Saved"));
			}
			else{
				echo json_encode(array("msg"=>"Not Saved"));
			}
		}
	}
	public function change_form_status()
	{
		if ($_POST) {
			$user = $this->check_login();
			$this->db->where('contact_form_id',$_POST['id']);
			$resp  = $this->db->update('contact_form',array("status"=>$_POST['status']));
			if ($resp) {
				echo json_encode(array("msg"=>"Saved"));
			}
			else{
				echo json_encode(array("msg"=>"Not Saved"));
			}
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
}
