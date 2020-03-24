## URLs

  Flash allows to create simple and clean urls without any limitation. create URLs and map with views.

### Map URLs with Views

  Let's create URL and map with views. open `app/urls.php` file and put the following code in it:

```php
//include views to route URLs
require_once("views.php");
require_once("product_view.php");

$urlpatterns=[
  '/' => 'app_view.home',
  '/product/{slug}' => 'product.data',
  '/about' => 'app_view.about',
];
```

### URL Patterns and slug

  Flash framework allows to create custom urls patterns.

  Example :
```
/product/1
/product/2
/product/3
```

  here the product id is dynamic it can be change on every request.

```php
$urlpatterns = [
  '/product/{slug}' => 'view.product',
];
```

  To access slug pattern data create a function product and pass parameter. now we can access the id of product and render the product data.

```php
class view extends Controller {
  function product($id){
    return $this->response("Product : $id");
  }
}
```

  Flash does not support any int, str, float type but you can use them in slug. {slug} support all the int, float, and string as well as Wildcards.

### Regular Expressions

  Flash allows to define URLs routing rules using regular expressions. Any valid regular expression is allowed.

```php
'/product/([0-9]+)' => 'view.product',
```

  this example is similar to :

```
/product/1
/product/2
/product/3
```

### Include URls

  Include your application URls file in main URLs file.

```php
$urlpatterns=[
  '/' => urls('application/app/urls.php'),
  '/product/{slug}' => urls('application/product/urls.php'),
];
```
