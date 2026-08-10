<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class QueryTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            [
                'exists' => true,
            ],
            DirectoryLink::query('/user/exists', 'a', 'a'),
        );
    }

    public function testThrows(): void
    {
        $this->expectException(DirectoryLinkException::class);
        $this->expectExceptionMessage('Bad wolf');

        $this->directoryShouldFail('Bad wolf');

        DirectoryLink::query('/user/exists', 'a', 'a');
    }
}
