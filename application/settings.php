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
* We can add an alias name of library.
* for example if we want to access a login service so just write '$this->login->is_valid'.
* but if we want to access user_authentication library so we have to write '$this->user_authentication->is_authenticated' that to difficult.
* if we will use an alias name for libraries "application/library/user_authentication" => "user", now we can access this in very simple way like '$this->user->is_authenticated' that easy.
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
*        'system.Request',
*        'system.user_authentication' => 'user'
*    ];
*
* We can add an alias name of library.
* for example if we want to access a Request library so just write '$this->Request->method'.
* but if we want to access user_authentication library so we have to write '$this->user_authentication->is_authenticated' that to difficult.
* if we will use an alias name for libraries "system.user_authentication" => "user", now we can access this in very simple way like '$this->user->is_authenticated' that easy.
*
* Add any system libraries and apps in 'install' array to install and use system libraries in your application.
* Note : Any library and application can not be used in models.
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
* Static Files Directory
*
* Static directory is used to serve your static files like CSS, Javascript etc.
* Example :
*    $setting['static'] = '/application/static_dir_name';
* Add static directory path to serve your static files.
* Note : you can also serve static files directly. but if you add the static directory path then you can serve any file easily.
* Example :
*    1. Serve login.css from login directory.
*        <link href="<php echo "$this->static/login/login.css"; ?>" rel="stylesheet">
*
* But if you don't use the static path then you have to write full path of your static files like "/application/css/login/login.css" that very difficult to manage.
*/

$setting['static'] = '';


/**
* Media Files Directory
*
* Media directory is used to upload your media files like image, audio, video etc.
* Example :
*    $setting['media'] = '/application/media_dir_name';
* Add media directory path to upload your media files.
* Note : you can also serve media files directly. but if you add the media directory path then you can serve any file easily.
* 
* But if you don't use the media path then you have to write full path of your media files like "/application/images/cat.jpg" that very difficult to manage.
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
