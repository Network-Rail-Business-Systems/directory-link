<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Eloquent\Model;
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

        /** @var class-string<Model> $localModelClass */
        $localModelClass = config("directory-link.models.$type.local");
        $total = $localModelClass::query()->count();

        /** @var class-string<DirectoryModel> $directoryModelClass */
        $directoryModelClass = config("directory-link.models.$type.directory");

        $progressBar = $this->output->createProgressBar($total);

        $localModelClass::query()
            ->each(function ($localModel) use ($progressBar, $directoryModelClass, $field) {
                /** @var SyncsWithDirectory $localModel */

                $this->info("Updating \"{$localModel->$field}\"...");

                $directoryModel = $directoryModelClass::get($localModel->$field, $field);

                if ($directoryModel !== null) {
                    $localModel->processDirectoryDetails($directoryModel);
                    $localModel->updateWithDirectoryDetails($directoryModel);
                }

                $progressBar->advance();
            });

        $progressBar->finish();

        /** @var class-string<SyncsWithDirectory> $localModelClass */
        $localModelClass::importFromDirectory($field);

        $this->info('Complete!');
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'type' => function () {
                return $this->choice(
                    'Which type of model do you want to refresh?',
                    array_keys(
                        config('directory-link.sync'),
                    ),
                );
            },
        ];
    }
}
