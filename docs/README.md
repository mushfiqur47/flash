# Flash Framework

<p align="center">
  <img src="flash-logo.png" width="400px" alt="Flash Logo">
</p>

Flash is a high performance, open source web application framework.
Flash web framework follows the MVT (Model-View-Template) architectural pattern or you can say MVC (Model-View-Controller) pattern, because controller is handle by the system.
Flash is fast, lightweight, powerful, simple and easy to use.

Flash allows user to create web applications in easy and simplest way, in Flash framework user can create their own services and library.

## Features

  - Flash is fast and powerful web framework.
  - It's very simple and easy to learn.
  - It is based on MVT Arhitecture.
  - It support custom libraries and services.
  - Easy to create API and Web Services.
  - Easy to deploy on any server.

## User Guide

- [Introduction](Introduction.md)
  - [What is flash framework](Introduction.md#What-is-flash-framework)
  - [why flash framework](Introduction.md#why-flash-framework)
  - [Flash architecture](Introduction.md#Flash-architecture)
  - [Directory Structure](Introduction.md#Directory-Structure-of-Flash)
- [Installation](Installation.md)
- [Views](Views.md)
  - [Create Views](Views.md#Create-a-view)
  - [Render templates](Views.md#Render-templates)
  - [Response data](Views.md#Response-data)
  - [Use Models](Views.md#Use-Models)
- [URLs](URLs.md)
  - [Map Urls with Views](URLs.md#Map-Urls-with-Views)
  - [URL patterns and slug](URLs.md#URL-patterns-and-slug)
  - [Regular Expressions](URLs.md#Regular-Expressions)
- [Models](Models.md)
  - [Create Models](Models.md#Create-a-model)
  - [Use Database](Models.md#Use-Database)
- [Templates](Templates.md)
- [Static and Media files](Static-and-Media-files.md)
- [Session](Session.md)
- [Cookie](Cookie.md)
- [Request Data](Request-Data.md)
  - [GET Data](Request-Data.md#GET-Data)
  - [POST Data](Request-Data.md#POST-Data)
- [Libraries and Services](Libraries-and-Services.md)
  - [What is Libraries and Services](Libraries-and-Services.md#What-is-Libraries-and-Services)
  - [Create Libraries](Libraries-and-Services.md#Create-Libraries)
  - [Create Services](Libraries-and-Services.md#Create-Services)
  - [System Libraries](Libraries-and-Services.md#System-Libraries)
    - [Request](Libraries-and-Services.md#Request)
    - [Security](Libraries-and-Services.md#Security)
- [Databases](Database.md)
  - [Connect Database](Database.md#Connect-Database)
  - [Database Query](Database.md#Database-Query)
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

$urlpatterns=[
  '/' => 'view.hello_world',
];
```
  Now a simple hello world web app is created.


## License

  [MIT License](../LICENSE)
