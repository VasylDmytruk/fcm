<?php

namespace autoxloo\fcm\message\target;

use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Class TargetCondition
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
     */
    public function __construct($condition)
    {
        if (!is_string($condition)) {
            throw new \InvalidArgumentException('Argument "$condition" should be a string');
        }
        if (empty($condition)) {
            throw new EmptyValueException('Argument "$condition" can not be empty');
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