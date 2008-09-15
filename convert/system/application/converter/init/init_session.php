<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! class_exists('Session'))
{
     require_once(APPPATH.'libraries/session'.EXT);
}

$obj =& get_instance();
$obj->session = new Session();
$obj->ci_is_loaded[] = 'session';

?>
