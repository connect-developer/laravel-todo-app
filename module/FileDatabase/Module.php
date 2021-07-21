<?php

namespace Module\FileDatabase;

use Takemo101\SimpleModule\Support\{
    InstallerInterface,
    ServiceProvider,
};
use Module\FileDatabase\App\Database\Manager;

class Module extends ServiceProvider implements InstallerInterface
{
    public function boot()
    {
        $this->app->singleton('module-file_database.db', function ($app) {
            return new Manager(resource_path('json'), $app['files']);
        });
        $this->app->alias('module-file_database.db', Manager::class);
    }

    public function register()
    {
        //
    }

    public function install()
    {
        //
    }

    public function uninstall()
    {
        //
    }

    public function packages(): array
    {
        return [
            // add composer packages
            // 'package_name' => true or false
            // true is require and remove
            // false is require only
        ];
    }
}
