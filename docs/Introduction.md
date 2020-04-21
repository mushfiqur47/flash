## Introduction

### What is flash framework

<p align="center">
  <img src="flash-logo.jpg" width="400px" alt="Flash Logo">
</p>

Flash is a high performance, open source web application framework.
Flash web framework follows the MVT (Model-View-Template) architectural pattern or you can say MVC (Model-View-Controller) pattern, because controller is handle by the system.
Flash is fast and lightweight web framework.

Flash allows user to create web applications in easy and simplest way, in Flash framework user can create their own services and library.

### Why flash framework

Flash is fast and lightweight php web framework. Flash framework is very simple and easy to learn. even if you are new in web development don't worry you will love this framework.

  - Flash is fast and powerful web framework.
  - It's very simple and easy to learn.
  - Easy to create API and Web Services.
  - Easy to deploy on any server.

### Flash architecture

<p align="center">
  <img src="flash-architecture.jpg" width="600px" alt="Flash Framework architecture">
</p>

Flash web framework based on MVT (Model-View-Template) architecture. The MVT (Model-View-Template) is a software design pattern. The Model helps to handle database. It is a data access layer which handles the database.
The Template is a presentation layer which handles User Interface part. The View is used to execute the business logic and interact with a model to carry data and renders a template.


### Directory Structure of Flash

```
/system
/application
    /app
        /templates
        /models.php
        /views.php
        /urls.php
    /app1
    /app..n
    /templates
    /settings.php
    /urls.php
/.htaccess
/index.php
```

#### system directory
  system directory is main system directory of flash framework, where all the system files are stored.

#### application directory
  application is main project directory that contains all your apps and project files. you can change this default application directory to different location, set the new APP_DIR path in index.php to change the default application directory. all your app project files (settings, urls) shold be inside the application directory.

#### app directory
  app is demo application of your project. your can create new apps like login, admin, news, blogs or any app that you want. your app directory contains views, models and urls files.

#### templates directory
  templates directory contains all your HTML template files.
