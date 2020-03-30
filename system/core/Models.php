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

  /**
  * Connect
  * Initialize database connection manually.
  */
  public function connect(...$dbname) {
    global $db;

    //Check db array
    if(is_array($db)) {
      $db_setting = $db;
    } else {
      exit("Invalid database setting array");
    }

    if(is_array($dbname)) {
      $db_name = $dbname;
    } else {
      $db_name = array($dbname);
    }

    //Parse database settings
      $this->db_setting = $this->parse_db($db_setting, $db_name);

    //Initialize database connection
    $this->load_driver($this->db_setting, $db_name);
  }

  /**
  * Load Driver
  * Load database driver.
  */
  private function load_driver(array $db_setting, array $connect) {
    //Check db driver exists or not
    foreach($connect as $name) {

      //Check database setting exists or not
      if(array_key_exists($name, $db_setting)) {
        $driver_name=strtolower($db_setting[$name]['driver']);
        if(file_exists(trim(SYS_DIR,'/').'/database/'.$driver_name.'_driver.php')) {
          require_once(trim(SYS_DIR,'/').'/database/'.$driver_name.'_driver.php');
          $driver=$driver_name.'_db_driver';
          if(class_exists($driver)) {
            $this->$name=new $driver($db_setting, $name);
          } else {
             exit("'".$db_setting[$name]['driver']."' : Database driver not found");
          }
        } else {
          exit("'".$db_setting[$name]['driver']."' : Database driver not found");
        }
      } else {
        exit("'".$name."' : Database setting not found");
      }
    }
  }

  /**
  * Parse DB
  * Parse database connection settings.
  */
  public function parse_db(array $db, array $connect) : array{
    //Set db_config default data type.
    $db_config=array();
    foreach($connect as $name) {
      //Check database setting exists or not
      if(array_key_exists($name, $db)) {
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
      } else {
        exit("'".$name."' : Database setting not found");
      }
    }
    return $db_config;
  }
}
