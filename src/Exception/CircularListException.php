<?php
/**
 * The file is part of the data-structure.
 *
 * (c) alan <alan1766447919@gmail.com>.
 *
 * 2020/9/13 12:05 下午
 */

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
