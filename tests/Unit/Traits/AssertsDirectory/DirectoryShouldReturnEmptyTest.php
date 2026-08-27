<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class DirectoryShouldReturnEmptyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->directoryShouldReturnEmpty();
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->directoryShouldReturnEmpty,
        );
    }
}
