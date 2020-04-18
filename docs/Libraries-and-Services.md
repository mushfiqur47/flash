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

  - [Request Library](#Request)
  - [Security Library](#Security)

  **Install system library**

```php
//install system library
$install = [
  'system.request',
  'system.security',
];
```

  **Use system library**

```php
class view extends Views {
  function home() {
    //check request method
    if($this->request->is_post) {
      //POST Request
    }
    return $this->render('home');
  }
}
```


## Request

  Resquest library handle all the HTTP Request and Server information.

  **Request Header Information**

  - `scheme` : Request scheme http or https.
  - `method` : Which request method was used to access the page; e.g. 'GET', 'HEAD', 'POST', 'PUT'.
  - `protocol` : Name and revision of the information protocol via which the page was requested e.g. 'HTTP/1.0'.
  - `accept` : Acceptable content types for the response. 
  - `language` : Acceptable languages for the response. Example: 'en'.
  - `encoding` : Acceptable encodings for the response. Example: 'gzip'.
  - `connection` : header from the current request, if there is one. Example: 'Keep-Alive'.
  - `content_type` : A string representing the MIME type of the request, parsed from the CONTENT_TYPE header.
  - `content_length` : The length of the request body (as a string).
  - `user_agent` : This is a string denoting the user agent being which is accessing the page. A typical example is: Mozilla/4.5 [en] (X11; U; Linux 2.2.9 i586).
  - `referer` : The address of the page (if any) which referred the user agent to the current page. This is set by the user agent. Not all user agents will set this, and some provide the ability to modify HTTP_REFERER as a feature. In short, it cannot really be trusted.
  - `headers` : Fetch all HTTP request headers.

  **Server Information**

  - `hostname` : The Host name from which the user is viewing the current page.
  - `host` : The HTTP Host header sent by the client.
  - `port` : The port on the server machine being used by the web server for communication. For default setups, this will be '80'; using SSL, for instance, will change this to whatever your defined secure HTTP port is.
  - `server_software` : Server identification string, given in the headers when responding to requests.

  **Request Information**

  - `is_secure` : TRUE if the current request is https.
  - `is_ajax` : TRUE if the current request is made by ajax.
  - `is_get` : TRUE if the current request is GET.
  - `is_post` : TRUE if the current request is POST.
  - `is_put` : TRUE if the current request is PUT.
  - `is_delete` : TRUE if the current request is DELETE.
  - `is_patch` : TRUE if the current request is PATCH.
  - `is_head` : TRUE if the current request is HEAD.
  - `is_options` : TRUE if the current request is OPTIONS.
  - `is_connect` : TRUE if the current request is CONNECT.
  - `is_trace` : TRUE if the current request is TRACE.
  - `is_copy` : TRUE if the current request is COPY.
  - `is_link` : TRUE if the current request is LINK.
  - `is_unlink` : TRUE if the current request is UNLINK.
  - `is_lock` : TRUE if the current request is LOCK.
  - `is_unlock` : TRUE if the current request is UNLOCK.
  - `is_purge` : TRUE if the current request is PURGE.
  - `is_propfind` : TRUE if the current request is PROPFIND.
  - `is_view` : TRUE if the current request is VIEW.
  - `is_http` : TRUE if the current request is http.
  - `is_https` : TRUE if the current request is https.

  **Path Information**

  - `url` : absolute URL of current request.
  - `path` : path of current request.
  - `path_info` : path of current request with query string.

  **User Information**

  - `remote_addr` : The IP address from which the user is viewing the current page.
  - `is_redirected` : True if user is redirected from somewhere.



## Security

  Security library provide basic security feature to the web application. flash framework provide CSRF, XSS and SQL Injection protection.

#### SQL Injection

  SQL Injection is a technique where an attacker creates or alters existing SQL commands to expose hidden data, or to override valuable ones, or even to execute dangerous system level commands on the database host. 

  **Avoid SQL Injection**

  - Use prepared statements.
  - Use database-specific string escape function (e.g. `mysql_real_escape_string()`, `sqlite_escape_string()`, etc.).

#### XSS

  Cross site scripting (XSS) is a common attack vector that injects malicious code into a vulnerable web application.
  Flash Framework provide XSS protection.

```php
class view extends Views {
  function blog() {
    //XSS Clean
    $data = $this->security->xss_clean($blog_data);
    return $this->response($data);
  }
}
```
  Use `$this->security->xss_clean()` to avoid xss attack.


#### CSRF

  Cross site request forgery (CSRF), also known as XSRF, Sea Surf or Session Riding attack. CSRF is a type of malicious exploit of a website where unauthorized commands are transmitted from a user that the web application trusts.

  **Add CSRF Token :**

  Add CSRF Token in your web form to avoid CSRF attack.

```html
<form method="POST">
  <?php $this->security->csrf_token(); ?>
  <input type="text" name="username" palceholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" name="submit" value="Login">
</form>
```

  **Add CSRF token in AJAX**

  Add CSRF token in Ajax request.

```javascript
$.ajax({
  type: "POST",
  url: "/login",
  data: {
    carf_token: "<?php echo $this->security->get_csrf_token(); ?>",
    username: "user_name",
    password: "password"
  },
  success: function(data){
     //success response data
  }
});
```

  **Verify CSRF Token**

```php
class view extends Views {
  function login() {
    //Form Submit
    if($this->request->is_post) {
      //Verify CSRF Token
      if($this->security->csrf_verify()) {
        //Valid CSRF Token
        $username = $this->post->username;
        $password = $this->post->password;
      } else {
        //Invalid CSRF Token
      }
    } else {
      //Render Login Page
      return $this->render('login');
    }
  }
}
```

  Add CSRF token in your web form and verify that token, to authenticate the web form and avoid CSRF attack.
