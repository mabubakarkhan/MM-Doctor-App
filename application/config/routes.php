<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['translate_uri_dashes'] = TRUE;
$route['default_controller'] = "home";
$controller_exceptions = array('admin','doctor','patient','StripeController');
$route['404_override'] = '';


$route["index"] = 'Home/index';
$route["doctor-profile/(.*)"] = 'Home/doctor/$1';
$route["booking/(.*)"] = 'Home/booking/$1';
$route["checkout/(.*)"] = 'Home/checkout/$1';
$route["submit-checkout"] = 'Home/submit_checkout';


$route["logout"] = 'Home/logout';
$route["patient/logout"] = 'Home/logout';
$route["doctor/logout"] = 'Home/logout';
$route["patient/get-city-by-state-ajax"] = 'Home/get_city_by_state_ajax';
$route["doctor/get-city-by-state-ajax"] = 'Home/get_city_by_state_ajax';


//patient
$route["login"] = 'Home/login';
$route["register"] = 'Home/register';
$route["post-login-patient"] = 'Home/post_login_patient';
$route["register-patient"] = 'Home/register_patient';
$route["post-register-patient"] = 'Home/post_register_patient';
$route["get-appointment-info"] = 'Home/get_appointment_info';

$route["patient/dashboard"] = 'patient/dashboard';
$route["patient/index"] = 'patient/dashboard';
$route["cancel-appointment"] = 'patient/cancel_appointment';

$route["patient/profile-settings"] = 'patient/profile_settings';
$route["patient/change-password"] = 'patient/change_password';
//Doctor
$route["login-doctor"] = 'Home/login_doctor';
$route["post-login-doctor"] = 'Home/post_login_doctor';
$route["register-doctor"] = 'Home/register_doctor';
$route["post-register-doctor"] = 'Home/post_register_doctor';

$route["doctor/dashboard"] = 'doctor/index';

$route["doctor/profile-settings"] = 'doctor/profile_settings';
$route["doctor/social-links"] = 'doctor/social_links';
$route["doctor/change-password"] = 'doctor/change_password';
$route["doctor/update-education"] = 'doctor/update_education';
$route["doctor/update-experience"] = 'doctor/update_experience';
$route["doctor/update-award"] = 'doctor/update_award';
$route["doctor/update-membership"] = 'doctor/update_membership';
$route["doctor/update-registration"] = 'doctor/update_registration';
$route["doctor/add-clinic"] = 'doctor/add_clinic';
$route["doctor/delete-doctor-hospital"] = 'doctor/delete_doctor_hospital';
$route["doctor/update-clinic"] = 'doctor/update_clinic';

$route["doctor/schedule-timings"] = 'doctor/schedule_timings';
$route["doctor/submit-time-slots"] = 'doctor/submit_time_slots';
$route["doctor/submit-time-slots/(.*)"] = 'doctor/submit_time_slots/$1';
$route["doctor/delete-schedule"] = 'doctor/delete_schedule';



// Test matter
$route["test"] = 'Home/test';
$route["test/(.*)"] = 'Home/test/$1';





/* End of file routes.php */
/* Location: ./application/config/routes.php */