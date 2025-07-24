<?php

namespace Modular\Config\Routes;

use DTO\DataTransferObject;

/**
 * @property-read ?string  $prefix
 * @property-read ?string  $name
 * @property-read ?string  $namespace
 * @property-read ?string  $controller
 * @property-read ?array   $middleware
 * @property-read string[] $files
 */
final class ModuleRouteConfig extends DataTransferObject {

    public function __construct(

        ?string $prefix     = null,
        ?string $name       = null,
        ?string $namespace  = null,
        ?string $controller = null,
        ?array  $middleware = null,
        array   $files      = []
    ) {

        parent::__construct(func_get_args());
    }
}
