<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Tests\Unit\Models\DirectoryUser;

use Illuminate\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Tests\TestCase;

class ListTest extends TestCase
{
    protected LengthAwarePaginator $list;

    protected function setUp(): void
    {
        parent::setUp();

        $this->list = DirectoryUser::list('gandalf.stormcrow@networkrail.co.uk');
    }

    public function test(): void
    {
        $this->assertInstanceOf(
            DirectoryUser::class,
            $this->list->items()[0],
        );
    }
}
