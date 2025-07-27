# Modu-lar - Module Definition Guide

**Laravel Modular Architecture**

- [Modu-lar - Module Definition Guide](#modu-lar---module-definition-guide)
  - [The module class](#the-module-class)
  - [Specifying the configuration type](#specifying-the-configuration-type)
  - [Registering service providers](#registering-service-providers)
  - [Registering routes](#registering-routes)
  - [Console commands and scheduling](#console-commands-and-scheduling)

***
***

## The module class

```php
use Modular\Module;

class MyModule extends Module {
}
```

***

## Specifying the configuration type

```php
/**
 * @extends Module<Config\MyModuleConfig>
 */
class MyModule extends Module {
    
  public static function getConfigClass(): string {
  
    return Config\MyModuleConfig::class;
  }
}
```

***

## Registering service providers

```php
class MyModule extends Module {

  public static function getServiceProviders(): array {

    return [
      RouteServiceProvider::class,
    ];
  }
}
```

***

## Registering routes

In the module's config file, you can specify the route groups that should be registered for the module.

```php
return [

  'routes' => [
    [
      'prefix' => 'my-module',
      'files' => [
        base_path('app/Modules/MyModule/routes/web.php')
      ]
    ],
    [
      'prefix' => 'my-module',
      'middleware' => ['api'],
      'files' => [
        base_path('app/Modules/MyModule/routes/api.php')
      ]
    ]
  ]
];
```

***

## Console commands and scheduling

```php
return [

  'console' => [
    'commandsDirs' => [],
    'schedule' => 'path/to/schedule.php'
  ]
];
```

