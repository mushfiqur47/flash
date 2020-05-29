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

  /**
  * System settings
  * All system settings variable, it include all the application settings.
  */
  public $setting;

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

  /*
  * Request Path
  * Request Path variable, it store server's current request url (path).
  */
  protected $request_path;

  //Initialize all the objects.
  function __construct() {
    global $setting, $urlpatterns, $errorhandler;

    //Get all application settings.
    $this->setting=$setting;

    //Set urlpatterns default data type.
    if(!is_array($urlpatterns)) {
      $urlpatterns=array();
    }

    //Set errorhandler default data type.
    if(!is_array($errorhandler)) {
      $errorhandler=array();
    }

    //Get server request path.
    if(isset($_SERVER['PATH_INFO'])) {
      $this->request_path=$_SERVER['PATH_INFO'];
    } else {
      $this->request_path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    //Get urlpatterns data.
    $urls = $this->urlparser($urlpatterns, $this->request_path);
    if(isset($setting['static_dir'])) {
      $static_urls=$this->static_url_parser($setting['static_dir'], $this->request_path);
    } else {
      $static_urls=array();
    }
    //Get all URLs Routes
    $this->routes=array_unique(array_merge($urls, $static_urls), SORT_REGULAR);

    //Get all ErrorHandler
    $this->error_routes=$this->parse_error($errorhandler, $this->request_path);

    //Check for server error
    $this->server_error();
    //Route URLs
    $this->router($this->request_path, $this->routes);
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
    $static_dir=BASEPATH.'/'.trim($static_dir, '/');
    //Static URLs array
    $static_urls=array();
    //check static dir exists or not
    if(is_dir($static_dir)) {
      if(isset($this->setting['static_url'])) {
        $static_url=rtrim($this->setting['static_url'], '/').'/(.*)';

       //Convert wildcard patterns to RegEx
       $regex=str_replace(array('{slug}'), array('([^/]+)'), $static_url);

        //URLs route
        $route=$regex;

        //Match RegEx patterns
        if(preg_match('#^'.$regex.'$#', $request_path, $matches)) {
          $route=$matches[0];
          //Remove first data from array
          array_shift($matches);
          //Add pathVariables Data
          $file_path=$static_dir.'/'.trim($matches[0], '/');
        } else {
          //Null pathVariables
          $file_path=NULL;
        }
        if(is_file($file_path)) {
          $static_urls[$route]['url']=$route;
          $static_urls[$route]['file_path']=$file_path;
          $static_urls[$route]['mime_type']=$this->get_mime_type($file_path);
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
      $this->load_view($this->error_routes[$response_code]['views'], array($this->request_path));
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
  private function router(string $request_path, array $routes) {
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
