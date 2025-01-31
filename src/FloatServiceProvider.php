<?php

namespace Spatie\FloatSdk;

use Spatie\FloatSdk\Exceptions\FloatException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->name('laravel-float-sdk');
    }

    public function registeringPackage(): void
    {
        $this->app->scoped(FloatClient::class, function () {
            if (config('float-sdk.api_token') === null) {
                throw FloatException::missingApiToken();
            }

            if (config('mailcoach-sdk.endpoint') === null) {
                throw FloatException::missingEndpoint();
            }

            return new FloatClient(
                config('mailcoach-sdk.api_token'),
                config('mailcoach-sdk.endpoint'),
            );
        });
    }
}
