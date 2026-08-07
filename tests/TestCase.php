<?php

namespace NetworkRailBusinessSystems\Entra\Tests;

use NetworkRailBusinessSystems\Entra\DirectoryLinkServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function getPackageProviders($app): array
    {
        return [
            DirectoryLinkServiceProvider::class,
        ];
    }
}
