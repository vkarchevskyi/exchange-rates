<?php

declare(strict_types=1);

namespace Vkarchevskyi\ExchangeRates\Exceptions;

use RuntimeException;
use Throwable;

final class ApiException extends RuntimeException
{
    public function __construct(
        string $body,
        int $statusCode,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            sprintf("Could not fetch the data from bank API. Status code: %s. Body: %s.", $statusCode, $body),
            $code,
            $previous
        );
    }
}
