<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryGroup;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class GetTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            DirectoryGroup::class,
            DirectoryGroup::get('a'),
        );
    }

    public function testWhenMissing(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertNull(
            DirectoryGroup::get('a'),
        );
    }
}
