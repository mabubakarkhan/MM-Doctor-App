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
	public function template($page = '', $data = '')
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
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
		$this->index();
	}
	public function index()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		// $data['meta_title'] = 'Dashboard';
		$data['profile_settings_active'] = 'active';
		$data['userSession'] = $user;
		$this->template('doctor/index',$data);
	}
	public function profile_settings()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		// $data['meta_title'] = 'Dashboard';
		$data['profile_settings_active'] = 'active';
		$data['userSession'] = $user;
		$this->template('doctor/index',$data);
	}
	public function your_reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['company'] = $user;
		$data['meta_title'] = 'Dashboard -> Your Reviews';
		$data['your_reviews_page_active'] = 'active';

		$total = $this->model->get_company_page_reviews_total('aprove',$user['company_id'],$data['company']['company_review_tbl'],'company',0);
		$data['total_recods'] = $total['total'];
		$data['current_page'] = 1;
		$data['company_reviews'] = $this->model->get_company_page_reviews('aprove',$user['company_id'],$data['company']['company_review_tbl'],1,$data['total_recods'],'company',0);
		//echo json_encode($data['company_reviews']);die;
		$data['flaged_reviews'] = $this->model->get_company_flaged_reviews($user['company_id'],$data['company']['company_review_tbl']);

		$data['flag_categories'] = $this->model->flag_categories();

		$flag['total'] = $this->model->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `".$data['company']['company_review_tbl']."` WHERE `company_id` = '".$user['company_id']."' AND `flag` != 'no';");
		//var_dump($flag['total']);die;

		$data['company_flag'] = true;
		$this->template('company/your_reviews',$data);
	}
	public function your_reviews_ajax()
	{
		$user = $this->check_login();
		parse_str($_POST['data'],$filters);
		$total = $this->model->get_company_page_reviews_total_ajax('aprove',$user['company_id'],$user['company_review_tbl'],'company',0,$filters);
		$total_recods = $total['total'];
		$current_page = 1;
		$data = $this->model->get_company_page_reviews_dashboard('aprove',$user['company_id'],$user['company_review_tbl'],1,$total_recods,'company',0,$filters);
		if ($data) {
			$html = '';
			foreach ($data as $keyCr => $cr) {
				$html .= '<div class="detail-holder">';
					$html .= '<div class="left">';
						$html .= '<img class="stars" src="'.IMG.'star'.$cr['review_ratting'].'.png" alt="image">';
						$html .= '<div class="text-box">';
							$html .= '<a href="#">'.$cr['user_name'].'</a>';
							/*$html .= '<div class="drop">';
								$html .= '<ul>';
									$html .= '<li><a href="#">1</a></li>';
									$html .= '<li><a href="#">2</a></li>';
									$html .= '<li><a href="#">3</a></li>';
								$html .= '</ul>';
							$html .= '</div>';*/
						$html .= '</div><!-- /text-box -->';

						for ($ii=1; $ii < 5; $ii++) { 
							if ($cr['review_service_ratting_'.$ii] > 0 && isset($cr['review_service_ratting_'.$ii])){
								$html .= '<div class="rating-list">';
									$html .= '<strong>'.$cr['service_'.$ii].'</strong>';
									$html .= '<div class="s-box">';
										$html .= '<img src="'.IMG.'star'.round($cr['review_service_ratting_'.$ii]).'.png" alt="image">';
										$html .= '<span>'.round($cr['review_service_ratting_'.$ii]).'/5</span>';
									$html .= '</div>';
								$html .= '</div>';
							}
						}
					$html .= '</div><!-- /left -->';
					$html .= '<div class="right">';
						$html .= '<div class="top-head">';
							$html .= '<strong>'.$cr['review_title'].'</strong>';
							$html .= '<span>'.$this->get_time_difference_php($cr['at']).'</span>';
						$html .= '</div><!-- /top-head -->';
						$html .= '<p>'.$cr['review_text'].'</p>';
						$html .= '<ul>';
							$html .= '<li>';
							if ($cr['type'] == 'direct'){
								$html .= 'Source: Direct access';
							}
							else{
								$html .= 'Source: Manual invitation';
							}
							if (strlen($cr['asked_ref_number']) > 1) {
								$html .= ' | Reference number: '.$cr['asked_ref_number'];
							}
							$html .= '</li>';
						$html .= '</ul>';
						$html .= '<div class="bottom-box">';
							$html .= '<ul>';
								if ($_SESSION['Company']['company_id'] == $company['company_id']){
									//$html .= '<li><a href="javascript://" class="make-review-reply" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-review="'.$cr['review_text'].'" data-reply="'.$cr['reply'].'">Replied<img src="'.IMG.'img217.png" alt="image"></a></li>';
									$html .= '<li><a href="javascript://" class="make-review-reply" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-review="'.$cr['review_text'].'" data-review-title="'.$cr['review_title'].'" data-reply="'.$cr['company_note'].'" data-at="'.date('d/m/Y',strtotime($cr['at'])).'" data-review-name="'.$cr['user_name'].'" data-review-star="'.IMG.'star'.$cr['review_ratting'].'.png'.'">Replied<img src="'.IMG.'img217.png" alt="image"></a></li>';
								}
								$html .= '<li>';
									$html .= '<a href="#">';
										$html .= '<img src="'.IMG.'img218.png" alt="image">';
										$html .= 'Share';
									$html .= '</a>';
								$html .= '</li>';
								if ($_SESSION['Company']['ask_user_ref'] == 'yes'){
									$html .= '<li><a href="javascript://" class="pre-ask-user-ref" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-user="'.$cr['user_id'].'"><img src="'.IMG.'img219.png" alt="image">Find Reviewer</a></li>';
								}
								else{
									$html .= '<li><a href="javascript://" data-toggle="modal" data-target="#upgradePackageModal"><img src="'.IMG.'img219.png" alt="image">Find Reviewer</a></li>';
								}
							$html .= '</ul>';
							if ($cr['flag'] == 'no'){
								$html .= '<a href="javascript://" class="make-review-flag" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-review="'.$cr['review_text'].'"><img src="'.IMG.'img214.png" alt="image"></a>';
							}
							else if($cr['flag'] == 'yes'){
								$html .= '<a href="javascript://" style="color:red;"><i class="fas fa-flag"></i></a>';
							}
							
						$html .= '</div><!-- /bottom-box -->';
					$html .= '</div><!-- /right -->';
				$html .= '</div><!-- /detail-holder -->';

				if ($cr['company_note_status'] == 'yes'){
					$html .= '<div class="bottom-detail-holder" id="review-reply-box-'.$cr['company_review_id'].'">';
						$html .= '<div class="d-holder">';
							$html .= '<strong>'.$_SESSION['Company']['company_name'].'</strong>';
							$html .= '<div class="holder-2">';
								$html .= '<span>'.$cr['company_note'].'</span>';
								$html .= '<span>'.$this->get_time_difference_php($cr['reply_at']).'</span>';
							$html .= '</div>';
						$html .= '</div>';
						$html .= '<div class="d-holder">';
							$html .= '<strong>'.$_SESSION['Company']['website'].'</strong>';
							$html .= '<div class="holder-2">';
								$html .= '<a href="javascript://" class="button make-review-reply" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-review="'.$cr['review_text'].'" data-review-title="'.$cr['review_title'].'" data-reply="'.$cr['company_note'].'" data-at="'.date('d/m/Y',strtotime($cr['at'])).'" data-review-name="'.$cr['user_name'].'" data-review-star="'.IMG.'star'.$cr['review_ratting'].'.png'.'">';
								//$html .= '<a href="javascript://" class="button make-review-reply" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'" data-review="'.$cr['review_text'].'" data-reply="'.$cr['company_note'].'">';
									$html .= 'Edit reply';
									$html .= '<img src="'.IMG.'img220.png" alt="image">';
								$html .= '</a>';
								$html .= '<a href="javascript://" class="button delete delete-reply" data-tbl="'.$company['company_review_tbl'].'" data-id="'.$cr['company_review_id'].'">';
									$html .= 'Delete reply';
									$html .= '<img src="'.IMG.'img221.png" alt="image">';
								$html .= '</a>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
				}
			}
			$pagesCount = $total_recods/2;
			$nextPage = 1+1;
			if ($pagesCount == $nextPage) {
				$nextPage = $_POST['page'];
			}

			if ($pagesCount > 1) {
				$pageCurrent = 1;
				$pagination = '';
				for ($i=0; $i < $pagesCount; $i++) {
					$ii = $i+1;
					if ($ii == $pageCurrent) {
						$pagination .= '<li><a class="company-review-listing-page-number company-review-listing-page-number-page-active-ref active" href="javascript://" data-id="'.$user['company_id'].'" data-total="'.$total_recods.'" data-page="'.$ii.'">'.$ii.'</a></li>';
					}
					else{
						$pagination .= '<li><a class="company-review-listing-page-number company-review-listing-page-number-page-active-ref" href="javascript://" data-id="'.$user['company_id'].'" data-total="'.$total_recods.'" data-page="'.$ii.'">'.$ii.'</a></li>';
					}
				}
			}
			echo json_encode(array("status"=>true,"html"=>$html,"next_page"=>$nextPage,"pagination"=>$pagination));
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function your_reviews_download()
	{
		$user = $this->check_login();
		$data = $this->model->get_company_reviews_download('aprove',$user['company_id'],$user['company_review_tbl'],'company',0,$_GET);
		if ($data) {
			$file = 'extensions_list_'.date('d-m-y H-i-s').'.csv';
			header('Content-Type: application/csv');
	        header('Content-Disposition: attachment; filename="'.$file.'"');

	        $fp = fopen('php://output', 'w');
	        $row[0] = 'ID';
	        $row[1] = 'User name';
	        $row[2] = 'Dated';
	        $row[3] = 'Review Title';
	        $row[4] = 'Review Text';
	        $row[5] = 'Source';
	        $row[6] = 'Your Reply';
	        $row[7] = 'Flaged';
	        $row[8] = 'Ratting';
	        $row[9] = $data[0]['service_1'];
	        $row[10] = $data[0]['service_2'];
	        $row[11] = $data[0]['service_3'];
	        $row[12] = $data[0]['service_4'];
	        fputcsv($fp, $row);
	        foreach ($data as $q) {
	            $row[0] = $q['company_review_id'];
	            $row[1] = $q['user_name'];
	            $row[2] = date('d-m-Y',strtotime($q['at']));
	            $row[3] = $q['review_title'];
	            $row[4] = $q['review_text'];
	            $row[5] = $q['type'];
	            $row[6] = $q['company_note'];
	            $row[7] = $q['flag'];
	            $row[8] = $q['review_ratting'];
	            $row[9] = $q['review_service_ratting_1'];
	            $row[10] = $q['review_service_ratting_2'];
	            $row[11] = $q['review_service_ratting_3'];
	            $row[12] = $q['review_service_ratting_4'];
	            fputcsv($fp, $row);
	        }
	        fclose($fp);
		}
		else{
			redirect('company/your-reviews');
		}
	}
	public function asked_reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['company'] = $user;
		$data['meta_title'] = 'Dashboard -> Your Asked Reviews';
		$data['asked_reviews_page_active'] = 'active';

		$data['reviews'] = $this->model->get_asked_reviews($user['company_id'],$data['company']['company_review_tbl'],'company');

		$data['company_flag'] = true;
		$this->template('company/asked_reviews',$data);
	}
	public function reply_asked_reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['company'] = $user;
		$data['meta_title'] = 'Dashboard -> Your Asked Reviews Reply';
		$data['reply_asked_reviews_page_active'] = 'active';

		$data['reviews'] = $this->model->get_reply_asked_reviews($user['company_id'],$data['company']['company_review_tbl'],'company');

		$data['company_flag'] = true;
		$this->template('company/asked_reviews',$data);
	}
	public function your_plan()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Your Plan';
		$data['your_plan_page_active'] = 'active';
		if ($user['plan_id'] > 0) {
			$data['plan'] = $this->model->get_plan_byid($user['plan_id']);
			$data['faqs'] = $this->model->get_faqs($plan['plan_id']);
		}
		else{
			redirect('company/pricing');
		}
		$this->template('company/your_plan',$data);
	}
	public function transections()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Your Transections';
		$data['transections_page_active'] = 'active';
		$data['transections'] = $this->model->get_company_transections($user['company_id']);
		$this->template('company/transections',$data);
	}
	public function invite_customers()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Invite Customers';
		$data['invite_customers_page_active'] = 'active';
		$data['templates'] = $this->model->get_email_templates($user['company_id']);
		$this->template('company/invite_customers',$data);
	}
	public function profile()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['q'] = $user;
		$data['meta_title'] = $user['company_name'];
		$data['profile_page_active'] = 'active';
		$data['countries'] = $this->model->countries();
		$data['super_cats'] = $this->model->get_super_cats('active');
		$data['company_cats'] = $this->model->get_company_cats($user['category_id']);
		if ($data['company_cats']) {
			$data['cats'] = $this->model->get_cats('active',$data['company_cats']['super_cat_id']);
			$data['sub_cats'] = $this->model->get_sub_cats('active',$data['company_cats']['cat_id']);
			$data['sub_cat'] = $this->model->get_sub_cat_byid($user['category_id']);
			$data['services'] = $this->model->get_services_by_ids($data['sub_cat']['service_ids']);
		}
		$data['timeTable'] = $this->model->get_timetable_by_company_id($user['company_id']);
		$this->template('company/profile',$data);
	}
	public function service_review_settings()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['q'] = $user;
		$data['meta_title'] = $user['company_name'];
		$data['service_review_settings_page_active'] = 'active';
		$data['super_cats'] = $this->model->get_super_cats('active');
		$data['company_cats'] = $this->model->get_company_cats($user['category_id']);
		if ($data['company_cats']) {
			$data['cats'] = $this->model->get_cats('active',$data['company_cats']['super_cat_id']);
			$data['sub_cats'] = $this->model->get_sub_cats('active',$data['company_cats']['cat_id']);
			$data['sub_cat'] = $this->model->get_sub_cat_byid($user['category_id']);
			$data['services'] = $this->model->get_services_by_ids($data['sub_cat']['service_ids']);
		}
		$this->template('company/service_review_settings',$data);
	}
	public function plan($id)
	{
		$_SESSION['url'] = 'company/plan/'.$id;
		$user = $this->check_login();
		$data['user'] = $user;
		$data['plan'] = $this->model->get_plan_byid($id);
		$data['meta_title'] = $data['plan']['title'];
		$data['faqs'] = $this->model->get_faqs($id);
		unset($_SESSION['url']);
		$this->template('company/plan',$data);
	}
	public function subacription($id)
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['plan'] = $this->model->get_plan_byid(1);
		$data['meta_title'] = 'subacribe to '.$data['plan']['title'];
		$data['countries'] = $this->model->countries();
		$this->template('company/subacription',$data);
	}
	public function widgets()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Widgets';
		$data['widgets'] = $this->model->widgets('active');
		$data['widgets_page_active'] = 'active';
		$this->template('company/widgets',$data);
	}
	public function widget($id)
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['widget'] = $this->model->widget_byid($id,'active');
		if (!($data['widget'])) {
			redirect('company/widgets');
		}
		if ($data['widget']['account_type'] == 'paid') {
			if ($user['account_type'] == 'free') {
				redirect('company/pricing');
			}
		}
		$data['meta_title'] = 'Widget -> '.$data['widget']['title'];
		$data['widgets_page_active'] = 'active';
		$this->template('company/widget',$data);
	}
	public function benchmark()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Benchmark';
		$data['benchmark_page_active'] = 'active';
		$data['company_reviews_count_ratio'] = $this->model->get_company_reviews_count_ratio($user['company_id'],$user['company_review_tbl'],'company');
		$data['cat'] = $this->model->get_sub_cat_byid($user['category_id']);
		$this->template('company/benchmark',$data);
	}
	public function pricing()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Pricing';
		$data['pricing_page_active'] = 'active';
		$data['plans'] = $this->model->get_plans();
		$data['addons'] = $this->model->get_addons();
		$this->template('company/pricing',$data);
	}
	public function invitation_setting()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Invitation Setting';
		$data['invitation_setting_page_active'] = 'active';
		$data['templates'] = $this->model->get_email_templates($user['company_id']);
		$setting = $this->model->get_email_setting($user['company_id']);
		if ($setting) {
			$data['mode'] = 'edit';
			$data['setting'] = $setting;
		}
		else{
			$data['mode'] = 'post';
			$data['setting'] = false;
		}
		$this->template('company/invitation_setting',$data);
	}
	public function post_email_setting()
	{
		$user = $this->check_login();
		$_POST['company_id'] = $user['company_id'];
		$resp = $this->db->insert('email_setting',$_POST);
		if ($resp) {
			redirect('company/invitation-setting');
		}
		else{
			redirect('company/invitation-setting?error=1&msg=not submitted, please try again or reload your web page.');
		}
	}
	public function update_email_setting()
	{
		$user = $this->check_login();
		$id = $_POST['id'];unset($_POST['id']);
		$this->db->where('email_setting_id',$id);
		$resp = $this->db->update('email_setting',$_POST);
		if ($resp) {
			redirect('company/invitation-setting');
		}
		else{
			redirect('company/invitation-setting?error=1&msg=not updated, please try again or reload your web page.');
		}
	}
	public function automatic_feedback_service()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Automatic Feedback Service';
		$data['automatic_feedback_service_page_active'] = 'active';
		$this->template('company/automatic_feedback_service',$data);
	}
	public function email_templates()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Email Templates';
		$data['email_templates_page_active'] = 'active';
		$data['templates'] = $this->model->get_email_templates($user['company_id']);
		$this->template('company/email_templates',$data);
	}
	public function social_sharing()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Social Sharing';
		$data['social_sharing_page_active'] = 'active';
		$this->template('company/social_sharing',$data);
	}
	public function ecommernce()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Ecommernce';
		$data['ecommernce_page_active'] = 'active';
		$this->template('company/ecommernce',$data);
	}
	public function email_widgets()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Email Widgets';
		$data['email_widgets_page_active'] = 'active';
		$this->template('company/email_widgets',$data);
	}
	public function marketing_assets()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Marketing Assets';
		$data['marketing_assets_page_active'] = 'active';
		$this->template('company/marketing_assets',$data);
	}
	public function analytics_overview()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Analytics Overview';
		$data['analytics_overview_page_active'] = 'active';
		$this->template('company/analytics_overview',$data);
	}
	public function reviews_overview()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Reviews Overview';
		$data['reviews_overview_page_active'] = 'active';
		$data['invitations_delivered'] = $this->model->get_invitations_count_last_30_days($user['company_id'],'send');
		$data['verfied_reviews_count'] = $this->model->get_verfied_reviews_count_last_30_days($user['company_id'],$user['company_review_tbl']);
		$data['ratting_count'] = $this->model->get_ratting_count_last_30_days($user['company_id'],$user['company_review_tbl']);
		$data['recent_invitations'] = $this->model->get_recent_invitations($user['company_id'],100);
		$this->template('company/reviews_overview',$data);
	}
	public function services_reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['meta_title'] = 'Dashboard -> Services Reviews';
		$data['services_reviews_page_active'] = 'active';
		$this->template('company/services_reviews',$data);
	}
	public function gallery()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['company'] = $user;
		$data['meta_title'] = 'Dashboard -> Gallery';
		$data['gallery_page_active'] = 'active';
		if ($user['gallery_allow'] == 'yes') {
			$data['total_records_photo'] = $this->model->get_photos_total($user['company_id']);
			$data['total_records_photo'] = $data['total_records_photo']['total'];
			$data['current_page_photo'] = 1;
			$data['photos'] = $this->model->get_photos_by_page($user['company_id'],1,$data['total_records_photo']);
		}
		else{
			$data['photos'] = false;
		}
		$this->template('company/gallery',$data);
	}
	public function delete_gallery()
	{
		$user = $this->check_login();
		$this->db->where('photo_id',$_POST['id']);
		$this->db->where('company_id',$user['company_id']);
		$resp = $this->db->delete('photo');
		if ($resp) {
			echo json_encode(array("status"=>true));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not deleted, please try again or reload your web page"));
		}
	}
	public function post_gallery()
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
				$insert['company_id'] = $user['company_id'];
				$insert['photo'] = $this->upload->data()['file_name'];
				$this->db->insert('photo',$insert);
	    	}
		}
		redirect('company/gallery');
	}
	public function product_reviews()
	{
		$user = $this->check_login();
		$data['user'] = $user;
		$data['company'] = $user;
		$data['meta_title'] = 'Dashboard -> Product Reviews';
		$data['product_reviews_page_active'] = 'active';
		if ($user['product_review_allow'] == 'yes') {
			$data['total_records_product'] = $this->model->get_all_company_products_total_by_page($user['company_id']);
			$data['total_records_product'] = $data['total_records_product']['total'];
			$data['current_page_product'] = 1;
			$data['products'] = $this->model->get_all_company_products_by_page('all',$user['company_id'],1,$data['total_records_product']);
		}
		else{
			$data['products'] = false;
		}
		$this->template('company/product_reviews',$data);
	}
	public function post_product()
	{
		$user = $this->check_login();
		$config['upload_path'] = 'uploads/';
    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
    	$config['encrypt_name'] = TRUE;
    	$ext = pathinfo($_FILES["image"]['name'], PATHINFO_EXTENSION);
		$new_name = md5(time().$_FILES["image"]['name']).'.'.$ext;
		$config['file_name'] = $new_name;
    	$resp = $this->load->library('upload', $config);
    	if ($resp) {
        	$this->upload->do_upload('image');
			$_POST['image'] = $this->upload->data()['file_name'];
			$_POST['company_id'] = $user['company_id'];
			$resp = $this->db->insert('company_product',$_POST);
			if ($resp) {
				redirect('company/product-reviews');
			}
			else{
				redirect('company/product-reviews?error=1&msg=not posted, please try again or reload your web page.');
			}
    	}
    	else{
			redirect('company/product-reviews?error=1&msg=file must be an image file.');
    	}
	}
	public function update_product()
	{
		$user = $this->check_login();

		if (isset($_FILES["img"]['name']) && strlen($_FILES["img"]['name']) > 3) {
			$config['upload_path'] = 'uploads/';
	    	$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
	    	$config['encrypt_name'] = TRUE;
	    	$ext = pathinfo($_FILES["img"]['name'], PATHINFO_EXTENSION);
			$new_name = md5(time().$_FILES["img"]['name']).'.'.$ext;
			$config['file_name'] = $new_name;
	    	$resp = $this->load->library('upload', $config);
	    	if ($resp) {
	        	$this->upload->do_upload('img');
				$update['image'] = $this->upload->data()['file_name'];
	    	}
	    	else{
				redirect('company/product-reviews?error=1&msg=file must be an image file.');
	    	}
		}
		$update['title'] = $_POST['title'];
		$update['status'] = $_POST['status'];
		$resp = $this->db->where('company_product_id',$_POST['id']);
		$resp = $this->db->where('company_id',$user['company_id']);
		$resp = $this->db->update('company_product',$update);
		if ($resp) {
			redirect('company/product-reviews');
		}
		else{
			redirect('company/product-reviews?error=1&msg=not updated, please try again or reload your web page.');
		}
	}
	public function post_email_template()
	{
		$user = $this->check_login();
		$_POST['company_id'] = $user['company_id'];
		$this->db->insert('email_template',$_POST);
		redirect('company/email-templates');
	}
	public function update_email_template()
	{
		$user = $this->check_login();
		$id = $_POST['id'];unset($_POST['id']);
		$this->db->where('email_template_id',$id);
		$this->db->where('company_id',$user['company_id']);
		$this->db->update('email_template',$_POST);
		redirect('company/email-templates');
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
	public function get_cat_by_super_cat()
	{
		$user = $this->check_login();
		if ($_POST) {
			$resp = $this->model->get_cats('active',$_POST['id']);
			if ($resp) {
		        $ServiceHtml = '';
				$html = '<option value="">Select Category</option>';
				$subCat = false;
				foreach ($resp as $key => $cat){
					if ($_POST['select'] == $cat['cat_id']){
						$subCat = true;
						$html .= '<option value="'.$cat['cat_id'].'" selected="selected">'.$cat['title'].'</option>';
					}
					else{
						$html .= '<option value="'.$cat['cat_id'].'">'.$cat['title'].'</option>';
					}
				}
				if ($subCat) {
					$subCats = $this->model->get_sub_cats('active',$_POST['select']);
					if ($subCats) {
						$servicesIDZ = false;
						$html2 = '<option value="">Select Sub Category</option>';
						foreach ($subCats as $key => $cat2){
							if ($_POST['select2'] == $cat2['sub_cat_id']){
								$servicesIDZ = $cat2['service_ids'];
								$html2 .= '<option value="'.$cat2['sub_cat_id'].'" data-services="'.$cat2['service_ids'].'" selected="selected">'.$cat2['title'].'</option>';
							}
							else{
								$html2 .= '<option value="'.$cat2['sub_cat_id'].'" data-services="'.$cat2['service_ids'].'">'.$cat2['title'].'</option>';
							}
						}
						if ($servicesIDZ) {
							$services = $this->model->get_services_by_ids($servicesIDZ);
		             		$companyServicesIds = explode(',', $user['service_ids']);
		             		foreach ($services as $key => $service){
			             		$ServiceHtml .= '<div class="col-lg-4">';
									if (in_array($service['service_id'], $companyServicesIds)){
										$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service" checked="checked"> '.$service['title'];
									}
									else{
										$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service"> '.$service['title'];
									}
			              		$ServiceHtml .= '</div><!-- /12/form-horizontal -->';
		             		}
						}
					}
					else{
						$html2 = '<option value="">Select Category</option>';
					}
				}
				else{
					$html2 = '<option value="">Select Category</option>';
				}
				echo json_encode(array("status"=>true,"html"=>$html,"html2"=>$html2,"services"=>$ServiceHtml));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"no record found"));
			}
		}
	}
	public function get_sub_cat_by_cat()
	{
		$user = $this->check_login();
		if ($_POST) {
			$resp = $this->model->get_sub_cats('active',$_POST['id']);
			if ($resp) {
				$ServiceHtml = '';
				$servicesIDZ = false;
				$html = '<option value="">Select Sub Category</option>';
				foreach ($resp as $key => $cat){
					if ($_POST['select'] == $cat['sub_cat_id']){
						$servicesIDZ = $cat['service_ids'];
						$html .= '<option value="'.$cat['sub_cat_id'].'" data-services="'.$cat['service_ids'].'" selected="selected">'.$cat['title'].'</option>';
					}
					else{
						$html .= '<option value="'.$cat['sub_cat_id'].'" data-services="'.$cat['service_ids'].'">'.$cat['title'].'</option>';
					}
				}
				if ($servicesIDZ) {
					$services = $this->model->get_services_by_ids($servicesIDZ);
             		$companyServicesIds = explode(',', $user['service_ids']);
             		foreach ($services as $key => $service){
	             		$ServiceHtml .= '<div class="col-lg-4">';
							if (in_array($service['service_id'], $companyServicesIds)){
								$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service" checked="checked"> '.$service['title'];
							}
							else{
								$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service"> '.$service['title'];
							}
	              		$ServiceHtml .= '</div><!-- /12/form-horizontal -->';
             		}
				}
				echo json_encode(array("status"=>true,"html"=>$html,"services"=>$ServiceHtml));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"no record found"));
			}
		}
	}
	public function get_services_by_sub_cat()
	{
		$user = $this->check_login();
		if ($_POST['services']) {
			$services = $this->model->get_services_by_ids($_POST['services']);
     		$companyServicesIds = explode(',', $user['service_ids']);
     		$ServiceHtml = '';
     		foreach ($services as $key => $service){
         		$ServiceHtml .= '<div class="col-lg-4">';
					if (in_array($service['service_id'], $companyServicesIds)){
						$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service" checked="checked"> '.$service['title'];
					}
					else{
						$ServiceHtml .= '<input type="checkbox" name="service[]" value="'.$service['service_id'].'" class="cat-service"> '.$service['title'];
					}
          		$ServiceHtml .= '</div><!-- /12/form-horizontal -->';
     		}
		}
		echo json_encode(array("status"=>true,"services"=>$ServiceHtml));
	}
	public function post_customer_csv_list()
	{
		$user = $this->check_login();
		$balance = $user['email_balance'];
		if ($_FILES) {
			$count=0;
			$fail=0;
			$failCheck=false;
			$code = date('Ymdhis').'-'.$user['company_id'];
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
	                if (filter_var($csv_line[0], FILTER_VALIDATE_EMAIL) && $balance > 0) {
		                $insert['company_id'] = $user['company_id'];
		                $insert['email'] = $csv_line[0];
		                $insert['name'] = $csv_line[1];
		                $insert['ref_id'] = $csv_line[2];
		                $insert['code'] = $code;
		                $balance--;
		                $failCheck=false;
					}
					else{
		                $failCheck=true;
					}
	            }
	            if ($failCheck == true) {
	            	$fail++;
	            }
	            else{
					$this->db->insert('invite_customer',$insert);
	            }
	            $failCheck = false;
	            $i++;
	        }
	        $this->db->where('company_id',$user['company_id']);
	        $this->db->update('company',array("email_balance"=>$balance));
	        $count--;
	        $count = $count - $fail;
	        fclose($fp) or die("can't close file");
	        if ($count > 0) {
	        	echo json_encode(array("status"=>true,"uploaded"=>$count,"failed"=>$fail,"code"=>$code));
	        }
	        else{
	        	echo json_encode(array("status"=>false,"msg"=>"no valid record found in file, please upload valid records."));
	        }
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"file missing."));
		}
	}
	public function save_customer_invition_form()
	{
		$user = $this->check_login();
		if ($_POST) {
			parse_str($_POST['data'],$post);
			$this->db->where('code',$post['code']);
			$this->db->update('invite_customer',$post);

			/*$this->db->where('company_id',$user['company_id']);
			$this->db->update('invite_customer',array("invitation_step"=>"yes"));*/

			echo json_encode(array("status"=>true));
		}
	}
	public function submit_company_profile($value='')
	{
		$user = $this->check_login();
		if ($_POST) {
			parse_str($_POST['data'],$post);
			if (isset($post['website'])) {
				$post['website'] = clean_url($post['website']);
			}
			if ($user['services_allow'] == 'yes') {
				if (isset($post['service'])) {
					$post['service_ids'] = implode(',', $post['service']);
				}
			}
			unset($post['service']);

			if ($post['is_open_question'] == 'on') {
				$post['is_open_question'] = 'yes';
			}
			else{
				$post['is_open_question'] = 'no';
			}

			if ($post['is_recomendation_question'] == 'on') {
				$post['is_recomendation_question'] = 'yes';
			}
			else{
				$post['is_recomendation_question'] = 'no';
			}

			$this->db->where('company_id',$user['company_id']);
			$resp = $this->db->update('company',$post);
			if ($resp) {
				echo json_encode(array("status"=>true));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"profile not updated, please try again."));
			}
		}
	}
	public function get_cats_for_select($value='')
	{
		$user = $this->check_login();
		if (isset($_POST['id']) && $_POST['id'] > 0) {
			$cats = $this->model->get_cats('active',$_POST['id']);
			if ($cats) {
				$html = '<option value="">Select Category</option>';
				foreach ($cats as $key => $cat) {
					$html .= '<option value="'.$cat['cat_id'].'">'.$cat['title'].'</option>';
				}
				echo json_encode(array("status"=>true,"html"=>$html));
			}
			else{
				echo json_encode(array("status"=>false));
			}
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function get_sub_cats_for_select($value='')
	{
		$user = $this->check_login();
		if (isset($_POST['id']) && $_POST['id'] > 0) {
			$cats = $this->model->get_sub_cats('active',$_POST['id']);
			if ($cats) {
				$html = '<option value="">Select Sub Category</option>';
				foreach ($cats as $key => $cat) {
					$html .= '<option value="'.$cat['sub_cat_id'].'">'.$cat['title'].'</option>';
				}
				echo json_encode(array("status"=>true,"html"=>$html));
			}
			else{
				echo json_encode(array("status"=>false));
			}
		}
		else{
			echo json_encode(array("status"=>false));
		}
	}
	public function update_time_table()
	{
		if ($_POST) {
			$user = $this->check_login();
			$check = $this->model->get_timetable_by_company_id($user['company_id']);
			if ($check) {
				if (!(isset($_POST['sunday']))) {
					$_POST['sunday'] = 'close';
				}
				else{
					$_POST['sunday'] = 'open';
				}
				if (!(isset($_POST['monday']))) {
					$_POST['monday'] = 'close';
				}
				else{
					$_POST['monday'] = 'open';
				}
				if (!(isset($_POST['tuesday']))) {
					$_POST['tuesday'] = 'close';
				}
				else{
					$_POST['tuesday'] = 'open';
				}
				if (!(isset($_POST['wednesday']))) {
					$_POST['wednesday'] = 'close';
				}
				else{
					$_POST['wednesday'] = 'open';
				}
				if (!(isset($_POST['thursday']))) {
					$_POST['thursday'] = 'close';
				}
				else{
					$_POST['thursday'] = 'open';
				}
				if (!(isset($_POST['friday']))) {
					$_POST['friday'] = 'close';
				}
				else{
					$_POST['friday'] = 'open';
				}
				if (!(isset($_POST['saturday']))) {
					$_POST['saturday'] = 'close';
				}
				else{
					$_POST['saturday'] = 'open';
				}
				$this->db->where('company_id',$user['company_id']);
				$this->db->update('time_table',$_POST);
			}
			else{
				$this->db->insert('time_table',$_POST);
			}
			redirect('company/profile');
		}
		else{
			redirect('company/profile');
		}
	}
	public function ask_user_ref_pre_detail()
	{
		$user = $this->check_login();
		$tbl = $_POST['tbl'];
		$id = $_POST['id'];
		$user = $_POST['user'];
		$resp = $this->model->get_row("SELECT u.fname,u.lname FROM `$tbl` AS r INNER JOIN `user` AS u ON u.user_id = r.user_id WHERE r.company_review_id = '$id' AND r.user_id = '$user';");
		if ($resp) {
			$html = '<h5>How it works</h5>
				<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Saepe vitae ipsam a consectetur nobis doloremque ex ullam! Accusantium aspernatur alias error perspiciatis laborum tempore nesciunt, tenetur, nihil impedit quis ut!</p>
				<p>They\'ll have 3 days to reply.</p>
				<p class="first-block"><i class="fa fa-envelope"></i> Here is the email we\'ll send to '.$resp['fname'].' '.$resp['lname'].':</p>
				<p class="second-p">
					<span>From: Insertreview</span><br>
					<span>To: '.$resp['fname'].'</span><br>
					<span>Subject: insertreveiw.com would like some information regarding your review.</span><br>
				</p>
				<p class="third-p">
					<span>Hi '.$resp['fname'].' '.$resp['lname'].',</span><br>
					<span>Thanks for review on insertreview</span><br>
					<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum alias mollitia totam quibusdam ipsa voluptatibus reiciendis illo obcaecati molestiae, ut corporis iure quis expedita necessitatibus tempora provident harum, aut sint.</p>
				</p>';
			echo json_encode(array("status"=>true,"html"=>$html));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"invalid call! please try again or reload your webpage."));
		}
	}
	public function ask_user_ref()
	{
		if ($_POST) {
			$user = $this->check_login();
			$tbl = $_POST['tbl'];
			$id = $_POST['id'];
			$user = $_POST['user'];
			$email = $this->model->get_row("SELECT u.fname,u.email,r.company_id FROM `$tbl` AS r INNER JOIN `user` AS u ON u.user_id = r.user_id WHERE r.company_review_id = '$id' AND r.user_id = '$user';");
			if ($email) {

				$to = $email;
				$emailTemplate = $this->model->get_dynamic_email_by_title('Company Ask For More Information Mail');
				$emailTemplate['template'] = str_replace('[image_link]', IMG, $emailTemplate['template']);
				$emailTemplate['template'] = str_replace('[user_fname]', $email['fname'], $emailTemplate['template']);
				$emailTemplate['template'] = str_replace('[company_name]', $user['company_name'], $emailTemplate['template']);
				$askedLink = BASEURL.'user-asked-information/'.$id.'/'.$email['company_id'].'/'.urlencode($email['email']);
				$emailTemplate['template'] = str_replace('[user_asked_review_link]', $askedLink, $emailTemplate['template']);

				$this->db->where('company_review_id',$id);
				$this->db->where('user_id',$user);
				$this->db->update($tbl,array("user_asked"=>"yes"));

				echo json_encode(array("status"=>true,"msg"=>"email sent to user"));
			}
			else{
				echo json_encode(array("status"=>false,"msg"=>"wrong call, no record found"));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"wrong call"));
		}
	}
	public function get_flag_reasons()
	{
		$user = $this->check_login();
		$data = $this->model->get_flag_reasons($_POST['id']);
		if ($data) {
			$html = '<ul class="radio-list">';
			foreach ($data as $key => $q) {
				$html .= '<li><input type="radio" name="flag_reason_id" value="'.$q['flag_reason_id'].'" data-title="'.$q['title'].'" />'.$q['title'].'</li>';
			}
			$html .= '</ul">';
			$cat = $this->model->get_flag_category_byid($_POST['id']);
			echo json_encode(array("status"=>true,"html"=>$html,"cat"=>$cat));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"nothing found"));
		}
	}
	public function post_flag_review_new()
	{
		$user = $this->check_login();
		$check = $this->model->get_row("SELECT `flag` FROM `".$_POST['tbl']."` WHERE `company_review_id` = '".$_POST['id']."' AND `company_id` = '".$user['company_id']."' AND `flag` = 'no';");
		if ($check) {
			$insert['review_table'] = $_POST['tbl'];
			$insert['company_review_id'] = $_POST['id'];
			$insert['flag_reason_id'] = $_POST['reason'];
			if (strlen($_POST['selected_words']) > 0) {
				$insert['selected_words'] = $_POST['selected_words'];
			}
			else{
				$insert['selected_words'] = '';
			}
			$resp = $this->db->insert('flag_review',$insert);
			if ($resp) {
				$this->db->where('company_review_id',$_POST['id']);
				$this->db->update($_POST['tbl'],array("flag"=>"sent"));
				echo json_encode(array("status"=>true));
			}
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"you are not able to flag this review."));
		}
	}
	public function delete_review_reply()
	{
		$user = $this->check_login();
		$update['company_note'] = '';
		$update['company_note_status'] = 'no';
		$this->db->where('company_review_id',$_POST['id']);
		$resp = $this->db->update($_POST['tbl'],$update);
		if ($resp) {
			echo json_encode(array("status"=>true));
		}
		else{
			echo json_encode(array("status"=>false,"msg"=>"not deleted, please try again or reload your webpage."));
		}
	}
	/**
	*
	*
	*	@Domestic Functions
	*
	*
	**/
	protected function order_mail($post,$orderId)
	{
		$planName = $this->model->get_row("SELECT `title` FROM `plan` WHERE `plan_id` = '".$post['plan_id']."';");
		$planName = $planName['title'];
		$order = $this->model->get_order_byid($orderId);
		$mail = '<!DOCTYPE html>
				<html lang="en">
				<head>
				  <title>Smart Review</title>
				  <meta charset="utf-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1">
				  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
				</head>
				<body>

					<table style="max-width: 650px; background: #f6f6f6; border-collapse: collapse; margin: 0 auto 10px; border: 1px solid #acacac; box-sizing: border-box; padding: 0 0 30px; display: block;">
						<tbody style="width: 100%; display: block;">
							<tr style="width: 100%; display: block;">
								<td style="width: 90%; display: block; margin: 0 auto; text-align: center; padding: 20px;">
									<img src="'.IMG.'logo-2.png" alt="logo">
								</td>
							</tr>

							<tr style="background: #283749;width: 94%;margin: 0 auto; border-bottom: 1px solid #999999; overflow: hidden; display: block;">
								<td style="color: #fff; font-size: 15px; padding: 12px 18px; box-sizing: border-box; font-family: \'Open Sans\' , sans-serif; width: 70%;">Invoice 270901</td>
								<td style="color: #fff; font-size: 15px; box-sizing: border-box; padding: 12px 18px; font-family: \'Open Sans\' , sans-serif;">Billed On '.date('M d, Y',strtotime($order['at'])).'</td>
							</tr>

							<tr style="width: 100%; display: block;">
								<td style="text-align: center; width: 90%; margin: 0 auto; background: #323232; padding: 12px; display: block;">
									<span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">'.$post['bill_fname'].' '.$post['bill_lname'].'</span><span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">'.$post['bill_address_line_1'].'</span>
									<span style="display: block; color: #fff; font-size: 14px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">';
										if(strlen($post['bill_address_line_1']) > 1){
											$mail .= $post['bill_address_line_1'];
										}
									$mail .= ' '.$post['bill_city'].'.</span>
								</td>
							</tr>

							<tr style="width: 100%; display: block;">
								<td style="text-align: center; width: 90%; margin: 0 auto; background: #transparent; padding: 20px 10px; display: block;">
									<span style="display: block; color: #000; font-size: 18px; font-weight: bold; padding: 2px; font-family: \'Open Sans\' , sans-serif;">We received your payment</span>
									<span style="display: block; color: #000; font-size: 12px; padding: 2px; font-family: \'Open Sans\' , sans-serif;">Thank you for your business. Enclosed is an invoice receipt for your records.</span>
									<span style="display: block; color: #000; font-size: 12px; padding: 2px; font-family: \'Open Sans\' , sans-serif; margin: 0 0 14px;">This email confirms your recent payment of $'.$post['amount'].'. Here are the details of your payment:</span>
									<a href="#" style="font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif;">View your invoice online</a>
								</td>
							</tr>

							<tr style="padding: 0 20px; display: flex; justify-content: space-between;">
								<td style="background: #fff;box-sizing: border-box; border: 1px solid #999; text-align: center; padding: 20px 5px; width: 49%;">
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif;">Your plan:</span>
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif;">'.$planName.'</span>
								</td>
								<td style="background: #fff;box-sizing: border-box; border: 1px solid #999; text-align: center; padding: 10px 5px; width: 49%;">
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif; padding: 16px 0 3px;">Next invoice date:</span>
									<span style="color: #000; font-size: 14px; font-weight: bold; display: block; font-family: \'Open Sans\' , sans-serif; padding: 3px 0;">July 1, 2021</span>
								</td>
							</tr>

							<tr style="width: 94%; margin: 0 auto; display: block; box-sizing: border-box;">
								<td style="width: 100%; display: block; box-sizing: border-box;">
									<table style="width: 100%; margin: 20px 0 0; border-collapse: collapse;">
										<thead style="background: #323232;">
											<th style="color: #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: left	; border-right: 4px solid #fff;">Date</th>
											<th style="color: #fff; border-right: 4px solid #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: left	;">Description</th>
											<th style="color: #fff; font-size: 14px; font-weight: bold; padding: 10px 20px; font-family: \'Open Sans\' , sans-serif; text-align: right;">Amount</th>
										</thead>
										<tbody>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;">'.date('M d, Y',strtotime($order['at'])).'</span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;">'.$planName.'</span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">$'.$order['amount'].'</span>
												</td>
											</tr>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Subtotal: $'.$order['amount'].'</span>
												</td>
											</tr>

											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Total: $'.$order['amount'].'</span>
												</td>
											</tr>
											<tr>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 12px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block;"></span>
												</td>
												<td style="background: #fff; font-size: 13px; color: #000; font-family: \'Open Sans\' , sans-serif; padding: 0 15px;">
													<span style=" border-bottom: 1px solid #ebebeb; padding: 10px 0; display: block; text-align: right; font-weight: bold;">Paid: $13.96</span>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>

					</table>

					<table style="max-width: 650px; padding: 20px; border-collapse: collapse; margin: 0 auto; border: 1px solid #acacac; box-sizing: border-box; display: block; background: #283749;">
							<tbody style="width: 100%; display: block;">
								<tr style="display: block; width: 100%; overflow: hidden;">
									<td style="float: left;">
										<span style="color: #fff; font-size: 14px; font-family: \'Open Sans\' , sans-serif; display: block;">Contact</span>
										<a href="tel:03455555613" style="text-decoration: none; color: #fff; font-size: 20px; font-weight: bold; font-family: \'Open Sans\' , sans-serif; display: block;"><img src="'.IMG.'bg-phone.png" alt="image" style="display: inline-block; margin: 10px 10px 0 0;">0345 5555 613</a>
										<a href="mailto:info@sms2connect" style="text-decoration: none; color: #fff; font-size: 20px; font-weight: bold; font-family: \'Open Sans\' , sans-serif; display: block;"><img src="'.IMG.'bg-mail.png" alt="image" style="display: inline-block; margin: 10px 10px 0 0;">info@sms2connect</a>
									</td>
									<td style="float: right;">
										<img src="'.IMG.'bg-sms.png" alt="image">
									</td>
								</tr>
							</tbody>
					</table>

				</body>	
				</html>
				';
		$to      = $post['bill_email'];
		$subject = 'Payment On Review';
		$from = EMAIL_FROM;

		$headers = '';
	    $headers .= "From: ".$from."" ."\r\n" .
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

		//mail($to, $subject, $mail, $headers);
		$this->send_mail($subject,$mail,$to,false);
		return true;
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
