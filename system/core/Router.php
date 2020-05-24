<?php
/**
* Flash Framework
*
* A high performance, open source web application framework.
*
* @package : Flash Framework
* @author : Rajkumar Dusad
* @copyright : Rajkumar Dusad
* @license : MIT License
* @link : https://github.com/rajkumardusad/flash
*/

defined('BASEPATH') OR exit('No direct access allowed');

/**
* Router
* Router class handles all the URL routes and map user views.
* Router class handles server errors and render user defined custom errorhanlder.
*
* @package : Router
* @category : System
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class Router{
  //Configuration object
  protected $config;

  /**
  * URL Routes
  * This variable store application URLs.
  */
  protected $routes;

  /**
  * ErrorHandler
  * ErrorHandler store user custom errorhandler.
  */
  protected $error_routes;

  //Initialize all the objects.
  function __construct() {
    global $urlpatterns,$errorhandler;
    //Initialize config object
    $this->config=new Config();
    //Get all URLs Routes
    $this->routes=$this->config->urlpatterns;
    //Get all ErrorHandler
    $this->error_routes=$this->config->errorhandler;
    //Check for server error
    $this->server_error();
    //Route URLs
    $this->router($this->config->request_path, $this->routes);
  }

  /**
  * Load Views
  * Load Views load user views
  */
  protected function load_view(array $views, array $pathVariables=NULL) {
    //Check view class exists or not
    if(class_exists($views['class'])) {
      //Create view object
      $this->view=new $views['class'];
      $method=$views['method'];
      //Check in views class method exists or not
      if(method_exists($this->view, $method)) {
        //Initialize view
        $this->view->__init();
        //Call the views method
        $this->view->$method(...$pathVariables);
      } else {
        exit("'$method' : view does not exists");
      }
    } else {
      exit("'".$views['class']."' : views class does not exists");
    }
  }

  /**
  * ErrorHandler
  * ErrorHandler handle server error like 404, 500 and load user's custom errorhandler.
  */
  private function errorhandler() {
    //Get server response status code.
    $response_code=http_response_code();
    //Check user's custom errorhandler
    if(array_key_exists($response_code, $this->error_routes)) {
      $this->load_view($this->error_routes[$response_code]['views'], array($this->config->request_path));
      exit();
    } else {
      //Default status codes
      $status_codes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',

        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',

        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        511 => 'Network Authentication Required',
      );
      //System ErrorHandler
      if(in_array($response_code,array(404)) && array_key_exists($response_code,$status_codes)) {
        exit($response_code.' : '.$status_codes[$response_code]);
      }
    }
  }

  /**
  * Server Error
  * Server Error check for server error, if any error found on the server call the ErrorHandler to handle the errors.
  * Server Error set HTTP Response code.
  */
  private function server_error(int $response_code=NULL) {
    //Set server response code
    if($response_code) {
      http_response_code($response_code);
    }
    //Handle server error
    if(http_response_code()) {
      $this->errorhandler();
    }
  }

  /**
  * Router
  * Router class routes the server request to the application views.
  */
  private function router(string $request_path,array $routes) {
    //Ignore trailing slashes
    if($this->config->setting['ingore_slash']===TRUE){
      $request_path=rtrim($request_path,'/');
    }
    //Match routes and render views
    if(array_key_exists($request_path, $routes)) {
      //Serve static files
      if(array_key_exists('file_path', $routes[$request_path])) {
        header('Content-type: '.$routes[$request_path]['mime_type']);
        readfile($routes[$request_path]['file_path']);
      } else {
        //render views
        $this->load_view($routes[$request_path]['views'], $routes[$request_path]['data']);
      }
    } else {
      //Page not found
      $this->server_error(404);
    }
    //Check server error
    $this->server_error();
  }
}
