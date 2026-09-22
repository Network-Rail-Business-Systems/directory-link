<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\UsesDirectory;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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

    public function testRestoresSoftDeletedModel(): void
    {
        Schema::table('my_models', function (Blueprint $table) {
            $table->softDeletes();
        });
        config()->set('directory-link.models.user.local', SoftDeletesModel::class);

        $model = SoftDeletesModel::importFromDirectory('a');

        $model->delete();

        $this->assertTrue($model->trashed());

        SoftDeletesModel::importFromDirectory('a');

        $this->assertFalse(
            SoftDeletesModel::withTrashed()
                ->first()
                ->trashed(),
        );
        $this->assertDatabaseCount('my_models', 1);
    }

    public function testDoesntRestoreWhenHardDeletes(): void
    {
        $original = MyModel::importFromDirectory('a');

        $original->delete();

        $new = MyModel::importFromDirectory('a');

        $this->assertNotEquals($original, $new);
    }

    public function testThrows(): void
    {
        $this->expectException(NotInDirectoryException::class);
        $this->expectExceptionMessage('"a" could not be found in the directory');

        $this->directoryShouldReturnEmpty();

        MyModel::importFromDirectory('a');
    }
}
