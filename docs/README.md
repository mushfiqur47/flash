# Flash Framework

<p align="center">
  <img src="flash-logo.jpg" width="400px" alt="Flash Logo">
</p>

Flash is a high performance, open source web application framework.
Flash web framework follows the MVT (Model-View-Template) architectural pattern or you can say MVC (Model-View-Controller) pattern, because controller is handle by the system.
Flash is fast, lightweight, powerful, simple and easy to use.

Flash allows user to create web applications in easy and simplest way, in Flash framework user can create their own services and library.

## Features

  - Flash is fast and powerful web framework.
  - It's very simple and easy to learn.
  - Easy to create API and Web Services.
  - Easy to deploy on any server.

## User Guide

- [Introduction](Introduction.md)
  - [What is flash framework](Introduction.md#What-is-flash-framework)
  - [Why flash framework](Introduction.md#Why-flash-framework)
  - [Flash architecture](Introduction.md#Flash-architecture)
  - [Directory Structure](Introduction.md#Directory-Structure-of-Flash)
- [Installation](Installation.md)
- [Views](Views.md)
  - [Create Views](Views.md#Create-a-view)
  - [Render templates](Views.md#Render-templates)
  - [Response data](Views.md#Response-data)
  - [Json Response](Views.md#Json-Response)
  - [Set Http Response code](Views.md#Set-Http-Response-code)
  - [Set Http Response header](Views.md#Set-Http-Response-header)
  - [Use Models](Views.md#Use-Models)
- [URLs](URLs.md)
  - [Map Urls with Views](URLs.md#Map-Urls-with-Views)
  - [URL patterns and slug](URLs.md#URL-patterns-and-slug)
  - [Regular Expressions](URLs.md#Regular-Expressions)
  - [Include URLs](URLs.md#Include-URLs)
- [Models](Models.md)
  - [Create Models](Models.md#Create-a-model)
  - [Use Database](Models.md#Use-Database)
- [Templates](Templates.md)
- [Static and Media files](Static-and-Media-files.md)
- [File Uploading](File-Uploading.md)
- [Session](Session.md)
- [Cookie](Cookie.md)
- [Request Data](Request-Data.md)
  - [GET Request](Request-Data.md#GET-Request)
  - [POST Request](Request-Data.md#POST-Request)
  - [PUT Request](Request-Data.md#PUT-Request)
  - [DELETE Request](Request-Data.md#DELETE-Request)
- [Libraries and Services](Libraries-and-Services.md)
  - [What is Libraries and Services](Libraries-and-Services.md#What-is-Libraries-and-Services)
  - [Create Libraries](Libraries-and-Services.md#Create-Libraries)
  - [Create Services](Libraries-and-Services.md#Create-Services)
  - [System Libraries](Libraries-and-Services.md#System-Libraries)
    - [Request](Libraries-and-Services.md#Request)
    - [Security](Libraries-and-Services.md#Security)
- [Databases](Databases.md)
  - [Connect Database](Databases.md#Connect-Database)
  - [Database Query](Databases.md#Database-Query)
- [Security](Security.md)
  - [SQL Injection](Security.md#SQL-Injection)
  - [XSS](Security.md#XSS)
  - [CSRF](Security.md#CSRF)
- [ErrorHandler](ErrorHandler.md)
- [Settings](Settings.md)
- [How to Deploy](How-to-Deploy.md)

## Simple Example

  A simple `Hello, World` web application in Flash web framework.

### Create View

  Let’s write the first view. Open the `app/views.php` file and put the following PHP code in it:

```php
class view extends Views {
  function hello_world() {
    return $this->response("hello, world !!");
  }
}
```

  Hello world view is created now map this view with URLs.

### Map URLs with Views

  Let's create URL and map with views. open `app/urls.php` file and put the following code in it:

```php
//include views to route URLs
require_once("views.php");

$urlpatterns = [
  '/' => 'view.hello_world',
];
```
  Now a simple hello world web app is created.


## Simple Web Api Example

  A simple `Hello, World` web Api in Flash web framework.

### Create View

  Let’s write the first view. Open the `app/views.php` file and put the following PHP code in it:

```php
class view extends Views {
  function hello_world() {
    $data = [
      'status' => true,
      'data' => 'Hello, World',
    ];
    //Send Json Response
    return $this->response_json($data);
  }
}
```

  Hello world view is created now map this view with URLs.

### Map URLs with Views

  Let's create URL and map with views. open `app/urls.php` file and put the following code in it:

```php
//include views to route URLs
require_once("views.php");

$urlpatterns = [
  '/' => 'view.hello_world',
];
```
  Now a simple `Hello, World` web Api is created.


## License

  [MIT License](../LICENSE)
