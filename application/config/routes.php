<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']['post'] = 'Logincontroller/login';
$route['datauser']['get'] = 'Usercontroller/datauser';