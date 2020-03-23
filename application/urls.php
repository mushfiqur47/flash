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
* Include App URLs :
*     '/blog' => urls('./application/blog/urls.php'),
*
* Create URLs and route to your views.
*/

$urlpatterns = [
  '/' => urls('application/app/urls.php'),
];

/**
* ErrorHandler
*
* Handle Errors like 404 (page not found), 500 (Internal Server Error), etc.
* Create you custom error handler to handle any server errors.
* Example :
*    1. create your handler view.
*        function page_not_found($request) {
*          return $this->response('404 Page Not Found', 404);
*        }
*    2. include your views to urls file.
*    3. Map your handler with errorhandler array.
*        $errorhandler = [
*            '404' => 'view_name.page_not_found',
*        ];
* it will redirect all 404 errors to your page_not_found view.
* Note : The ErrorHandler array, it must be in the main urls file only.
*
* Create your custom ErrorHandler.
*/

$errorhandler = [
  '404' => 'app_view.page_not_found',
];
