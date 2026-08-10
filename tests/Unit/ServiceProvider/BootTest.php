<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\ServiceProvider;

use Illuminate\Support\Facades\Artisan;
use NetworkRailBusinessSystems\DirectoryLink\DirectoryLinkServiceProvider;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class BootTest extends TestCase
{
    protected string $basePath;

    protected string $outputPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->basePath = realpath(__DIR__ . '/../../../src');
        $this->outputPath = base_path();
    }

    public function test(): void
    {
        $publishes = DirectoryLinkServiceProvider::$publishes[DirectoryLinkServiceProvider::class];

        $this->assertEquals(
            [
                "$this->basePath/config.php" => "$this->outputPath/config/directory-link.php",
            ],
            $publishes,
        );

        $commands = Artisan::all();

        $this->assertArrayHasKey(
            'directory-link:import',
            $commands,
        );

        $this->assertArrayHasKey(
            'directory-link:refresh',
            $commands,
        );
    }
}
