<?php
class Model_functions extends CI_Model {

	public function get_results($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			return $res->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_row($sql){
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0)
		{
			$resp = $res->result_array();
			return $resp[0];
		}
		else
		{
			return false;
		}
	}
	public function login($username,$password)
	{
		return $this->get_row("SELECT * FROM `admin` WHERE `username`= '$username' AND `password` = '$password';");
	}
	public function countries()
	{
		return $this->get_results("SELECT * FROM `country` ORDER BY `name` ASC;");
	}
	public function get_country_byid($id)
	{
		return $this->get_row("SELECT * FROM `country` WHERE `country_id` = '$id';");
	}
	/**
	*	@API
	*/
	public function company_api_login($email,$password)
	{
		return  $this->get_row("SELECT * FROM `company` WHERE `email` = '$email' AND `api_password` = '$password';");
	}
	// ----
	//Company Review Table
	public function get_next_company_review_tbl()
	{
		return $this->get_row("SELECT * FROM `company_review_table` where `count` = (select MIN(count) FROM company_review_table) AND `status` = 'active';");
	}
	//services
	public function services()
	{
		return $this->get_results("SELECT * FROM `service` ORDER BY `title` ASC;");
	}
	public function get_service_byid($id)
	{
		return $this->get_row("SELECT * FROM `service` WHERE `service_id` = '$id';");
	}
	public function get_services_by_ids($ids)
	{
		if (strlen($ids) > 0) {
			return $this->get_results("SELECT * FROM `service` WHERE `service_id` IN($ids) ORDER BY `title` ASC;");
		}
		else{
			return false;
		}
	}
	//companies
	public function check_company_login($username,$password)
	{
		return $this->get_row("SELECT * FROM `company` WHERE (`email` = '$username' OR `phone` = '$username') AND `password` = '$password';");
	}
	public function get_all_companies($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `company`;");
		}
		else{
			return $this->get_results("SELECT * FROM `company` WHERE `status` = '$status';");
		}
	}
	public function get_companies_by_cat($id)
	{
		$total = $this->get_row("SELECT COUNT(`company_id`) AS 'total' FROM `company` WHERE `category_id` = '$id';");
		$totalLimit = ($total['total']/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$resp['total'] = $totalLimit;
		$resp['data'] = $this->get_results("SELECT * FROM `company` WHERE `category_id` = '$id' ORDER BY `at` DESC LIMIT 1");
		return $resp;
	}
	public function get_companies_by_cat_filters($get)
	{
		$id = $get['id'];
		$total = $this->get_row("SELECT COUNT(`company_id`) AS 'total' FROM `company` WHERE `category_id` = '$id';");
		$totalLimit = ($total['total']/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$limit = 1;
		$pages = ceil($totalLimit / $limit);
		$offset = ($get['page'] - 1)  * $limit;
		$resp['total'] = $totalLimit;
		$where = '';
		if (isset($get['reviews']) && $get['reviews'] > 0) {
			$where .= ' AND review_company_count >= '.$get['reviews'].' ';
		}
		if (isset($get['varified']) && $get['varified'] > 0) {
			$where .= ' AND varified_company_review = '.$get['varified'].' ';
		}
		if (isset($get['duration']) && $get['duration'] > 0) {
			$where .= ' AND at >= DATE_SUB(CURDATE(),INTERVAL '.$get['duration'].' MONTH) ';
		}
		$resp['data'] = $this->get_results("SELECT * FROM `company` WHERE `category_id` = '$id' $where ORDER BY `at` DESC LIMIT $limit OFFSET $offset");
		return $resp;
	}
	public function get_company_byid($id)
	{
		return $this->get_row("SELECT * FROM `company` WHERE `company_id` = '$id';");
	}
	public function get_company_by_web($website)
	{
		return $this->get_row("SELECT * FROM `company` WHERE `website` = '$website';");
	}
	public function get_all_company_products($status,$company,$tbl)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `company_product` WHERE `company_id` = '$company' ORDER BY `company_product_id` DESC;");
		}
		else{
			return $this->get_results("SELECT * FROM `company_product` WHERE `company_id` = '$company' AND `status` = '$status' ORDER BY `company_product_id` DESC;");
		}
	}
	public function get_all_company_products_total_by_page($company)
	{
		return $this->get_row("SELECT COUNT(`company_product_id`) AS 'total' FROM `company_product` WHERE `company_id` = '$company' AND `status` = 'active';");
	}
	public function get_all_company_products_by_page($status,$company,$page,$total)
	{
		$totalLimit = ($total/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$limit = 2;
		$pages = ceil($totalLimit / $limit);
		$offset = ($page - 1)  * $limit;
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `company_product` WHERE `company_id` = '$company' ORDER BY `company_product_id` DESC LIMIT $limit OFFSET $offset;");
		}
		else{
			return $this->get_results("SELECT * FROM `company_product` WHERE `company_id` = '$company' AND `status` = '$status' ORDER BY `company_product_id` DESC LIMIT $limit OFFSET $offset;");
		}
	}
	public function get_company_product_byid($id)
	{
		return $this->get_row("SELECT * FROM `company_product` WHERE `company_product_id` = '$id';");
	}
	//Photos
	public function get_photos($company)
	{
		return $this->get_results("SELECT * FROM `photo` WHERE `company_id` = '$company' ORDER BY `at` DESC;");
	}
	public function get_photos_total($company)
	{
		return $this->get_row("SELECT COUNT(`photo_id`) AS 'total' FROM `photo` WHERE `company_id` = '$company';");
	}
	public function get_photos_by_page($company,$page,$total)
	{
		$totalLimit = ($total/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$limit = 2;
		$pages = ceil($totalLimit / $limit);
		$offset = ($page - 1)  * $limit;
		return $this->get_results("SELECT * FROM `photo` WHERE `company_id` = '$company' ORDER BY `at` DESC LIMIT $limit OFFSET $offset;;");
	}
	//CATs
	public function get_super_cats($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `super_cat` ORDER BY `title` ASC;");
		}
		else{
			return $this->get_results("SELECT * FROM `super_cat` WHERE `status` = '$status' ORDER BY `title` ASC;");
		}
	}
	public function get_super_cat_byid($id)
	{
		return $this->get_row("SELECT * FROM `super_cat` WHERE `super_cat_id` = '$id';");
	}
	public function get_cats($status, $super_cat_id)
	{
		if ($status == 'all') {
			if ($super_cat_id > 0) {
				return $this->get_results("
					SELECT c.*, sc.title AS super_cat 
					FROM `cat` AS c 
					INNER JOIN `super_cat` AS sc ON sc.super_cat_id = c.super_cat_id 
					WHERE c.super_cat_id = '$super_cat_id' 
					ORDER BY c.title ASC;
				");
			}
			else{
				return $this->get_results("
					SELECT c.*, sc.title AS super_cat 
					FROM `cat` AS c 
					INNER JOIN `super_cat` AS sc ON sc.super_cat_id = c.super_cat_id 
					ORDER BY c.title ASC;
				");
			}
		}
		else{
			if ($super_cat_id > 0) {
				return $this->get_results("
					SELECT c.*, sc.title AS super_cat 
					FROM `cat` AS c 
					INNER JOIN `super_cat` AS sc ON sc.super_cat_id = c.super_cat_id 
					WHERE c.super_cat_id = '$super_cat_id' AND c.status = '$status' 
					ORDER BY c.title ASC;
				");
			}
			else{
				return $this->get_results("
					SELECT c.*, sc.title AS super_cat 
					FROM `cat` AS c 
					INNER JOIN `super_cat` AS sc ON sc.super_cat_id = c.super_cat_id 
					WHERE c.status = '$status' 
					ORDER BY c.title ASC;
				");
			}
		}
	}
	public function get_cat_byid($id)
	{
		return $this->get_row("SELECT * FROM `cat` WHERE `cat_id` = '$id';");
	}
	public function get_sub_cats($status,$cat_id)
	{
		if ($status == 'all') {
			if ($cat_id > 0) {
				return $this->get_results("
					SELECT sc.*, c.title AS cat 
					FROM `sub_cat` AS sc 
					INNER JOIN `cat` AS c ON sc.cat_id = c.cat_id 
					WHERE sc.cat_id = '$cat_id' 
					ORDER BY sc.title ASC;
				");
			}
			else{
				return $this->get_results("
					SELECT sc.*, c.title AS cat 
					FROM `sub_cat` AS sc 
					INNER JOIN `cat` AS c ON sc.cat_id = c.cat_id 
					ORDER BY sc.title ASC;
				");
			}
		}
		else{
			if ($cat_id > 0) {
				return $this->get_results("
					SELECT sc.*, c.title AS cat 
					FROM `sub_cat` AS sc 
					INNER JOIN `cat` AS c ON sc.cat_id = c.cat_id 
					WHERE sc.cat_id = '$cat_id' AND sc.status = '$status' 
					ORDER BY sc.title ASC;
				");
			}
			else{
				return $this->get_results("
					SELECT sc.*, c.title AS cat 
					FROM `sub_cat` AS sc 
					INNER JOIN `cat` AS c ON sc.cat_id = c.cat_id 
					WHERE sc.status = '$status' 
					ORDER BY sc.title ASC;
				");
			}
		}
	}
	public function get_popular_cats($id)
	{
		return $this->get_results("SELECT `sub_cat_id`,`title` FROM `sub_cat` WHERE `popular` = 'yes' AND `status` = 'active' AND `sub_cat_id` != '$id' ORDER BY `title` ASC;");
	}
	public function get_sub_cat_byid($id)
	{
		return $this->get_row("SELECT * FROM `sub_cat` WHERE `sub_cat_id` = '$id';");
	}
	public function get_categories_for_listing()
	{
		$superCats = $this->get_super_cats('active');
		if ($superCats) {
			$final = array();
			$count = 0;
			foreach ($superCats as $key => $q) {
				$super_cat_id = $q['super_cat_id'];
				$cats = $this->get_cats('active', $super_cat_id);
				if ($cats) {
					$final[$count]['super'] = $q;
					$final[$count]['cats'] = $cats;
					$count++;
				}
			}
			return $final;
		}
		else{
			return false;
		}
	}
	//User
	public function login_social($id)
	{
		return $this->get_row("SELECT * FROM `user` WHERE `fb_id` = '$id';");
	}
	public function get_company_cats($id)
	{
		if (intval($id) > 0) {
			return $this->get_row("
				SELECT sub.sub_cat_id, c.cat_id, super.super_cat_id 
				FROM `sub_cat` AS sub 
				LEFT JOIN `cat` AS c ON sub.cat_id = c.cat_id 
				LEFT JOIN `super_cat` AS super ON c.super_cat_id = super.super_cat_id 
				WHERE sub.sub_cat_id = '$id' AND sub.status = 'active';
			");
		}
		else{
			return false;
		}
	}
	public function get_users($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `user` ORDER BY `fname`,`lname` ASC;");
		}
		else{
			return $this->get_results("SELECT * FROM `user` WHERE `status` = '$status' ORDER BY `fname`,`lname` ASC;");
		}
	}
	public function get_user_byid($id)
	{
		return $this->get_row("SELECT * FROM `user` WHERE `user_id` = '$id';");
	}
	public function get_user_by_email($email)
	{
		return $this->get_row("SELECT * FROM `user` WHERE `email` = '$email';");
	}
	public function check_user_login($username,$password)
	{
		return $this->get_row("SELECT * FROM `user` WHERE (`email` = '$username' OR `phone` = '$username') AND `password` = '$password';");
	}
	public function get_user_company_review($user,$company,$tbl,$review_type,$product_id = 0)
	{
		return $this->get_row("SELECT * FROM `$tbl` WHERE `user_id` = '$user' AND `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id';");
	}
	public function user_reviews($user,$tables)
	{
		$tables = explode(',', $tables);
		foreach ($tables as $key => $q) {
			$resp = $this->get_results("
				SELECT r.*, c.company_name, c.logo AS company_logo, c.website 
				FROM `$q` AS r 
				LEFT JOIN `company` AS c ON r.company_id = c.company_id 
				WHERE r.user_id = '$user' AND r.status = 'aprove' AND r.review_type = 'company' 
				ORDER BY r.company_review_id DESC 
			;");
			if ($key == 0) {
				if ($resp) {
					if ($arr) {
						$arr = array_merge($arr,$resp);
					}
					else{
						$arr = $resp;
					}
				}
			}
			else{
				if ($resp) {
					if ($arr) {
						$arr = array_merge($arr,$resp);
					}
					else{
						$arr = $resp;
					}
				}
			}
		}
		return $arr;
	}
	//review
	public function get_homepage_random_reviews()
	{
		$tbl = 'company_review_'.rand(1,50);
		$resp = $this->get_results("
			SELECT r.*, c.company_name, c.logo AS company_logo 
			FROM `$tbl` AS r 
			LEFT JOIN `company` AS c ON r.company_id = c.company_id 
			WHERE r.status = 'aprove' AND r.review_type = 'company' 
			ORDER BY r.company_review_id DESC LIMIT 3
			;");
		if ($resp) {
			return $resp;
		}
		else{
			$this->get_homepage_random_reviews();
		}
	}
	public function get_review_by_code($code)
	{
		return $this->get_row("SELECT * FROM `company_review` WHERE `api_code` = '$code';");
	}
	public function get_company_review_byid($id, $tbl)
	{
		return $this->get_row("SELECT * FROM `$tbl` WHERE `company_review_id` = '$id';");
	}
	public function get_company_reviews($status,$company,$tbl,$review_type,$product_id = 0)
	{
		if ($status == 'all') {
			return $this->get_results("
				SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
				FROM `$tbl` AS r 
				LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
				LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
				LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
				LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
				WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' 
				ORDER BY r.company_review_id DESC;
			");
		}
		else{
			return $this->get_results("
				SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
				FROM `$tbl` AS r 
				LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
				LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
				LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
				LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
				WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' 
				ORDER BY r.company_review_id DESC;
			");
		}
	}
	public function get_company_page_reviews_total($status,$company,$tbl,$review_type,$product_id = 0)
	{
		return $this->get_row("
			SELECT COUNT(r.company_review_id) AS 'total' 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' 
			ORDER BY r.company_review_id DESC;
		");
	}
	public function get_company_page_reviews_total_ajax($status,$company,$tbl,$review_type,$product_id = 0,$filters)
	{
		$where = '';
		if (strlen($filters['star']) > 0 && intval($filters['star']) > 0) {
			$where .= "AND r.review_ratting = ".$filters['star']." ";
		}

		if (strlen($filters['reply']) > 0 && $filters['reply'] == "yes") {
			$where .= "AND company_note_status = 'yes' ";
		}
		else if (strlen($filters['reply']) > 0 && $filters['reply'] == "no") {
			$where .= "AND company_note_status = 'no' ";
		}

		if (strlen($filters['flag']) > 0) {
			$where .= "AND flag = '".$filters['flag']."' ";
		}

		if (strlen($filters['type']) > 0) {
			$where .= "AND type = '".$filters['type']."' ";
		}

		if (strlen($filters['user_asked']) > 0) {
			$where .= "AND user_asked = '".$filters['user_asked']."' ";
		}
		return $this->get_row("
			SELECT COUNT(r.company_review_id) AS 'total' 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' $where
			ORDER BY r.company_review_id DESC;
		");
	}
	public function get_company_page_reviews($status,$company,$tbl,$page,$total,$review_type,$product_id = 0)
	{

		$totalLimit = ($total/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$limit = 2;
		$pages = ceil($totalLimit / $limit);
		$offset = ($page - 1)  * $limit;

		return $this->get_results("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' 
			ORDER BY r.company_review_id DESC 
			LIMIT $limit OFFSET $offset;
		");
	}
	public function get_company_page_reviews_dashboard($status,$company,$tbl,$page,$total,$review_type,$product_id = 0,$filters)
	{
		$totalLimit = ($total/100)*100;
		if ($totalLimit <= 1) {
			$totalLimit = 1;
		}
		$limit = 2;
		$pages = ceil($totalLimit / $limit);
		$offset = ($page - 1)  * $limit;

		$where = '';
		if (strlen($filters['star']) > 0 && intval($filters['star']) > 0) {
			$where .= "AND r.review_ratting = ".$filters['star']." ";
		}

		if (strlen($filters['reply']) > 0 && $filters['reply'] == "yes") {
			$where .= "AND company_note_status = 'yes' ";
		}
		else if (strlen($filters['reply']) > 0 && $filters['reply'] == "no") {
			$where .= "AND company_note_status = 'no' ";
		}

		if (strlen($filters['flag']) > 0) {
			$where .= "AND flag = '".$filters['flag']."' ";
		}

		if (strlen($filters['type']) > 0) {
			$where .= "AND type = '".$filters['type']."' ";
		}

		if (strlen($filters['user_asked']) > 0) {
			$where .= "AND user_asked = '".$filters['user_asked']."' ";
		}
		return $this->get_results("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' $where
			ORDER BY r.company_review_id DESC 
			LIMIT $limit OFFSET $offset;
		");
	}
	public function get_company_reviews_download($status,$company,$tbl,$review_type,$product_id = 0,$filters)
	{
		$where = '';
		if (strlen($filters['star']) > 0 && intval($filters['star']) > 0) {
			$where .= "AND r.review_ratting = ".$filters['star']." ";
		}

		if (strlen($filters['reply']) > 0 && $filters['reply'] == "yes") {
			$where .= "AND company_note_status = 'yes' ";
		}
		else if (strlen($filters['reply']) > 0 && $filters['reply'] == "no") {
			$where .= "AND company_note_status = 'no' ";
		}

		if (strlen($filters['flag']) > 0) {
			$where .= "AND flag = '".$filters['flag']."' ";
		}

		if (strlen($filters['type']) > 0) {
			$where .= "AND type = '".$filters['type']."' ";
		}

		if (strlen($filters['user_asked']) > 0) {
			$where .= "AND user_asked = '".$filters['user_asked']."' ";
		}
		return $this->get_results("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' $where
			ORDER BY r.company_review_id DESC;
		");
	}
	public function get_company_reviews_count_ratio($company,$tbl,$review_type,$product_id = 0)
	{
		$final['star_1'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '1';");
		$final['star_2'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '2';");
		$final['star_3'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '3';");
		$final['star_4'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '4';");
		$final['star_5'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '5';");
		return $final;
	}
	public function get_company_reviews_count_ratio_last_year($company,$tbl,$review_type,$product_id = 0)
	{
		$final['star_1'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '1' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR);");
		$final['star_2'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '2' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR);");
		$final['star_3'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '3' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR);");
		$final['star_4'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '4' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR);");
		$final['star_5'] = $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `review_type` = '$review_type' AND `product_id` = '$product_id' AND `status` = 'aprove' AND `review_ratting` = '5' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR);");
		return $final;
	}
	public function get_company_reviews_count_ratio_by_months($company,$tbl)
	{
		$resp['star_1'] = $this->model->get_results("
			SELECT
			MONTH(`at`) AS Month,
			COUNT(`review_ratting`) AS Count
			FROM `$tbl`
			WHERE `review_ratting` = '1' AND `company_id` = '$company' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) 
			GROUP BY MONTH(`at`)
		;");
		$resp['star_2'] = $this->model->get_results("
			SELECT
			MONTH(`at`) AS Month,
			COUNT(`review_ratting`) AS Count
			FROM `$tbl`
			WHERE `review_ratting` = '2' AND `company_id` = '$company' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) 
			GROUP BY MONTH(`at`)
		;");
		$resp['star_3'] = $this->model->get_results("
			SELECT
			MONTH(`at`) AS Month,
			COUNT(`review_ratting`) AS Count
			FROM `$tbl`
			WHERE `review_ratting` = '3' AND `company_id` = '$company' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) 
			GROUP BY MONTH(`at`)
		;");
		$resp['star_4'] = $this->model->get_results("
			SELECT
			MONTH(`at`) AS Month,
			COUNT(`review_ratting`) AS Count
			FROM `$tbl`
			WHERE `review_ratting` = '4' AND `company_id` = '$company' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) 
			GROUP BY MONTH(`at`)
		;");
		$resp['star_5'] = $this->model->get_results("
			SELECT
			MONTH(`at`) AS Month,
			COUNT(`review_ratting`) AS Count
			FROM `$tbl`
			WHERE `review_ratting` = '5' AND `company_id` = '$company' AND at >= DATE_SUB(CURDATE(),INTERVAL 1 YEAR) 
			GROUP BY MONTH(`at`)
		;");
		return $resp;
	}
	public function get_review_byid($status,$review,$company,$tbl,$review_type,$product_id = 0)
	{
		return $this->get_row("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_review_id = '$review' AND r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.status = '$status' 
		");
	}
	public function get_asked_reviews($company,$tbl,$review_type,$product_id = 0)
	{
		return $this->get_results("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.user_asked = 'yes' 
		");
	}
	public function get_reply_asked_reviews($company,$tbl,$review_type,$product_id = 0)
	{
		return $this->get_results("
			SELECT r.*, s1.title AS service_1, s2.title AS service_2, s3.title AS service_3, s4.title AS service_4 
			FROM `$tbl` AS r 
			LEFT JOIN `service` AS s1 ON r.review_service_id_1 = s1.service_id 
			LEFT JOIN `service` AS s2 ON r.review_service_id_2 = s2.service_id 
			LEFT JOIN `service` AS s3 ON r.review_service_id_3 = s3.service_id 
			LEFT JOIN `service` AS s4 ON r.review_service_id_4 = s4.service_id 
			WHERE r.company_id = '$company' AND r.review_type = '$review_type' AND r.product_id = '$product_id' AND r.user_asked = 'yes' AND r.asked_name != '' AND r.asked_email != '' AND r.asked_phone != '' AND r.asked_ref_number != '' 
		");
	}
	//Plans
	public function get_plans()
	{
		return $this->get_results("SELECT * FROM `plan` ORDER BY `plan_id` ASC;");
	}
	public function get_plan_byid($id)
	{
		return $this->get_row("SELECT * FROM `plan` WHERE `plan_id` = '$id';");
	}
	public function get_addons()
	{
		return $this->get_results("SELECT * FROM `addon` ORDER BY `addon_id` ASC;");
	}
	public function get_faqs($id)
	{
		return $this->get_results("SELECT * FROM `faq` WHERE `plan_id` = '$id' AND `status` = 'active' ORDER BY `faq_id` ASC;");
	}
	public function get_order_byid($id)
	{
		return $this->get_row("SELECT * FROM `order` WHERE `order_id` = '$id';");
	}
	//Widgets
	public function widgets($status = 'all')
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `widget`;");
		}
		else{
			return $this->get_results("SELECT * FROM `widget` WHERE `status` = '$status';");
		}
	}
	public function widget_byid($id,$status)
	{
		return $this->get_row("SELECT * FROM `widget` WHERE `widget_id` = '$id' AND `status` = '$status';");
	}
	public function get_widget_byid($id)
	{
		return $this->get_row("SELECT * FROM `widget` WHERE `widget_id` = '$id';");
	}
	public function widget_features($id)
	{
		return $this->get_results("SELECT * FROM `widget_feature` WHERE `widget_id` = '$id' ORDER BY `widget_feature_id` ASC;");
	}


	public function get_timetable_by_company_id($company)
	{
		return $this->get_row("SELECT * FROM `time_table` WHERE `company_id` = '$company';");
	}
	public function get_pages($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `page`;");
		}
		else{
			return $this->get_results("SELECT * FROM `page` WHERE `status` = '$status';");
		}
	}
	public function get_page_by_slug($slug)
	{
		return $this->get_row("SELECT * FROM `page` WHERE `slug` = '$slug';");
	}


	public function get_settings()
	{
		return $this->get_results("SELECT * FROM `settings` ORDER BY `id` ASC;");
	}
	public function get_setting_byid($id)
	{
		return $this->get_row("SELECT * FROM `settings` WHERE `id` = '$id';");
	}
	public function get_email_cron_setting()
	{
		return $this->get_row("SELECT `value` FROM `settings` WHERE `title` =  'email_cron';");
	}

	public function get_dynamic_emails()
	{
		return $this->get_results("SELECT * FROM `dynamic_email` ORDER BY `title` ASC;");
	}
	public function get_dynamic_email_byid($id)
	{
		return $this->get_row("SELECT * FROM `dynamic_email` WHERE `dynamic_email` = '$id';");
	}
	public function get_dynamic_email_by_title($title)
	{
		return $this->get_row("SELECT * FROM `dynamic_email` WHERE `title` = '$title';");
	}
	public function get_email_templates($company)
	{
		return $this->get_results("SELECT * FROM `email_template` WHERE `company_id` = '$company' ORDER BY `email_template_id` ASC;");
	}
	public function get_contact_form($status)
	{
		if ($status == 'all') {
			return $this->model->get_results("SELECT * FROM `contact_form`;");
		}
		else{
			return $this->model->get_results("SELECT * FROM `contact_form` WHERE `status` = '$status';");
		}
	}
	public function get_contact_form_byid($id)
	{
		return $this->model->get_row("SELECT * FROM `contact_form` WHERE `contact_form_id` = '$id';");
	}
	public function industries()
	{
		return $this->get_results("SELECT * FROM `industry` ORDER BY `title` ASC;");
	}
	public function get_industry_byid($id)
	{
		return $this->get_row("SELECT * FROM `industry` WHERE `industry_id` = '$id';");
	}
	public function get_industry_by_slug($slug)
	{
		return $this->get_row("SELECT * FROM `industry` WHERE `slug` = '$slug';");
	}
	public function get_email_setting($company)
	{
		return $this->get_row("SELECT * FROM `email_setting` WHERE `company_id` = '$company';");
	}
	public function get_company_transections($company)
	{
		return $this->get_results("
			SELECT o.price_type,o.amount,o.at,p.title AS 'plan' 
			FROM `order` AS o 
			INNER JOIN `plan` AS p ON o.plan_id = p.plan_id 
			WHERE o.company_id = '$company' 
			ORDER BY o.at DESC;
		");
	}
	public function get_all_transections()
	{
		return $this->get_results("
			SELECT o.price_type,o.amount,o.at,p.title AS 'plan' 
			FROM `order` AS o 
			INNER JOIN `plan` AS p ON o.plan_id = p.plan_id 
			ORDER BY o.at DESC;
		");
	}
	//notifications
	public function notifications()
	{
		return $this->get_results("SELECT * FROM `notification` ORDER BY `notification_id` ASC;");
	}
	public function get_notification_byid($id)
	{
		return $this->get_row("SELECT * FROM `notification` WHERE `notification_id` = '$id';");
	}
	public function get_notify_by_company($company,$type)
	{
		if ($type == 'all') {
			$records = $this->get_results("
				SELECT notify.*, n.title, n.tag_line 
				FROM `notify` AS notify 
				INNER JOIN `notification` AS n ON n.notification_id = notify.notification_id 
				WHERE notify.all = 'yes' AND notify.company_id = 0 AND notify.parent = 0 
				ORDER BY notify.at DESC 
			;");
			if ($records) {
				$final = array();
				foreach ($records as $key => $q) {
					$check = $this->get_row("SELECT `notify_id` FROM `notify` WHERE `parent` = '".$q['notify_id']."';");
					if (!($check)) {
						$final[] = $q;
					}
				}
				return $final;
			}
			else{
				return false;
			}
		}
		else{
			return $this->get_results("
				SELECT notify.*, n.title, n.tag_line 
				FROM `notify` AS notify 
				INNER JOIN `notification` AS n ON n.notification_id = notify.notification_id 
				WHERE notify.company_id = '$company' AND notify.all = 'no' AND notify.status = 'unread' 
				ORDER BY notify.at DESC 
			;");
		}
	}
	public function get_notify_by_company_single($company,$notify,$type)
	{
		if ($type == 'all') {
			return $this->get_row("
				SELECT notify.*, n.title, n.tag_line, n.detail 
				FROM `notify` AS notify 
				INNER JOIN `notification` AS n ON n.notification_id = notify.notification_id 
				WHERE notify.company_id = 0 AND notify.notify_id = '$notify' 
				ORDER BY notify.at DESC 
			;");
		}
		else{
			return $this->get_row("
				SELECT notify.*, n.title, n.tag_line, n.detail 
				FROM `notify` AS notify 
				INNER JOIN `notification` AS n ON n.notification_id = notify.notification_id 
				WHERE notify.company_id = '$company' AND notify.notify_id = '$notify' 
				ORDER BY notify.at DESC 
			;");
		}
	}
	public function check_alert_duplication($notify,$company)
	{
		return $this->get_row("SELECT * FROM `notify` WHERE `company_id` = '$company' AND `parent` = '$notify' AND `all` = 'yes' AND `status`  = 'read';");
	}
	/* OVERVIEW REVIEWS */
	public function get_invitations_count_last_30_days($company,$status)
	{
		return $this->get_row("SELECT COUNT(`invite_customer_id`) AS 'count' FROM `invite_customer` WHERE `company_id` = '$company' AND `status` = '$status' AND `updated_at` BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY `updated_at` DESC;");
	}
	public function get_verfied_reviews_count_last_30_days($company,$tbl)
	{
		return $this->get_row("SELECT COUNT(`company_review_id`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `type` = 'api' AND `status` = 'aprove' AND `updated_at` BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY `updated_at` DESC;");
	}
	public function get_ratting_count_last_30_days($company,$tbl)
	{
		return $this->get_row("SELECT AVG(`review_ratting`) AS 'count' FROM `$tbl` WHERE `company_id` = '$company' AND `status` = 'aprove' AND `updated_at` BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY `updated_at` DESC;");
	}
	public function get_recent_invitations($company,$limit)
	{
		return $this->get_results("SELECT `email`,`status`,`at`,`updated_at`,`ref_id` FROM `invite_customer` WHERE `company_id` = '$company' AND `updated_at` BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY `updated_at` DESC LIMIT $limit;");
	}
	public function flag_categories()
	{
		return $this->get_results("SELECT * FROM `flag_category` ORDER BY `title` ASC;");
	}
	public function get_flag_category_byid($id)
	{
		return $this->get_row("SELECT * FROM `flag_category` WHERE `flag_category_id` = '$id';");
	}
	public function get_flag_reasons($id)
	{
		return $this->get_results("SELECT * FROM `flag_reason` WHERE `flag_category_id` = '$id' ORDER BY `title` ASC;");	
	}
	public function flag_requestes()
	{
		return $this->get_results("SELECT * FROM `flag_review` WHERE `status` = 'pending' ORDER BY `at` ASC;");
	}
	public function flag_request_byid($id)
	{
		return $this->get_row("SELECT * FROM `flag_review` WHERE `flag_review_id` = '$id';");
	}
	public function get_flag_review_detail($id)
	{
		$flag = $this->flag_request_byid($id);
		if ($flag) {
			$reason = $this->get_row("SELECT `title` FROM `flag_reason` WHERE `flag_reason_id` = '".$flag['flag_reason_id']."'");
			$tbl = $flag['review_table'];
			$detail = $this->get_row("
				SELECT u.fname,u.lname,u.phone AS userPhone,u.email AS userEmail, c.company_name,c.website,c.phone AS companyPhone,c.email AS companyEmail, cr.review_text 
				FROM `".$tbl."` AS cr 
				INNER JOIN `user` AS u ON cr.user_id = u.user_id 
				INNER JOIN `company` AS c ON cr.company_id = c.company_id 
				WHERE cr.company_review_id = '".$flag['company_review_id']."'
			;");
			$detail['reason'] = $reason['title'];
			$detail['selected_words'] = $flag['selected_words'];
			$detail['time'] = $flag['at'];
			return $detail;
		}
		else{
			return false;
		}
	}
	public function get_company_flaged_reviews($id,$tbl)
	{
		return $this->get_results("
			SELECT review.company_review_id, review.review_text, review.review_title, review.review_ratting, review.at AS review_date, reason.title AS reason_title, flag.at AS flaged_date, flag.status 
			FROM `flag_review` AS flag 
			INNER JOIN `$tbl` AS review ON review.company_review_id = flag.company_review_id 
			INNER JOIN `flag_reason` AS reason ON flag.flag_reason_id = reason.flag_reason_id 
			WHERE review.company_id = '$id' 
			ORDER BY flag.at 
		;");
	}
}