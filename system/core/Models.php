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
* Models
* Model Class is handle all the database settings and database transactions.
*
* @package : Model
* @category : System
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class Models{
  //Database connection settings
  private $db_setting;
  function __construct() {
    global $db, $connect;
    if(is_array($db) && is_array($connect)) {
      $this->db_setting=$this->parse_db($db, $connect);
    } else {
      $this->db_setting=$this->parse_db(array($db), array($connect));
    }
    //Initialize database connection
    if($connect) {
      if(is_array($connect)) {
        $this->load_driver($this->db_setting, $connect);
      } else {
        $this->load_driver($this->db_setting, array($connect));
      }
    }
  }

  /**
  * Load Driver
  * Load database driver.
  */
  private function load_driver(array $db=array(), array $connect=array()) {
    //Check db driver exists or not
    foreach($connect as $name) {
      $driver_name=strtolower($db[$name]['driver']);
      if(file_exists(trim(SYS_DIR,'/').'/database/'.$driver_name.'_driver.php')) {
        require_once(trim(SYS_DIR,'/').'/database/'.$driver_name.'_driver.php');
        $driver=$driver_name.'_db_driver';
        if(class_exists($driver)) {
          $this->$name=new $driver($db, $name);
        } else {
           exit("'".$db[$name]['driver']."' : Database driver not found");
        }
      } else {
        exit("'".$db[$name]['driver']."' : Database driver not found");
      }
    }
  }

  /**
  * Connect
  * Initialize database connection manually.
  */
  public function connect(string $dbname) {
    $this->load_driver($this->db_setting, array($dbname));
  }

  /**
  * Parse DB
  * Parse database connection settings.
  */
  public function parse_db(array $db, array $connect) : array{
    //Set db_config default data type.
    $db_config=array();
    foreach($connect as $name) {
      if($db[$name]['dsn']==NULL) {
        $db_config[$name]['dsn']=NULL;
      } else {
        $db_config[$name]['dsn']=$db[$name]['dsn'];
      }
      if($db[$name]['hostname']==NULL) {
        $db_config[$name]['hostname']=NULL;
      } else {
        $db_config[$name]['hostname']=$db[$name]['hostname'];
      }
      if($db[$name]['port']==NULL) {
        $db_config[$name]['port']=NULL;
      } else {
        $db_config[$name]['port']=$db[$name]['port'];
      }
      if($db[$name]['username']==NULL) {
        $db_config[$name]['username']=NULL;
      } else {
        $db_config[$name]['username']=$db[$name]['username'];
      }
      if($db[$name]['password']==NULL) {
        $db_config[$name]['password']=NULL;
      } else {
        $db_config[$name]['password']=$db[$name]['password'];
      }
      if($db[$name]['database']==NULL) {
        $db_config[$name]['database']=NULL;
      } else {
        $db_config[$name]['database']=$db[$name]['database'];
      }
      if($db[$name]['driver']==NULL) {
        $db_config[$name]['driver']=NULL;
      } else {
        $db_config[$name]['driver']=$db[$name]['driver'];
      }
      if($db[$name]['char_set']==NULL) {
        $db_config[$name]['char_set']=NULL;
      } else {
        $db_config[$name]['char_set']=$db[$name]['char_set'];
      }
    }
    return $db_config;
  }
}
