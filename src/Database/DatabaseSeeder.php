<?php

namespace Modular\Database;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public final function run() {

        foreach (config('modular.app.modules', []) as $moduleName) {

            /** @var \Modular\Module */
            $module = app()->make(config("modular.$moduleName.module"));

            $module->seedDatabase(fn (array $seeders) => $this->call($seeders));
        }
    }
}
