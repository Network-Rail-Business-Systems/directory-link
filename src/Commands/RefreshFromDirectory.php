<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\SyncsWithDirectory;

class RefreshFromDirectory extends Command implements PromptsForMissingInput
{
    protected $signature = 'directory-link:refresh {type} {field?}';

    protected $description = 'Refresh all local models using the directory';

    public function handle(): void
    {
        $type = $this->argument('type');
        $field = $this->argument('field');

        if ($field === null) {
            $field = config("directory-link.sync.$type.on");
        }

        $this->info("Starting $type refresh using \"$field\"...");

        /** @var class-string<SyncsWithDirectory> $localModelClass */
        $localModelClass = config("directory-link.models.$type.local");

        /** @var class-string<DirectoryModel> $localModelClass */
        $directoryModelClass = config("directory-link.models.$type.directory");

        $localModelClass::query()
            ->each(function (SyncsWithDirectory $localModel) use ($directoryModelClass, $field) {
                $this->info("Updating {$localModel->$field}...");

                $directoryModel = $directoryModelClass::get($localModel->$field, $field);

                if ($directoryModel !== false) {
                    $localModel->processDirectoryDetails($directoryModel);
                    $localModel->updateWithDirectoryDetails($directoryModel);
                }
            });

        $localModelClass::importFromDirectory($field);

        $this->info('Complete!');
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'type' => [
                'label' => 'Which type of model do you want to import?',
                'options' => array_keys(
                    config('directory-link.sync'),
                ),
            ],
        ];
    }
}
