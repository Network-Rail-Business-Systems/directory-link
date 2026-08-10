<?php

namespace NetworkRailBusinessSystems\DirectoryLink;

use Illuminate\Support\ServiceProvider;
use NetworkRailBusinessSystems\DirectoryLink\Commands\ImportFromDirectory;
use NetworkRailBusinessSystems\DirectoryLink\Commands\RefreshFromDirectory;

class DirectoryLinkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config.php',
            'directory-link',
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('directory-link.php'),
        ], 'directory-link');

        $this->commands([
            ImportFromDirectory::class,
            RefreshFromDirectory::class,
        ]);
    }
}
