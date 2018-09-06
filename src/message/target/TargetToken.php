<?php

namespace autoxloo\fcm\message\target;


use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Class TargetToken
 */
class TargetToken implements Target
{
    const TARGET_KEY = 'token';

    /**
     * @var string Registration token to send a message to.
     */
    protected $token;

    /**
     * TargetToken constructor.
     *
     * @param string $token Registration token to send a message to.
     *
     * @throws EmptyValueException
     */
    public function __construct($token)
    {
        if (!is_string($token)) {
            throw new \InvalidArgumentException('Argument "$token" should be a string');
        }
        if (empty($token)) {
            throw new EmptyValueException('Argument "$token" can not be empty');
        }

        $this->token = $token;
    }

    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     */
    public function getTargetKeyValue()
    {
        return [self::TARGET_KEY => $this->token];
    }
}