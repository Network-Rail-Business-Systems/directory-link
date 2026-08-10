<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\UsesDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ProcessDirectoryDetailsTest extends TestCase
{
    protected MyModel $model;

    protected DirectoryUser $directoryUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->directoryUser = $this->directoryFakeUser();
        $this->model = new MyModel();
    }

    public function testImports(): void
    {
        $this->assertInstanceOf(
            MyModel::class,
            $this->model->processDirectoryDetails($this->directoryUser),
        );
    }
}
