<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class EmulateResultTest extends TestCase
{
    public function testListGroup(): void
    {
        $users = DirectoryLink::emulateResult(
            '/group/list',
            'fellowship@middle-earth.com',
            'mail',
        );

        $this->assertCount(1, $users['data']);
    }

    public function testListUser(): void
    {
        $users = DirectoryLink::emulateResult(
            '/user/list',
            'gandalf.stormcrow@networkrail.co.uk',
            'mail',
        );

        $this->assertCount(1, $users['data']);
    }

    public function testGet(): void
    {
        $user = DirectoryLink::emulateResult(
            '/user/get',
            'gandalf.stormcrow@networkrail.co.uk',
            'mail',
        );

        $this->assertEquals(
            'gandalf.stormcrow@networkrail.co.uk',
            $user['mail'],
        );
    }

    public function testExists(): void
    {
        $user = DirectoryLink::emulateResult(
            '/user/exists',
            'gandalf.stormcrow@networkrail.co.uk',
            'mail',
        );

        $this->assertTrue(
            $user['exists'],
        );
    }

    public function testUserLogin(): void
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
