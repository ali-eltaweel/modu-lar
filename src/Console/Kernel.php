<?php

namespace Modular\Console;

use Modular\Module;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Closure;

final class Kernel extends ConsoleKernel {

    protected final function schedule(Schedule $schedule) {

        $this->foreachModule(function(Module $module) use ($schedule) {
            
            if (!is_null($filename = $module->config->console->schedule)) {

                Closure::bind(fn () => require $filename, $schedule)();
            }
        });
    }

    protected function commands() {

        $this->foreachModule(function(Module $module) {
            
            $this->load($module->config->console->commandsDirs->toArray());
        });
    }

    private function foreachModule(callable $callback): void {

        foreach (config('modular.app.modules', []) as $moduleName) {

            /**
             * @var \Modular\Module
             */
            $module = $this->app->make(config("modular.$moduleName.module"));

            $callback($module, $moduleName);
        }
    }
}
