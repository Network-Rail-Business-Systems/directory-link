<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Traits;

use AnthonyEdmonds\LaravelTestingTraits\UsesFaker;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;

trait AssertsDirectory
{
    use UsesFaker;

    public bool $directoryShouldFail = false;

    public bool $directoryShouldReturnEmpty = false;

    public string $directoryError = '';

    public function useDirectoryEmulator(): void
    {
        Http::fake(function (Request $request) {
            if ($this->directoryShouldFail === true) {
                return $this->directoryHttpResponse([
                    'error' => $this->directoryError,
                    'status' => 500,
                ]);
            }

            $url = $request->url();

            if ($this->directoryShouldReturnEmpty === true) {
                return match (true) {
                    str_contains($url, 'exists') => $this->directoryHttpResponse([
                        'exists' => false,
                    ]),
                    str_contains($url, 'list') => $this->directoryHttpResponse(
                        $this->directoryFakeList([]),
                    ),
                    default => $this->directoryHttpResponse([]),
                };
            }

            return match (true) {
                str_contains($url, 'group/exists'),
                str_contains($url, 'user/exists') => $this->directoryHttpResponse([
                    'exists' => true,
                ]),
                str_contains($url, 'group/get') => $this->directoryHttpResponse(
                    $this->directoryFakeGroup(false),
                ),
                str_contains($url, 'group/list') => $this->directoryHttpResponse(
                    $this->directoryFakeList([
                        $this->directoryFakeGroup(false),
                    ]),
                ),
                str_contains($url, 'user/get') => $this->directoryHttpResponse(
                    $this->directoryFakeUser(false),
                ),
                str_contains($url, 'user/list') => $this->directoryHttpResponse(
                    $this->directoryFakeList([
                        $this->directoryFakeUser(false),
                    ]),
                ),
                default => $this->directoryHttpResponse([
                    'error' => "\"$url\" is not a supported directory endpoint",
                    'status' => 500,
                ]),
            };
        });
    }

    public function directoryShouldFail(
        string $error = 'Invalid access token',
    ): void {
        $this->directoryShouldFail = true;
        $this->directoryError = $error;
    }

    public function directoryShouldReturnEmpty(): void
    {
        $this->directoryShouldReturnEmpty = true;
    }

    public function directoryFakeGroup(bool $model = true): DirectoryGroup|array
    {
        $faker = $this->faker();

        $data = [
            'id' => $faker->uuid(),
            'mail' => $faker->email(),
            'displayName' => $faker->name(),
            'description' => $faker->paragraph(1, false),
            'members' => [
                $faker->email(),
                $faker->email(),
                $faker->email(),
            ],
            'membersCount' => $faker->randomNumber(3),
        ];

        return $model === true
            ? DirectoryGroup::make($data)
            : $data;
    }

    public function directoryFakeList(array $list): LengthAwarePaginator
    {
        return new LengthAwarePaginator($list, 20, 10, 1);
    }

    public function directoryFakeUser(bool $model = true): DirectoryUser|array
    {
        $faker = $this->faker();

        $data = [
            'id' => $faker->uuid(),
            'mail' => $faker->email(),
            'displayName' => $faker->name(),
            'givenName' => $faker->firstName(),
            'surname' => $faker->lastName(),
            'jobTitle' => $faker->jobTitle(),
            'officeLocation' => $faker->streetAddress(),
            'phone' => $faker->phoneNumber(),
            'department' => $faker->company(),
            'employeeId' => $faker->numerify('#####'),
        ];

        return $model === true
            ? DirectoryUser::make($data)
            : $data;
    }

    protected function directoryHttpResponse(
        array|LengthAwarePaginator $properties,
        int $status = 200,
    ): PromiseInterface {
        return Http::response(
            json_encode($properties),
            $status,
        );
    }
}
