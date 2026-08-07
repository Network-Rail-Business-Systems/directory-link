<?php

namespace NetworkRailBusinessSystems\Entra;

use Illuminate\Support\ServiceProvider;

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
    }
}
