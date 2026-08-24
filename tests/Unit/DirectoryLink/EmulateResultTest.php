<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class EmulateResultTest extends TestCase
{
    public function testGroup(): void
    {
        $users = DirectoryLink::emulateResult(
            '/group/list',
            'fellowship@middle-earth.com',
            'mail',
        );

        $this->assertCount(1, $users);
    }

    public function testUser(): void
    {
        $users = DirectoryLink::emulateResult(
            '/user/list',
            'gandalf.stormcrow@networkrail.co.uk',
            'mail',
        );

        $this->assertCount(1, $users);
    }

    public function testSpecificUser(): void
    {
        $users = DirectoryLink::emulateResult(
            '/user/get',
            'abc-123',
            'id',
        );

        $this->assertEquals(
            'abc-123',
            $users['id'],
        );
    }

    public function testThrows(): void
    {
        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('"/bloop" has not been set up for emulation');

        DirectoryLink::emulateResult(
            '/bloop',
            'gandalf.stormcrow@networkrail.co.uk',
            'mail',
        );
    }
}
