<?php

namespace Modular\App\Config;

use Modular\Config\ModuleConfig;

use DTO\DataTransferObject;
use Modular\Config\Exceptions\ModuleExceptionsConfiguration;

/**
 * @property-read string[] $modules
 */
class AppModuleConfig extends ModuleConfig {

    public function __construct(string $module, array $modules, ModuleExceptionsConfiguration $exceptions) {

        DataTransferObject::__construct(func_get_args());
    }
}
