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
* Views Controller
* Views controller is system default controller, this controller handle application views.
* Views controller load the user defined services and libraries, render HTML templates.
*
* @package : Views Controller
* @category : System
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class Views{
  //Configuration object
  private $config;
  //URI library object
  public $uri;
  //Input library object
  public $get;
  public $post;
  public $put;
  public $delete;
  public $patch;
  public $head;
  public $options;
  public $connect;
  public $trace;
  public $copy;
  public $link;
  public $unlink;
  public $lock;
  public $unlock;
  public $purge;
  public $propfind;
  public $view;
  public $files;
  public $session;
  public $cookie;
  //Site base URL.
  public $base_url;
  //Static directory path.
  public $static;
  //Media directory path.
  public $media;

  //Initialize all objects.
  function __init() {
    //Initialize Configuration object.
    $this->config=new Config();

    /**
    * URI Library
    * Initialize object of system URI library.
    */
    $this->uri=new URI();
    //Get site base url.
    $this->base_url=$this->uri->base_url();
    //Get site static directory path.
    $this->static=$this->uri->static();
    //Get site media directory path.
    $this->media=$this->uri->media();

    /**
    * Input Library
    * Initialize all objects of system input library.
    */
    $this->get=new get_request_data();
    $this->post=new post_request_data();
    $this->put=new put_request_data();
    $this->delete=new delete_request_data();
    $this->patch=new patch_request_data();
    $this->head=new head_request_data();
    $this->options=new options_request_data();
    $this->connect=new connect_request_data();
    $this->trace=new trace_request_data();
    $this->copy=new copy_request_data();
    $this->link=new link_request_data();
    $this->unlink=new unlink_request_data();
    $this->lock=new lock_request_data();
    $this->unlock=new unlock_request_data();
    $this->purge=new purge_request_data();
    $this->propfind=new propfind_request_data();
    $this->view=new view_request_data();
    $this->files=new files_request_data();
    $this->session=new session_data();
    $this->cookie=new cookie_data();

    /**
    * Load system libraries.
    * Load all system libraries in web application.
    */
    foreach($this->config->install as $object => $library) {
      //Check library exists or not
      if(file_exists(trim(SYS_DIR,'/').'/libraries/'.$library.'.php')) {
        require_once(trim(SYS_DIR,'/').'/libraries/'.$library.'.php');
        if(class_exists($library)) {
          $this->$object=new $library();
        } else {
           exit("'$library' : library or application not found");
        }
      } else {
        exit("'$object' : library or application not found");
      }
    }

    /**
    * Load user libraries
    * Load all user defined libraries in web application.
    */
    foreach($this->config->library as $library) {
      $path=$library['path'];
      $class=$library['class'];
      $object=$library['object'];
      //Check library exists or not
      if(file_exists($path)) {
        require_once($path);
        if(class_exists($class)) {
          $this->$object=new $class();
        } else {
          exit("'$class' : library class not found");
        }
      } else {
        exit("'$path' : library file not found");
      }
    }

    /**
    * Load user services.
    * Load all user defined services in web application.
    */
    foreach($this->config->service as $service) {
      $path=$service['path'];
      //Check service exists or not
      if(file_exists($path)) {
        require_once($path);
      } else {
        exit("'$path' : service file not found");
      }
    }
  }

  /**
  * Response Header
  * Set HTTP Response header.
  */
  protected function response_header(string $header, bool $replace=TRUE, int $http_response_code=NULL) {
    //Set HTTP header
    if($http_response_code) {
      header($header,$replace,$http_response_code);
    } else {
      header($header, $replace);
    }
  }

  /**
  * Response Code
  * Set HTTP response status code.
  */
  protected function response_code(int $response_code) {
    //Set HTTP Response code
    http_response_code($response_code);
  }

  /**
  * Redirect URLs
  * Redirect users to another page.
  */
  protected function redirect(string $url=NULL,string $method=NULL, $response_code=NULL) {
    //Set HTTP response code
    if($response_code) {
      http_response_code($response_code);
    }
    //IIS environment use 'refresh' for better compatibility
    if($method && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
      $method = 'refresh';
    }
    //Redirect URLs
    if($url && $method) {
      if(strtolower($method)==='refresh') {
        header("Refresh: 0; url=$url");
      }
    } else {
      header("Location: $url");
    }
  }

  /**
  * Response
  * Render string data with HTTP Response status code.
  */
  protected function response($string=NULL, int $response_code=NULL) {
    if(!empty($response_code) && is_int($response_code)) {
      //HTTP Response code
      http_response_code($response_code);
    }
    //Render string data.
    if($string) {
      //Check string data type.
      if(is_array($string)) {
        print_r($string);
      } else {
        echo $string;
      }
    }
  }
  
  /**
  * Json Data
  * Check Data is valid json format or not.
  */
  protected function is_json($data) {
    return is_array($data) ? false : is_array(json_decode($str,true));
  }
  
  /**
  * Response
  * Render json data with HTTP Response status code.
  */
  protected function response_json($data=NULL, int $response_code=NULL) {
    //Set header content type for json response.
    header('Content-type: application/json');
    if(!empty($response_code) && is_int($response_code)) {
      //HTTP Response code
      http_response_code($response_code);
    }
    //Render json data.
    if($data) {
      //Check string data type.
      if(is_array($data)) {
        echo json_encode($data);
      } else if($this->is_json($data)){
        echo $data;
      } else {
        echo json_encode(array($data));
      }
    }
  }

  /**
  * Render templates
  * Render the HTML templates.
  */
  protected function render(string $template, array $user_variable=NULL){
    //Set variables of array.
    if(is_array($user_variable)) {
      foreach($user_variable as $variable => $value) {
        ${$variable}=$value;
      }
    }

    //Check template exists or not.
    foreach($this->config->template as $template_dir) {
      //Get template directory path
      $templates=trim($template_dir,'/');
      //Get template path.
      if(file_exists($templates.'/'.$template)) {
        $template_path=$templates.'/'.$template;
      } else if(file_exists($templates.'/'.$template.'.php')) {
        $template_path=$templates.'/'.$template.'.php';
      } else if(file_exists($templates.'/'.$template.'.html')) {
        $template_path=$templates.'/'.$template.'.html';
      }
    }

    //Render html templates.
    if($template_path) {
      return require_once($template_path);
    } else {
      exit("'$template' : template not exists");
    }
  }
}
