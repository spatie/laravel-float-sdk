<?php

namespace Spatie\FloatSdk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\FloatSdk\Commands\FloatSdkCommand;

class FloatServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-float-sdk')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_float_sdk_table')
            ->hasCommand(FloatSdkCommand::class);
    }
}
