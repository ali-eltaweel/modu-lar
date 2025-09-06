<?php

namespace Modular\Config\Exceptions;

use DTO\DataTransferCollection;

/**
 * @extends DataTransferCollection<string>
 */
final class ExceptionsList extends DataTransferCollection {

    public function __v(string $exceptionClass) {}
}
