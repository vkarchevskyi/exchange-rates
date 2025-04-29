<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Date;
use Throwable;
use Vkarchevskyi\ExchangeRates\DataMapper\PrivatbankDataMapper;
use Vkarchevskyi\ExchangeRates\Resources\API\PrivatbankApiResource;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Service\FetchService;

final readonly class PrivatbankRepository
{
    public function __construct(private FetchService $fetch, private PrivatbankDataMapper $dataMapper)
    {
    }

    /**
     * @return PrivatbankApiResource
     * @throws ConnectionException
     * @throws Throwable
     * @throws ApiException
     */
    public function getData(): PrivatbankApiResource
    {
        $endpoint = sprintf(
            '%s?date=%s',
            Config::string('exchange-rates.banks.privatbank.endpoint'),
            Date::now()->format('d.m.Y')
        );

        return $this->dataMapper->map($this->fetch->run($endpoint));
    }
}
