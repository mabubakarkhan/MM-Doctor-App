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
        echo json_encode('invalid call!');
	}

	

	/**
	*

		@HATH NA LAIE

	*
	*/

	/******
		
		Login



	*******/
	public function login($arg='')
	{
		$data['title'] = 'Login';
		$this->load->view('admin/login' ,$data);
	}

	public function process_login()
	{
		//$user = $this->check_login();
		if(!isset($_POST['username']) || $_POST['username'] == "")
		{
			$data['title'] = "Username/Password Error";
			$data['error'] = TRUE;
			$this->load->view('admin/login' ,$data);
		}
		else
		{
			$result = $this->model->login($_POST['username'], md5($_POST['password']));
			if(!$result)
			{
				$data['title'] = "Admin Panel";
				$data['error'] = TRUE;
				$this->load->view('admin/login' ,$data);
			}
			else
			{
				$_SESSION['user'] = serialize($result);
				$_SESSION['current'] = DEFAULT_CONTROLLER;
				redirect("admin/index");
			}
		}
	}
	public function check_login($redrc = FALSE)
	{
		if(isset($_SESSION['user']) && $_SESSION['user']!= "" && isset($_SESSION['current']) )
		{
			$user = unserialize($_SESSION['user']);
			$username = $user['username'];
			$password = $user['password'];
			$new = $this->model->login($username, $password);
			if($new)
			{
				$_SESSION['user'] = serialize($new);
				return $new;
			}
			else
			{
				unset($_SESSION['user']);
				redirect('admin/login');
			}
		}
		else
		{
			if($redrc)
			{
				return FALSE;
			}
			redirect('admin/login');
		}
	}
	public function logout($arg='')
	{
		unset($_SESSION['user']);
		redirect('admin/login');
	}


	/*     Login         */

	public function template($page = '', $data = '')
	{
		$data['user'] = unserialize($_SESSION['user']);
		$this->load->view('admin/header',$data);
		$this->load->view($page,$data);
		$this->load->view('admin/footer',$data);
	}
	/*     SETTINGS         */
	public function settings()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Settings';
		$data['data'] = $this->model->get_settings($status);
		$this->template('admin/settings',$data);
	}
	public function update_setting($value='')
	{
		if ($_POST) {
			$this->db->where('id',$_POST['id']);
			$this->db->update('settings',array("value"=>$_POST['value']));
			redirect('admin/settings');
		}
	}
	/*     EMAILS         */
	public function dynamic_emails()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Emails Dynamic';
		$data['page_active'] = 'dynamic-emails';
		$data['data'] = $this->model->get_dynamic_emails();
		$this->template('admin/dynamic_emails',$data);
	}
	public function update_dynamic_email()
	{
		if ($_POST) {
			$this->db->where('dynamic_email_id',$_POST['id']);
			unset($_POST['id']);
			$resp = $this->db->update('dynamic_email',$_POST);
			redirect('admin/dynamic-emails');
		}	
	}
	public function email_templates()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Email Templates';
		$data['page_active'] = 'email_templates';
		$data['data'] = $this->model->get_email_templates(0);
		$data['countries'] = $this->model->countries();
		$this->template('admin/email_templates',$data);
	}
	public function post_email_template()
	{
		$this->db->insert('email_template',$_POST);
		redirect('admin/email-templates');
	}
	public function update_email_template()
	{
		if ($_POST) {
			$this->db->where('email_template_id',$_POST['id']);
			unset($_POST['id']);
			$this->db->update('email_template',$_POST);
			redirect('admin/email-templates');
		}
	}
	public function submit_companies_email_to_send_email()
	{
		if ($_POST['country_id'] == '0') {
			$companies = $this->model->get_results("SELECT `email` FROM `company`;");
		}
		else{
			$companies = $this->model->get_results("SELECT `email` FROM `company` WHERE `country_id` = '".$_POST['country_id']."' ;");
		}
		if ($companies) {
			$insert['email_template_id'] = $_POST['id'];
			foreach ($companies as $key => $q) {
				$insert['email'] = $q['email'];
				$this->db->insert('send_email',$insert);
			}
			redirect('admin/email-templates');
		}
		else{
			redirect('admin/email-templates');
		}
	}
	public function update_email_template_contacts_bulk()
    {
        if ($_FILES) {
            $fp = fopen($_FILES['csv']['tmp_name'],'r') or die("can't open file");
            $insert['email_template_id'] = $_POST['email_template_id'];
            while($csv_line = fgetcsv($fp,1024))
            {
                for($i = 0, $j = count($csv_line); $i < $j; $i++)
                {
                    $insert['email'] = $csv_line[0];
                }
                $i++;
                $this->db->insert('send_email',$insert);
            }
            fclose($fp) or die("can't close file");
        }
        redirect('admin/email-templates');
    }
	/**
	*

	@Main Functions Starts From Here
		
	*
	*/
	public function index()
	{
		$user = $this->check_login();
		$this->dashboard();
	}
	public function home()
	{
		$user = $this->check_login();
		$this->dashboard();
	}
	public function dashboard()
	{
		$this->companies();
	}
	public function companies($status = 'all')
	{
		$user = $this->check_login();
		$data['page_title'] = $status.' companies';
		$data['page_active'] = $status.'_companies';
		$data['companies'] = $this->model->get_all_companies($status);
		$data['notifications'] = $this->model->notifications();
		$this->template('admin/companies',$data);
	}
	public function company_products($id)
	{
		$user = $this->check_login();
		$data['company'] = $this->model->get_company_byid($id);
		$data['page_title'] = $data['company']['company_name']."'s Products";
		$data['page_active'] = $data['company']['status'].'_companies';
		$data['data'] = $this->model->get_all_company_products('all',$id);
		$this->template('admin/company_products',$data);
	}
	public function company_services($id)
	{
		$user = $this->check_login();
		$data['company'] = $this->model->get_company_byid($id);
		if ($data['company']['services_allow'] == 'no') {
			redirect('admin/logout');
		}
		$data['page_title'] = $data['company']['company_name']."'s Services";
		$data['page_active'] = $data['company']['status'].'_companies';
		$data['cat'] = $this->model->get_sub_cat_byid($data['company']['category_id']);
		$data['services'] = $this->model->get_services_by_ids($data['cat']['service_ids']);
		$this->template('admin/company_services',$data);
	}
	public function transections()
	{
		$user = $this->check_login();
		$data['company'] = $this->model->get_company_byid($id);
		$data['page_title'] = "Transections";
		$data['page_active'] ='transections';
		$data['data'] = $this->model->get_all_transections();
		$this->template('admin/transections',$data);
	}
	//services
	public function services()
	{
		$user = $this->check_login();
		$data['page_title'] = "All Services";
		$data['page_active'] = 'services';
		$data['data'] = $this->model->services();
		$this->template('admin/services',$data);
	}
	//CATs
	public function super_cats($status = 'all')
	{
		$user = $this->check_login();
		$data['page_title'] = $status.' super categories';
		$data['page_active'] = $status.'_super_cats';
		$data['cats'] = $this->model->get_super_cats($status);
		$this->template('admin/super_cats',$data);
	}
	public function cats($status = 'all', $super_cat_id = 0)
	{
		$user = $this->check_login();
		$data['page_title'] = $status.' Categories';
		$data['page_active'] = $status.'_cats';
		$data['super_cat_id'] = $super_cat_id;
		$data['cats'] = $this->model->get_cats($status,$super_cat_id);
		$this->template('admin/cats',$data);
	}
	public function sub_cats($status = 'all', $cat_id = 0)
	{
		$user = $this->check_login();
		$data['page_title'] = $status.' sub categories';
		$data['page_active'] = $status.'_sub_cats';
		$data['cat_id'] = $cat_id;
		$data['data'] = $this->model->get_sub_cats($status,$cat_id);
		$this->template('admin/sub_cats',$data);
	}
	//user
	public function users($status = 'all')
	{
		$user = $this->check_login();
		$data['page_title'] = $status.' users';
		$data['page_active'] = $status.'_users';
		$data['users'] = $this->model->get_users($status);
		$this->template('admin/users',$data);
	}
	//contact form
	public function contact_form($status = 'all')
	{
		$user = $this->check_login();
		$data['status'] = $status;
		$data['page_title'] = $status.' messages';
		$data['page_active'] = $status.'_contact_form';
		$data['form'] = $this->model->get_contact_form($status);
		$this->template('admin/contact_form',$data);
	}
	//widgets
	public function widgets()
	{
		$user = $this->check_login();
		$data['page_title'] = "All Widgets";
		$data['page_active'] = 'widgets';
		$data['data'] = $this->model->widgets('active');
		$this->template('admin/widgets',$data);	
	}
	//services
	public function industries()
	{
		$user = $this->check_login();
		$data['page_title'] = "All Industries";
		$data['page_active'] = 'industries';
		$data['data'] = $this->model->industries();
		$this->template('admin/industries',$data);
	}
	//notifications
	public function notifications()
	{
		$user = $this->check_login();
		$data['page_title'] = "All Notifications";
		$data['page_active'] = 'notifications';
		$data['data'] = $this->model->notifications();
		$this->template('admin/notifications',$data);
	}
	//Flag
	public function flag_categories()
	{
		$user = $this->check_login();
		$data['page_title'] = "Flag's Categories";
		$data['page_active'] = 'flag_categories';
		$data['data'] = $this->model->flag_categories();
		$this->template('admin/flag_categories',$data);
	}
	public function flag_requestes()
	{
		$user = $this->check_login();
		$data['page_title'] = "Flag Requestes";
		$data['page_active'] = 'flag_requestes';
		$data['data'] = $this->model->flag_requestes();
		$this->template('admin/flag_requestes',$data);
	}
	/**
	*

	@Add Functions
		
	*
	*/
	public function add_company()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Company';
		$data['page_active'] = 'add_company';
		$data['cats'] = $this->model->get_sub_cats('active');
		$data['countries'] = $this->model->countries();
		$this->template('admin/add_company',$data);
	}
	public function add_service()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Service';
		$data['page_active'] = 'add_service';
		$this->template('admin/add_service',$data);
	}
	public function add_industry()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Industry';
		$data['page_active'] = 'industries';
		$this->template('admin/add_industry',$data);
	}
	public function add_notification()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Notification';
		$data['page_active'] = 'notifications';
		$this->template('admin/add_notification',$data);
	}
	public function add_company_product($id)
	{
		$user = $this->check_login();
		$data['company'] = $this->model->get_company_byid($id);
		$data['page_title'] = 'Add product to '.$data['company']['company_name'];
		$data['page_active'] = $data['company']['status'].'_companies';
		$this->template('admin/add_company_product',$data);
	}
	public function add_super_cat()
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Super Category';
		$data['page_active'] = 'add_super_cat';
		$this->template('admin/add_super_cat',$data);
	}
	public function add_cat($super_cat_id = 0)
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Category';
		$data['page_active'] = 'add_cat';
		$data['super_cat_id'] = $super_cat_id;
		$data['cats'] = $this->model->get_super_cats('active');
		$this->template('admin/add_cat',$data);
	}
	public function add_sub_cat($cat_id = 0)
	{
		$user = $this->check_login();
		$data['page_title'] = 'Add Sub Category';
		$data['page_active'] = 'add_sub_cat';
		$data['cat_id'] = $cat_id;
		$data['cats'] = $this->model->get_cats('active',$cat_id);
		$data['services'] = $this->model->services();
		$this->template('admin/add_sub_cat',$data);
	}
	/**
	*

	@Insert Functions
		
	*
	*/
	public function post_company()
	{
		$user = $this->check_login();
		$emailCheck = $this->model->get_row("SELECT `email` FROM `company` WHERE `email` = '".$_POST['email']."';");
		if ($emailCheck) {
			//$this->db->insert('company',$_POST);
			redirect("admin/add-company/?msg=Error: Email is already in use.");
		}
		else{
			$tbl = $this->model->get_next_company_review_tbl();
			$_POST['company_review_tbl_id'] = $tbl['company_review_table_id'];
			$_POST['company_review_tbl'] = $tbl['tbl'];
			$this->db->insert('company',$_POST);
			$this->db->query("UPDATE `company_review_table` SET `count`=`count`+1 WHERE `company_review_table_id` = ".$tbl['company_review_table_id']."");
			redirect("admin/companies/".$_POST['status']."/?msg=Company Added!");
		}
	}
	public function post_service()
	{
		$user = $this->check_login();
		$this->db->insert('service',$_POST);
		redirect("admin/services/?msg=Service Added!");
	}
	public function post_industry()
	{
		$user = $this->check_login();
		$this->db->insert('industry',$_POST);
		redirect("admin/industries/?msg=Industry Added!");
	}
	public function post_notification()
	{
		$user = $this->check_login();
		$this->db->insert('notification',$_POST);
		redirect("admin/notifications/?msg=Notification Added!");
	}
	public function post_company_product()
	{
		$user = $this->check_login();
		$this->db->insert('company_product',$_POST);
		redirect("admin/company_products/".$_POST['company_id']."/?msg=Company Product Added!");
	}
	public function post_super_cat()
	{
		$user = $this->check_login();
		$this->db->insert('super_cat',$_POST);
		redirect("admin/super-cats/".$_POST['status']."/?msg=Category Added!");
	}
	public function post_cat($super_cat_id = 0)
	{
		$user = $this->check_login();
		$this->db->insert('cat',$_POST);
		redirect("admin/cats/".$_POST['status']."/".$super_cat_id."/?msg=Category Added!");
	}
	public function post_sub_cat($cat_id = 0)
	{
		$user = $this->check_login();
		$_POST['service_ids'] = implode(',', $_POST['service']);unset($_POST['service']);
		$this->db->insert('sub_cat',$_POST);
		redirect("admin/sub-cats/".$_POST['status']."/".$cat_id."/?msg=Sub Category Added!");
	}
	public function post_flag_cat()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('flag_category',$post);
		if ($resp) {
			$id = $this->db->insert_id();
			$html = '<tr id="row-'.$id.'">
                <td>'.$post['title'].'</td>
                <td><span class="badge badge-success">ACTIVE</span></td>
                <td><a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row get-flag-cat-reasons" data-id="'.$id.'" data-title="'.$post['title'].'" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-eye" aria-hidden="true"></i></a></td>
                <td>
                    <a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row flag-cat-edit" data-id="'.$id.'" data-title="'.$post['title'].'" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="javascript:del_q(\''.$id.'\')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                </td>
            </tr>';
            echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not added, please try again or reload your webpage."));
		}
	}
	public function post_flag_reason()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('flag_reason',$post);
		if ($resp) {
			$data = $this->model->get_flag_reasons($post['flag_category_id']);
			if ($data) {
				$html = '';
				foreach ($data as $key => $q) {
					$html .= '<tr>
		                <td>'.$q['title'].'</td>
		                <td>Action</td>
		            </tr>';
				}
			}
			else{
				$html = '<tr>
	                <td colspan="2">No reason found</td>
	            </tr>';
			}
            echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not added, please try again or reload your webpage."));
		}
	}
	/**
	*

	@Edit Functions
		
	*
	*/
	public function edit_company()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Company ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_company_byid($new_id);
			$data['cats'] = $this->model->get_sub_cats('active');
			$data['countries'] = $this->model->countries();
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Company';
			$data['page_active'] = $data['q']['status'].'_companies';
			$this->template('admin/add_company',$data);
		}
	}
	public function edit_service()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Service ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_service_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Service';
			$data['page_active'] = 'services';
			$this->template('admin/add_service',$data);
		}
	}
	public function edit_widget()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Widget ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_widget_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['page_title'] = 'Edit Widget';
			$data['page_active'] = 'widgets';
			$this->template('admin/add_widget',$data);
		}
	}
	public function edit_industry()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Industry ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_industry_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Industry';
			$data['page_active'] = 'industries';
			$this->template('admin/add_industry',$data);
		}
	}
	public function edit_notification()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Notification ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_notification_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Notification';
			$data['page_active'] = 'notifications';
			$this->template('admin/add_notification',$data);
		}
	}
	public function edit_company_product()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Company Product ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_company_product_byid($new_id);
			$data['company'] = $this->model->get_company_byid($data['q']['company_id']);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Company Product';
			$data['page_active'] = $data['company']['status'].'_companies';
			$this->template('admin/add_company_product',$data);
		}
	}
	public function edit_super_cat()
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Super Category ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_super_cat_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Super Category';
			$data['page_active'] = $data['q']['status'].'_super_cats';
			$this->template('admin/add_super_cat',$data);
		}
	}
	public function edit_cat($super_cat_id = 0)
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Category ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_cat_byid($new_id);
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['super_cat_id'] = $super_cat_id;
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Category';
			$data['page_active'] = $data['q']['status'].'_cats';
			$this->template('admin/add_cat',$data);
		}
	}
	public function edit_sub_cat($cat_id = 0)
	{
		$user = $this->check_login();
		$new_id = isset($_GET['id']) ? $_GET['id'] : 0;
		if($new_id < 1) 
		{
			echo json_encode("Wrong Sub Category ID has been passed");
		}
		else 
		{
			$data['q'] = $this->model->get_sub_cat_byid($new_id);
			$data['cats'] = $this->model->get_cats('active');
			$data['services'] = $this->model->services();
			if (!($data['q'])) {
				redirect('admin/logout');
			}
			$data['cat_id'] = $cat_id;
			$data['mode'] = "edit";
			$data['signin'] = FALSE;
			$data['page_title'] = 'Edit Sub Category';
			$data['page_active'] = $data['q']['status'].'_sub_cats';
			$this->template('admin/add_sub_cat',$data);
		}
	}
	/**
	*

	@Update Functions
		
	*
	*/
	public function update_company()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$Company = $this->model->get_company_byid($aid);
		$emailCheck = $this->model->get_row("SELECT `email` FROM `company` WHERE `email` = '".$_POST['email']."' AND `email` != '".$Company['email']."';");
		if ($emailCheck) {
			redirect("admin/edit-company/?id=".$aid."&msg=Error: Email is already in use.");
		}
		else{
			$this->db->where('company_id', $aid);
			$data = $this->db->update('company', $_POST);
			if($data)
			{
				redirect("admin/companies/".$_POST['status']."/?msg=Edited Company");
			}
			else
			{
				redirect("admin/edit-company/?id=".$aid."&msg=Error occured while Editing Company");
			}
		}
	}
	public function update_service()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('service_id', $aid);
		$data = $this->db->update('service', $_POST);
		if($data)
		{
			redirect("admin/services/?msg=Edited Service");
		}
		else
		{
			redirect("admin/edit-service/?id=".$aid."&msg=Error occured while Editing Service");
		}
	}
	public function update_widget()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('widget_id', $aid);
		$data = $this->db->update('widget', $_POST);
		if($data)
		{
			redirect("admin/widgets/?msg=Edited Widget");
		}
		else
		{
			redirect("admin/edit-widget/?id=".$aid."&msg=Error occured while Editing Widget");
		}
	}
	public function update_industry()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('industry_id', $aid);
		$data = $this->db->update('industry', $_POST);
		if($data)
		{
			redirect("admin/industries/?msg=Edited Industry");
		}
		else
		{
			redirect("admin/edit-industry/?id=".$aid."&msg=Error occured while Editing Industry");
		}
	}
	public function update_notification()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('notification_id', $aid);
		$data = $this->db->update('notification', $_POST);
		if($data)
		{
			redirect("admin/notifications/?msg=Edited Notification");
		}
		else
		{
			redirect("admin/edit-notification/?id=".$aid."&msg=Error occured while Editing Notification");
		}
	}
	public function update_company_product()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('company_product_id', $aid);
		$data = $this->db->update('company_product', $_POST);
		if($data)
		{
			redirect("admin/company-products/".$_POST['company_id']."/?msg=Edited Company Product");
		}
		else
		{
			redirect("admin/edit-company-product/?id=".$aid."&msg=Error occured while Editing Company Product");
		}
	}
	public function update_super_cat()
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('super_cat_id', $aid);
		$data = $this->db->update('super_cat', $_POST);
		if($data)
		{
			redirect("admin/super-cats/".$_POST['status']."/?msg=Edited Super Category");
		}
		else
		{
			redirect("admin/edit-super-cat/?id=".$aid."&msg=Error occured while Editing Super Category");
		}
	}
	public function update_cat($super_cat_id = 0)
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$this->db->where('cat_id', $aid);
		$data = $this->db->update('cat', $_POST);
		if($data)
		{
			redirect("admin/cats/".$_POST['status']."/".$super_cat_id."/?msg=Edited Category");
		}
		else
		{
			redirect("admin/edit-cat/".$super_cat_id."/?id=".$aid."&msg=Error occured while Editing Category");
		}
	}
	public function update_sub_cat($cat_id = 0)
	{
		$user = $this->check_login();
		$aid = $_POST['aid'];
		unset($_POST['aid'], $_POST['mode'], $_POST['security']);
		$_POST['service_ids'] = implode(',', $_POST['service']);unset($_POST['service']);
		$this->db->where('sub_cat_id', $aid);
		$data = $this->db->update('sub_cat', $_POST);
		if($data)
		{
			redirect("admin/sub-cats/".$_POST['status']."/".$cat_id."/?msg=Edited Sub Category");
		}
		else
		{
			redirect("admin/edit-sub-cat/".$cat_id."/?id=".$aid."&msg=Error occured while Editing Sub Category");
		}
	}
	public function update_company_services()
	{
		$user = $this->check_login();
		$company = $this->model->get_company_byid($_POST['company_id']);
		if ($company['services_allow'] == 'no') {
			redirect('admin/logout');
		}
		$update['service_ids'] = implode(',', $_POST['service']);
		$this->db->where('company_id', $_POST['company_id']);
		$data = $this->db->update('company', $update);
		if($data)
		{
			redirect("admin/company-services/".$_POST['company_id']."/?msg=Edited Services");
		}
		else
		{
			redirect("admin/company-services/".$_POST['company_id']."/?msg=Error occured while Editing Servies");
		}
	}
	public function update_flag_cat()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$update['title'] = $post['title'];
		$this->db->where('flag_category_id',$post['id']);
		$resp = $this->db->update('flag_category',$update);
		if ($resp) {
			$id = $post['id'];
			$html = '<td>'.$post['title'].'</td>
                <td><span class="badge badge-success">ACTIVE</span></td>
                <td><a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row get-flag-cat-reasons" data-id="'.$id.'" data-title="'.$post['title'].'" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-eye" aria-hidden="true"></i></a></td>
                <td>
                    <a href="javascript://" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row flag-cat-edit" data-id="'.$id.'" data-title="'.$post['title'].'" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="javascript:del_q(\''.$id.'\')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                </td>';
            echo json_encode(array("status"=>true,"id"=>$id,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not updated, please try again or reload your webpage."));
		}
	}
	/**
	*

	@Delete Functions
		
	*
	*/
	public function delete_service($id)
	{
		$user = $this->check_login();
		$this->db->where('service_id', $id);
   		$resp = $this->db->delete('service');
		if($resp)
		{
			redirect("admin/services/?msg=Service has Deleted");
		}
		else
		{
			redirect("admin/services/?&msg=Service has failed to delete. Try Again!");
		}
	}
	public function delete_industry($id)
	{
		$user = $this->check_login();
		$this->db->where('industry_id', $id);
   		$resp = $this->db->delete('industry');
		if($resp)
		{
			redirect("admin/industries/?msg=Industry has Deleted");
		}
		else
		{
			redirect("admin/industries/?&msg=Industry has failed to delete. Try Again!");
		}
	}
	public function delete_notification($id)
	{
		$user = $this->check_login();
		$this->db->where('notification_id', $id);
   		$resp = $this->db->delete('notification');
		if($resp)
		{
			redirect("admin/notifications/?msg=Notification has Deleted");
		}
		else
		{
			redirect("admin/notifications/?&msg=Notification has failed to delete. Try Again!");
		}
	}
	public function delete_company_product($pid,$cid)
	{
		$user = $this->check_login();
		if ($pid > 0) {
			$this->db->where('company_product_id', $pid);
	   		$resp = $this->db->delete('company_product');
			if($resp)
			{
				redirect("admin/company-products/".$cid."/?msg=Super Product has Deleted");
			}
			else
			{
				redirect("admin/company-products/".$cid."/?&msg=Super Product has failed to delete. Try Again!");
			}
		}
		else{
			redirect('admin/logout');
		}
	}
	public function delete_super_cat($id)
	{
		$user = $this->check_login();
		$cat = $this->model->get_super_cat_byid($id);
		if ($cat) {
			$this->db->where('super_cat_id', $id);
	   		$resp = $this->db->delete('super_cat');
			if($resp)
			{
				redirect("admin/super-cats/".$cat['status']."/?msg=Super Category has Deleted");
			}
			else
			{
				redirect("admin/super-cats/".$cat['status']."/?&msg=Super Category has failed to delete. Try Again!");
			}
		}
		else{
			redirect('admin/logout');
		}
	}
	public function delete_cat($id,$super_cat_id = 0)
	{
		$user = $this->check_login();
		$cat = $this->model->get_cat_byid($id);
		if ($cat) {
			$this->db->where('cat_id', $id);
	   		$resp = $this->db->delete('cat');
			if($resp)
			{
				redirect("admin/cats/".$cat['status']."/".$super_cat_id."/?msg=Category has Deleted");
			}
			else
			{
				redirect("admin/cats/".$cat['status']."/".$super_cat_id."/?&msg=Category has failed to delete. Try Again!");
			}
		}
		else{
			redirect('admin/logout');
		}
	}
	public function delete_sub_cat($id,$cat_id = 0)
	{
		$user = $this->check_login();
		$cat = $this->model->get_sub_cat_byid($id);
		if ($cat) {
			$this->db->where('sub_cat_id', $id);
	   		$resp = $this->db->delete('sub_cat');
			if($resp)
			{
				redirect("admin/sub-cats/".$cat['status']."/".$cat_id."/?msg=Sub Category has Deleted");
			}
			else
			{
				redirect("admin/sub-cats/".$cat['status']."/".$cat_id."/?&msg=Sub Category has failed to delete. Try Again!");
			}
		}
		else{
			redirect('admin/logout');
		}
	}
	public function delete_contact_form($id,$status)
	{
		$user = $this->check_login();
		$this->db->where('contact_form_id', $id);
   		$resp = $this->db->delete('contact_form');
		if($resp)
		{
			redirect("admin/contact-form/".$status."/?msg=Message has Deleted");
		}
		else
		{
			redirect("admin/contact-form/".$status."/?&msg=Message has failed to delete. Try Again!");
		}
	}
	public function delete_flag_category($id)
	{
		$user = $this->check_login();
		$this->db->where('flag_category_id', $id);
   		$resp = $this->db->delete('flag_category');
		if($resp)
		{
			redirect("admin/flag-categories/?msg=Category has Deleted");
		}
		else
		{
			redirect("admin/flag-categories/&msg=Category has failed to delete. Try Again!");
		}
	}
	
	/**
	*

	@AJAX Functions
		
	*
	*/
	public function post_photo_ajax()
	{
		$user = $this->check_login();
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
	public function change_company_status($value='')
	{
		$user = $this->check_login();
		if ($_POST) {
			$update['status'] = $_POST['status'];
			$this->db->where('company_id',$_POST['id']);
			$resp = $this->db->update('company',$update);
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"changed."));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"not changed, please try again or reload your web page."));
			}
		}
	}
	public function change_user_status($value='')
	{
		$user = $this->check_login();
		if ($_POST) {
			$update['status'] = $_POST['status'];
			$this->db->where('user_id',$_POST['id']);
			$resp = $this->db->update('user',$update);
			if ($resp) {
				echo json_encode(array("status"=>true,"msg"=>"changed."));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"not changed, please try again or reload your web page."));
			}
		}
	}
	public function get_services_by_catid()
	{
		$user = $this->check_login();
		if ($_POST) {
			$resp = $this->model->get_services_by_ids($_POST['services']);
			if ($resp) {
				$html = '<h2>Services</h2>';
				$html .= '<p>Select Only 4 services</p>';
				foreach ($resp as $key => $service) {
					$html .= '<div class="col-lg-4 form-horizontal">';
	                	$html .= '<div class="example-wrap">';
							$html .= '<div class="form-group form-material">';
								$html .= '<div class=" col-lg-12 col-sm-9">';
									$html .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service"> '.$service['title'];
								$html .= '</div><!-- /12 -->';
							$html .= '</div><!-- /form-group -->';
						$html .= '</div><!-- /example-wrap -->';
              		$html .= '</div><!-- /12/form-horizontal -->';
				}
				echo json_encode(array("status"=>true,"html"=>$html));
			}
			else{
				echo json_encode(array("status"=>false));
			}
		}
		else{
			redirect('admin/logout');
		}
	}
	public function change_contact_from_status()
	{
		$user = $this->check_login();
		if ($_POST) {
			$this->db->where("contact_form_id",$_POST['id']);
			$resp = $this->db->update('contact_form',array("status"=>$_POST['status']));
			if($resp)
			{
				echo json_encode(array("status"=>true,"msg"=>"status changed, will display after reload the page."));
			}
			else
			{
				echo json_encode(array("status"=>true,"msg"=>"status not changed, please try again or reload your web page."));
			}
		}
	}
	public function submit_all_notify()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$post['company_id'] = 0;
		$post['all'] = 'yes';
		$resp = $this->db->insert('notify',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Notification sent :)"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Notification not sent :("));
		}
	}
	public function submit_company_notify()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$post);
		$resp = $this->db->insert('notify',$post);
		if ($resp) {
			echo json_encode(array("status"=>true,"msg"=>"Notification sent :)"));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"Notification not sent :("));
		}
	}
	public function change_flag_request_status()
	{
		$user = $this->check_login();
		$flag = $this->model->flag_request_byid($_POST['id']);
		if ($flag['status'] == 'pending') {
			if ($_POST['status'] == 'accept') {
				$this->db->where('company_review_id',$flag['company_review_id']);
				$this->db->update($flag['review_table'],array("flag"=>"yes"));

				$this->db->where('flag_review_id',$flag['flag_review_id']);
				$this->db->update('flag_review',array("status"=>"accept","updated_at"=>date('Y-m-d H:i:s')));


				$email = $this->model->get_row("SELECT u.email,u.fname,u.lname,c.company_name,c.website,c.email AS company_email, c.company_id FROM `".$flag['review_table']."` AS r INNER JOIN `company` AS c ON c.company_id = r.company_id INNER JOIN `user` AS u ON u.user_id = r.user_id WHERE r.company_review_id = '".$flag['company_review_id']."';");
				//user
				$to = $email['email'];
				$subject = $email['company_name'].' flaged your review';
				$from = EMAIL_FROM;
				$headers = '';
			    $headers .= "From: ".$from."" ."\r\n" .
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				$html = '<!DOCTYPE html>
						<html lang="en">
						<head>
						  <title>Smart Review</title>
						  <meta charset="utf-8">
						  <meta name="viewport" content="width=device-width, initial-scale=1">
						  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
						</head>
						<body>

							<table style="width: 568px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto;">
								<tr>
									<td>
										<table style="background: #fff; padding: 20px; width: 100%; border-collapse: collapse;">
											<tr>
												<td style="width: 95%; display: block; margin: 0 auto; text-align: center; padding: 20px; background:#283749;">
													<img src="'.IMG.'logo.png" alt="logo">
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; background: #fff; padding: 20px;">
													<strong style="color: #000; font-size: 20px; display: block; font-family: \'Open Sans\' , sans-serif;">Hi '.$email['fname'].' '.$email['lname'].',</strong>
													<p style="color: #000; font-size: 13px; font-family: \'Open Sans\' , sans-serif;"> <a href="'.$email['website'].'" style="color: #000; text-decoration: none; font-weight: bold;">'.$email['website'].'</a> has just flaged your review.</p>
												</td>
											</tr>
											<tr>
												<td style="width: 70%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #283749; padding: 16px; border-top: 4px solid #fff; border-bottom: 20px solid #fff;">
													<a href="'.BASEURL.'single-review/'.$email['company_id'].'/'.$flag['company_review_id'].'"><span style="color: #fff; font-size: 15px; font-weight: bold; display: block; margin: 0 0 5px; font-family: \'Open Sans\' , sans-serif;">See Review</span></a>
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #ffcb05; padding:20px 12px; border-top: 4px solid #283749; border-bottom: 20px solid #fff;">
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 40px;">
														Please note: This is a direct link to your insert Review account. <br> Please don’t share it with others.
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 80px;">
														If you want, you can edit your review after reading <br> the company’s reply
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 20px;">
														Enjoy, <br> The Insert Reviews Team
													</p>
												</td>
											</tr>
											<tr>
											<td style="width: 95%; background: #283749; margin: 0 auto;"> 
												<span style="width: 44%;  text-align: right; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"><img src="'.IMG.'bg-phone.png" alt="image" style="margin: 0 10px 0 0;"> 0345 5555 613 </span>
												<span style="width: 44%;  text-align: left; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"> <img src="'.IMG.'bg-mail.png" alt="image" style="margin: 0 10px 0 0;"> info@smartreviews.com</span>
											</td>
											
										</tr>
										<tr>
											<td style="width: 100%; background: #fff; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; padding: 20px 10px;">
												
												<ul style="padding: 0; margin: 0; list-style: none;">
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'facebook.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'twitter.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'linkedin.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'gmail.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'pintrest.png" alt="image"></a></li>
												</ul>
												
											</td>
										</tr>
										</table>
									</td>
								</tr>
							</table>

						</body>	
						</html>';
				$this->send_mail($subject,$html,$to,false);

				//company
				$to = $email['company_email'];
				$subject = 'insertreview accept your request to flag the review.';
				$from = EMAIL_FROM;
				$headers = '';
			    $headers .= "From: ".$from."" ."\r\n" .
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				$html = '<!DOCTYPE html>
						<html lang="en">
						<head>
						  <title>Smart Review</title>
						  <meta charset="utf-8">
						  <meta name="viewport" content="width=device-width, initial-scale=1">
						  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
						</head>
						<body>

							<table style="width: 568px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto;">
								<tr>
									<td>
										<table style="background: #fff; padding: 20px; width: 100%; border-collapse: collapse;">
											<tr>
												<td style="width: 95%; display: block; margin: 0 auto; text-align: center; padding: 20px; background:#283749;">
													<img src="'.IMG.'logo.png" alt="logo">
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; background: #fff; padding: 20px;">
													<strong style="color: #000; font-size: 20px; display: block; font-family: \'Open Sans\' , sans-serif;">Hi '.$email['company_name'].',</strong>
													<p style="color: #000; font-size: 13px; font-family: \'Open Sans\' , sans-serif;">your request to flag the review is accepted.</p>
												</td>
											</tr>
											<tr>
												<td style="width: 70%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #283749; padding: 16px; border-top: 4px solid #fff; border-bottom: 20px solid #fff;">
													<a href="'.BASEURL.'single-review/'.$email['company_id'].'/'.$flag['company_review_id'].'"><span style="color: #fff; font-size: 15px; font-weight: bold; display: block; margin: 0 0 5px; font-family: \'Open Sans\' , sans-serif;">See Review</span></a>
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #ffcb05; padding:20px 12px; border-top: 4px solid #283749; border-bottom: 20px solid #fff;">
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 40px;">
														Please note: This is a direct link to your insert Review account. <br> Please don’t share it with others.
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 80px;">
														If you want, you can edit your review after reading <br> the company’s reply
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 20px;">
														Enjoy, <br> The Insert Reviews Team
													</p>
												</td>
											</tr>
											<tr>
											<td style="width: 95%; background: #283749; margin: 0 auto;"> 
												<span style="width: 44%;  text-align: right; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"><img src="'.IMG.'bg-phone.png" alt="image" style="margin: 0 10px 0 0;"> 0345 5555 613 </span>
												<span style="width: 44%;  text-align: left; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"> <img src="'.IMG.'bg-mail.png" alt="image" style="margin: 0 10px 0 0;"> info@smartreviews.com</span>
											</td>
											
										</tr>
										<tr>
											<td style="width: 100%; background: #fff; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; padding: 20px 10px;">
												
												<ul style="padding: 0; margin: 0; list-style: none;">
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'facebook.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'twitter.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'linkedin.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'gmail.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'pintrest.png" alt="image"></a></li>
												</ul>
												
											</td>
										</tr>
										</table>
									</td>
								</tr>
							</table>

						</body>	
						</html>';
				$this->send_mail($subject,$html,$to,false);
			
				echo json_encode(array("status"=>true,"msg"=>"status changed :) this request will disappear after page reload."));
			}
			else if ($_POST['status'] == 'reject') {
				$this->db->where('company_review_id',$flag['company_review_id']);
				$this->db->update($flag['review_table'],array("flag"=>"no"));

				$this->db->where('flag_review_id',$flag['flag_review_id']);
				$this->db->update('flag_review',array("status"=>"reject","updated_at"=>date('Y-m-d H:i:s')));
				

				$email = $this->model->get_row("SELECT u.email,u.fname,u.lname,c.company_name,c.website,c.email AS company_email, c.company_id FROM `".$flag['review_table']."` AS r INNER JOIN `company` AS c ON c.company_id = r.company_id INNER JOIN `user` AS u ON u.user_id = r.user_id WHERE r.company_review_id = '".$flag['company_review_id']."';");
				//User
				$to = $email['email'];
				$subject = $email['company_name']."'s  flaged request rejected for your review";
				$from = EMAIL_FROM;
				$headers = '';
			    $headers .= "From: ".$from."" ."\r\n" .
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				$html = '<!DOCTYPE html>
						<html lang="en">
						<head>
						  <title>Smart Review</title>
						  <meta charset="utf-8">
						  <meta name="viewport" content="width=device-width, initial-scale=1">
						  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
						</head>
						<body>

							<table style="width: 568px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto;">
								<tr>
									<td>
										<table style="background: #fff; padding: 20px; width: 100%; border-collapse: collapse;">
											<tr>
												<td style="width: 95%; display: block; margin: 0 auto; text-align: center; padding: 20px; background:#283749;">
													<img src="'.IMG.'logo.png" alt="logo">
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; background: #fff; padding: 20px;">
													<strong style="color: #000; font-size: 20px; display: block; font-family: \'Open Sans\' , sans-serif;">Hi '.$email['fname'].' '.$email['fname'].',</strong>
													<p style="color: #000; font-size: 13px; font-family: \'Open Sans\' , sans-serif;"> <a href="'.$email['website'].'" style="color: #000; text-decoration: none; font-weight: bold;">'.$email['website'].'</a> requested to flag your review which rejected by insertreview after inquiry</p>
												</td>
											</tr>
											<tr>
												<td style="width: 70%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #283749; padding: 16px; border-top: 4px solid #fff; border-bottom: 20px solid #fff;">
													<a href="'.BASEURL.'single-review/'.$email['company_id'].'/'.$flag['company_review_id'].'"><span style="color: #fff; font-size: 15px; font-weight: bold; display: block; margin: 0 0 5px; font-family: \'Open Sans\' , sans-serif;">See Review</span></a>
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #ffcb05; padding:20px 12px; border-top: 4px solid #283749; border-bottom: 20px solid #fff;">
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 40px;">
														Please note: This is a direct link to your insert Review account. <br> Please don’t share it with others.
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 80px;">
														If you want, you can edit your review after reading <br> the company’s reply
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 20px;">
														Enjoy, <br> The Insert Reviews Team
													</p>
												</td>
											</tr>
											<tr>
											<td style="width: 95%; background: #283749; margin: 0 auto;"> 
												<span style="width: 44%;  text-align: right; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"><img src="'.IMG.'bg-phone.png" alt="image" style="margin: 0 10px 0 0;"> 0345 5555 613 </span>
												<span style="width: 44%;  text-align: left; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"> <img src="'.IMG.'bg-mail.png" alt="image" style="margin: 0 10px 0 0;"> info@smartreviews.com</span>
											</td>
											
										</tr>
										<tr>
											<td style="width: 100%; background: #fff; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; padding: 20px 10px;">
												
												<ul style="padding: 0; margin: 0; list-style: none;">
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'facebook.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'twitter.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'linkedin.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'gmail.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'pintrest.png" alt="image"></a></li>
												</ul>
												
											</td>
										</tr>
										</table>
									</td>
								</tr>
							</table>

						</body>	
						</html>';
				$this->send_mail($subject,$html,$to,false);

				//company
				$to = $email['company_email'];
				$subject = 'insertreview rejected your request to flag the review.';
				$from = EMAIL_FROM;
				$headers = '';
			    $headers .= "From: ".$from."" ."\r\n" .
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				$html = '<!DOCTYPE html>
						<html lang="en">
						<head>
						  <title>Smart Review</title>
						  <meta charset="utf-8">
						  <meta name="viewport" content="width=device-width, initial-scale=1">
						  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
						</head>
						<body>

							<table style="width: 568px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto;">
								<tr>
									<td>
										<table style="background: #fff; padding: 20px; width: 100%; border-collapse: collapse;">
											<tr>
												<td style="width: 95%; display: block; margin: 0 auto; text-align: center; padding: 20px; background:#283749;">
													<img src="'.IMG.'logo.png" alt="logo">
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; background: #fff; padding: 20px;">
													<strong style="color: #000; font-size: 20px; display: block; font-family: \'Open Sans\' , sans-serif;">Hi '.$email['company_name'].',</strong>
													<p style="color: #000; font-size: 13px; font-family: \'Open Sans\' , sans-serif;">your request to flag the review is rejected.</p>
												</td>
											</tr>
											<tr>
												<td style="width: 70%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #283749; padding: 16px; border-top: 4px solid #fff; border-bottom: 20px solid #fff;">
													<a href="'.BASEURL.'single-review/'.$email['company_id'].'/'.$flag['company_review_id'].'"><span style="color: #fff; font-size: 15px; font-weight: bold; display: block; margin: 0 0 5px; font-family: \'Open Sans\' , sans-serif;">See Review</span></a>
												</td>
											</tr>
											<tr>
												<td style="width: 95%; box-sizing: border-box; display: block; margin: 0 auto; text-align:center; background: #ffcb05; padding:20px 12px; border-top: 4px solid #283749; border-bottom: 20px solid #fff;">
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 40px;">
														Please note: This is a direct link to your insert Review account. <br> Please don’t share it with others.
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 80px;">
														If you want, you can edit your review after reading <br> the company’s reply
													</p>
													<p style=" font-family: \'Open Sans\' , sans-serif; color: #000; font-size: 14px; margin: 0 0 20px;">
														Enjoy, <br> The Insert Reviews Team
													</p>
												</td>
											</tr>
											<tr>
											<td style="width: 95%; background: #283749; margin: 0 auto;"> 
												<span style="width: 44%;  text-align: right; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"><img src="'.IMG.'bg-phone.png" alt="image" style="margin: 0 10px 0 0;"> 0345 5555 613 </span>
												<span style="width: 44%;  text-align: left; padding: 12px; display: inline-block; color: #fff;  font-family: \'Open Sans\' , sans-serif; font-size: 15px;"> <img src="'.IMG.'bg-mail.png" alt="image" style="margin: 0 10px 0 0;"> info@smartreviews.com</span>
											</td>
											
										</tr>
										<tr>
											<td style="width: 100%; background: #fff; box-sizing: border-box; display: block; margin: 0 auto; text-align: center; padding: 20px 10px;">
												
												<ul style="padding: 0; margin: 0; list-style: none;">
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'facebook.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'twitter.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'linkedin.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'gmail.png" alt="image"></a></li>
													<li style="display: inline-block; margin: 0 2px 0 0;"><a href="#"><img src="'.IMG.'pintrest.png" alt="image"></a></li>
												</ul>
												
											</td>
										</tr>
										</table>
									</td>
								</tr>
							</table>

						</body>	
						</html>';
				$this->send_mail($subject,$html,$to,false);


				echo json_encode(array("status"=>true,"msg"=>"status changed :) this request will disappear after page reload."));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"invalid call!"));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"this review already ".$flag['status']."ed by admin, you can't change it now."));
		}
	}
	public function get_flag_detail()
	{
		$user = $this->check_login();
		$resp = $this->model->get_flag_review_detail($_POST['id']);
		if ($resp) {
			$html = '<tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>'.$resp['fname'].' '.$resp['lname'].'</td>
                            <td>Wajid</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>'.$resp['userPhone'].'</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>'.$resp['userEmail'].'</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>Company</td>
                            <td>'.$resp['company_name'].'</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>'.$resp['website'].'</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>'.$resp['companyEmail'].'</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>'.$resp['companyPhone'].'</td>
                        </tr>
                    </table>
                </td>
                <td>'.$resp['time'].'</td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>Review</td>
                            <td>'.$resp['review_text'].'</td>
                        </tr>
                        <tr>
                            <td>Reason</td>
                            <td class="alert alert-danger">'.$resp['reason'].'</td>
                        </tr>
                        <tr>
                            <td>Selected Words</td>
                            <td class="alert alert-warning">'.$resp['selected_words'].'</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <select name="status" class="form-control" data-id="'.$_POST['id'].'">
                        <option value="blank">Change Status</option>
                        <option value="accept">Accept</option>
                        <option value="reject">Reject</option>
                    </select>
                </td>
            </tr>';
            echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"no record found."));
		}
	}
	/**
	*

	@Bulk Upload
		
	*
	*/
	public function submit_bulk_super_cats()
	{
		$user = $this->check_login();
		if ($_FILES) {
			$count=0;
	        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
	        while($csv_line = fgetcsv($fp,1024))
	        {
	            $count++;
	            /*if($count == 1)
	            {
	                continue;
	            }*/
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert['title'] = $csv_line[0];
	            }
	            $i++;
				$this->db->insert('super_cat',$insert);
	        }
	        fclose($fp) or die("can't close file");
	        redirect('admin/super-cats/all/?error=0&msg=uploaded');
		}
	}
	public function submit_bulk_cats()
	{
		$user = $this->check_login();
		if ($_FILES) {
			$count=0;
	        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
			$insert['super_cat_id'] = $_POST['super_cat_id'];
	        while($csv_line = fgetcsv($fp,1024))
	        {
	            $count++;
	            /*if($count == 1)
	            {
	                continue;
	            }*/
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert['title'] = $csv_line[0];
	            }
	            $i++;
				$this->db->insert('cat',$insert);
	        }
	        fclose($fp) or die("can't close file");
	        redirect('admin/super-cats/all/?error=0&msg=child categories uploaded');
		}
	}
	public function submit_bulk_sub_cats()
	{
		$user = $this->check_login();
		if ($_FILES) {
			$count=0;
	        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
			$insert['cat_id'] = $_POST['cat_id'];
	        while($csv_line = fgetcsv($fp,1024))
	        {
	            $count++;
	            /*if($count == 1)
	            {
	                continue;
	            }*/
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert['title'] = $csv_line[0];
	            }
	            $i++;
				$this->db->insert('sub_cat',$insert);
	        }
	        fclose($fp) or die("can't close file");
	        redirect('admin/cats/all/?error=0&msg=child categories uploaded');
		}
	}
	public function submit_bulk_companies()
	{
		$user = $this->check_login();
		if ($_FILES) {
			$count=0;
	        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
	        while($csv_line = fgetcsv($fp,1024))
	        {
	            $count++;
	            if($count == 1)
	            {
	                continue;
	            }//keep this if condition if you want to remove the first row
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	            	$CatName = $csv_line[0];
	            	$cat = $this->model->get_row("SELECT `sub_cat_id` FROM `sub_cat` WHERE `title` = '$CatName';");
	            	if ($cat) {
	                	$insert['category_id'] = $cat['sub_cat_id'];
	            	}
	            	else{
	                	$insert['category_id'] = 0;
	            	}
                	//$insert['category_id'] = $csv_line[0];
	            	$insert['company_name'] = $csv_line[1];
	            	if (strlen($csv_line[2]) > 1) {
                		$insert['company_about'] = $csv_line[2];
                	}
                	else{
                		$insert['company_about'] = '';
                	}
                	if (strlen($csv_line[3]) > 1) {
                		$insert['website'] = clean_url($csv_line[3]);
                	}
                	else{
                		$insert['website'] = '';
                	}
                	if (strlen($csv_line[4]) > 1) {
                		$insert['logo'] = $csv_line[4];
                	}
                	else{
                		$insert['logo'] = '';
                	}
                	if (strlen($csv_line[5]) > 1) {
	                	$insert['address'] = $csv_line[5];
	                }
	                else{
	                	$insert['address'] = '';
	                }
	                if (strlen($csv_line[6]) > 1) {
	                	$insert['phone'] = $csv_line[6];
	            	}
	            	else{
	                	$insert['phone'] = '';
	            	}
	            	$country = $this->model->get_row("SELECT `country_id` FROM `country` WHERE `name` = '".$csv_line[7]."';");
	                if ($country) {
	                	$insert['country_id'] = $country['country_id'];
	                }
	                else{
	                	$insert['country_id'] = 0;
	                }
	                if (strlen($csv_line[8]) > 1) {
	                	$insert['email'] = $csv_line[8];
	                }
	                else{
	                	$insert['email'] = '';
	                }
	                /*if (strlen($csv_line[7]) > 1) {
	                	$insert['password'] = md5($csv_line[7]);
	                }
	                else{
	                	$insert['password'] = '';
	                }
	                if (strlen($csv_line[8]) > 1) {
	                	$insert['api_password'] = md5($csv_line[8]);
	                	$insert['api_password_text'] = md5($csv_line[8]);
	                }
	                else{
	                	$insert['api_password'] = '';
	                	$insert['api_password_text'] = '';
	                }*/
                	/*if (strlen($csv_line[14]) > 0) {
                		$insert['balance'] = $csv_line[14];
                	}
                	else{
                		$insert['balance'] = '';
                	}*/
                	$insert['review_company_count'] = 0;
                	$insert['review_company_ratio'] = 0;
                	$insert['varified_company_review'] = 'yes';//yes/no
                	$insert['product_review_allow'] = 'yes';//yes/no/pending/apply
                	$insert['services_allow'] = 'yes';//yes/no
                	$insert['service_ids'] = 0;
                	$insert['multi_reviews'] = 'yes';//yes/no
	            }
	            $i++;
	            $tbl = $this->model->get_next_company_review_tbl();
				$insert['company_review_tbl_id'] = $tbl['company_review_table_id'];
				$insert['company_review_tbl'] = $tbl['tbl'];
				$this->db->insert('company',$insert);
				$companyID = $this->db->insert_id();
				$timeTable['company_id'] = $companyID;
				$this->db->insert('time_table',$timeTable);
				$this->db->query("UPDATE `company_review_table` SET `count`=`count`+1 WHERE `company_review_table_id` = ".$tbl['company_review_table_id']."");
	        }
	        fclose($fp) or die("can't close file");
	        redirect('admin/companies?error=0&msg=uploaded');
		}
	}
	public function submit_bulk_review()
	{
		$user = $this->check_login();
		if ($_FILES) {
			$count=0;
	        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
	        while($csv_line = fgetcsv($fp,1024))
	        {
	            $count++;
	            if($count == 1)
	            {
	                continue;
	            }//keep this if condition if you want to remove the first row
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	            	$insert['company_id'] = $csv_line[0];
	            	$insert['review_title'] = $csv_line[1];
	            	$insert['review_text'] = $csv_line[2];
	            	$insert['review_ratting'] = $csv_line[3];
	            	$insert['user_name'] = $csv_line[4];
	            	//$insert['at'] = date('Y-m-d H:i',strlen($csv_line[5]));


                	/*$insert['company_id'] = $csv_line[0];
                	if (strlen($csv_line[1]) > 0) {
                		$insert['product_id'] = $csv_line[1];
                	}
                	else{
                		$insert['product_id'] = 0;
                	}
	                $insert['review_type'] = $csv_line[2];//company/product
	                if (strlen($csv_line[3]) > 0) {
	                	$insert['user_id'] = $csv_line[3];
	                }
	                else{
	                	$insert['user_id'] = 0;
	                }
	                if (strlen($csv_line[4]) > 0) {
	                	$insert['user_name'] = $csv_line[4];
	                }
	                else{
	                	$insert['user_name'] = '';
	                }
	                if (strlen($csv_line[5]) > 0) {
	                	$insert['user_email'] = $csv_line[5];
	                }
	                else{
	                	$insert['user_email'] = '';
	                }
	                if (strlen($csv_line[6]) > 0) {
	                	$insert['user_phone'] = $csv_line[6];
	                }
	                else{
	                	$insert['user_phone'] = '';
	                }
	                if (strlen($csv_line[7]) > 0) {
	                	$insert['review_text'] = $csv_line[7];
	                }
	                else{
	                	$insert['review_text'] = '';
	                }
	                if (strlen($csv_line[8]) > 0) {
	                	$insert['review_title'] = $csv_line[8];
	                }
	                else{
	                	$insert['review_title'] = '';
	                }
	                if (strlen($csv_line[9]) > 0) {
	                	$insert['review_title'] = $csv_line[9];
	                }
	                else{
	                	$insert['review_image'] = '';
	                }
	                $insert['review_ratting'] = $csv_line[10];
	                if (strlen($csv_line[11]) > 0) {
	                	$insert['review_service_id_1'] = $csv_line[11];
	                }
	                else{
	                	$insert['review_service_id_1'] = 0;
	                }
	                if (strlen($csv_line[12]) > 0) {
	                	$insert['review_service_ratting_1'] = $csv_line[12];
	                }
	                else{
	                	$insert['review_service_ratting_1'] = 0;
	                }
	                if (strlen($csv_line[13]) > 0) {
	                	$insert['review_service_id_2'] = $csv_line[13];
	                }
	                else{
	                	$insert['review_service_id_2'] = 0;
	                }
	                if (strlen($csv_line[14]) > 0) {
	                	$insert['review_service_ratting_2'] = $csv_line[14];
	                }
	                else{
	                	$insert['review_service_ratting_2'] = 0;
	                }
	                if (strlen($csv_line[15]) > 0) {
	                	$insert['review_service_id_3'] = $csv_line[15];
	                }
	                else{
	                	$insert['review_service_id_3'] = 0;
	                }
	                if (strlen($csv_line[16]) > 0) {
	                	$insert['review_service_ratting_3'] = $csv_line[16];
	                }
	                else{
	                	$insert['review_service_ratting_3'] = 0;
	                }
	                if (strlen($csv_line[17]) > 0) {
	                	$insert['review_service_id_4'] = $csv_line[17];
	                }
	                else{
	                	$insert['review_service_id_4'] = 0;
	                }
	                if (strlen($csv_line[18]) > 0) {
	                	$insert['review_service_ratting_4'] = $csv_line[18];
	                }
	                else{
	                	$insert['review_service_ratting_4'] = 0;
	                }
	                if (strlen($csv_line[19]) > 0) {
	                	$insert['company_note'] = $csv_line[19];
	                }
	                else{
	                	$insert['company_note'] = '';
	                }*/

	                /*if (strlen($csv_line[20]) > 0) {
	                	$insert['api_user_name'] = $csv_line[20];
	                }
	                else{
	                	$insert['api_user_name'] = '';
	                }
	                if (strlen($csv_line[21]) > 0) {
	                	$insert['api_user_email'] = $csv_line[21];
	                }
	                else{
	                	$insert['api_user_email'] = '';
	                }
	                if (strlen($csv_line[22]) > 0) {
	                	$insert['api_user_id'] = $csv_line[22];
	                }
	                else{
	                	$insert['api_user_id'] = '';
	                }
	                if (strlen($csv_line[23]) > 0) {
	                	$insert['api_order_number'] = $csv_line[23];
	                }
	                else{
	                	$insert['api_order_number'] = '';
	                }*/
                	$insert['status'] = 'aprove';
                	$company = $this->model->get_company_byid($insert['company_id']);
					$tbl = $company['company_review_tbl'];
	            }
	            $i++;
	            $resp = $this->db->insert($tbl,$insert);
	            if ($resp) {
					$this->db->query("UPDATE `company` SET `review_company_count`=`review_company_count`+1 WHERE `company_id` = ".$insert['company_id']."");
					$avg = $this->model->get_row("SELECT AVG(`review_ratting`) AS 'avg' FROM `$tbl` WHERE `company_id` = '".$insert['company_id']."' AND `status` = 'aprove';");
					$this->db->query("UPDATE `company` SET `review_company_ratio`='".$avg['avg']."' WHERE `company_id` = ".$insert['company_id']."");
				}
	        }
	        fclose($fp) or die("can't close file");
	        redirect('admin/companies?error=0&msg=uploaded');
		}
	}
	/**
	*

	@AJAX GET FUNCTIONS
		
	*
	*/
	public function get_flag_cat_reasons()
	{
		$user = $this->check_login();
		$resp = $this->model->get_flag_reasons($_POST['id']);
		if ($resp) {
			$html = '';
			foreach ($resp as $key => $q) {
				$html .= '<tr>
	                <td>'.$q['title'].'</td>
	                <td>Action</td>
	            </tr>';
			}
		}
		else{
			$html = '<tr>
                <td colspan="2">No reason found</td>
            </tr>';
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function get_widget_features_ajax()
	{
		$features = $this->model->widget_features($_POST['id']);
		$html = '';
		if ($features) {
			foreach ($features as $key => $q) {
				$html .= '<tr>                        
                    <td>'.$q['feature'].'</td>
                    <td><a href="javascript://" class="delete-feature" data-id="'.$q['widget_feature_id'].'"><i class="icon md-delete" aria-hidden="true"></i></a></td>
                </tr>';
			}
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function post_widget_feature_ajax()
	{
		parse_str($_POST['data'],$post);
		$this->db->insert('widget_feature',$post);
		$features = $this->model->widget_features($post['widget_id']);
		$html = '';
		if ($features) {
			foreach ($features as $key => $q) {
				$html .= '<tr>                        
                    <td>'.$q['feature'].'</td>
                    <td><a href="javascript://" class="delete-feature" data-id="'.$q['widget_feature_id'].'"><i class="icon md-delete" aria-hidden="true"></i></a></td>
                </tr>';
			}
		}
		echo json_encode(array("status"=>true,"html"=>$html));
	}
	public function delete_widget_feature_ajax()
	{
		$this->db->where('widget_feature_id',$_POST['id']);
		$this->db->delete('widget_feature');
		echo json_encode(array("status"=>true));
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
	/**
	*

	@Test Functions
		
	*
	*/
	public function test($arg='')
	{
		die;
		$query = $this->db->query('UPDATE `phase` SET `count`=`count`+1 WHERE `phase_id` = 1');
	}
	/**
	*

	@TEXT FILE EXTRACTING
		
	*
	*/
	public function text_file()
	{
		error_reporting(E_ALL);
		set_time_limit(0);
		ini_set('memory_limit', '-1');

		$handle = fopen("uploads/text_test/test.txt", "r");
		$final = array();
		$i = 0;
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
				$line = explode(':', $line);
				$final[$i]['number'] = $line[0];
				$final[$i]['id'] = $line[1];
				$final[$i]['fname'] = $line[2];
				$final[$i]['lname'] = $line[3];
				$final[$i]['gender'] = $line[4];
				$final[$i]['city'] = $line[5];
				$i++;
		    }
		    fclose($handle);
		}
		print_r($final);
	}
}
