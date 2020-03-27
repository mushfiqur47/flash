## Views
  Views are classes that render templates, communicate with models and contain all the business logic of web application.
  generally all the views are written in a views.php file that is in your application directory or apps directory, but you can create your own views file in Flash framework.

### Create a view
  Let’s write the first view. Open the `app/views.php` file and put the following PHP code in it:

```php
class view extends Views {
  function hello_world() {
    return $this->response("hello, world !!");
  }
}
```

  a simple hello world view is created, to render views map your view with URLs.


### Render templates

  Render html templates, crate a template `hello.html` or `hello.php` in templates directory.

```php
class view extends Views {
  function hello_world() {
    //Render HTML Templats
    return $this->render("hello");
  }
}
```

### Response data

  **Response simple string data :**

```php
class view extends Views {
  function hello_world() {
    //Response string data
    return $this->response("hello");
  }
}
```

  **Response simple string data with http response code :**

```php
class view extends Views {
  function hello_world() {
    //Response string data with http response code
    return $this->response("404 Page not found !!", 404);
  }
}
```

### Json Response

  Response json data for api response :

```php
class view extends Views {
  function hello_world() {
    //Response json data
    return $this->response_json(array("data" => "hello world"));
  }
}
```

### Set http response code :

  Set Http Response status code :
```php
class view extends Views {
  function hello_world() {

    //Response http response code
    return $this->response_code(404);

  }
}
```

### Set http response header

  Set Http Response header :

```php
class view extends Views {
  function hello_world() {

    //Set Response Header
    $this->response_header("Content-Type: application/json");

    //Response data
    return $this->response("<h1>hello world</h1>");
  }
}
```

### Use Models

  Create a model Test and include models file in views file.

```php
//Include models file
require_once('models.php');

class view extends Views {
  function demo() {
    //Create model object
    $test = new Test();
    return $this->response($test->get_data());
  }
}
```
