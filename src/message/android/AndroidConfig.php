<?php

namespace autoxloo\fcm\message\android;

use autoxloo\fcm\message\BaseFieldKeysObject;

/**
 * Class AndroidConfig Represents object AndroidConfig of FCM resource Message.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#AndroidConfig
 * @since 1.0.1
 */
class AndroidConfig extends BaseFieldKeysObject implements \JsonSerializable
{
    const FIELD_COLLAPSE_KEY = 'collapse_key';
    const FIELD_PRIORITY = 'priority';
    const FIELD_TTL = 'ttl';
    const FIELD_RESTRICTED_PACKAGE_NAME = 'restricted_package_name';
    const FIELD_DATA = 'data';
    const FIELD_NOTIFICATION = 'notification';

    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';

    /**
     * @var string An identifier of a group of messages that can be collapsed,
     * so that only the last message gets sent when delivery can be resumed.
     * A maximum of 4 different collapse keys is allowed at any given time.
     */
    protected $collapse_key;
    /**
     * @var string Message priority. Can take "NORMAL" and "HIGH" values.
     */
    protected $priority = self::PRIORITY_NORMAL;
    /**
     * @var string How long (in seconds) the message should be kept in FCM storage if the device is offline.
     * The maximum time to live supported is 4 weeks, and the default value is 4 weeks if not set.
     * Set it to 0 if want to send the message immediately.
     * In JSON format, the Duration type is encoded as a string rather than an object,
     * where the string ends in the suffix "s" (indicating seconds) and is preceded by the number of seconds,
     * with nanoseconds expressed as fractional seconds.
     * For example, 3 seconds with 0 nanoseconds should be encoded in JSON format as "3s",
     * while 3 seconds and 1 nanosecond should be expressed in JSON format as "3.000000001s".
     * The ttl will be rounded down to the nearest second.
     * A duration in seconds with up to nine fractional digits, terminated by 's'. Example: "3.5s".
     */
    protected $ttl;
    /**
     * @var string Package name of the application where the registration tokens
     * must match in order to receive the message.
     */
    protected $restricted_package_name;
    /**
     * @var array Arbitrary key/value payload. If present, it will override  [[Message::data]].
     * @see Message::$data
     */
    protected $data = [];
    /**
     * @var AndroidNotification Notification to send to android devices.
     */
    protected $notification;


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
