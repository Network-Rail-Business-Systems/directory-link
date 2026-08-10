<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests;

use AnthonyEdmonds\LaravelTestingTraits\AssertsValidationRules;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Traits\AssertsDirectory;
use NetworkRailBusinessSystems\DirectoryLink\DirectoryLinkServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AssertsDirectory;
    use AssertsValidationRules;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->useDirectoryEmulator();

        config()->set('directory-link.models.user.local', MyModel::class);
        config()->set('directory-link.api.endpoint', 'http://localhost.com');
        config()->set('directory-link.api.token', 'abc123');
    }

    protected function getPackageProviders($app): array
    {
        return [
            DirectoryLinkServiceProvider::class,
        ];
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__ . '/Database');
        $this->runLaravelMigrations();
    }
}
