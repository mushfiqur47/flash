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
* Input Library
* Input library handel GET, POST, PUT and all the request variables.
* Input library is system default libraray, this library handel COOKIES, SESSION and file uplaod.
*
* @package : Input Library
* @category : Library
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

/**
* GET Class
* GET class sotre all the GET request data.
*/
class get_request_data{
  function __construct() {
    if(isset($_GET)) {
      foreach($_GET as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

/**
* POST Class
* POST class sotre all the POST request data.
*/
class post_request_data{
  function __construct() {
    if(isset($_POST)) {
      foreach($_POST as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

/**
* PUT Class
* PUT class sotre all the PUT request data.
*/
class put_request_data{
  function __construct() {
    //Parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //Get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='PUT' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

/**
* DELETE Class
* DELETE class sotre all the DELETE request data.
*/
class delete_request_data{
  function __construct() {
    //Parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //Get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='DELETE' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

/**
* PATCH Class
* PATCH class sotre all the PATCH request data.
*/
class patch_request_data{
  function __construct() {
    //Parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //Get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='PATCH' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All HEAD request data
class head_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='HEAD' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All OPTIONS request data
class options_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='OPTIONS' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All CONNECT request data
class connect_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='CONNECT' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All TRACE request data
class trace_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='TRACE' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All COPY request data
class copy_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='COPY' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All LINK request data
class link_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='LINK' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All UNLINK request data
class unlink_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='UNLINK' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All LOCK request data
class lock_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='LOCK' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All UNLOCK request data
class unlock_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='UNLOCK' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All PURGE request data
class purge_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='PURGE' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All PROPFIND request data
class propfind_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='PROPFIND' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

//All VIEW request data
class view_request_data{
  function __construct() {
    //parse all request data
    parse_str(file_get_contents('php://input'),$request_data);
    //get request method
    $method = strtoupper($_SERVER['REQUEST_METHOD']);
    if($method==='VIEW' && isset($request_data)) {
      foreach($request_data as $var => $val) {
        $this->$var=$val;
      }
    }
  }
}

/**
* FILES
* FILES class store all uploaded files data and upload files on the server.
*/
class files_request_data{
  function __construct() {
    if(isset($_FILES)) {
      foreach($_FILES as $var => $val) {
        $this->$var=$val;
      }
    }
  }
  //Upload files on the server.
  public function upload(string $filename, string $destination) {
    return move_uploaded_file($filename,$destination);
  }
}

/**
* SESSION
* SESSION class store all the SESSION data.
* SESSION class also set, get and delete SESSION data.
*/
class session_data{
  function __construct() {
    //Start session
    session_start();
    if(isset($_SESSION)) {
      foreach($_SESSION as $var => $val) {
        $this->$var=$val;
      }
    }
  }
  //Set session
  public function set($name=NULL,$data=NULL) {
    session_start();
    if($data) {
      return $_SESSION[$name]=$data;
    } else if($name) {
      return $_SESSION[$name];
    }
  }
  //Get session
  public function get($name=NULL) {
    session_start();
    if($name) {
      return $_SESSION[$name];
    } else {
      return $_SESSION;
    }
  }
  //Delete session
  public function delete($name=NULL) {
    session_start();
    if($name) {
      unset($_SESSION[$name]);
    } else {
      return session_destroy();
    }
  }
}

/**
* COOKIE
* COOKIE class store all the cookies data.
* COOKIE class also set, get and delete COOKIE data.
*/
class cookie_data{
  function __construct() {
    if(isset($_COOKIE)) {
      foreach($_COOKIE as $var => $val) {
        $this->$var=$val;
      }
    }
  }
  //Set cookies
  public function set(string $name,string $value='',int $expire=0,string $path='/',string $domain='',bool $secure=FALSE, bool $httponly=FALSE) {
    if($value) {
      //Set cookie
      setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    } else {
      if($_COOKIE[$name]) {
        return $_COOKIE[$name];
      } else {
        return false;
      }
    }
  }
  //Get cookie
  public function get($name=NULL) {
    if($name) {
      return $_COOKIE[$name];
    } else {
      return $_COOKIE;
    }
  }
  //Delete cookie
  public function delete(string $name,string $path='/',string $domain='') {
    setcookie($name, '', -1, $path,$domain);
  }
}
