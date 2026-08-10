<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryUser;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class GetTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(
            DirectoryUser::class,
            DirectoryUser::get('a'),
        );
    }

    public function testWhenMissing(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertNull(
            DirectoryUser::get('a'),
        );
    }
}
