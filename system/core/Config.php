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

  /*
  * Database
  * Database variable, it include application database settings array.
  */
  public $database;

  /*
  * URLPatterns
  * URLPatterns variable, it include an array of urlpatterns.
  */
  public $urlpatterns;

  /*
  * ErrorHandler
  * ErrorHandler variable, it include an array of all user defined errorhandler.
  */
  public $errorhandler;

  /*
  * Request Path
  * Request Path variable, it store server's current request url (path).
  */
  public $request_path;

  //Initialize all configuration variable.
  function __construct() {
    global $setting,$template,$install,$library,$service,$urlpatterns,$errorhandler;

    //Set urlpatterns default data type.
    if(!is_array($urlpatterns)) {
      $urlpatterns=array();
    }

    //Set errorhandler default data type.
    if(!is_array($errorhandler)) {
      $errorhandler=array();
    }

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

    //Get application database settings.
    if(empty($db)) {
      $this->database=array();
    } else {
      $this->database=$db;
    }

    //Get server request path.
    if(isset($_SERVER['PATH_INFO'])) {
      $this->request_path=$_SERVER['PATH_INFO'];
    } else {
      $this->request_path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    //Get errorhandler data.
    $this->errorhandler=$this->parse_error($errorhandler,$this->request_path);

    //Get urlpatterns data.
    $urls=$this->urlparser($urlpatterns, $this->request_path);
    if(isset($setting['static_dir'])) {
      $static_urls=$this->static_url_parser($setting['static_dir'], $this->request_path);
    } else {
      $static_urls=array();
    }
    $this->urlpatterns=array_unique(array_merge($urls, $static_urls), SORT_REGULAR);

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
            list($system,$library) = explode('.',$lib);
            //Checking for valid library
            if(strtolower($system) === 'system') {
              $this->install[$obj]=strtolower($library);
            } else {
              exit("'$library' : invalid system library or application");
            }
          } else {
            list($system,$library) = explode('.',$obj);
            //Checking for valid library
            if(strtolower($system) === 'system') {
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


  /**
  * Get Mime Type
  * get files mime type.
  */
  function get_mime_type(string $file) {
    //mime types
    $mime_types = array(
      'txt' => 'text/plain',
      'htm' => 'text/html',
      'html' => 'text/html',
      'php' => 'text/html',
      'css' => 'text/css',
      'js' => 'application/javascript',
      'json' => 'application/json',
      'xml' => 'application/xml',
      'swf' => 'application/x-shockwave-flash',
      'flv' => 'video/x-flv',

       //images
      'png' => 'image/png',
      'jpe' => 'image/jpeg',
      'jpeg' => 'image/jpeg',
      'jpg' => 'image/jpeg',
      'gif' => 'image/gif',
      'bmp' => 'image/bmp',
      'ico' => 'image/vnd.microsoft.icon',
      'tiff' => 'image/tiff',
      'tif' => 'image/tiff',
      'svg' => 'image/svg+xml',
      'svgz' => 'image/svg+xml',

      //archives
      'zip' => 'application/zip',
      'rar' => 'application/x-rar-compressed',
      'exe' => 'application/x-msdownload',
      'msi' => 'application/x-msdownload',
      'cab' => 'application/vnd.ms-cab-compressed',

      //audio/video
      'mp3' => 'audio/mpeg',
      'qt' => 'video/quicktime',
      'mov' => 'video/quicktime',

      //adobe
      'pdf' => 'application/pdf',
      'psd' => 'image/vnd.adobe.photoshop',
      'ai' => 'application/postscript',
      'eps' => 'application/postscript',
      'ps' => 'application/postscript',

      //ms office
      'doc' => 'application/msword',
      'rtf' => 'application/rtf',
      'xls' => 'application/vnd.ms-excel',
      'ppt' => 'application/vnd.ms-powerpoint',
      'docx' => 'application/msword',
      'xlsx' => 'application/vnd.ms-excel',
      'pptx' => 'application/vnd.ms-powerpoint',

      //open office
      'odt' => 'application/vnd.oasis.opendocument.text',
      'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    $extension = strtolower(end(explode('.', $file)));
    if(isset($mime_types[$extension])) {
     return $mime_types[$extension];
    } else {
     return mime_content_type($file);
    }
  }


  /**
  * Parse Static URL
  * This function configure and parse application static files URLs.
  */
  function static_url_parser(string $static_dir, string $request_path) : array {
    //Static dir path
    $static_dir = BASEPATH.'/'.trim($static_dir, '/');
    //Static URLs array
    $static_urls = array();
    //check static dir exists or not
    if(is_dir($static_dir)) {
      if(isset($this->setting['static_url'])) {
        $static_url = rtrim($this->setting['static_url'], '/').'/(.*)';

       //Convert wildcard patterns to RegEx
       $regex=str_replace(array('{slug}'), array('([^/]+)'), $static_url);

        //URLs route
        $route=$regex;

        //Match RegEx patterns
        if(preg_match('#^'.$regex.'$#', $request_path, $matches)) {
          $route = $matches[0];
          //Remove first data from array
          array_shift($matches);
          //Add pathVariables Data
          $file_path=$static_dir.'/'.trim($matches[0], '/');
        } else {
          //Null pathVariables
          $file_path=null;
        }
        if(is_file($file_path)) {
          $static_urls[$route]['url'] = $route;
          $static_urls[$route]['file_path'] = $file_path;
          $static_urls[$route]['mime_type'] = $this->get_mime_type($file_path);
        }
      }
    }
    return $static_urls;
  }


  /**
  * Parse urlpatterns
  * This function configure and parse application urlpatterns array.
  */
  protected function urlparser(array $urlpatterns, string $request_path) : array {

    //urlpatterns array
    $urls=array();

    //Parse urlpatterns array
    foreach($urlpatterns as $url => $views) {

      //Ignore trailing slashes
      if($this->setting['ingore_slash']===true) {
        $url=rtrim($url,'/');
      }

     //Convert wildcard patterns to RegEx
     $regex=str_replace(array('{slug}'), array('([^/]+)'), $url);

      //URLs route
      $route=$regex;

      //check urlpatterns have another urls array
      if(!is_array($views)) {

        //get views class name and method name
        list($class,$view)=explode('.',$views);

        //Match RegEx patterns
        if(preg_match('#^'.$regex.'$#', $request_path, $matches)) {

          //Matched URLs route
          $route=$matches[0];

          //Remove first data from array
          array_shift($matches);

          //Add pathVariables
          $data=$matches;

        } else {
          //Null pathVariables
          $data=array();
        }

        //Add URLs data
        $urls[$route]['url']=$route;
        $urls[$route]['views']=array('class'=>$class, 'method'=>$view);
        $urls[$route]['data']=$data;

      //if urlpatterns have another urls array
      } else {

        //Parse urlpatterns
        foreach($views as $child_url => $child_view) {

          //merge child urls with parent url
          if(strlen($child_url)>0) {
            //URLs route
            $url=rtrim($route,'/').'/'.ltrim($child_url,'/');
          } else {
            //URLs route
            $url=$child_url;
          }

          //Ignore trailing slashes
          if($this->setting['ingore_slash']==true) {
            $url=rtrim($url,'/');
          }

          //Convert wildcard patterns to RegEx
          $regex=str_replace(array('{slug}'), array('([^/]+)'), $url);

           //URLs route
          $child_route=$regex;

          //check view is array or not
          if(!is_array($child_view)) {

            //get views class name and method name
            list($class,$view)=explode('.',$child_view);

            //Match RegEx patterns
            if(preg_match('#^'.$regex.'$#', $request_path, $matches)) {

              //Matched URLs route
              $child_route=$matches[0];

              //Remove first data from array
              array_shift($matches);

              //Add pathVariables
              $data=$matches;

            } else {
              //Null pathVaraiables
              $data=array();
            }
            //Add URLs data
            $urls[$child_route]['url']=$child_route;
            $urls[$child_route]['views']=array('class'=>$class, 'method'=>$view);
             $urls[$child_route]['data']=$data;

           } else {
            //Invalid urlpatterns
            exit("invalid urlpatterns");
          }
        }
      }
    }
    //return urlpatterns
    return $urls;
  }


  /**
  * Parse ErrorHandler
  * This function configure and parse users custom errorhandler array.
  */
  protected function parse_error(array $errorhandler, string $request_path) : array {
    //ErrorHandler array
    $errors=array();
    //Parse errorhandler array
    foreach($errorhandler as $error => $handler) {
      //Ignore trailing slashes
      $error=trim($error,'/');
      //Check handler is array or not
      if(!is_array($handler)) {
        //Get views class name and method name
        list($class,$view)=explode('.',$handler);
        $errors[$error]['error']=$error;
        $errors[$error]['views']=array('class'=>$class,'method'=>$view);
        $errors[$error]['request']=$request_path;
      } else {
        exit("invalid errorhandler");
      }
    }
    return $errors;
  }
}