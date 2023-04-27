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
	public function get_state_bycountry($id)
	{
		return $this->get_results("SELECT * FROM `state` WHERE `country_id` = '$id' ORDER BY `name` ASC;");
	}
	public function get_city_byname($name)
	{
		return $this->get_row("SELECT * FROM `city` WHERE LOWER(`name`) = LOWER('$name');");
	}
	public function get_pak_cities()
	{
		$state = $this->get_state_bycountry(166);
		foreach ($state as $key => $val) {
			if ($key == 0) {
				$id  = $val['state_id'];
			}
			else {
				$id .= ','.$val['state_id'];
			}
		}
		if (strlen($id) > 0) {
			return $this->get_results("SELECT * FROM `city` WHERE `state_id` IN ($id) ORDER BY `name` ASC;");
		}
		else {
			return false;
		}
		
	}
	public function get_city_bystate($id)
	{
		return $this->get_results("SELECT * FROM `city` WHERE `state_id` = '$id' ORDER BY `name` ASC;");
	}
	public function check_dublicate_phone($phone,$tbl)
	{
		return $this->get_row("SELECT `phone` FROM `$tbl` WHERE `phone`= '$phone';");
	}
	public function get_doctor_byid($id)
	{
		return $this->get_row("SELECT * FROM  `doctor` WHERE `doctor_id` = '$id';");
	}
	public function get_doctor_profile($slug)
	{
		return $this->get_row("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE (d.doctor_id = '$slug' OR d.username = '$slug')
		;");
	}
	public function doctor_login($key,$password)
	{
		return $this->get_row("SELECT * FROM `doctor` WHERE `phone` = '$key' AND `password` = '$password';");
	}
	public function get_patient_byid($id)
	{
		return $this->get_row("SELECT * FROM  `patient` WHERE `patient_id` = '$id';");
	}
	public function patient_login($key,$password)
	{
		return $this->get_row("SELECT * FROM `patient` WHERE `phone` = '$key' AND `password` = '$password';");
	}
	public function services()
	{
		return $this->get_results("SELECT * FROM `service` ORDER BY `title` ASC;");
	}
	public function specializations()
	{
		return $this->get_results("SELECT * FROM `specialization` ORDER BY `title` ASC;");
	}
	public function all_education_by_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `education` WHERE `doctor_id` = '$doctor' ORDER BY `education_id` ASC;");
	}
	public function all_experience_by_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `experience` WHERE `doctor_id` = '$doctor' ORDER BY `experience_id` ASC;");
	}
	public function all_award_by_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `award` WHERE `doctor_id` = '$doctor' ORDER BY `award_id` ASC;");
	}
	public function all_membership_by_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `membership` WHERE `doctor_id` = '$doctor' ORDER BY `membership_id` ASC;");
	}
	public function all_registration_by_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `registration` WHERE `doctor_id` = '$doctor' ORDER BY `registration_id` ASC;");
	}
	public function hospitals()
	{
		return $this->get_results("SELECT * FROM `hospital` ORDER BY `name` ASC;");
	}
	public function hospital_byid($id)
	{
		return $this->get_row("SELECT * FROM `hospital` WHERE `hospital_id` = '$id';");
	}
	public function doctor_hospitals($doctor)
	{
		return $this->get_results("
			SELECT dh.doctor_hospital_id, dh.hospital_id, dh.fee, dh.timing_note, h.name, h.address, c.name AS cityName 
			FROM `doctor_hospital` AS dh 
			INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
			INNER JOIN `city` AS c ON h.city_id = c.city_id 
			WHERE dh.doctor_id = '$doctor' 
			ORDER BY h.name ASC 
		;");
	}
	public function get_doctor_hospital_by_ids($doctor,$hospital)
	{
		return $this->get_row("
			SELECT dh.doctor_hospital_id, dh.fee, dh.timing_note, h.name, h.address, c.name AS cityName, h.hospital_id 
			FROM `doctor_hospital` AS dh 
			INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
			INNER JOIN `city` AS c ON h.city_id = c.city_id 
			WHERE dh.doctor_id = '$doctor' AND dh.hospital_id = '$hospital' 
		;");
	}
	public function get_hospital_by_doctor_hospital_id($doctor,$doctor_hospital)
	{
		return $this->get_row("
			SELECT dh.doctor_hospital_id, dh.fee, dh.timing_note, h.*, c.name AS cityName 
			FROM `doctor_hospital` AS dh 
			INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
			INNER JOIN `city` AS c ON h.city_id = c.city_id 
			WHERE dh.doctor_id = '$doctor' AND dh.doctor_hospital_id = '$doctor_hospital' 
		;");
	}
	public function get_hospital_by_doctor_hospital_id_2($doctor,$hospital)
	{
		return $this->get_row("
			SELECT dh.doctor_hospital_id, dh.fee, dh.timing_note, h.*, c.name AS cityName 
			FROM `doctor_hospital` AS dh 
			INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
			INNER JOIN `city` AS c ON h.city_id = c.city_id 
			WHERE dh.doctor_id = '$doctor' AND dh.hospital_id = '$hospital' 
		;");
	}
	public function get_doctor_hospital_by_id($doctor,$doctor_hospital)
	{
		return $this->get_row("
			SELECT dh.doctor_hospital_id, dh.fee, dh.timing_note, h.name, h.address, c.name AS cityName 
			FROM `doctor_hospital` AS dh 
			INNER JOIN `hospital` AS h ON dh.hospital_id = h.hospital_id 
			INNER JOIN `city` AS c ON h.city_id = c.city_id 
			WHERE dh.doctor_id = '$doctor' AND dh.doctor_hospital_id = '$doctor_hospital' 
			ORDER BY h.name ASC 
		;");
	}
	public function get_all_slots_for_doctor($doctor)
	{
		return $this->get_results("SELECT * FROM `time_slot` WHERE `doctor_id` = '$doctor' ORDER BY `day_number`,`time_start` ASC");
	}
	public function get_all_slots_for_doctor_hospital($doctor)
	{
		return $this->get_results("SELECT * FROM `time_slot` WHERE `doctor_id` = '$doctor' ORDER BY `day_number`,`time_start` ASC");
	}
	public function get_all_slots_for_doctor_hospital_by_ids($doctor,$hospital)
	{
		return $this->get_results("SELECT * FROM `time_slot` WHERE `hospital_id` = '$hospital' AND `doctor_id` = '$doctor' ORDER BY `day_number`,`time_start` ASC");
	}
	public function get_slots_by_day_number($doctor,$day_number)
	{
		return $this->get_results("SELECT * FROM `time_slot` WHERE `doctor_id` = '$doctor' AND `day_number` = '$day_number' ORDER BY `day_number`,`time_start` ASC");
	}
	public function get_slot_byid($id)
	{
		return $this->get_row("SELECT * FROM `time_slot` WHERE `time_slot_id` = '$id';");
	}
	public function get_appointments_by_patient($patient)
	{
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username 
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			WHERE a.patient_id = '$patient' 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function get_appointment_by_id($id)
	{
		return $this->get_row("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username 
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			WHERE a.appointment_id = '$id' 
		;");
	}
}