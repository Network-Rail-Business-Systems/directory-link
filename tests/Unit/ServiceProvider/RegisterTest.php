<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\ServiceProvider;

use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test(): void
    {
        $this->assertTrue(
            config()->has('directory-link'),
        );
    }
}
