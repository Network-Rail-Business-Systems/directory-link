<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\Models\MyModel;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class GetModelTypeTest extends TestCase
{
    public function testMatchesByLocal(): void
    {
        $this->assertEquals(
            'user',
            DirectoryLink::getModelType(MyModel::class),
        );
    }

    public function testMatchesByDirectory(): void
    {
        $this->assertEquals(
            'user',
            DirectoryLink::getModelType(DirectoryUser::class),
        );
    }

    public function testThrows(): void
    {
        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('"Potato" is not configured for directory syncing');

        DirectoryLink::getModelType('Potato');
    }
}
