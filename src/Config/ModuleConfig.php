<?php

namespace Modular\Config;

use DTO\DataTransferObject;

/**
 * @property-read string $module
 */
class ModuleConfig extends DataTransferObject {

    public function __construct(string $module) {

        parent::__construct(func_get_args());
    }
}
