<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class QueryTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            [
                'exists' => true,
            ],
            DirectoryLink::query('/user/exists', 'a', 'a'),
        );
    }

    public function testEmulator(): void
    {
        config()->set('directory-link.emulator.enabled', true);

        $this->assertEquals(
            [
                'businessPhones' => '01234567890',
                'department' => 'Wizardry',
                'displayName' => 'Gandalf Stormcrow',
                'employeeId' => '123456',
                'givenName' => 'Gandalf',
                'id' => '123ab4c5-6789-01de-f2g3-45678hijk9lm',
                'jobTitle' => 'Wizard',
                'mail' => 'gandalf.stormcrow@networkrail.co.uk',
                'mobilePhone' => '01234567890',
                'officeLocation' => 'Minas Tirith',
                'phone' => '01234567890',
                'surname' => 'Stormcrow',
                'userPrincipalName' => 'gandalf@networkrail.co.uk',
            ],
            DirectoryLink::query('/user/get', 'gandalf.stormcrow@networkrail.co.uk', 'mail'),
        );
    }

    public function testThrows(): void
    {
        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('Bad wolf');

        $this->directoryShouldFail('Bad wolf');

        DirectoryLink::query('/user/exists', 'a', 'a');
    }
}
