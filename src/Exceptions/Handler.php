<?php

namespace Modular\Exceptions;

use Generator;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;

use Throwable;

class Handler extends ExceptionsHandler {

    public function report(Throwable $e) {

        foreach ( $this->modulesHandlers($e) as $handler ) {

            return $handler->report($e);
        }

        if (is_null($appModuleHandler = $this->getAppModuleHandler())) {

            return parent::report($e);
        }

        return $appModuleHandler->report($e);
    }

    public function render($request, Throwable $e) {

        foreach ( $this->modulesHandlers($e) as $handler ) {

            return $handler->render($request, $e);
        }

        if (is_null($appModuleHandler = $this->getAppModuleHandler())) {

            return parent::render($request, $e);
        }

        return $appModuleHandler->render($request, $e);
    }

    private function modulesHandlers(Throwable $e): Generator {
        
        foreach (config('modular.app.modules', []) as $moduleName) {

            /** @var ?string $moduleClass */
            $moduleClass = config("modular.$moduleName.module");

            /** @var \Modular\Module $module */
            $module = app()->make($moduleClass);

            if (is_null($handler = $module->config->exceptions->handler)) {

                continue;
            }

            foreach ($module->config->exceptions->exceptions as $exception) {

                if ($e instanceof $exception) {
                    
                    yield app()->make($handler);
                }
            }
        }
    }

    private function getAppModuleHandler(): ?ExceptionsHandler {
        
        $appModule = app()->make('app-module');

        if (is_null($handler = $appModule->config->exceptions->handler)) {

            return null;
        }

        return app()->make($handler);
    }
}
