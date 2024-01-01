<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


if($_SERVER['SERVER_NAME'] == 'localhost')
{
	define('BASEURL', 'http://localhost/MM/doctor_app/');
}
else
{
	define('BASEURL', 'https://advicedrs.com/');
}

define('APP_TITLE', 'ADVICEDRS');

define('PLUGINS', BASEURL.'asset/plugins/');
define('ASSET', BASEURL.'asset/');
define('CSS', BASEURL.'asset/css/');
define('JS', BASEURL.'asset/js/');
define('IMG', BASEURL.'asset/images/');
define('UPLOADS', BASEURL.'uploads/');
define('GLOBAL_', BASEURL.'asset/global/');

define('CURRENCY', 'PKR ');

define('EMAIL_TITLE', 'InsertReveiw');
define('EMAIL_SERVER', 'mail.smartcompare.pk');
define('EMAIL_FROM', 'info@smartcompare.pk');
define('EMAIL_PASSWORD', '48@){@g%CUIa');

function redirect($link) {
	header("location:".BASEURL . trim($link));
	die();
}
function clean_url($url) {
	$url = preg_replace("(^https?://)", "", $url );
	$url = preg_replace("(^www?.)", "", $url );
	return $url;
}
function trim_phone($phone) {
	$phone = ltrim($phone, "0");
	$phone = ltrim($phone, "92");
	$phone = ltrim($phone, "+");
	return $phone;
}

function get_time_difference_php($created_time)
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
        return intval($time_differnce/$years)."y";
    }else if(intval($time_differnce/$years) > 0)
    {
        return intval($time_differnce/$years)."y";
    }else if(intval($time_differnce/$months) > 1)
    {
        return intval($time_differnce/$months)."mon";
    }else if(intval(($time_differnce/$months)) > 0)
    {
        return intval(($time_differnce/$months))."mon";
    }else if(intval(($time_differnce/$days)) > 1)
    {
        return intval(($time_differnce/$days))."d";
    }else if (intval(($time_differnce/$days)) > 0) 
    {
        return intval(($time_differnce/$days))."d";
    }else if (intval(($time_differnce/$hours)) > 1) 
    {
        return intval(($time_differnce/$hours))."h";
    }else if (intval(($time_differnce/$hours)) > 0) 
    {
        return intval(($time_differnce/$hours))."h";
    }else if (intval(($time_differnce/$minutes)) > 1) 
    {
        return intval(($time_differnce/$minutes))."min";
    }else if (intval(($time_differnce/$minutes)) > 0) 
    {
        return intval(($time_differnce/$minutes))."min";
    }else if (intval(($time_differnce)) > 1) 
    {
        return intval(($time_differnce))." s";
    }else
    {
        // return "few seconds ago";
        return "now";
    }
}