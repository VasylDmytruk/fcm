<?php

namespace autoxloo\fcm\message\web;

use autoxloo\fcm\traits\FieldKeys;

/**
 * Class WebpushConfig Represents object WebpushConfig of FCM resource Message.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#WebpushConfig
 * @since 1.0.1
 */
class WebpushConfig implements \JsonSerializable
{
    use FieldKeys;

    const FILED_HEADERS = 'headers';
    const FILED_DATA = 'data';
    const FILED_NOTIFICATION = 'notification';
    const FILED_FCM_OPTIONS = 'fcm_options';

    /**
     * @var array Map (key: string, value: string)
     * HTTP headers defined in webpush protocol. Refer to Webpush protocol for supported headers, e.g. "TTL": "15".
     * An object containing a list of "key": value pairs. Example: { "name": "wrench", "mass": "1.3kg", "count": "3" }.
     * @see https://tools.ietf.org/html/rfc8030#section-5
     */
    protected $headers = [];
    /**
     * @var array Map (key: string, value: string)
     * Arbitrary key/value payload. If present, it will override [[Message::data]].
     * An object containing a list of "key": value pairs. Example: { "name": "wrench", "mass": "1.3kg", "count": "3" }.
     * @see Message::$data
     */
    protected $data = [];
    /**
     * @var array Web Notification options as a map (key: string, value: string).
     * Supports Notification instance properties as defined in Web Notification API.
     * @see https://developer.mozilla.org/en-US/docs/Web/API/Notification
     * If present, "title" and "body" fields override [[Notification::title]] and [[Notification::body]].
     * @see Notification::$title
     * @see Notification::$body
     */
    protected $notification = [];
    /**
     * @var WebpushFcmOptions
     */
    protected $fcm_options;


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
