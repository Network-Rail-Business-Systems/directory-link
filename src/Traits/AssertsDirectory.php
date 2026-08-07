<?php

namespace NetworkRailBusinessSystems\Entra\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

trait AssertsDirectory
{
    public bool $directoryShouldFail = false;

    public string $directoryError = '';

    public function useEntraEmulator(): void
    {
        Http::fake(function (Request $request) {
            if ($this->directoryShouldFail === true) {
                return $this->directoryHttpResponse([
                    'error' => $this->directoryError,
                ]);
            }

            $requestUrl = $request->url();

            $url = substr(
                $requestUrl,
                strpos(
                    $requestUrl,
                    '/',
                    -7,
                ),
            );

            return match ($url) {
                '/group/exists' => $this->directoryHttpResponse([]),
                '/group/get' => $this->directoryHttpResponse([]),
                '/group/list' => $this->directoryHttpResponse([]),
                '/user/exists' => $this->directoryHttpResponse([]),
                '/user/get' => $this->directoryHttpResponse([]),
                '/user/list' => $this->directoryHttpResponse([]),
                default => $this->directoryHttpResponse([
                    'error' => "$url is not a supported directory endpoint",
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

    protected function directoryHttpResponse(
        array $properties,
        int $status = 200,
    ): PromiseInterface {
        return Http::response(
            json_encode($properties),
            $status,
        );
    }
}
