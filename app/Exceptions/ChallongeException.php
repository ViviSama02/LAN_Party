<?php

namespace App\Exceptions;

use App\Challonge;
use Exception;
use Throwable;

class ChallongeException extends Exception
{
    protected $errors;

    public function __construct(array $errors, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(join('; ', $errors), $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
