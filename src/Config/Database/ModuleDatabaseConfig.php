<?php

namespace Modular\Config\Database;

use DTO\DataTransferObject;

/**
 * @property-read ModuleSeedersConfig $seeders
 */
final class ModuleDatabaseConfig extends DataTransferObject {

    public function __construct(ModuleSeedersConfig $seeders) {

        parent::__construct(func_get_args());
    }
}
