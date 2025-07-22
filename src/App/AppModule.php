<?php

namespace Modular\App;

use Modular\Module;
use RuntimeException;

/**
 * @extends Module<Config\AppModuleConfig>
 */
class AppModule extends Module {

    public final function getModule(string $name): Module {

        if (is_null($moduleClass = config("modular.$name.module"))) {

            throw new RuntimeException('Unknown module ' . $name);
        }

        return app($moduleClass);
    }

    public static function getConfigClass(): string {

        return Config\AppModuleConfig::class;
    }
}
