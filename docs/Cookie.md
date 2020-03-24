## Cookie

  cookie is a small piece of information which is stored at client browser. It is used to recognize the user. Cookie is created at server side and saved to client browser. Each time when client sends request to the server, cookie is embedded with request.

  **Create a New Cookie**

```php
//Create new cookie
$this->cookie->set('email','example@gmail.com',time()+(60*30),'/');
```

  **Get Cookie Data**

```php
//Get cookie data
$this->cookie->email;
//OR
$thie->cookie->get('email');
```

  **Delete Cookie**

```php
//Delete cookie
$this->cookie->delete('email');
```
