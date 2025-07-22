# Modu-lar - Module Definition Guide

**Laravel Modular Architecture**

- [Modu-lar - Module Definition Guide](#modu-lar---module-definition-guide)
  - [The module class](#the-module-class)
  - [Specifying the configuration type](#specifying-the-configuration-type)

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
