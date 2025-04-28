<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Service;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;

final readonly class FetchService
{
    public function __construct(private Factory $http)
    {
    }

    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    public function run(string $endpoint): string
    {
        $response = $this->http->get($endpoint);
        $contents = $response->getBody()->getContents();

        if (!$response->ok()) {
            throw new ApiException($contents, $response->getStatusCode());
        }

        return $contents;
    }
}
