<?php
defined('BASEPATH') OR exit('No direct access allowed');
/**
* Settings and Configuration
* Application default setting and configuration file.
*/

/**
* Debug
*
* Set $setting["debug"] = TRUE to show all error's.
* Set $setting["debug"] = FALSE to hide all error's in production.
* SECURITY WARNING: don't run with debug turned on in production.
*/

$setting['debug'] = TRUE;


/**
* Users Libraries
*
* Create your own libraries and install them to use in your app.
* Example :
*    $library = [
*        '/application/library/login',
*        '/application/library/user_authentication' => 'user',
*    ];
*
* Add your library path in 'library' array to install and use libraries in your application.
* you can also install or load your libraries manually.
* Note : Any library and service can not be used in models.
*/

$library = [];


/**
* Users Services
*
* Create your own services and install them to use in your app.
* Example :
*    $service = [
*        '/application/service/login',
*        '/application/service/user_authentication',
*    ];
*
* Add your service path in 'service' array to install and use service's in your application.
* you can also install or load your service manually.
* Note : Any library and service can not be used in models.
*/

$service = [];


/**
* System App & Libraries
*
* Install system application & libraries to use in your app.
* Example :
*    $install = [
*        'system.request',
*        'system.user_agent' => 'user'
*    ];
*
* Add any system libraries and apps in 'install' array to install and use system libraries in your application.
* Note : Any library and service can not be used in models.
*/

$install = [
    'system.request',
    'system.security',
];


/**
* Template Directory
*
* Template directory is use to render you templates.
* Example :
*    1. Add single template directory.
*        $template = '/application/templates';
*
*    2. Add multiple templates directory.
*        $template = [
*            '/application/templates',
*        ];
* Add templates directory to render your templates.
*/

$template = [
    '/application/templates',
];


/**
* Database Settings
*
* Database settings needed to access your database. you setup multiple database settings.
* Example :
*    $db['db'] = [];
*    $db['mydb'] = [];
*
* Database Variables :
*    'dsn'  =>  The full DSN string describe a connection to the database. by default you can leav it will blank.
*    'hostname'  =>  The hostname of your database server.
*    'port'  =>  The port of your database server.
*    'username'  =>  The username used to connect to the database.
*    'password'  =>  The password used to connect to the database.
*    'database'  =>  The name of the database you want to connect to.
*    'driver'  =>  The name of the database driver (mysqli,pdo,sqlite3).
*    'char_set'  =>  The character set used in communicating with the database.
* Add your database connection to communicate with database.
*/

$db['db'] = [
    'dsn' => '',
    'hostname' => 'localhost',
    'port' => '',
    'username' => '',
    'password' => '',
    'database' => '',
    'driver' => 'mysqli',
    'char_set' => 'utf8',
];


/**
* Static Files
*
* Add static URL to serve your static files.
* Example :
*    $setting['static_url'] = '/static';
*
* Static directory is used to serve your static files like CSS, Javascript etc.
* Example :
*    $setting['static_dir'] = '/application/static_dir_name';
*
*/

//Static URL
$setting['static_url'] = '';

//Static files DIR
$setting['static_dir'] = '';


/**
* Media Files
*
* Media directory is used to upload your media files like image, audio, video etc.
* Example :
*    $setting['media'] = '/application/media_dir_name';
* Add media directory path to upload your media files.
*/

$setting['media'] = '';


/**
* Main URLs path
* Set main URLs file path
*/

$setting['urls'] = 'urls.php';


/**
* Urls Setting
*
* Ignore trailing slashes
* Example :
*    Set $setting['ignore_slash']=TRUE if you want to ignore trailing slashes.
*
*    Set $setting['ignore_slash']=FALSE if you don't want to ignore trailing slashes.
*/

$setting['ingore_slash'] = FALSE;


//Set default timezone
date_default_timezone_set('UTC');
