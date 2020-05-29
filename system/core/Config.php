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
* Configuration
* Configuration file store all the system configuration and settings.
* It will configure and validate all the application settings, urlpatterns and errorhandler.
*
* @package : Configuration
* @category : System
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*
* (Note : Do not change the configuration)
*/

class Config{
  /**
  * System settings
  * All system settings variable, it include all the application settings.
  */
  public $setting;

  /*
  * System Libraries
  * System libraries variable, it include an array of all the system libraries that user want to install.
  */
  public $install;

  /*
  * User Libraries
  * User libraries variable, it include an array of all the user defined libraries that user want to install.
  */
  public $library;

  /*
  * User Services
  * User Services variable, it include an array of all the user defined services that user want to install.
  */
  public $service;

  /*
  * Template
  * Template variable, it include an array of application templates directory.
  */
  public $template;

  //Initialize all configuration variable.
  function __construct() {
    global $setting, $template, $install, $library, $service;

    //Get all application settings.
    $this->setting=$setting;

    //Parse install array.
    $this->parse_install($install);

    //Parse libraries array.
    $this->parse_library($library);

    //Parse services array.
    $this->parse_service($service);

    //Get application template directory.
    if(is_array($template)) {
      $this->template=$template;
    } else {
      $this->template=array($template);
    }
  }

  /**
  * Parse install array
  * This function configure and parse system library array.
  */
  private function parse_install($install) {
    if(is_array($install)) {
      if(empty($install)) {
        $this->install=array();
      } else {
        foreach($install as $lib => $obj) {
          //Check if library has object name
          if(!is_int($lib)) {
            list($system,$library)=explode('.',$lib);
            //Checking for valid library
            if(strtolower($system)==='system') {
              $this->install[$obj]=strtolower($library);
            } else {
              exit("'$library' : invalid system library or application");
            }
          } else {
            list($system,$library)=explode('.',$obj);
            //Checking for valid library
            if(strtolower($system)==='system') {
              $this->install[$library]=strtolower($library);
            } else {
              exit("'$library' : invalid system library or application");
            }
          }
        }
      }
    } else {
      exit("'install' : invalid array");
    }
  }

  /**
  * Parse users library array
  * This function configure and parse users library array.
  */
  private function parse_library($library) {
    if(is_array($library)) {
      if(empty($library)) {
        $this->library=array();
      } else {
        foreach($library as $lib_path => $obj) {
          //Check if library has object name
          if(!is_int($lib_path)) {
            //Users library name
            $name=basename($lib_path);
            //Users library path
            $path=trim($lib_path,'/');
            $this->library["$path.php"]['path']="$path.php";
            $this->library["$path.php"]['class']=$name;
            $this->library["$path.php"]['object']=$obj;
          } else {
            //Users library name
            $name=basename($obj);
            //Users library path
            $path=trim($obj,'/');
            $this->library["$path.php"]['path']="$path.php";
            $this->library["$path.php"]['class']=$name;
            $this->library["$path.php"]['object']=$name;
          }
        }
      }
    } else {
      exit("'library' : invalid array");
    }
  }

  /**
  * Parse users service array
  * This function configure and parse users service array.
  */
  private function parse_service($service) {
    if(is_array($service)) {
      if(empty($service)) {
        $this->service=array();
      } else {
        foreach($service as $service_path => $obj) {
          //Check if service has object name
          if(!is_int($service_path)) {
            //Users service name
            $name=basename($service_path);
            //Users service path
            $path=trim($service_path,'/');
            $this->service["$path.php"]['path']="$path.php";
            $this->service["$path.php"]['class']=$name;
            $this->service["$path.php"]['object']=$obj;
          } else {
            //Users service name
            $name=basename($obj);
            //Users service path
            $path=trim($obj,'/');
            $this->service["$path.php"]['path']="$path.php";
            $this->service["$path.php"]['class']=$name;
            $this->service["$path.php"]['object']=$name;
          }
        }
      }
    } else {
      exit("'service' : invalid array");
    }
  }
}
