<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryGroup;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class MakeTest extends TestCase
{
    protected DirectoryGroup $group;

    protected array $expected;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expected = $this->directoryFakeGroup(false);
        $this->group = DirectoryGroup::make($this->expected);
    }

    public function test(): void
    {
        foreach ($this->expected as $field => $value) {
            $this->assertEquals(
                $value,
                $this->group->$field,
            );
        }
    }
}
