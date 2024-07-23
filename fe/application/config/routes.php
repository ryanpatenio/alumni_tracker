<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['dashboard'] = 'dashboard';
$route['product'] = 'productController';

$route['default_controller'] = 'authController';
$route['logout'] = 'authController/logout';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
