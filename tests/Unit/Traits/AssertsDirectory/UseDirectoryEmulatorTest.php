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

    public function testShouldEmptyExists(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertFalse(
            DirectoryLink::query('/group/exists', 'a@b.com', 'mail')['exists'],
        );
    }

    public function testShouldEmptyList(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertEmpty(
            DirectoryLink::query('/group/list', 'a@b.com', 'mail')['data'],
        );
    }

    public function testShouldEmptyGet(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertEmpty(
            DirectoryLink::query('/group/get', 'a@b.com', 'mail'),
        );
    }

    public function testEmulatedResult(): void
    {
        $this->assertNotEmpty(
            DirectoryLink::query('/user/exists', 'gandalf.stormcrow@networkrail.co.uk', 'mail'),
        );
    }
}
