<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Commands;

use NetworkRailBusinessSystems\DirectoryLink\Exceptions\NotInDirectoryException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ImportFromDirectoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
    }

    public function testDefaults(): void
    {
        $this->artisan('directory-link:import')
            ->expectsQuestion('Which type of Directory model do you want to import? (user, group)', 'user')
            ->expectsQuestion('What term should be used to find the model to import? (for the provided field)', 'a')
            ->expectsOutput('Attempting to import user where "id" = "a"...')
            ->expectsOutput('Complete!');

        $this->assertDatabaseCount('my_models', 1);
    }

    public function testProvided(): void
    {
        $this->expectException(NotInDirectoryException::class);
        $this->expectExceptionMessage('"a" could not be found in the directory');

        $this->artisan('directory-link:import user a mail')
            ->expectsOutput('Attempting to import user where "mail" = "a"...');
    }
}
