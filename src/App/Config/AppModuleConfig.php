<?php

namespace Modular\App\Config;

use Modular\Config\ModuleConfig;

use DTO\DataTransferObject;

/**
 * @property-read string[] $modules
 */
class AppModuleConfig extends ModuleConfig {

    public function __construct(string $module, array $modules) {

        DataTransferObject::__construct(func_get_args());
    }
}
