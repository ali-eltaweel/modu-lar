# Modu-lar

**Laravel Modular Architecture**

- [Modu-lar](#modu-lar)
  - [Installation](#installation)
  - [Setup](#setup)
    - [Publish the configuration files](#publish-the-configuration-files)
    - [Define your modules](#define-your-modules)
    - [Register your modules](#register-your-modules)

***
***

## Installation

```shell
composer require ali-eltaweel/modu-lar
```

***
***

## Setup

### Publish the configuration files

```shell
php artisan vendor:publish --tag=modular-config
```

***

### Define your modules

Consult the [Module Definition Guide](module.md) for detailed instructions on how to define your modules.

***

### Register your modules

- Create a single configuration file for each module under *config/modular* directory.
- Add the names of the config files to the `modules` array in the *config/modular/app.php* file.
- Run `php artisan optimize`.
