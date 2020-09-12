<?php

namespace Alan\Structure\Exception;

use Exception;
use Throwable;

class CircularListException extends Exception
{
    public function __construct($node = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct("The list is circular. {$node}", $code, $previous);
    }

    protected $message = 'The list is circular';
}
