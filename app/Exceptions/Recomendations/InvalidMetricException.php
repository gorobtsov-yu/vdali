<?php

namespace App\Exceptions\Recomendations;

use Exception;
use Throwable;
use Override;

class InvalidMetricException extends Exception
{
    public function __construct(?string $message = null, ?int $limit = 0, int $code = 0, Throwable|null $previous = null)
    {
        $msg = $message ?? 'The property value must be less then '. $limit .' .';

        return parent::__construct($msg, $code, $previous);
    }
}
