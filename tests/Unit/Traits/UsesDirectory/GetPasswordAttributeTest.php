<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\UsesDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class GetPasswordAttributeTest extends TestCase
{
    protected MyModel $model;

    protected DirectoryUser $directoryUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
    }

    public function test(): void
    {
        $this->assertEquals(
            '',
            $this->model->password,
        );
    }
}
