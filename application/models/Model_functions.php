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
	public function setting($id)
	{
		return $this->get_row("SELECT * FROM `setting` WHERE `setting_id` = '$id';");
	}
	public function login($username,$password)
	{
		return $this->get_row("SELECT * FROM `admin` WHERE `username`= '$username' AND `password` = '$password';");
	}
	public function get_search_doctor($get)
	{
		$where =  "1 = 1";
		$sort = '';
		if ($get['city_id'] != '') {
			$where .= " AND d.city_id = '".$get['city_id']."'";
		}
		if ($get['service'] != '') {
			if ($get['direct'] == 'true') {
				$where .= " AND d.service_ids IN(".$get['service'].") ";
			}
			else{
				$where .= ' AND (';
				foreach ($get['service'] as $key => $service) {
					if (!(empty($service))) {
						if ($key == 0) {
							$where .= " d.service_ids IN(".$service.") ";
						}
						else{
							$where .= " OR d.service_ids IN(".$service.") ";
						}
					}
				}
				$where .= ') ';
			}
		}
		if ($get['specialization'] != '') {
			if ($get['direct'] == 'true') {
				$where .= " AND d.specialization_ids IN(".$get['specialization'].") ";
			}
			else{
				$where .= ' AND (';
				foreach ($get['specialization'] as $key => $specialization) {
					if (!(empty($specialization))) {
						if ($key == 0) {
							$where .= " d.specialization_ids IN(".$specialization.") ";
						}
						else{
							$where .= " OR d.specialization_ids IN(".$specialization.") ";
						}
					}
				}
				$where .= ') ';
			}
		}
		if ($get['gender'] != '') {
			$where .= " AND d.gender = '".$get['gender']."'";
		}
		if ($get['sort'] == 'ratting') {
			$sort = " ORDER BY d.ratting ASC";
		}
		if ($get['sort'] == 'ASC') {
			$sort = " ORDER BY d.fname,d.lname ASC";
		}
		if ($get['sort'] == 'DESC') {
			$sort = " ORDER BY d.fname,d.lname DESC";
		}
		return $this->get_results("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE $where 
			$sort
		");

	}
	public function featured_doctors_for_home()
	{
		return $this->get_results("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE d.status = 'active' AND d.specialization_featured = 'yes' 
			ORDER BY RAND() 
			LIMIT 4
		");
	}
	public function specializations_featured_doctors()
	{
		return $this->get_results("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE d.status = 'active' AND d.specialization_featured = 'yes' 
			ORDER BY RAND()
		");
	}
	public function services_featured_doctors()
	{
		return $this->get_results("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE d.status = 'active' AND d.service_featured = 'yes' 
			ORDER BY RAND()
		");
	}
	public function doctors_by_hospital($id)
	{
		return $this->get_results("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `doctor_hospital` AS dh 
			INNER JOIN  `doctor` AS d ON d.doctor_id = dh.doctor_id 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE d.status = 'active' AND dh.hospital_id = '$id' 
			ORDER BY d.ratting ASC
		");
	}
	public function get_doctors_by_patient($patient)
	{
		return $this->get_results("
			SELECT DISTINCT(mr.doctor_id) , d.fname, d.lname 
			FROM  `medical_record` AS mr 
			INNER JOIN  `doctor` AS d ON d.doctor_id = mr.doctor_id 
			WHERE mr.patient_id = '$patient' 
			ORDER BY d.fname, d.lname ASC
		;");
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
	public function check_dublicate($phone,$email,$tbl)
	{
		return $this->get_row("SELECT `phone` FROM `$tbl` WHERE `phone`= '$phone' OR `email`= '$email';");
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
	public function get_patient_profile($id)
	{
		return $this->get_row("
			SELECT d.*, city.name AS 'cityName', state.name AS 'stateName', country.name AS 'countryName' 
			FROM  `patient` AS d 
			LEFT JOIN `city` AS city ON d.city_id = city.city_id 
			LEFT JOIN `state` AS state ON d.state_id = state.state_id 
			LEFT JOIN `country` AS country ON d.country_id = country.country_id 
			WHERE d.patient_id = '$id'
		;");
	}
	public function patient_login($key,$password)
	{
		return $this->get_row("SELECT * FROM `patient` WHERE `phone` = '$key' AND `password` = '$password';");
	}
	public function services()
	{
		return $this->get_results("SELECT * FROM `service` ORDER BY `title` ASC;");
	}
	public function services_featured()
	{
		return $this->get_results("SELECT * FROM `service` WHERE `featured` = 'yes' ORDER BY `title` ASC;");
	}
	public function get_service_byid($id)
	{
		return $this->get_row("SELECT * FROM `service` WHERE `service_id` = '$id';");
	}
	public function specializations()
	{
		return $this->get_results("SELECT * FROM `specialization` ORDER BY `title` ASC;");
	}
	public function specializations_featured()
	{
		return $this->get_results("SELECT * FROM `specialization` WHERE `featured` = 'yes' ORDER BY `title` ASC;");
	}
	public function get_specialization_byid($id)
	{
		return $this->get_row("SELECT * FROM `specialization` WHERE `specialization_id` = '$id'");
	}
	public function conditions_by_specialization($id)
	{
		return $this->get_results("
			SELECT c.*, s.title AS specializationTitle 
			FROM `condition` AS c 
			INNER JOIN `specialization` AS s ON c.specialization_id = s.specialization_id 
			WHERE c.specialization_id = '$id' 
			ORDER BY c.title ASC
		;");
	}
	public function conditions()
	{
		return $this->get_results("
			SELECT c.*, s.title AS specializationTitle 
			FROM `condition` AS c 
			INNER JOIN `specialization` AS s ON c.specialization_id = s.specialization_id 
			ORDER BY c.title ASC
		;");
	}
	public function conditions_featured()
	{
		return $this->get_results("
			SELECT c.*, s.title AS specializationTitle 
			FROM `condition` AS c 
			INNER JOIN `specialization` AS s ON c.specialization_id = s.specialization_id 
			WHERE c.featured = 'yes'
			ORDER BY c.title ASC
		;");
	}
	public function get_condition_byid($id)
	{
		return $this->get_row("SELECT * FROM `condition` WHERE `condition_id` = '$id'");
	}
	public function facilities()
	{
		return $this->get_results("SELECT * FROM `facility` ORDER BY `title` ASC;");
	}
	public function facilities_featured()
	{
		return $this->get_results("SELECT * FROM `facility` WHERE `featured` = 'yes' ORDER BY `title` ASC;");
	}
	public function get_facility_byid($id)
	{
		return $this->get_row("SELECT * FROM `facility` WHERE `facility_id` = '$id'");
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
	public function all_hospitals($value='')
	{
		return $this->get_results("
			SELECT h.*, city.name AS cityName, state.name AS stateName, doctor.fname AS doctorFname, doctor.lname AS doctorLname, doctor.username 
			FROM `hospital` AS h 
			INNER JOIN `city` AS city ON h.city_id = city.city_id 
			INNER JOIN `state` AS state ON h.state_id = state.state_id 
			LEFT JOIN `doctor` AS doctor ON h.doctor_id = doctor.doctor_id 
			ORDER BY h.name ASC 
		;");	
	}
	public function featured_hospitals()
	{
		return $this->get_results("SELECT `hospital_id`,`name` FROM `hospital` WHERE `featured` = 'yes' ORDER BY `name` ASC;");
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
	public function get_appointments_admin($get)
	{
		$where = '1=1';
		if (isset($get['doctor_id'])) {
			$where .= " AND a.doctor_id = '".$get['doctor_id']."'";
		}
		if (isset($get['patient_id'])) {
			$where .= " AND a.patient_id = '".$get['patient_id']."'";
		}
		if (isset($get['status'])) {
			$where .= " AND a.status = '".$get['status']."'";
		}
		if (isset($get['cancel_by'])) {
			$where .= " AND a.cancel_by = '".$get['cancel_by']."'";
		}
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg', h.name AS 'hospitalName'
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `hospital` AS h ON a.hospital_id = h.hospital_id  
			WHERE $where 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function get_appointments_by_patient($patient)
	{
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg', h.name AS 'hospitalName'
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `hospital` AS h ON a.hospital_id = h.hospital_id  
			WHERE a.patient_id = '$patient' 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function appointments_by_patient($patient)
	{
		return $this->get_results("
			SELECT a.appointment_id
			FROM `appointment` AS a 
			WHERE a.patient_id = '$patient' 
			ORDER BY a.appointment_id ASC
		;");
	}
	public function get_appointments_by_doctor($doctor)
	{
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg', h.name AS 'hospitalName'
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `hospital` AS h ON a.hospital_id = h.hospital_id 
			WHERE a.doctor_id = '$doctor' 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function get_done_appointments_by_doctor($doctor)
	{
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg', h.name AS 'hospitalName', r.review AS 'reviewNote', r.ratting 
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `hospital` AS h ON a.hospital_id = h.hospital_id 
			LEFT JOIN `review` AS r ON a.appointment_id = r.appointment_id 
			WHERE a.doctor_id = '$doctor' 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function get_appointment_by_id($id)
	{
		return $this->get_row("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg' 
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			WHERE a.appointment_id = '$id' 
		;");
	}
	public function get_appointments_by_slot($slot,$doctor)
	{
		return $this->get_results("SELECT * FROM `appointment` WHERE `time_slot_id` = '$slot' AND `doctor_id` = '$doctor' AND `status` != 'cancel' AND `status` != 'done';");
	}
	public function get_patients_by_doctor($doctor)
	{
		return $this->get_results("
			SELECT distinct(a.patient_id) AS 'patient_id', p.fname, p.lname, c.name AS cityName, p.phone, p.img, p.blood_group, p.gender 
			FROM `appointment` AS a 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `city` AS c ON p.city_id = c.city_id 
			WHERE a.doctor_id = '$doctor' 
			ORDER BY p.fname,p.lname 
		;");
	}
	public function get_medical_records($appointment)
	{
		return $this->get_results("
			SELECT m.*, p.fname AS 'patientFname', p.lname AS 'patientLname', d.fname AS 'doctorFname', d.lname AS 'doctorLname' 
			FROM `medical_record` AS m 
			INNER JOIN `patient` AS p ON m.patient_id = p.patient_id 
			INNER JOIN `doctor` AS d ON m.doctor_id = d.doctor_id 
			WHERE m.appointment_id = '$appointment' 
			ORDER BY m.medical_record_id DESC
		");
	}
	public function get_medical_records_for_search($post)
	{
		$chk = false;
		$where = " m.patient_id = '".$post['patient_id']."'";
		if (!(empty($post['appointment_id']))) {
			$where .= " AND m.appointment_id = '".$post['appointment_id']."'";
			$chk = true;
		}
		if (!(empty($post['doctor_id']))) {
			$where .= " AND m.doctor_id = '".$post['doctor_id']."'";
			$chk = true;
		}
		if ($chk) {
			return $this->get_results("
				SELECT m.*, p.fname AS 'patientFname', p.lname AS 'patientLname', d.fname AS 'doctorFname', d.lname AS 'doctorLname' 
				FROM `medical_record` AS m 
				INNER JOIN `patient` AS p ON m.patient_id = p.patient_id 
				INNER JOIN `doctor` AS d ON m.doctor_id = d.doctor_id 
				WHERE $where 
				ORDER BY m.medical_record_id DESC
			");
		}
		elsE{
			return false;
		}
	}
	public function get_medical_records_by_patient($patient)
	{
		return $this->get_results("
			SELECT m.*, p.fname AS 'patientFname', p.lname AS 'patientLname', d.fname AS 'doctorFname', d.lname AS 'doctorLname' 
			FROM `medical_record` AS m 
			INNER JOIN `patient` AS p ON m.patient_id = p.patient_id 
			LEFT JOIN `doctor` AS d ON m.doctor_id = d.doctor_id 
			WHERE m.patient_id = '$patient' 
			ORDER BY m.medical_record_id DESC
		");
	}
	public function check_bookmark($doctor,$patient)
	{
		return $this->get_row("SELECT * FROM `bookmark_doctor` WHERE `doctor_id` = '$doctor' AND `patient_id` = '$patient';");
	}
	public function get_favourites($patient)
	{
		return $this->get_results("
			SELECT b.bookmark_doctor_id, d.*, c.name AS cityName
			FROM `bookmark_doctor` AS b 
			INNER JOIN `doctor` AS d ON b.doctor_id = d.doctor_id 
			LEFT JOIN `city` AS c ON d.city_id = c.city_id 
			WHERE b.patient_id = '$patient' 
			ORDER BY d.fname ASC
		;");
	}
	public function get_done_appointments_by_patient($patient)
	{
		return $this->get_results("
			SELECT a.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username, p.fname AS 'patientFname', p.lname AS 'patientLname', p.img AS 'patientImg', h.name AS 'hospitalName', r.review AS 'reviewNote', r.ratting 
			FROM `appointment` AS a 
			INNER JOIN `doctor` AS d ON a.doctor_id = d.doctor_id 
			INNER JOIN `patient` AS p ON a.patient_id = p.patient_id 
			LEFT JOIN `hospital` AS h ON a.hospital_id = h.hospital_id
			LEFT JOIN `review` AS r ON a.appointment_id = r.appointment_id 
			WHERE a.patient_id = '$patient' AND a.status = 'done' 
			ORDER BY a.appointment_date, a.time_start, a.time_end ASC
		;");
	}
	public function get_reviews_by_doctor($doctor)
	{
		return $this->get_results("
			SELECT p.*, r.* 
			FROM `review` AS r 
			INNER JOIN `patient` AS p ON p.patient_id = r.patient_id 
			WHERE r.doctor_id = '$doctor' 
			ORDER BY r.at DESC
		;");
	}
	public function check_chat_group($doctor,$patient)
	{
		return $this->get_row("SELECT `chat_group_id` FROM `chat_group` WHERE `doctor_id` = '$doctor' AND `patient_id` = '$patient';");
	}
	public function patient_chat_groups($patient)
	{
		return $this->get_results("
			SELECT g.*, d.fname AS doctorFname, d.lname AS 'doctorLname', d.img, d.specialization_titles, d.username 
			FROM `chat_group` AS g 
			INNER JOIN `doctor` AS d ON g.doctor_id = d.doctor_id 
			WHERE `patient_id` = '$patient' 
			ORDER BY g.last_msg_at DESC 
		;");
	}
	public function doctor_chat_groups($doctor)
	{
		return $this->get_results("
			SELECT g.*, p.fname AS patientFname, p.lname AS 'patientLname', p.img 
			FROM `chat_group` AS g 
			INNER JOIN `patient` AS p ON g.patient_id = p.patient_id 
			WHERE `doctor_id` = '$doctor' 
			ORDER BY g.last_msg_at DESC 
		;");
	}
	public function get_chat($group,$doctor,$patient)
	{
		return $this->get_results("SELECT * FROM `chat` WHERE `chat_group_id` = '$group' AND `doctor_id` = '$doctor' AND `patient_id` = '$patient' ORDER BY `at` ASC;");
	}
	public function get_chat_by_id($id)
	{
		return $this->get_row("SELECT * FROM `chat` WHERE `chat_id` = '$id';");
	}
	public function get_auto_new_chat($group,$doctor,$patient,$last_id)
	{
		return $this->get_results("SELECT * FROM `chat` WHERE `chat_id` > '$last_id' AND `chat_group_id` = '$group' AND `doctor_id` = '$doctor' AND `patient_id` = '$patient' ORDER BY `at` ASC;");
	}
	public function admin_doctors($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT `doctor_id`,`fname`,`lname`,`phone` FROM `doctor` ORDER BY `doctor_id` ASC;");
		}
		else{
			return $this->get_results("SELECT `doctor_id`,`fname`,`lname`,`phone` FROM `doctor` WHERE `status` = '$status' ORDER BY `doctor_id` ASC;");
		}
	}
	public function admin_patients($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT `patient_id`,`fname`,`lname`,`phone` FROM `patient` ORDER BY `patient_id` ASC;");
		}
		else{
			return $this->get_results("SELECT `patient_id`,`fname`,`lname`,`phone` FROM `patient` WHERE `status` = '$status' ORDER BY `patient_id` ASC;");
		}
	}
	public function blog_home()
	{
		return $this->get_results("SELECT * FROM `blog` ORDER BY `updated_at` DESC LIMIT 4;");
	}
	public function blog()
	{
		return $this->get_results("SELECT * FROM `blog` ORDER BY `updated_at` DESC;");
	}
	public function get_blog_byid($id)
	{
		return $this->get_row("SELECT * FROM `blog` WHERE `blog_id` = '$id';");
	}
	public function get_blog_by_slug($slug)
	{
		return $this->get_row("SELECT * FROM `blog` WHERE `slug` = '$slug';");
	}
	public function photos($type, $id)
	{
		return $this->get_results("SELECT * FROM `photo` WHERE `type` = '$type' AND `id` = '$id' ORDER BY `photo_id` ASC;");
	}
	public function faqs($type, $id)
	{
		return $this->get_results("SELECT * FROM `faq` WHERE `type` = '$type' AND `id` = '$id' ORDER BY `faq_id` ASC;");
	}
	public function get_faq_byid($faq_id, $type, $id)
	{
		return $this->get_row("SELECT * FROM `faq` WHERE `faq_id` = '$faq_id' AND `type` = '$type' AND `id` = '$id';");
	}
	public function pages()
	{
		return $this->get_results("SELECT * FROM `page` ORDER BY `title` ASC;");
	}
	public function get_page_byid($id)
	{
		return $this->get_row("SELECT * FROM `page` WHERE `page_id` = '$id';");
	}
	public function cats($status)
	{
		if ($status == 'all') {
			return $this->get_results("SELECT * FROM `category` ORDER BY `title` ASC;");
		}
		else{
			return $this->get_results("SELECT * FROM `category` WHERE `status` = '$status' ORDER BY `title` ASC;");
		}
	}
	public function get_cat_byid($id)
	{
		return $this->get_row("SELECT * FROM `category` WHERE `category_id` = '$id';");
	}
	public function get_cat_byslug($slug)
	{
		return $this->get_row("SELECT * FROM `category` WHERE `slug` = '$slug';");
	}
	public function get_products_by_cat($id)
	{
		return $this->get_results("
			SELECT p.title, p.slug, p.product_id, p.image, p.price, p.old_price, p.new 
			FROM `product` AS p 
			WHERE p.status = 'active' AND p.category_id = '$id' 
			ORDER BY p.product_id DESC;
		");
	}
	public function get_products_by_cats($ids,$sort)
	{
		$sort = explode('-',$sort);
		if ($sort[0] == 'title') {
			$sortBy = " ORDER BY p.title ".$sort[1].";";
		}
		else{
			$sortBy = " ORDER BY p.price ".$sort[1].";";
		}
		if ($ids == false) {
			return $this->get_results("
				SELECT p.title, p.slug, p.product_id, p.image, p.price, p.old_price, p.new 
				FROM `product` AS p 
				WHERE p.status = 'active' 
				$sortBy;
			");
		}
		return $this->get_results("
			SELECT p.title, p.slug, p.product_id, p.image, p.price, p.old_price, p.new 
			FROM `product` AS p 
			WHERE p.status = 'active' AND p.category_id IN($ids) 
			$sortBy;
		");
	}
	public function products($status = 'all')
	{
		if ($status == 'all') {
			return $this->get_results("
				SELECT p.*, c.title AS category 
				FROM `product` AS p 
				INNER JOIN `category` AS c ON p.category_id = c.category_id 
				ORDER BY p.product_id DESC;
			");
		}
		else{
			return $this->get_results("
				SELECT p.*, c.title AS category 
				FROM `product` AS p 
				INNER JOIN `category` AS c ON p.category_id = c.category_id 
				WHERE p.status = '$status' 
				ORDER BY p.product_id DESC;
			");
		}
	}
	public function get_product_byid($id)
	{
		return $this->get_row("SELECT * FROM `product` WHERE `product_id` = '$id';");
	}
	public function get_product_byslug($slug)
	{
		return $this->get_row("SELECT * FROM `product` WHERE `slug` = '$slug';");
	}
	public function get_product($id)
	{
		return $this->get_row("
			SELECT p.*, c.title AS category, c.slug AS categorySlug 
			FROM `product` AS p 
			INNER JOIN `category` AS c ON p.category_id = c.category_id 
			WHERE p.product_id = '$id' 
		");
	}
	public function get_orders_by_patient_id($patient_id)
	{
		return $this->get_results("
			SELECT o.*, c.name AS cityName, s.name AS stateName 
			FROM `order` AS o 
			LEFT JOIN `state` AS s ON o.state_id = s.state_id 
			LEFT JOIN `city` AS c ON o.city_id = c.city_id 
			WHERE `patient_id` = '$patient_id' 
			ORDER BY `order_id` DESC
		;");
	}
	public function orders($status)
	{
		$where = '';
		if ($status != 'all') {
			$where = "WHERE `status` = '".$status."'";
		}
		return $this->get_results("
			SELECT o.*, c.name AS cityName, s.name AS stateName 
			FROM `order` AS o 
			LEFT JOIN `state` AS s ON o.state_id = s.state_id 
			LEFT JOIN `city` AS c ON o.city_id = c.city_id 
			$where 
			ORDER BY `order_id` DESC
		;");
	}
}