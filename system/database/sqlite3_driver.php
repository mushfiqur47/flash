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
* SQLite3 Database Driver
* SQLite3 Database Driver extends SQLite3 class and handle sqlite database connection.
*
* @package : SQLite3 Database Driver
* @category : Driver
* @author : Flash Framework
* @link : https://github.com/rajkumardusad/flash
*/

class sqlite3_db_driver extends SQLite3{
  //DSN
  protected $dsn;
  //User Name
  protected $username;
  //Password
  protected $password;
  //Database
  protected $database;
  //Server hostname
  protected $hostname;
  //Server Port
  protected $port;
  //Charset
  protected $char_set;

  function __construct($db,$name) {
    $this->dsn=$db[$name]['dsn'];
    $this->username=$db[$name]['username'];
    $this->password=$db[$name]['password'];
    $this->database=$db[$name]['database'];
    $this->hostname=$db[$name]['hostname'];
    $this->port=$db[$name]['port'];
    $this->char_set=$db[$name]['char_set'];

    try {
      parent::__construct($this->database);
    } catch (Exception $error) {
      echo 'Connect Error : '.$error->getMessage();
    }
  }
}