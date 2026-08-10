<?php

namespace NetworkRailBusinessSystems\DirectoryLink;

use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;

class DirectoryLink
{
    // API
    public static function query(
        string $endpoint,
        string $term,
        string $field,
        ?int $page = null,
        ?int $per = null,
        ?string $sort = null,
        ?string $order = null,
    ): array {
        $response = Http::withToken(
            config('directory-link.api.token'),
        )
            ->acceptJson()
            ->query(
                config('directory-link.api.endpoint') . $endpoint,
                [
                    'field' => $field,
                    'order' => $order,
                    'page' => $page,
                    'per' => $per,
                    'sort' => $sort,
                    'term' => $term,
                ],
            )
            ->json();

        if (array_key_exists('error', $response) === true) {
            throw new DirectoryLinkException(
                $response['error'],
                $response['status'] ?? 500,
            );
        }

        return $response;
    }

    // Utilities
    public static function getModelType(string $modelClass): string
    {
        $modelTypes = config('directory-link.models');

        foreach ($modelTypes as $type => $models) {
            if (
                $models['local'] === $modelClass
                || $models['directory'] === $modelClass
            ) {
                return $type;
            }
        }

        throw new DirectoryLinkException("\"$modelClass\" is not configured for directory syncing");
    }
}
