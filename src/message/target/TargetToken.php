<?php

namespace autoxloo\fcm\message\target;

use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Class TargetToken
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Message.FIELDS.token
 * @since 1.0.1
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
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     * @throws EmptyValueException
     */
    public function getTargetKeyValue()
    {
        if (!is_string($this->token)) {
            throw new \UnexpectedValueException('Field "token" should be a string');
        }
        if (empty($this->token)) {
            throw new EmptyValueException('Field "token" can not be empty');
        }

        return [self::TARGET_KEY => $this->token];
    }
}
