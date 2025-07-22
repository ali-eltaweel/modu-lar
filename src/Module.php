<?php

namespace Modular;

/**
 * @template TConfig of Config\ModuleConfig
 * 
 * @property-read TConfig $config
 */
abstract class Module {

    /**
     * @param TConfig $config
     */
    public final function __construct(

        public readonly Config\ModuleConfig $config
    ) {}

    public static function getConfigClass(): string {

        return Config\ModuleConfig::class;
    }
}
