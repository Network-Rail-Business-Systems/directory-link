<?php


namespace NetworkRailBusinessSystems\Entra\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;

class DirectoryGroup implements DirectoryModel
{
    // Setup
    public function __construct(
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

    // API
    public static function exists(
        string $term,
        string $field = 'email',
    ): bool {
        // TODO: Implement exists() method.
    }

    public static function get(
        string $term,
        string $field = 'email',
    ): static {
        // TODO: Implement get() method.
    }

    public static function list(
        string $term,
        string $field = 'email',
        int $page = 1,
        int $per = 10,
        string $sort = 'email',
        string $order = 'asc',
    ): LengthAwarePaginator {
        // TODO: Implement list() method.
    }
}
