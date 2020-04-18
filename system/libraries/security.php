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
* Security Library
* Security Library provide security to the web application.
* This Library provide XSS, CSRF protection.
*
* @package : Security Library
* @category : Library
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class security{
  //Initialize all security variable
  function __construct() {
    //Set csrf_token cookie
    setcookie('csrf_token','',time()+(60*30),'/');
  }

  //Get csrf_token
  public function get_csrf_token() {
    //Generate token
    if(function_exists('random_bytes')) {
      $token=bin2hex(random_bytes(32));
    } else {
      $token=bin2hex(openssl_random_pseudo_bytes(32));
    }
    //Set csrf_token cookie or session
    if(isset($token)) {
      if(isset($_COOKIE['csrf_token'])) {
        $_COOKIE['csrf_token']=$token;
      } else {
        session_start();
        $_SESSION['csrf_token']=$token;
      }
    }
    //Check token is generated or not
    if((isset($_COOKIE['csrf_token']) && isset($token) || isset($_SESSION['csrf_token'])) && isset($token)) {
      return $token;
    } else {
      return FALSE;
    }
  }

  //Generate csrf_token
  public function csrf_token() {
    //Generate token
    if(function_exists('random_bytes')) {
      $token=bin2hex(random_bytes(32));
    } else {
      $token=bin2hex(openssl_random_pseudo_bytes(32));
    }
    //Set csrf_token cookie or session
    if(isset($token)) {
      if(isset($_COOKIE['csrf_token'])) {
        $_COOKIE['csrf_token']=$token;
      } else {
        session_start();
        $_SESSION['csrf_token']=$token;
      }
    }
    //Check token is generated or not
    if((isset($_COOKIE['csrf_token']) && isset($token) || isset($_SESSION['csrf_token'])) && isset($token)) {
      echo '<input type="text" name="csrf_token" value="'.$token.'" hidden>';
    } else {
      return FALSE;
    }
  }

  //Verify csrf_token
  public function csrf_verify(string $csrf_var=NULL) : bool{
    //Check csrf_token variable is set or not
    if(!$csrf_var) {
      $csrf_var='csrf_token';
    }
    //Get request method
    $method=strtoupper($_SERVER['REQUEST_METHOD']);
    //Get csrf_token data
    if(isset($_COOKIE['csrf_token'])) {
      $token=$_COOKIE['csrf_token'];
    } else {
      session_start();
      if(isset($_SESSION['csrf_token'])) {
        $token=$_SESSION['csrf_token'];
      }
    }
    //Get csrf_token from Request
    if($method==='POST' && isset($_POST[$csrf_var])) {
      $token_var=$_POST[$csrf_var];
    } else if($method==='GET' && isset($_GET[$csrf_var])) {
      $token_var=$_GET[$csrf_var];
    } else {
      //Parse any request data
      parse_str(file_get_contents('php://input'),$request_data);
      if(isset($request_data[$csrf_var])) {
        $token_var=$request_data[$csrf_var];
      } else {
        $token_var=NULL;
      }
    }
    //Verify csrf_token
    if(isset($token_var) && isset($token) && hash_equals($token_var,$token)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }


  /**
  * XSS Protection
  * Provide XSS Protection with XSS Clean.
  */
  public function xss_clean(string $xss_string) {
    //Convert all characters to HTML entities
    return htmlentities($xss_string, ENT_QUOTES | ENT_IGNORE);
  }
}
