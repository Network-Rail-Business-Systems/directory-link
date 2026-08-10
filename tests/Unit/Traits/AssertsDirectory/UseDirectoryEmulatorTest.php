<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class UseDirectoryEmulatorTest extends TestCase
{
    public function testShouldFail(): void
    {
        $this->directoryShouldFail('Bad wolf');

        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('Bad wolf');

        DirectoryLink::query('/group/exists', '', '');
    }

    public function testGroupExists(): void
    {
        $this->assertTrue(
            DirectoryLink::query('/group/exists', '', '')['exists'],
        );
    }

    public function testGroupGet(): void
    {
        $this->assertNotEmpty(
            DirectoryLink::query('/group/get', '', ''),
        );
    }

    public function testGroupList(): void
    {
        $this->assertNotEmpty(
            DirectoryLink::query('/group/list', '', ''),
        );
    }

    public function testUserExists(): void
    {
        $this->assertTrue(
            DirectoryLink::query('/user/exists', '', '')['exists'],
        );
    }

    public function testUserGet(): void
    {
        $this->assertNotEmpty(
            DirectoryLink::query('/user/get', '', ''),
        );
    }

    public function testUserList(): void
    {
        $this->assertNotEmpty(
            DirectoryLink::query('/user/list', '', ''),
        );
    }

    public function testBadEndpoint(): void
    {
        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('"potato" is not a supported directory endpoint');

        DirectoryLink::query('/potato', '', '');
    }
}
