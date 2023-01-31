# WebRouter @CafeWebCode

###### Small and simple component to help you with the implementation of scales.

A simple and easy to use component. The webrouter is a PHP routing component for MVC abstraction.

## About CafeWebRoute

###### CafeWebRoute is a set of small and optimized PHP components for common tasks. Held by Cleyber F. Matos.

## Documentation

#### Apache

```apacheconfig
RewriteEngine On

# ROUTER URL Rewrite
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule ^(.*)$ index.php?route=/$1 [L,QSA]
```
##### Routes

```php
<?php

use Cafewebcode\Webrouter\Webrouter;

$router = new Webrouter("https://www.youdomain.com");

/**
 * routes
 * The controller must be in the namespace Test\Controller
 * this produces routes for route, route/$id, route/{$id}/profile, etc.
 */
$router->namespace("Test");

$router->get("/route", "Controller:method");
$router->post("/route/{id}", "Controller:method");
$router->put("/route/{id}/profile", "Controller:method");
$router->patch("/route/{id}/profile/{photo}", "Controller:method");
$router->delete("/route/{id}", "Controller:method");

$router->execute();

if ($router->error()) {
    var_dump($router->error());
}

```

###### Named Controller Example

```php
<?php

class Name
{
   
    public function home(?array $data): void
    {
        echo "<h1>Home</h1>";
        
        var_dump($data);
    }
    
}
```


## Contributing

Please see [CONTRIBUTING](https://github.com/cleyber2010/webrouter/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email cleyber.fernandes@gmail.com instead of using the issue tracker.

Thank you

## Credits

- [Cleyber F. Matos](https://github.com/cleyber2010) (Developer)
- [All Contributors](https://github.com/cleyber2010/webrouter/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/cleyber2010/webrouter/blob/master/LICENSE) for more
information.