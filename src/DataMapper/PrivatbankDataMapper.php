<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\DataMapper;

use JsonException;
use Vkarchevskyi\ExchangeRates\Resources\API\Privatbank\PrivatbankApiRateResource;
use Vkarchevskyi\ExchangeRates\Resources\API\PrivatbankApiResource;

final readonly class PrivatbankDataMapper
{
    /**
     * @throws JsonException
     */
    public function map(string $body): PrivatbankApiResource
    {
        /** @var PrivatbankApiResource $data */
        $data = json_decode($body, flags: JSON_THROW_ON_ERROR);

        return new PrivatbankApiResource(
            $data->date,
            $data->bank,
            $data->baseCurrency,
            $data->baseCurrencyLit,
            array_map(
                static fn (object $rate): PrivatbankApiRateResource => new PrivatbankApiRateResource(
                    $rate->baseCurrency,
                    $rate->currency,
                    $rate->saleRateNB,
                    $rate->purchaseRateNB,
                    $rate->saleRate ?? null,
                    $rate->purchaseRate ?? null,
                ),
                $data->exchangeRate
            ),
        );
    }
}
