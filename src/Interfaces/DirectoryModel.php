<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DirectoryModel
{
    public static function make(array $data): static;

    public static function exists(
        string $term,
        string $field = 'email',
    ): bool;

    public static function get(
        string $term,
        string $field = 'email',
    ): static|false;

    public static function list(
        string $term,
        string $field = 'email',
        int $page = 1,
        int $per = 10,
        string $sort = 'email',
        string $order = 'asc',
    ): LengthAwarePaginator;
}
