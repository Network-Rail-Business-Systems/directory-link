<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Traits\AssertsDirectory;

use Illuminate\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class DirectoryFakeListTest extends TestCase
{
    public const array EXPECTED_KEYS = [
        'id',
        'mail',
        'displayName',
        'description',
        'members',
        'membersCount',
    ];

    public function test(): void
    {
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $this->directoryFakeList([]),
        );
    }
}
