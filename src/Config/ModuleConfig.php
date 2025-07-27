<?php

namespace Modular\Config;

use DTO\DataTransferObject;

/**
 * @property-read string $module
 * @property-read Routes\ModuleRoutesConfig $routes
 * @property-read Console\ConsoleModuleConfig $console
 */
class ModuleConfig extends DataTransferObject {

    public function __construct(string $module, Routes\ModuleRoutesConfig $routes, Console\ConsoleModuleConfig $console) {

        parent::__construct(func_get_args());
    }
}
