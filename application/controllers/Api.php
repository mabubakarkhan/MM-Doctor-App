<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
        header('Content-type: text/json');
        error_reporting(0);
        $this->load->database();
        $this->load->model('Model_functions','model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
	}
	public function index()
	{
		die;
	}
	public function creview()
	{
		if ( (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 3) && (isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 0) && (isset($_REQUEST['user_email']) && strlen($_REQUEST['user_email']) > 3) && (isset($_REQUEST['user_name']) && strlen($_REQUEST['user_name']) > 3) ) {
			$login = $this->model->company_api_login($_REQUEST['email'],md5($_REQUEST['password']));
			if ($login) {
				if ($login['varified_company_review'] == 'yes') {
					$post['company_id'] = $login['company_id'];
					if (strlen($_REQUEST['user_email']) > 0) {
						$post['api_user_email'] = $_REQUEST['user_email'];
					}
					if (strlen($_REQUEST['user_name']) > 0) {
						$post['api_user_name'] = $_REQUEST['user_name'];
					}
					if (strlen($_REQUEST['user_id']) > 0) {
						$post['api_user_id'] = $_REQUEST['user_id'];
					}
					if (strlen($_REQUEST['order_number']) > 0) {
						$post['api_order_number'] = $_REQUEST['order_number'];
					}
					$post['status'] = 'api_pending';
					$post['type'] = 'api';
					$resp = $this->db->insert($login['company_review_tbl'],$post);
					if ($resp) {
						$id = $this->db->insert_id();
						$update['api_code'] = md5($id);
						$this->db->where('company_review_id',$id);
						$resp = $this->db->update($login['company_review_tbl'],$update);
						if ($resp) {
							echo json_encode(array("status"=>true));
						}
						else{
							$this->db->where('company_review_id',$id);
							$this->db->delete($login['company_review_tbl']);
							echo json_encode(array("status"=>false,"error"=>"incomplete action","msg"=>"action not completed, please review your parameters."));
						}

					}
					else{
						echo json_encode(array("status"=>false,"error"=>"incomplete action","msg"=>"action not completed, please review your parameters."));
					}
				}
				else{
					echo json_encode(array("status"=>false,"error"=>"service not allowed","msg"=>"you are not allowed for this action, please upgrade your package."));
				}
			}
			else{
				echo json_encode(array("status"=>false,"error"=>"login fail","msg"=>"email/password not correct."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"error"=>"missing parameters","msg"=>"some parameters are missing."));
		}
	}
	public function pcreate()
	{
		if ( (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 3) && (isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 0) && (isset($_REQUEST['product_name']) && strlen($_REQUEST['product_name']) > 3) ) {
			$login = $this->model->company_api_login($_REQUEST['email'],md5($_REQUEST['password']));
			if ($login) {
				if ($login['product_review_allow'] == 'yes') {
					$check = $this->model->get_row("SELECT `company_product_id` FROM `company_product` WHERE `title` = '".$_REQUEST['product_name']."';");
					if ($check) {
						echo json_encode(array("status"=>true,"id"=>$check['company_product_id']));
					}
					else{
						$post['company_id'] = $login['company_id'];
						$post['title'] = $_REQUEST['product_name'];
						$resp = $this->db->insert('company_product',$post);
						if ($resp) {
							$id = $this->db->insert_id();
							echo json_encode(array("status"=>true,"id"=>$id));
						}
						else{
							echo json_encode(array("status"=>false,"error"=>"incomplete action","msg"=>"action not completed, please review your parameters."));
						}
					}

				}
				else{
					echo json_encode(array("status"=>false,"error"=>"service not allowed","msg"=>"you are not allowed for this action, please upgrade your package."));
				}
			}
			else{
				echo json_encode(array("status"=>false,"error"=>"login fail","msg"=>"email/password not correct."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"error"=>"missing parameters","msg"=>"some parameters are missing."));
		}
	}
	public function get_review()
	{
		if ( (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 3) && (isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 0) && (isset($_REQUEST['type']) && strlen($_REQUEST['type']) > 3) ) {
			$login = $this->model->company_api_login($_REQUEST['email'],md5($_REQUEST['password']));
			if ($login) {
				$tbl = $login['company_review_tbl'];
				if (isset($_REQUEST['ratting']) && intval($_REQUEST['ratting']) > 0) {
					if ($_REQUEST['type'] == 'company') {
						$type = $_REQUEST['type'];
						$start = $_REQUEST['ratting'];
						$end = $_REQUEST['ratting']+1;
						if ($_REQUEST['limit'] > 0) {
							$limit = "LIMIT ".$_REQUEST['limit'];
						}
						else{
							$limit = '';
						}
						if ($login['services_allow'] == 'yes') {
							$data = $this->model->get_results("
								SELECT r.company_review_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type,
								s1.title AS service_1, r.review_service_ratting_1 AS service_1_ratting, s2.title AS service_2, r.review_service_ratting_2 AS service_2_ratting, s3.title AS service_3, r.review_service_ratting_3 AS service_3_ratting, s4.title AS service_4, r.review_service_ratting_4 AS service_4_ratting 
								FROM `$tbl` AS r 
								LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
								LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
								LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
								LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
								WHERE r.review_type = 'company' AND r.review_ratting >= '$start' AND r.review_ratting < '$end' 
								ORDER BY r.review_ratting DESC 
								$limit
							;");
						}
						else{
							$data = $this->model->get_results("
								SELECT r.company_review_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type 
								FROM `$tbl` AS r 
								WHERE r.review_type = 'company' AND r.review_ratting >= '$start' AND r.review_ratting < '$end' 
								ORDER BY r.review_ratting DESC 
								$limit
							;");
						}
					}//company
					else{
						$type = $_REQUEST['type'];
						$start = $_REQUEST['ratting'];
						$end = $_REQUEST['ratting']+1;
						if ($_REQUEST['limit'] > 0) {
							$limit = "LIMIT ".$_REQUEST['limit'];
						}
						else{
							$limit = '';
						}
						$data = $this->model->get_results("
							SELECT r.company_review_id,r.product_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type, p.title AS 'product_name', p.image AS 'product_image' 
							FROM `$tbl` AS r 
							INNER JOIN `company_product` AS p ON r.product_id = p.company_product_id 
							WHERE r.review_type = 'product' AND r.review_ratting >= '$start' AND r.review_ratting < '$end' 
							ORDER BY r.review_ratting DESC 
							$limit
						;");
					}//product
				}//with ratting
				else{
					if ($_REQUEST['type'] == 'company') {
						$type = $_REQUEST['type'];
						if ($_REQUEST['limit'] > 0) {
							$limit = "LIMIT ".$_REQUEST['limit'];
						}
						else{
							$limit = '';
						}
						if ($login['services_allow'] == 'yes') {
							$data = $this->model->get_results("
								SELECT r.company_review_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type, 
								s1.title AS service_1, r.review_service_ratting_1 AS service_1_ratting, s2.title AS service_2, r.review_service_ratting_2 AS service_2_ratting, s3.title AS service_3, r.review_service_ratting_3 AS service_3_ratting, s4.title AS service_4, r.review_service_ratting_4 AS service_4_ratting 
								FROM `$tbl` AS r 
								LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
								LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
								LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
								LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
								WHERE r.review_type = 'company' 
								ORDER BY r.review_ratting DESC 
								$limit
							;");
						}
						else{
							$data = $this->model->get_results("
								SELECT r.company_review_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type 
								FROM `$tbl` AS r 
								WHERE r.review_type = 'company' 
								ORDER BY r.review_ratting DESC 
								$limit
							;");
						}
					}//company
					else{
						$type = $_REQUEST['type'];
						if ($_REQUEST['limit'] > 0) {
							$limit = "LIMIT ".$_REQUEST['limit'];
						}
						else{
							$limit = '';
						}
						$data = $this->model->get_results("
							SELECT r.company_review_id,r.product_id, r.user_name, r.user_email, r.user_phone, r.review_text, r.review_title, r.review_image, r.review_ratting, r.company_note, r.api_user_name, r.api_user_email, r.api_user_id, r.api_order_number, r.at, r.status, r.type AS request_type, p.title AS 'product_name', p.image AS 'product_image' 
							FROM `$tbl` AS r 
							INNER JOIN `company_product` AS p ON r.product_id = p.company_product_id 
							WHERE r.review_type = 'product' 
							ORDER BY r.review_ratting DESC 
							$limit
						;");
					}//product
				}//without ratting
				echo json_encode(array("status"=>true,"data"=>$data));
			}//login
			else{
				echo json_encode(array("status"=>false,"error"=>"login fail","msg"=>"email/password not correct."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"error"=>"missing parameters","msg"=>"some parameters are missing."));
		}
	}
}
