<?php

namespace Modular\Providers;

use Modular\App\AppModule;
use Modular\Module;

use Illuminate\Support\ServiceProvider;

use RuntimeException;

final class ModuleServiceProvider extends ServiceProvider {

    public final function register() {

        $this->registerModule('app', AppModule::class);
        $this->app->bind('app-module', AppModule::class);

        foreach (config('modular.app.modules', []) as $moduleName) {

            $this->registerModule($moduleName);
            $this->registerModuleProviders($moduleName);
        }
    }

    public final function boot() {
        
        $this->publishes([
            
            MODULAR_SRC_CONFIG_DIR . '/app.php' => config_path('modular/app.php')

        ], [ 'modular-config', 'config' ]);

        foreach (config('modular.app.modules', []) as $moduleName) {

            $this->bootModule($moduleName);
        }
    }

    private function registerModule(string $name, string $moduleClass = Module::class): void {

        /**
         * @var string $module
         */
        $module = config("modular.$name.module");

        if (!is_a($module, $moduleClass, true)) {

            throw new RuntimeException("Module class ($module) is not defined or does not extend the $moduleClass class");
        }

        $this->app->singleton($module, function() use ($name, $module): Module {

            return new $module(
                
                config: $module::getConfigClass()::fromArray(config("modular.$name", []))
            );
        });
    }

    private function registerModuleProviders(string $name): void {

        /**
         * @var string $moduleClass
         */
        $moduleClass = config("modular.$name.module");

        foreach ($moduleClass::getServiceProviders() as $providerClass) {

            if (!is_a($providerClass, ServiceProvider::class, true)) {

                throw new RuntimeException("Service provider class ($providerClass) is not defined or does not extend the Illuminate\\Support\\ServiceProvider class");
            }
            
            $this->app->register($providerClass);
        }
    }

    private function bootModule(string $name): void {

        $this->app->make(config("modular.$name.module"))->boot();
    }
}
