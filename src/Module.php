<?php

namespace Modular;

use ReflectionClass;

/**
 * @template TConfig of Config\ModuleConfig
 * 
 * @property-read TConfig $config
 */
abstract class Module {

    private readonly Http\Routing\ModuleRoutingProvider $routingProvider;

    /**
     * @param TConfig $config
     */
    public final function __construct(public readonly Config\ModuleConfig $config) {

        $this->routingProvider = new Http\Routing\ModuleRoutingProvider(routes: $config->routes);
    }

    public final function seedDatabase(callable $seed): void {

        $seed($this->getSeeders());
    }

    public function boot(): void {

        $this->routingProvider->boot();
    }

    protected function getSeeders(): array {

        return $this->config->database->seeders->toArray();
    }

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
