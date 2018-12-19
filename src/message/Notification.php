<?php

namespace autoxloo\fcm\message;

/**
 * Class Notification Represents object Notification of FCM resource Message.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Notification
 * @since 1.0.1
 */
class Notification implements \JsonSerializable
{
    const FIELD_TITLE = 'title';
    const FIELD_BODY = 'body';

    /**
     * @var string Notification title.
     */
    protected $title;
    /**
     * @var string Notification body.
     */
    protected $body;


    /**
     * Notification constructor.
     *
     * @param string $title Notification title.
     * @param string $body Notification body.
     *
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function __construct($title, $body)
    {
        if (!empty($title) && !is_string($title)) {
            throw new \UnexpectedValueException('Field "title" has to be a string, not ' . gettype($this->title));
        }
        if (!empty($body) && !is_string($body)) {
            throw new \InvalidArgumentException('Field "body" has to be a string, not ' . gettype($this->body));
        }

        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $jsonData = [
            self::FIELD_TITLE => $this->title,
            self::FIELD_BODY => $this->body,
        ];

        return $jsonData;
    }
}
