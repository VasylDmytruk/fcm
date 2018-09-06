<?php

namespace autoxloo\fcm\message;

use autoxloo\fcm\exceptions\EmptyValueException;
use autoxloo\fcm\message\android\AndroidConfig;
use autoxloo\fcm\message\apns\ApnsConfig;
use autoxloo\fcm\message\web\WebpushConfig;
use autoxloo\fcm\message\target\Target;

/**
 * Class Message Represents Message to send by Firebase Cloud Messaging Service.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages
 */
class Message implements \JsonSerializable
{
    const FIELD_NAME = 'name';
    const FIELD_DATA = 'data';
    const FIELD_NOTIFICATION = 'notification';
    const FIELD_ANDROID = 'android';
    const FIELD_WEBPUSH = 'webpush';
    const FIELD_APNS = 'apns';

    /**
     * @var string
     */
    protected $name;
    /**
     * @var array
     */
    protected $data;
    /**
     * @var Notification
     */
    protected $notification;
    /**
     * @var AndroidConfig
     */
    protected $androidConfig;
    /**
     * @var WebpushConfig
     */
    protected $webpushConfig;
    /**
     * @var ApnsConfig
     */
    protected $apnsConfig;
    /**
     * @var Target
     */
    protected $target;


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     * @throws EmptyValueException
     */
    public function jsonSerialize()
    {
        $jsonData = [];

        if (!empty($this->name)) {
            $jsonData[self::FIELD_NAME] = $this->name;
        }

        if (!empty($this->data)) {
            $jsonData[self::FIELD_DATA] = $this->data;
        }

        if ($this->notification) {
            $jsonData[self::FIELD_NOTIFICATION] = $this->notification;
        }

        if ($this->androidConfig) {
            $jsonData[self::FIELD_ANDROID] = $this->androidConfig;
        }

        if ($this->webpushConfig) {
            $jsonData[self::FIELD_WEBPUSH] = $this->webpushConfig;
        }

        if ($this->apnsConfig) {
            $jsonData[self::FIELD_APNS] = $this->apnsConfig;
        }

        if ($this->target === null) {
            throw new EmptyValueException('Field target can not be null');
        }
        $target = $this->target->getTargetKeyValue();
        $jsonData = array_merge($jsonData, $target);

        return $jsonData;
    }

    /**
     * @param string $name
     * @return Message
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param array $data
     * @return Message
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param Notification $notification
     * @return Message
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @param AndroidConfig $androidConfig
     * @return Message
     */
    public function setAndroidConfig($androidConfig)
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    /**
     * @param WebpushConfig $webpushConfig
     * @return Message
     */
    public function setWebpushConfig($webpushConfig)
    {
        $this->webpushConfig = $webpushConfig;

        return $this;
    }

    /**
     * @param ApnsConfig $apnsConfig
     * @return Message
     */
    public function setApnsConfig($apnsConfig)
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }
}