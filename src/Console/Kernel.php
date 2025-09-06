<?php

namespace Modular\Console;

use Modular\Module;

use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Symfony\Component\Finder\Finder;

use Closure;
use ReflectionClass;
use SplFileInfo;

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

    protected function load($paths) {

        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });

        if (empty($paths)) {
            return;
        }

        if (property_exists($this, 'loadedPaths')) {

            $this->loadedPaths = array_values(
                array_unique(array_merge($this->loadedPaths, $paths))
            );
        }

        $namespace = $this->app->getNamespace();

        foreach (Finder::create()->in($paths)->files() as $file) {

            $command = $this->commandClassFromFile($file, $namespace);
            
            if (is_subclass_of($command, Command::class) &&
                ! (new ReflectionClass($command))->isAbstract()) {
                Artisan::starting(function ($artisan) use ($command) {
                    $artisan->resolve($command);
                });
            }
        }
    }

    protected function commandClassFromFile(SplFileInfo $file, string $namespace): string {

        $handle = $file->openFile();

        if (!str_starts_with($handle->fgets(), '<?php')) {

            throw new \RuntimeException("File {$file->getRealPath()} is not a PHP file.");
        }

        while ($handle->valid()) {

            $line = $handle->fgets();

            if ($line === "\n") {

                continue;
            }

            if (str_starts_with($line, 'namespace ')) {

                $namespaceLine = trim(substr($line, strlen('namespace ')));
                $namespace     = rtrim($namespaceLine, ';');
                
                return $namespace . '\\' . str_replace('.php', '', $file->getBasename());
            }
            
            return '';
        }

        return '';
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
