## Models

  Models are classes that are designed to work with database. it manages the database, logic and rules of the web application.

### Create a model

  Let’s create the first model. Open the `app/models.php` file and put the following PHP code in it:

```php
class blog extends Models {
  private $title;
  private $author;
  private $date;
  function get_data() {
    $result = $this->db->query('select * from blog');
    return $result;
  }
}
```

### Use Database

  Create database connection in settings file and access database in models.

```php
class blog extends Models {
  function get_data() {
    //select data from database
    $result = $this->blog_db->query('select * from blog');
    return $result;
  }

  function put_data($title,$author) {
    //insert data in database
    return $this->blog_db->query("insert into blog values('$title','$author')");
  }
}
```

  **Manually create database connection**

```php
class blog extends Models {
  function get_data() {
    //create database connection
    $this->connect('blog_db');
    //select data from database
    return $this->blog_db->query('select * from blog');
  }
}
```
