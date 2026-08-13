<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;

class DirectoryGroup implements DirectoryModel
{
    // Setup
    final public function __construct(
        public string $id,
        public string $mail,
        public string $displayName,
        public string $description = '',
        public array $members = [],
        public int $membersCount = -1,
    ) {
        if ($this->membersCount === -1) {
            $this->membersCount = count($this->members);
        }
    }

    public static function make(array $data): static
    {
        return new static(
            $data['id'],
            $data['mail'],
            $data['displayName'],
            $data['description'] ?? '',
            $data['members'] ?? [],
            $data['membersCount'] ?? -1,
        );
    }

    // API
    public static function exists(
        string $term,
        string $field = 'mail',
    ): bool {
        return DirectoryLink::query(
            '/group/exists',
            $term,
            $field,
        )['exists'] === true;
    }

    public static function get(
        string $term,
        string $field = 'mail',
    ): ?static {
        $data = DirectoryLink::query(
            '/group/get',
            $term,
            $field,
        );

        return empty($data) === false
            ? static::make($data)
            : null;
    }

    public static function list(
        string $term,
        string $field = 'mail',
        int $page = 1,
        int $per = 10,
        string $sort = 'mail',
        string $order = 'asc',
    ): LengthAwarePaginatorInterface {
        $data = DirectoryLink::query(
            '/group/list',
            $term,
            $field,
            $page,
            $per,
            $sort,
            $order,
        );

        $items = [];
        foreach ($data['data'] as $result) {
            $items[] = static::make($result);
        }

        return new LengthAwarePaginator(
            $items,
            $data['total'],
            $data['per_page'],
            $data['current_page'],
        );
    }
}
