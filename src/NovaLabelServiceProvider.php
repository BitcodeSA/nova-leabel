<?php

namespace Bitcodesa\NovaLabel;

use Bitcodesa\NovaLabel\Commands\MakeLabel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NovaLabelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('nova-label')
//            ->hasConfigFile()
            ->hasCommand(MakeLabel::class);
    }
}
