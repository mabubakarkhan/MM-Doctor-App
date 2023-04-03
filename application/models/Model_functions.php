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
	public function check_dublicate_phone($phone,$tbl)
	{
		return $this->get_row("SELECT `phone` FROM `$tbl` WHERE `phone`= '$phone';");
	}
	public function get_doctor_byid($id)
	{
		return $this->get_row("SELECT * FROM  `doctor` WHERE `doctor_id` = '$id';");
	}
	public function doctor_login($key,$password)
	{
		return $this->get_row("SELECT * FROM `doctor` WHERE `phone` = '$key' AND `password` = '$password';");
	}
}