<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class DirectoryShouldFailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->directoryShouldFail('Bad wolf');
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->directoryShouldFail,
        );

        $this->assertEquals(
            'Bad wolf',
            $this->directoryError,
        );
    }
}
