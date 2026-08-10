<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryGroup;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ExistsTest extends TestCase
{
    public function test(): void
    {
        $this->assertTrue(
            DirectoryGroup::exists('a'),
        );
    }
}
