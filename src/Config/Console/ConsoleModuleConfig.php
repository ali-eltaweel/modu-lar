<?php

namespace Modular\Config\Console;

use DTO\DataTransferObject;

/**
 * @property-read CommandsDirsList $commandsDirs
 * @property-read string $schedule
 */
final class ConsoleModuleConfig extends DataTransferObject {

    public function __construct(CommandsDirsList $commandsDirs, ?string $schedule = null) {

        parent::__construct(func_get_args());
    }
}
