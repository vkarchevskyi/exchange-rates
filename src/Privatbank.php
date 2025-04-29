<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use JsonException;
use Vkarchevskyi\ExchangeRates\Exceptions\ApiException;
use Vkarchevskyi\ExchangeRates\Interfaces\BankInterface;
use Vkarchevskyi\ExchangeRates\Repositories\PrivatbankRepository;
use Vkarchevskyi\ExchangeRates\Resources\API\Privatbank\PrivatbankApiRateResource;
use Vkarchevskyi\ExchangeRates\Resources\API\PrivatbankApiResource;
use Vkarchevskyi\ExchangeRates\Resources\ExchangeRateResource;

final readonly class Privatbank implements BankInterface
{
    public function __construct(private PrivatbankRepository $repository)
    {
    }

    /**
     * @inheritDoc
     * @return PrivatbankApiResource
     * @throws ConnectionException
     * @throws ApiException
     * @throws JsonException
     */
    public function rates(array $currencies): array
    {
        return (new Collection($this->repository->getData()->exchangeRate))
            ->filter(
                static fn (PrivatbankApiRateResource $rate): bool => in_array($rate->currency, $currencies, true)
            )
            ->map(
                static fn (PrivatbankApiRateResource $rate): ExchangeRateResource => new ExchangeRateResource(
                    $rate->currency,
                    $rate->baseCurrency,
                    $rate->purchaseRate,
                    $rate->saleRate
                )
            )
            ->all();
    }
}
