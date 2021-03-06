# IP Control Middleware

[![Latest Stable Version](https://poser.pugx.org/luisinder/ip-control-middleware/v/stable)](https://packagist.org/packages/luisinder/ip-control-middleware)
[![Total Downloads](https://poser.pugx.org/luisinder/ip-control-middleware/downloads)](https://packagist.org/packages/luisinder/ip-control-middleware)

Middleware to control the IPs that have access to the application.

  - Allows adding multiple IPs.
  - Defines a return URL in case the IP is not allowed.

### Installation

Using Composer:
```sh
$ composer require luisinder/ip-control-middleware
```

### Use
Allowed IPs must be inside an array. The second parameter is the return URL in case of failure:
```sh
$app->add(new Luisinder\Middleware\IpControl(['::1','192.168.1.0','127.0.0.1'],"https://github.com"));
```