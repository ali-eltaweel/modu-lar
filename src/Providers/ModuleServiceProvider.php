<?php

namespace Modular\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Modular\App\AppModule;
use Modular\Module;
use RuntimeException;

final class ModuleServiceProvider extends ServiceProvider {

    public final function register() {

        $this->registerModule('app', AppModule::class);
        $this->app->bind('app-module', AppModule::class);

        foreach (config('modular.app.modules', []) as $moduleName) {

            $this->registerModule($moduleName);
        }
    }

    public final function boot() {
        
        $this->publishes([
            
            MODULAR_SRC_CONFIG_DIR . '/app.php' => config_path('modular/app.php')

        ], [ 'modular-config', 'config' ]);
    }

    private function registerModule(string $name, string $moduleClass = Module::class): void {

        /**
         * @var string $moduleClass
         */
        $moduleClass = config("modular.$name.module", AppModule::class);

        if (!is_a($moduleClass, $moduleClass, true)) {

            throw new RuntimeException("Module class ($moduleClass) is not defined or does not extend the Modular\\Module class");
        }

        $this->app->singleton($moduleClass, function() use ($name, $moduleClass): Module {

            return new $moduleClass(
                
                config: $moduleClass::getConfigClass()::fromArray(config("modular.$name", []))
            );
        });
    }
}
