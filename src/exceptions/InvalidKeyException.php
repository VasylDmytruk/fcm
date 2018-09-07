<?php

namespace autoxloo\fcm\exceptions;

use Throwable;

/**
 * Class InvalidKeyException
 */
class InvalidKeyException extends \Exception
{
    /**
     * InvalidKeyException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Invalid Key', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
