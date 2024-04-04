<?php

namespace mpstenson\CloudflareAI;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use mpstenson\CloudflareAI\Commands\CloudflareAICommand;

class CloudflareAIServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('cloudflare-ai')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_cloudflare-ai_table')
            ->hasCommand(CloudflareAICommand::class);
    }
}
