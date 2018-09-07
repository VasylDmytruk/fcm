<?php

namespace autoxloo\fcm\message\apns;

use autoxloo\fcm\traits\FieldKeys;

/**
 * Class ApnsConfig Represents object ApnsConfig of FCM resource Message.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#ApnsConfig
 * @since 1.0.1
 */
class ApnsConfig implements \JsonSerializable
{
    use FieldKeys;

    const FIELD_HEADERS = 'headers';
    const FIELD_PAYLOAD = 'payload';

    /**
     * @var array Map (key: string, value: string)
     * HTTP request headers defined in Apple Push Notification Service.
     * Refer to APNs request headers for supported headers, e.g. "apns-priority": "10".
     * @see https://goo.gl/C6Yhia
     * An object containing a list of "key": value pairs. Example: { "name": "wrench", "mass": "1.3kg", "count": "3" }.
     */
    protected $headers = [];
    /**
     * @var array APNs payload as a Map (key: string, value: string), including both aps dictionary and custom payload.
     * See Payload Key Reference.
     * @see https://goo.gl/32Pl5W
     * If present, it overrides [[autoxloo\fcm\message\Notification::title]]
     * and [[autoxloo\fcm\message\Notification::body]].
     * @see \autoxloo\fcm\message\NotificationNotification::$title
     * @see \autoxloo\fcm\message\NotificationNotification::$body
     */
    protected $payload = [];


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     * @throws \ReflectionException
     */
    public function jsonSerialize()
    {
        return $this->getFieldsMap();
    }
}
