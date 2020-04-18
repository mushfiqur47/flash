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
* Request Library
* Request Library store all the server request data.
*
* @package : Request Library
* @category : Library
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class request{
  //Request Header Information
  public $scheme;
  public $method;
  public $protocol;
  public $accept;
  public $language;
  public $encoding;
  public $connection;
  public $content_type;
  public $content_length;
  public $user_agent;
  public $referer;
  public $headers;

  //Request Body Information
  public $body;
  
  //Server Information
  public $hostname;
  public $host;
  public $port;

  //Path Information
  public $uri;
  public $url;
  public $path;
  public $path_info;
  public $request_uri;

  //Request Information
  public $is_secure;
  public $is_ajax;
  public $is_get;
  public $is_post;
  public $is_put;
  public $is_delete;
  public $is_patch;
  public $is_head;
  public $is_options;
  public $is_connect;
  public $is_trace;
  public $is_copy;
  public $is_link;
  public $is_unlink;
  public $is_lock;
  public $is_unlock;
  public $is_purge;
  public $is_propfind;
  public $is_view;
  public $is_http;
  public $is_https;

  //User Information
  public $remote_addr;
  public $is_redirected;

  function __construct() {
    /**
    * Request Header Information
    * Get Request header information.
    */
    //Get scheme of request (https or http)
    $this->scheme=(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1)) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || (isset($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS'])!== 'off') ? 'https' : 'http';
    //Get request method get, post, put, delete
    $this->method=strtoupper($_SERVER['REQUEST_METHOD']);
    //Get server protocol
    $this->protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;
    //Get http_accept
    $this->accept=isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : FALSE;
    //Get accept language
    $this->language=isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : FALSE;
    //Get connection
    $this->connection=isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] : FALSE;
    //Get http encoding
    $this->encoding=isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : FALSE;
    //Get content type, request MIME type from header
    $this->content_type=isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : isset($_SERVER['HTTP_CONTENT_TYPE']) ? $_SERVER['HTTP_CONTENT_TYPE'] : FALSE;
    //Get content length
    $this->content_length=isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : isset($_SERVER['HTTP_CONTENT_LENGTH']) ? $_SERVER['HTTP_CONTENT_LENGTH'] : FALSE;
    //Get user agent
    $this->user_agent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : FALSE;
    //Get http referer
    $this->referer=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : FALSE;
    //Header information array
    $this->headers=getallheaders();


    /**
    * Request Body
    * Get Request body information.
    */
    $this->body=file_get_contents('php://input');


    /**
    * Server Information
    * Get web server information.
    */
    //Get hostname
    $this->hostname=isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : FALSE;
    //Get host
    $this->host=isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : FALSE;
    //Get port
    $this->port=isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : FALSE;


    /**
    * Path Information
    * Get all urls and path information.
    */
    //Get Request URI
    $this->uri=$_SERVER['REQUEST_URI'];
    //Get Request URI
    $this->request_uri=$_SERVER['REQUEST_URI'];
    //Get site full url
    $this->url=$this->scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    //Get request path without query string.
    $this->path=isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //Get request path including query string.
    $this->path_info=$_SERVER['REQUEST_URI'];


    /**
    * Request Information
    * Get all Http request information.
    */
    //Check connection is secure
    $this->is_secure=(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1)) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || (isset($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS'])!== 'off') ? TRUE : FALSE;
    //Check request made with ajax
    $this->is_ajax=isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' ? TRUE : FALSE;
    //Check request method is get or not
    $this->is_get=$this->method==='GET' ? TRUE : FALSE;
    //Check request method is post or not
    $this->is_post=$this->method==='POST' ? TRUE : FALSE;
    //Check request method is put or not
    $this->is_put=$this->method==='PUT' ? TRUE : FALSE;
    //Check request method is delete or not
    $this->is_delete=$this->method==='DELETE' ? TRUE : FALSE;
    //Check request method is patch or not
    $this->is_patch=$this->method === 'PATCH' ? TRUE : FALSE;
    //Check request method is head or not
    $this->is_head=$this->method === 'HEAD' ? TRUE : FALSE;
    //Check request method is options or not
    $this->is_options=$this->method==='OPTIONS' ? TRUE : FALSE;
    //Check request method is connect or not
    $this->is_connect=$this->method==='CONNECT' ? TRUE : FALSE;
    //Check request method is trace or not
    $this->is_trace=$this->method==='TRACE' ? TRUE : FALSE;
    //Check request method is copy or not
    $this->is_copy=$this->method==='COPY' ? TRUE : FALSE;
    //Check request method is link or not
    $this->is_link=$this->method==='LINK' ? TRUE : FALSE;
    //Check request method is unlink or not
    $this->is_unlink=$this->method==='UNLINK' ? TRUE : FALSE;
    //Check request method is lock or not
    $this->is_lock=$this->method==='LOCK' ? TRUE : FALSE;
    //Check request method is unlock or not
    $this->is_unlock=$this->method==='UNLOCK' ? TRUE : FALSE;
    //Check request method is purge or not
    $this->is_purge=$this->method==='PURGE' ? TRUE : FALSE;
    //Check request method is propfind or not
    $this->is_propfind=$this->method==='PROPFIND' ? TRUE : FALSE;
    //Check request method is view or not
    $this->is_view=$this->method==='VIEW' ? TRUE : FALSE;
    //Check protocol https or not
    $this->is_http=$this->scheme==='http' ? TRUE : FALSE;
    //Check protocol is http or not
    $this->is_https=$this->scheme==='https' ? TRUE : FALSE;


    /**
    * User Information
    * Get User web browser information.
    */
    //Get remote ip address
    $this->remote_addr=isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : FALSE;
    //Check request is redirected from some whare.
    $this->is_redirected=isset($_SERVER['HTTP_REFERER']) ? TRUE : FALSE;

  }

  //Get server all informarion.
  public function server($server_index) {
    $server_index=strtoupper($server_index);
    return $_SERVER[$server_index];
  }
}
