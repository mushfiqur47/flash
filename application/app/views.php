<?php
defined('BASEPATH') OR exit('No direct access allowed');
//include models files to use model
require_once('models.php');

//Create your views here.

class app_view extends Views{

  function __construct() {
    parent::__construct();
  }

  //home view
  function home() {
    //render home template
    return $this->render("home");
  }

  //custom 404 error handler view
  function page_not_found($request) {
    return $this->response("404 Page Not Found", 404);
  }
}
