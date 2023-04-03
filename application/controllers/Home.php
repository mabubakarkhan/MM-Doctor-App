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
		
		Signup/Login/Doctor

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
		$chk = $this->model->check_dublicate_phone(trim_phone($_POST['phone']),'doctor');
		if ($chk) {
			echo json_encode(array("status"=>false,"msg"=>"phone number (".$_POST['phone'].") is already in use."));
		}
		else{
			$_POST['password'] = md5($_POST['password']);
			$this->db->insert('doctor',$_POST);
			$resp = $this->model->get_doctor_byid($this->db->insert_id());
			if ($resp) {
				$resp['controller'] = 'doctor';
				$_SESSION['user'] = serialize($resp);
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
		
		Signup/Login/Patient

	*
	*/
	public function login()
	{
		$this->template('login',$data);
	}
	public function register()
	{
		$this->template('register',$data);
	}
	
	/**
		
		Site

	*
	*/
	public function index()
	{
		$this->template('index',$data);
	}
}