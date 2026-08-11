<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;

class DirectoryUser implements DirectoryModel
{
    // Setup
    final public function __construct(
        public string $id,
        public string $mail,
        public string $displayName,
        public string $givenName,
        public string $surname,
        public string $jobTitle = '',
        public string $officeLocation = '',
        public string $phone = '',
        public string $department = '',
        public int $employeeId = 0,
    ) {
        //
    }

    public static function make(array $data): static
    {
        return new static(
            $data['id'],
            $data['mail'],
            $data['displayName'],
            $data['givenName'],
            $data['surname'],
            $data['jobTitle'] ?? '',
            $data['officeLocation'] ?? '',
            $data['phone'] ?? '',
            $data['department'] ?? '',
            $data['employeeId'] ?? 0,
        );
    }

    // API
    public static function exists(
        string $term,
        string $field = 'email',
    ): bool {
        return DirectoryLink::query(
            '/user/exists',
            $term,
            $field,
        )['exists'] === true;
    }

    public static function get(
        string $term,
        string $field = 'email',
    ): ?static {
        $data = DirectoryLink::query(
            '/user/get',
            $term,
            $field,
        );

        return empty($data) === false
            ? static::make($data)
            : null;
    }

    public static function list(
        string $term,
        string $field = 'email',
        int $page = 1,
        int $per = 10,
        string $sort = 'email',
        string $order = 'asc',
    ): LengthAwarePaginatorInterface {
        $data = DirectoryLink::query(
            '/user/list',
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

        // TODO URL / Path / Query
        return new LengthAwarePaginator(
            $items,
            $data['total'],
            $data['per_page'],
            $data['current_page'],
        );
    }
}
