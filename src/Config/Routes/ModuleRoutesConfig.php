<?php

namespace Modular\Config\Routes;

use DTO\DataTransferCollection;

/**
 * @extends DataTransferCollection<ModuleRouteConfig>
 */
final class ModuleRoutesConfig extends DataTransferCollection {

    public function __v(ModuleRouteConfig $v) {}
}
