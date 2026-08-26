<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Commands;

use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class RefreshFromDirectoryTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->updateWithDirectoryDetails(
            $this->directoryFakeUser(),
        );
    }

    public function test(): void
    {
        $this->artisan('directory-link:refresh')
            ->expectsChoice('Which type of model do you want to refresh?', 'user', ['group', 'user'])
            ->expectsOutput('Starting user refresh using "id" => "azure_id"...')
            ->expectsOutput('Complete!');

        $this->assertDatabaseCount('my_models', 1);
    }
}
