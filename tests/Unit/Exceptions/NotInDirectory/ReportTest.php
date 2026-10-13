<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Exceptions\NotInDirectory;

use NetworkRailBusinessSystems\DirectoryLink\Exceptions\NotInDirectoryException;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ReportTest extends TestCase
{
    protected NotInDirectoryException $exception;

    public function test(): void
    {
        $this->exception = new NotInDirectoryException();

        $this->assertNull(
            $this->exception->report(),
        );
    }
}
