<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\UsesDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class UpdateWithDirectoryDetailsTest extends TestCase
{
    protected MyModel $model;

    protected DirectoryUser $directoryUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->directoryUser = $this->directoryFakeUser();
        $this->model = new MyModel();

        $this->model->updateWithDirectoryDetails($this->directoryUser);
    }

    public function testImports(): void
    {
        $mapping = config('directory-link.sync.user.attributes');

        foreach ($mapping as $directoryKey => $localKey) {
            $this->assertEquals(
                $this->directoryUser->$directoryKey,
                $this->model->$localKey,
            );
        }

        $this->assertFalse(
            $this->model->isDirty(),
        );
    }
}
