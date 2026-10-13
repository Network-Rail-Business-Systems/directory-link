<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Exceptions\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ReportTest extends TestCase
{
    protected DirectoryLinkException $exception;

    public function testFalseWhen500(): void
    {
        $this->exception = new DirectoryLinkException('', 500);

        $this->assertFalse(
            $this->exception->report(),
        );
    }

    public function testNullWhenNot(): void
    {
        $this->exception = new DirectoryLinkException('', 404);

        $this->assertNull(
            $this->exception->report(),
        );
    }
}
