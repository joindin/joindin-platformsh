<?php
/**
 * Joindin config file
 *
 * @category  Joind.in
 * @package   Configuration
 * @copyright 2009 - 2012 Joind.in
 * @license   http://github.com/joindin/joind.in/blob/master/doc/LICENSE JoindIn
 */

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (isset($_ENV['PLATFORM_RELATIONSHIPS'])) {
    $relationships = json_decode(base64_decode($_ENV['PLATFORM_RELATIONSHIPS']), true);
    if (empty($databases['default']) && ! empty($relationships)) {
        foreach ($relationships as $key => $relationship) {
            $active_group  = "default";
            $active_record = true;

            $db['default']['hostname'] = $instance['host'];
            $db['default']['username'] = $instance['username'];
            $db['default']['password'] = $instance['password'];
            $db['default']['database'] = $instance['path'];
            $db['default']['dbdriver'] = $instance['scheme'];
            $db['default']['dbprefix'] = "";
            $db['default']['pconnect'] = true;
            $db['default']['db_debug'] = true;
            $db['default']['cache_on'] = false;
            $db['default']['cachedir'] = "";
            $db['default']['char_set'] = "utf8";
            $db['default']['dbcollat'] = "utf8_general_ci";
        }
    }
}


/* End of file database.php */
/* Location: ./system/application/config/database.php */
