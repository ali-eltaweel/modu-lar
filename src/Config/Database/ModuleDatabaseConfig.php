<?php

namespace Modular\Config\Database;

use DTO\DataTransferObject;

/**
 * @property-read ModuleSeedersConfig $seeders
 * @property-read ModuleMigrationsDirs $migrationsDirs
 */
final class ModuleDatabaseConfig extends DataTransferObject {

    public function __construct(ModuleSeedersConfig $seeders, ModuleMigrationsDirs $migrationsDirs) {

        parent::__construct(func_get_args());
    }
}
