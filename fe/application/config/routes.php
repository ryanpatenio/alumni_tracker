<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['dashboard'] = 'dashboard';
$route['students'] = 'studentController';
$route['professor'] = 'professorController';
$route['batch'] = 'BatchController';
$route['courses'] = 'CourseController';
$route['adv-records'] = 'AdvisoryRecordsController';
$route['sections'] = 'SectionController';
$route['product'] = 'productController';

$route['default_controller'] = 'authController';
$route['logout'] = 'authController/logout';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
