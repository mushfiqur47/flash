<?php
defined('BASEPATH') OR exit('No direct access allowed');
/**
* URL Configuration
*
* Include views file to route URLs to the views.
* Examples:
*      1. Include view from current app.
*          require_once('views.php');
*      2. Include view from another app.
*          require_once('./application/app_name/views.php');
*
* The 'urlpatterns' array routes URLs to your views.
* Examples:
* Simple URLs Router
*      1. Add a URL to urlpatterns:  '/' => 'app_view.home',
*  Where the app_view is class name and home is the function name.

* Slug URLs Router
*      1. Add a URL to urlpatterns:  '/name/{slug}' => 'app_view.name',
*      2. Create a class app_view and function name($your_var_name) to access slug data.
*
* Create URLs and route to your views.
*/
//include views to route URLs
require_once('views.php');

$urlpatterns = [
  '/' => 'app_view.home',
];
