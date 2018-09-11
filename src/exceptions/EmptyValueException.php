<?php

namespace autoxloo\fcm\exceptions;

use Throwable;

/**
 * Class EmptyValueException
 * @since 1.0.1
 */
class EmptyValueException extends \Exception
{
    /**
     * EmptyValueException constructor.
     * 
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Empty Value', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
