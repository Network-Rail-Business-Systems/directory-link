<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class DirectoryFakeUserTest extends TestCase
{
    public const array EXPECTED_KEYS = [
        'id',
        'mail',
        'displayName',
        'givenName',
        'surname',
        'jobTitle',
        'officeLocation',
        'phone',
        'department',
        'employeeId',
    ];

    public function testModel(): void
    {
        $this->assertInstanceOf(
            DirectoryUser::class,
            $this->directoryFakeUser(),
        );
    }

    public function testArray(): void
    {
        $user = $this->directoryFakeUser(false);

        foreach (self::EXPECTED_KEYS as $key) {
            $this->assertArrayHasKey(
                $key,
                $user,
            );
        }
    }
}
