<?php

namespace Modular\Config\Exceptions;

use DTO\DataTransferObject;

/**
 * @property-read ?string $handler
 * @property-read ExceptionsList|string[] $exceptions
 */
final class ModuleExceptionsConfiguration extends DataTransferObject {

    public function __construct(ExceptionsList $exceptions, ?string $handler) {

        parent::__construct(func_get_args());
    }
}
