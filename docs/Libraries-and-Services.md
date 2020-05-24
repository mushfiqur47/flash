## Libraries and Services

#### What is Libraries and Services

  **Library**

  Libraries are classes that are located in the library directory.

  **Service**

  Services are reusable functions, classes and variables that are located in the Service directory.

#### Create Libraries

  user's can create their own libraries in Flash framework.

  - **Create your library**

  create `hello.php` in library directory and put the following php code in it.

```php
//hello world library
class hello {
  function say_hello($name) {
    echo "hello, $name";
  }
}
```

  - **Install your library**

  go to settings file add your library in `library` array.

```php
$library = [
  'application/library/hello'
];
```

  - **Use library**

```php
class view extends Views {
  function hello() {
    return $this->hello->say_hello("World");
  }
}
```

  - **Set alias name to your library**

```php
$library = [
  //set alias name
  'application/library/hello' => 'say',
];
```

```php
class view extends Views {
  function hello() {
    return $this->say->say_hello("World");
  }
}
```

  Any library and service can not be used in models.


#### Create Services

  user's can create their own services in Flash framework.

  - **Create your service**

  create `hello.php` in service directory and put the following php code in it.

```php
//hello world service
class hello {
  function say_hello($name) {
    echo "hello, $name";
  }
}
```

  - **Install your service**

  go to settings file add your service in `service` array.

```php
$service = [
  'application/service/hello'
];
```

  - **Use service**

```php
class view extends Views {
  function hello() {
    //create service object
    $hello = new hello();
    return $hello->say_hello("World");
  }
}
```

  Any library and service can not be used in models.


## System Libraries

  Flash framework provide lots of pre-defined system libraries.

  There are several libraries available in Flash framework.

  - [Request Library](Libraries/Request.md)
  - [Security Library](Libraries/Security.md)
  - [User Agent Library](Libraries/User-Agent.md)

  **Install system library**

```php
//install system library
$install = [
  'system.request',
  'system.security',
  //Add alias name
  'system.user_agent' => 'user',
];
```

  **Use system library**

```php
class view extends Views {
  function home() {
    //check request method
    if($this->request->is_post) {
      //POST Request
      echo $this->user->ip;
    }
    return $this->render('home');
  }
}
```
