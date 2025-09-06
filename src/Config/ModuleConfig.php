<?php

namespace Modular\Config;

use DTO\DataTransferObject;

/**
 * @property-read string $module
 * @property-read Routes\ModuleRoutesConfig $routes
 * @property-read Console\ConsoleModuleConfig $console
 * @property-read Database\ModuleDatabaseConfig $database
 * @property-read Exceptions\ModuleExceptionsConfiguration $exceptions
 */
class ModuleConfig extends DataTransferObject {

    public function __construct(
        
        string $module,
        Routes\ModuleRoutesConfig $routes,
        Console\ConsoleModuleConfig $console,
        Database\ModuleDatabaseConfig $database,
        Exceptions\ModuleExceptionsConfiguration $exceptions
    ) {

        parent::__construct(func_get_args());
    }
}
