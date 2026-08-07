<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Interfaces;

interface SyncsWithDirectory
{
    /** Find or create a local model, fill it with details from the directory, and save */
    public static function importFromDirectory(string $term): static;

    /** Perform any processing of the directory details prior to applying them */
    public function processDirectoryDetails(DirectoryModel $model): static;

    /** Update the local model with details from the directory */
    public function updateWithDirectoryDetails(DirectoryModel $model): static;
}
