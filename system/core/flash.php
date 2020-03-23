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

//load application settings file.
if(file_exists(trim(APP_DIR,'/').'/settings.php')) {
  require_once(trim(APP_DIR,'/').'/settings.php');
} else {
  exit("'".trim(APP_DIR,'/')."/settings.php' : file note found");
}

/**
* Debug setting
* Set the error_reporting directive at runtime.
* PHP has many levels of errors, using this function sets that level for the duration (runtime) of your script.
* If the optionallevel is not set, error_reporting() will just return the current error reporting level.
*/
if($setting['debug'] === FALSE) {
  //Turn off all error reporting.
  error_reporting(0);
} else {
  //Turn on all error reporting.
  //It will display E_ERROR, E_WARNING, and E_PARSE error, it will not display any E_NOTICE and other error. to display all errors use E_ALL or -1 in error_reporting.
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
}


/**
* Load system files
* Autoload all the system files
*/
if(file_exists(trim(SYS_DIR,'/').'/core/Config.php')) {
  require_once(trim(SYS_DIR,'/').'/core/Config.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/Config.php' : file note found");
}
if(file_exists(trim(SYS_DIR,'/').'/core/Models.php')) {
  require_once(trim(SYS_DIR,'/').'/core/Models.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/Models.php' : file note found");
}
if(file_exists(trim(SYS_DIR,'/').'/core/Controller.php')) {
  require_once(trim(SYS_DIR,'/').'/core/Controller.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/Controller.php' : file note found");
}
if(file_exists(trim(SYS_DIR,'/').'/core/Router.php')) {
  require_once(trim(SYS_DIR,'/').'/core/Router.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/Router.php' : file note found");
}

/**
* Load system libraries
* Autoload all default system libraries.
*/
if(file_exists(trim(SYS_DIR,'/').'/core/URI.php')) {
  require_once(trim(SYS_DIR,'/').'/core/URI.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/URI.php' : file note found");
}
if(file_exists(trim(SYS_DIR,'/').'/core/Input.php')) {
  require_once(trim(SYS_DIR,'/').'/core/Input.php');
} else {
  exit("'".trim(SYS_DIR,'/')."/core/Input.php' : file note found");
}


/**
* Load Application files
* Autoload all the required application files.
*/
//load application URLs file
if(isset($setting['urls']) && $setting['urls']!=NULL) {
  if(file_exists(trim(APP_DIR,'/').'/'.trim($setting['urls'],'/'))) {
    require_once(trim(APP_DIR,'/').'/'.trim($setting['urls'],'/'));
  } else {
    exit("'".trim(APP_DIR,'/')."/".trim($setting['urls'],'/')."' : file note found");
  }
} else {
  exit('URLs file not found');
}


/**
* Include URLs
* Include apps urls file and merge with main urlpatterns file.
*/
function urls(string $urls_path) {
  //Check URLs pattern exists or not
  if(file_exists($urls_path)) {
    //Include urlpatterns file
    require_once($urls_path);
    //Check urlpatterns array exists or not
    if(isset($urlpatterns) && $urlpatterns) {
      return $urlpatterns;
    } else {
      exit('urlpatterns : array not found');
    }
  } else {
    exit("'$urls_path' : invalid urls path");
  }
}


/**
* App
* Initialize Flash web framework, start listening routes.
*/
class app{
  //URLs Router
  private $router;
  function __construct() {
    //URLs Router
    $this->router=new Router();
  }
}
