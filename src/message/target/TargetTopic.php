<?php

namespace autoxloo\fcm\message\target;

use autoxloo\fcm\exceptions\EmptyValueException;

/**
 * Class TargetTopic
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Message.FIELDS.topic
 * @since 1.0.1
 */
class TargetTopic implements Target
{
    const TARGET_KEY = 'topic';
    /**
     * Topic regex pattern.
     * @see https://firebase.google.com/docs/cloud-messaging/send-message#send_messages_to_topics
     */
    const TOPIC_PATTERN = '/[a-zA-Z0-9-_.~%]+/';    // maybe should add ^ to the begin and $ to the end of pattern

    /**
     * @var string Topic name to send a message to, e.g. "weather". Note: "/topics/" prefix should not be provided.
     */
    protected $topic;


    /**
     * TargetTopic constructor.
     *
     * @param string $topic Topic name to send a message to, e.g. "weather".
     * >Note: "/topics/" prefix should not be provided.
     *
     * @throws EmptyValueException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function __construct($topic)
    {
        if (!is_string($topic)) {
            throw new \UnexpectedValueException('Field "topic" has to be a string');
        }
        if (empty($topic)) {
            throw new EmptyValueException('Field "topic" can not be empty');
        }
        if (!preg_match(self::TOPIC_PATTERN, $topic)) {
            throw new \InvalidArgumentException(
                'Field "topic" has to be a string that matches the regular expression: "' . self::TOPIC_PATTERN . '"'
            );
        }

        $this->topic = $topic;
    }

    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     */
    public function getTargetKeyValue()
    {
        return [self::TARGET_KEY => $this->topic];
    }
}
