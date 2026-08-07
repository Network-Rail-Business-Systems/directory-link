<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Traits;

use Illuminate\Database\Eloquent\Model;
use NetworkRailBusinessSystems\DirectoryLink\DirectoryLink;
use NetworkRailBusinessSystems\DirectoryLink\Exceptions\NotInDirectoryException;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\SyncsWithDirectory;

/**
 * @implements SyncsWithDirectory<Model>
 * @mixin Model
 */
trait UsesDirectory
{
    public static function importFromDirectory(string $term): static
    {
        $type = DirectoryLink::getModelType(static::class);
        $on = config("directory-link.sync.$type.on");

        /** @var class-string<DirectoryModel> $directoryModelClass */
        $directoryModelClass = config("directory-link.models.$type.directory");
        $directoryModel = $directoryModelClass::get($term, $on);

        if ($directoryModel === false) {
            throw new NotInDirectoryException("$term could not be found in the directory");
        }

        return static::query()
            ->where($on, '=', $term)
            ->firstOrNew()
            ->processDirectoryDetails($directoryModel)
            ->updateWithDirectoryDetails($directoryModel);
    }

    public function processDirectoryDetails(DirectoryModel $model): static
    {
        return $this;
    }

    public function updateWithDirectoryDetails(DirectoryModel $model): static
    {
        $type = DirectoryLink::getModelType(static::class);
        $mapping = config("directory-link.sync.$type.attributes");

        foreach ($mapping as $directoryKey => $localKey) {
            $this->$localKey = $model->$directoryKey;
        }

        $this->save();

        return $this;
    }
}
