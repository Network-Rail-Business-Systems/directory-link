<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryUser;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ExistsTest extends TestCase
{
    public function test(): void
    {
        $this->assertTrue(
            DirectoryUser::exists('gandalf.stormcrow@networkrail.co.uk'),
        );
    }
}
