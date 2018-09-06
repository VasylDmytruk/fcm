<?php

namespace autoxloo\fcm\message\target;

/**
 * Interface Target
 */
interface Target
{
    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     */
    public function getTargetKeyValue();
}