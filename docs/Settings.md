## Settings

  A settings file is a application default setting and configuration file.

  **Debug**

  Set the error_reporting directive at runtime.

  ***SECURITY WARNING: don't run with debug turned on in production.***

```php
$setting['debug'] = TRUE;
```
  Set `$setting["debug"] = TRUE;` to show all error's.

  Set `$setting["debug"] = FALSE` to hide all error's in production.
  
  **User Libraries Configuration**

  Install user defined libraries in you web application.

```php
$library = [
  'application/library/my_library',
];
```

  **User Services Configuration**

  Install user defined Services in you web application.

```php
$service = [
  'application/service/my_library',
];
```

  **System Apps and Libraries Configuration**

  Install system libraries in you web application.

```php
$install = [
  'system.request',
  'system.security',
];
```

  **Initialize Database Connection**

  Initialize your database connection.

```php
//Initialize database connection
$connect = [
  'db',
  'blog_db',
];
```

  Add your databse in the `connect` array to initialize database connection.

  **Database Configuration**

```php
$db['db']= [
    'dsn' => '',
    'hostname' => 'localhost',
    'port' => '',
    'username' => 'demo_user',
    'password' => '1234',
    'database' => 'demo',
    'driver' => 'mysqli',
    'char_set' => 'utf8',
];
```

  Database Configuration :

  - **dsn** : The full DSN string describe a connection to the database. by default you can leav it will blank.
  - **hostname** : The hostname of your database server.
  - **port** : The port of your database server.
  - **username** : The username used to connect to the database.
  - **password** : The password used to connect to the database.
  - **database** : The name of the database you want to connect to.
  - **driver** : The name of the database driver (mysqli,pdo,sqlite3).
  - **char_set** : The character set used in communicating with the database.


  **Static Files Configuration**

  Add your static files directory path.

```php
$setting['static'] = 'application/static';
```

  **Media Files Configuration**

  Add your media files directory path.

```php
$setting['media'] = 'application/media';
```

  **Templates Configuration**

  Add your templates directory path.

```php
$template = [
  'application/templates',
];
```

  **Urls Settings**

  Set main URLs file path

```php
$setting['urls'] = 'urls.php';
```

  Ignore trailing slashes

```php
$setting['ingore_slash'] = FALSE;
```

  Set `$setting['ignore_slash'] = TRUE` if you want to ignore trailing slashes.

  Set `$setting['ignore_slash'] = FALSE` if you don't want to ignore trailing slashes.


  **Set Default timezone**

  Set your default timezone.

```php
//Set default timezone
date_default_timezone_set('UTC');
```
