<?php
/**
 * Joindin config file
 *
 * @category  Joind.in
 * @package   Configuration
 * @copyright 2009 - 2012 Joind.in
 * @license   http://github.com/joindin/joind.in/blob/master/doc/LICENSE JoindIn
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$relationships = getenv('PLATFORM_RELATIONSHIPS');
if ($relationships) {
    $relationships = json_decode(base64_decode($relationships), true);
}

if (empty($relationships)) {
    throw new \Exception("PLATFORM_RELATIONSHIPS Not Set or empty.");
}

$active_group  = "default";
$active_record = true;
foreach ($relationships as $key => $instance) {
    $db[$key]['hostname'] = $instance['host'];
    $db[$key]['username'] = $instance['username'];
    $db[$key]['password'] = $instance['password'];
    $db[$key]['database'] = $instance['path'];
    $db[$key]['dbdriver'] = $instance['scheme'];
    $db[$key]['dbprefix'] = "";
    $db[$key]['pconnect'] = true;
    $db[$key]['db_debug'] = true;
    $db[$key]['cache_on'] = false;
    $db[$key]['cachedir'] = "";
    $db[$key]['char_set'] = "utf8";
    $db[$key]['dbcollat'] = "utf8_general_ci";
}



/* End of file database.php */
/* Location: ./system/application/config/database.php */
