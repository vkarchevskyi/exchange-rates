<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Data;

final class MonobankApiResource
{
    private int $currencyCodeA;
    private int $currencyCodeB;
    private int $date;
    private ?float $rateSell;
    private ?float $rateBuy;
    private ?float $rateCross;

    public function getCurrencyCodeA(): int
    {
        return $this->currencyCodeA;
    }

    public function setCurrencyCodeA(int $currencyCodeA): void
    {
        $this->currencyCodeA = $currencyCodeA;
    }

    public function getCurrencyCodeB(): int
    {
        return $this->currencyCodeB;
    }

    public function setCurrencyCodeB(int $currencyCodeB): void
    {
        $this->currencyCodeB = $currencyCodeB;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): void
    {
        $this->date = $date;
    }

    public function getRateSell(): ?float
    {
        return $this->rateSell;
    }

    public function setRateSell(?float $rateSell): void
    {
        $this->rateSell = $rateSell;
    }

    public function getRateBuy(): ?float
    {
        return $this->rateBuy;
    }

    public function setRateBuy(?float $rateBuy): void
    {
        $this->rateBuy = $rateBuy;
    }

    public function getRateCross(): ?float
    {
        return $this->rateCross;
    }

    public function setRateCross(?float $rateCross): void
    {
        $this->rateCross = $rateCross;
    }
}
