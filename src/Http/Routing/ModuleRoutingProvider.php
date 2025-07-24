<?php

namespace Modular\Http\Routing;

use Modular\Config\Routes\{ ModuleRouteConfig, ModuleRoutesConfig };

use Illuminate\Support\Facades\Route;

final class ModuleRoutingProvider {

    public final function __construct(private readonly ModuleRoutesConfig $routes) {}

    public function boot(): void {

        foreach ($this->routes as $route) {

            $this->registerRoute($route);
        }
    }

    private function registerRoute(ModuleRouteConfig $route): void {

        $groupAttributes = $this->getGroupAttributes($route);

        foreach ($route->files as $file) {

            Route::group($groupAttributes, $file);
        }
    }

    private function getGroupAttributes(ModuleRouteConfig $route): array {

        $attributes = [];

        if (!is_null($route->prefix)) {
            
            $attributes['prefix'] = $route->prefix;
        }

        if (!is_null($route->name)) {

            $attributes['as'] = $route->name;
        }

        if (!is_null($route->namespace)) {

            $attributes['namespace'] = $route->namespace;
        }

        if (!is_null($route->controller)) {

            $attributes['controller'] = $route->controller;
        }

        if (!is_null($route->middleware)) {

            $attributes['middleware'] = $route->middleware;
        }

        return $attributes;
    }
}
