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
            DirectoryUser::get('gandalf.stormcrow@networkrail.co.uk'),
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
