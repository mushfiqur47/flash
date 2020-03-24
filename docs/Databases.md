## Databases

  Flash framework support fast and secure database connection.

#### Database Configuration

  Configure your databse settings in settings file.

```php
//Initialize database connection
$connect=['db'];

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

  **Database Configuration :**

  - **dsn** : The full DSN string describe a connection to the database. by default you can leav it will blank.
  - **hostname** : The hostname of your database server.
  - **port** : The port of your database server.
  - **username** : The username used to connect to the database.
  - **password** : The password used to connect to the database.
  - **database** : The name of the database you want to connect to.
  - **driver** : The name of the database driver (mysqli,pdo,sqlite3).
  - **char_set** : The character set used in communicating with the database.


#### Database Connection

  Configure your database settings and initialize database connection.

  **Initialize database connection**

```php
//Initialize database connection
$connect = [
  'db',
  'blog_db',
];
```

  Add your databse in the `connect` array to initialize database connection.

**Manually Initialize database connection**

```php
class model Models {
  function blog() {
    //initialize database
    $this->connect('db');
    $this->connect('blog_db');
  }
}
```

  Flash framework automatically create new database connection from settings.

#### Database Query

  Flash framework support very simple databse query.

```php
class blog_model extends Models {
  function get_data() {
    //select data from blog_db
    return $this->blog_db->query('select * from blog');
  }
}
```
