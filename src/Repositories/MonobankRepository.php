<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use JsonException;
use Vkarchevskyi\ExchangeRates\Resources\MonobankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

/**
 * @see https://monobank.ua/api-docs/monobank/publichni-dani/get--bank--currency
 */
final readonly class MonobankRepository
{
    public function __construct(private FetchService $fetch)
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
        /** @var list<object> $decodedData */
        $decodedData = json_decode(
            $this->fetch->run(Config::string('exchange-rates.banks.monobank.endpoint')),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        /** @var Collection<int, MonobankApiResource> $dataCollection */
        $dataCollection = MonobankApiResource::collect($decodedData, Collection::class);

        return $dataCollection->all();
    }
}
