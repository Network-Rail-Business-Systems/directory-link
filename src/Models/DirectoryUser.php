<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;

class DirectoryUser implements DirectoryModel
{
    // Setup
    public function __construct(
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

    // API
    public static function exists(
        string $term,
        string $field = 'email'
    ): bool {
        // TODO: Implement exists() method.
    }

    public static function get(
        string $term,
        string $field = 'email',
    ): static {
        // Get and return user
    }

    public static function list(
        string $term,
        string $field = 'email',
        int $page = 1,
        int $per = 10,
        string $sort = 'email',
        string $order = 'asc',
    ): LengthAwarePaginator {
        // Poll directory
        // Return paginated results
    }
}
