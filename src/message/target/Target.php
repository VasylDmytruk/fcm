<?php

namespace autoxloo\fcm\message\target;

use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Interface Target
 * @since 1.0.1
 */
interface Target
{
    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     *
     * @throws \UnexpectedValueException
     * @throws EmptyValueException
     */
    public function getTargetKeyValue();
}
