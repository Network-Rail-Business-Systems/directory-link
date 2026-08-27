<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Rules;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Rules\ExistsInDirectory;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ExistsInDirectoryTest extends TestCase
{
    protected ExistsInDirectory $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new ExistsInDirectory(DirectoryUser::class);
    }

    public function testPasses(): void
    {
        $this->assertRulePasses(
            $this->rule,
            'mail',
            'gandalf.stormcrow@networkrail.co.uk',
        );
    }

    public function testFails(): void
    {
        $this->directoryShouldReturnEmpty();

        $this->assertRuleFails(
            $this->rule,
            'email',
            'a',
            'An entry with the mail "a" does not exist in the directory',
        );
    }
}
