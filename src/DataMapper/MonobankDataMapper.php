<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\DataMapper;

use JsonException;
use Vkarchevskyi\ExchangeRates\Resources\API\MonobankApiResource;

final readonly class MonobankDataMapper
{
    /**
     * @return MonobankApiResource[]
     * @throws JsonException
     */
    public function map(string $body): array
    {
        /** @var MonobankApiResource[] $data */
        $data = json_decode($body, flags: JSON_THROW_ON_ERROR);

        return array_map(
            static fn (object $rate): MonobankApiResource => new MonobankApiResource(
                $rate->currencyCodeA,
                $rate->currencyCodeB,
                $rate->date,
                $rate->rateSell ?? null,
                $rate->rateBuy ?? null,
                $rate->rateCross ?? null,
            ),
            $data
        );
    }
}
