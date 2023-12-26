<?php

namespace Bitcodesa\NovaLabel;

use Bitcodesa\NovaLabel\Commands\MakeLabel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasCommand(MakeLabel::class);
    }
}
