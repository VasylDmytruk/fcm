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
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Gets FCM target key (token, topic, condition) and it value.
     *
     * @return array Map (key: string, value: string)
     * @throws EmptyValueException
     */
    public function getTargetKeyValue()
    {
        if (!is_string($this->topic)) {
            throw new \UnexpectedValueException('Field "topic" should be a string');
        }
        if (empty($this->topic)) {
            throw new EmptyValueException('Field "topic" can not be empty');
        }
        if (!preg_match(self::TOPIC_PATTERN, $this->topic)) {
            throw new \InvalidArgumentException(
                'Field "topic" should be string that matches the regular expression: "' . self::TOPIC_PATTERN . '"'
            );
        }

        return [self::TARGET_KEY => $this->topic];
    }
}
