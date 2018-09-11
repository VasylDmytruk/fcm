<?php

namespace autoxloo\fcm\message\target;

use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Class TargetCondition
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Message.FIELDS.condition
 * @since 1.0.1
 */
class TargetCondition implements Target
{
    const TARGET_KEY = 'condition';

    /**
     * @var string Condition to send a message to, e.g. "'foo' in topics && 'bar' in topics".
     */
    protected $condition;


    /**
     * TargetCondition constructor.
     *
     * @param string $condition Condition to send a message to, e.g. "'foo' in topics && 'bar' in topics".
     *
     * @throws EmptyValueException
     * @throws \UnexpectedValueException
     */
    public function __construct($condition)
    {
        if (!is_string($condition)) {
            throw new \UnexpectedValueException('Field "condition" should be a string');
        }
        if (empty($condition)) {
            throw new EmptyValueException('Field "condition" can not be empty');
        }

        $this->condition = $condition;
    }

    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     */
    public function getTargetKeyValue()
    {
        return [self::TARGET_KEY => $this->condition];
    }
}
