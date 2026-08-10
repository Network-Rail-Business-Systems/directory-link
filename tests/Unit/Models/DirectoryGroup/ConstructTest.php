<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryGroup;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected DirectoryGroup $group;

    protected function setUp(): void
    {
        parent::setUp();

        $this->group = new DirectoryGroup(
            'abc123',
            'a@b.com',
            'Gabba',
            'Hey',
            [1, 2, 3],
        );
    }

    public function test(): void
    {
        $this->assertEquals(
            3,
            $this->group->membersCount,
        );
    }
}
