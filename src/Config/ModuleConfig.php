<?php

namespace Modular\Config;

use DTO\DataTransferObject;

/**
 * @property-read string $module
 * @property-read Routes\ModuleRoutesConfig $routes
 */
class ModuleConfig extends DataTransferObject {

    public function __construct(string $module, Routes\ModuleRoutesConfig $routes) {

        parent::__construct(func_get_args());
    }
}
