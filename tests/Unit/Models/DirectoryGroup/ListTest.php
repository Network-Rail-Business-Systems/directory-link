<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryGroup;

use Illuminate\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ListTest extends TestCase
{
    protected LengthAwarePaginator $list;

    protected function setUp(): void
    {
        parent::setUp();

        $this->list = DirectoryGroup::list('a');
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            DirectoryGroup::class,
            $this->list->items()[0],
        );
    }
}
