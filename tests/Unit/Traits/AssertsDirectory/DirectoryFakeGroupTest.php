<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class DirectoryFakeGroupTest extends TestCase
{
    public const array EXPECTED_KEYS = [
        'id',
        'mail',
        'displayName',
        'description',
        'members',
        'membersCount',
    ];

    public function testModel(): void
    {
        $this->assertInstanceOf(
            DirectoryGroup::class,
            $this->directoryFakeGroup(),
        );
    }

    public function testArray(): void
    {
        $group = $this->directoryFakeGroup(false);

        foreach (self::EXPECTED_KEYS as $key) {
            $this->assertArrayHasKey(
                $key,
                $group,
            );
        }
    }
}
