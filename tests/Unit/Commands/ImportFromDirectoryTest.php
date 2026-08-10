<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Commands;

use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ImportFromDirectoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
    }

    public function test(): void
    {
        $this->artisan('directory-link:import')
            ->expectsChoice('Which type of model do you want to import?', 'user', ['group', 'user'])
            ->expectsQuestion('What term should be used to find the model to import?', 'a')
            ->expectsOutput('Attempting to import user "a"...')
            ->expectsOutput('Complete!');

        $this->assertDatabaseCount('my_models', 1);
    }
}
