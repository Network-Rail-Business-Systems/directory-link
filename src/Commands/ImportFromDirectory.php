<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\SyncsWithDirectory;

class ImportUser extends Command implements PromptsForMissingInput
{
    protected $signature = 'directory-link:import {type} {term}';

    protected $description = 'Import a model from the directory';

    public function handle(): void
    {
        $type = $this->argument('type');
        $term = $this->argument('term');

        $this->info("Attempting to import $type \"$term\"...");

        /** @var class-string<SyncsWithDirectory> $localModelClass */
        $localModelClass = config("directory-link.models.$type.local");
        $localModelClass::importFromDirectory($term);

        $this->info('Complete!');
    }

    /** @return array|array[]|string[] */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'type' => [
                'label' => 'Which type of model do you want to import?',
                'options' => array_keys(
                    config('directory-link.sync'),
                ),
            ],
            'term' => 'What term should be used to find the model to import?',
        ];
    }
}
