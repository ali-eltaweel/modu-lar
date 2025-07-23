<?php

namespace Modular;

use ReflectionClass;

/**
 * @template TConfig of Config\ModuleConfig
 * 
 * @property-read TConfig $config
 */
abstract class Module {

    /**
     * @param TConfig $config
     */
    public final function __construct(public readonly Config\ModuleConfig $config) {}

    public function boot(): void {}

    public static function getConfigClass(): string {

        return Config\ModuleConfig::class;
    }

    public static function getServiceProviders(): array {

        return array_column(
            Annotations\Provider::annotatedOn(new ReflectionClass(static::class)) ?? [],
            'name'
        );
    }
}
