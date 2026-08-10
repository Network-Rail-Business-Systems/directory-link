<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryUser;

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class MakeTest extends TestCase
{
    protected DirectoryUser $user;

    protected array $expected;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expected = $this->directoryFakeUser(false);
        $this->user = DirectoryUser::make($this->expected);
    }

    public function test(): void
    {
        foreach ($this->expected as $field => $value) {
            $this->assertEquals(
                $value,
                $this->user->$field,
            );
        }
    }
}
