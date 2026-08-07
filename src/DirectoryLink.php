<?php

namespace NetworkRailBusinessSystems\DirectoryLink;

use NetworkRailBusinessSystems\DirectoryLink\Exceptions\DirectoryLinkException;

class DirectoryLink
{
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

        throw new DirectoryLinkException("$modelClass is not configured for directory syncing");
    }
}
