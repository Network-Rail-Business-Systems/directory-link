<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\SyncsWithDirectory;

class ImportFromDirectory extends Command implements PromptsForMissingInput
{
    protected $signature = 'directory-link:import {type} {term} {field?}';

    protected $description = 'Import a model from the directory';

    public function handle(): void
    {
        $type = $this->argument('type');
        $term = $this->argument('term');
        $field = $this->argument('field') ?? config("directory-link.sync.$type.on");

        $this->info("Attempting to import $type where \"$field\" = \"$term\"...");

        /** @var class-string<SyncsWithDirectory> $localModelClass */
        $localModelClass = config("directory-link.models.$type.local");
        $localModelClass::importFromDirectory($term, $field);

        $this->info('Complete!');
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'type' => 'Which type of Directory model do you want to import? (user, group)',
            'term' => 'What term should be used to find the model to import? (for the provided field)',
        ];
    }
}
