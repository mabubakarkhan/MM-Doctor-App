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
$route["search"] = 'Home/search';
$route["search-filter"] = 'Home/search_filter';
$route["doctor-profile/(.*)"] = 'Home/doctor/$1';
$route["booking/(.*)"] = 'Home/booking/$1';
$route["booking-filter"] = 'Home/booking_filter';
$route["checkout/(.*)"] = 'Home/checkout/$1';
$route["submit-checkout"] = 'Home/submit_checkout';
$route["make-bookmark"] = 'Home/make_bookmark';


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
$route["patient/cancel-appointment"] = 'patient/cancel_appointment';

$route["patient/profile-settings"] = 'patient/profile_settings';
$route["patient/change-password"] = 'patient/change_password';

$route["patient/medical-records"] = 'patient/medical_records';
$route["patient/search-medical-records"] = 'patient/search_medical_records';
$route["patient/get-medical-records"] = 'patient/get_medical_records';
$route["patient/post-medical-record"] = 'patient/post_medical_record';
$route["patient/remove-record"] = 'patient/remove_record';
$route["patient/invoices"] = 'patient/invoices';

$route["patient/favourites"] = 'patient/favourites';
$route["patient/remove-favourite"] = 'patient/remove_favourite';
$route["patient/reviews"] = 'patient/reviews';
$route["patient/post-review"] = 'patient/post_review';
$route["patient/messages"] = 'patient/messages';
$route["patient/get-chat"] = 'patient/get_chat';
$route["patient/post-message"] = 'patient/post_message';
$route["patient/new-messages-auto"] = 'patient/new_messages_auto';
$route["patient/groups-list-auto"] = 'patient/groups_list_auto';


//Doctor
$route["login-doctor"] = 'Home/login_doctor';
$route["post-login-doctor"] = 'Home/post_login_doctor';
$route["register-doctor"] = 'Home/register_doctor';
$route["post-register-doctor"] = 'Home/post_register_doctor';

$route["doctor/dashboard"] = 'doctor/index';
$route["doctor/cancel-appointment"] = 'doctor/cancel_appointment';

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

$route["doctor/medical-records"] = 'doctor/medical_records';
$route["xml-content/get-appointments-by-patient"] = 'doctor/get_appointments_by_patient';
$route["doctor/get-medical-records"] = 'doctor/get_medical_records';
$route["doctor/post-medical-record"] = 'doctor/post_medical_record';

$route["doctor/my-patients"] = 'doctor/my_patients';
$route["doctor/appointments"] = 'doctor/appointments';
$route["doctor/accounts"] = 'doctor/accounts';
$route["doctor/update-account"] = 'doctor/update_account';
$route["doctor/invoices"] = 'doctor/invoices';
$route["doctor/reviews"] = 'doctor/reviews';

$route["doctor/messages"] = 'doctor/messages';
$route["doctor/get-chat"] = 'doctor/get_chat';
$route["doctor/post-message"] = 'doctor/post_message';
$route["doctor/new-messages-auto"] = 'doctor/new_messages_auto';
$route["doctor/groups-list-auto"] = 'doctor/groups_list_auto';


// Test matter
$route["test"] = 'Home/test';
$route["test/(.*)"] = 'Home/test/$1';





/* End of file routes.php */
/* Location: ./application/config/routes.php */