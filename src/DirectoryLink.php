<?php

namespace NetworkRailBusinessSystems\DirectoryLink;

use Illuminate\Pagination\LengthAwarePaginator;
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
        $response = config('directory-link.emulator.enabled') === true
            ? DirectoryLink::emulateResult($endpoint, $term, $field)
            : Http::withOptions([
                'proxy' => config('directory-link.api.proxy'),
            ])
                ->withToken(
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
                ->json() ?? [];

        if (
            array_key_exists('error', $response) === true
            || array_key_exists('exception', $response) === true
        ) {
            throw new DirectoryLinkException(
                $response['error'] ?? $response['message'],
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

    public static function emulateResult(
        string $endpoint,
        string $term,
        string $field,
    ): array {
        $directory = match (true) {
            str_contains($endpoint, 'group') => config('directory-link.emulator.groups'),
            str_contains($endpoint, 'user') => config('directory-link.emulator.users'),
            default => throw new DirectoryLinkException("\"$endpoint\" has not been set up for emulation"),
        };

        if (
            $field === 'id'
            && str_contains($endpoint, 'user/get')
        ) {
            $first = $directory[0];
            $first[$field] = $term;
            return $first;
        }

        $results = array_filter($directory, function (array $item) use ($term, $field) {
            return $item[$field] === $term;
        });

        return match (true) {
            str_contains($endpoint, 'exists') => [
                'exists' => empty($results) === false,
            ],
            str_contains($endpoint, 'get') => array_first($results) ?? [],
            default => (new LengthAwarePaginator($results, 20, 10, 1))->toArray(),
        };
    }
}
