<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use JsonException;
use Vkarchevskyi\ExchangeRates\DataMapper\MonobankDataMapper;
use Vkarchevskyi\ExchangeRates\Resources\API\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository
{
    public function __construct(private FetchService $fetch, private MonobankDataMapper $dataMapper)
    {
    }

    /**
     * @return MonobankApiResource[]
     * @throws ConnectionException
     * @throws ApiException
     * @throws JsonException
     */
    public function getData(): array
    {
        return $this->dataMapper->map(
            $this->fetch->run(Config::string('exchange-rates.banks.monobank.endpoint'))
        );
    }
}
