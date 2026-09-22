<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\UsesDirectory;

use Carbon\Carbon;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\NotInDirectoryException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\SoftDeletesModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ImportFromDirectoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();
    }

    public function testImports(): void
    {
        MyModel::importFromDirectory('a');

        $this->assertDatabaseCount('my_models', 1);
    }

    public function testSoftDeletes(): void
    {
        config()->set('directory-link.models.user.local', SoftDeletesModel::class);

        $model = new SoftDeletesModel();
        $model->deleted_at = Carbon::now();

        SoftDeletesModel::importFromDirectory('a');

        $this->assertTrue($model->trashed());
        $this->assertDatabaseCount('my_models', 1);
    }

    public function testThrows(): void
    {
        $this->expectException(NotInDirectoryException::class);
        $this->expectExceptionMessage('"a" could not be found in the directory');

        $this->directoryShouldReturnEmpty();

        MyModel::importFromDirectory('a');
    }
}
