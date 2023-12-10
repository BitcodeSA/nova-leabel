<?php

namespace Bitcodesa\NovaLabel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Bitcodesa\NovaLabel\Commands\NovaLabelCommand;

class NovaLabelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('nova-label')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_nova-label_table')
            ->hasCommand(NovaLabelCommand::class);
    }
}
