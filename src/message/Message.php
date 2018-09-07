<?php

namespace autoxloo\fcm\message;

use autoxloo\fcm\exceptions\EmptyValueException;
use autoxloo\fcm\FCMFacade;
use autoxloo\fcm\message\android\AndroidConfig;
use autoxloo\fcm\message\apns\ApnsConfig;
use autoxloo\fcm\message\target\Target;
use autoxloo\fcm\message\web\WebpushConfig;
use autoxloo\fcm\traits\FieldKeys;

/**
 * Class Message Represents Message to send by Firebase Cloud Messaging Service.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages
 */
class Message implements \JsonSerializable
{
    use FieldKeys;

    const FIELD_NAME = 'name';
    const FIELD_DATA = 'data';
    const FIELD_NOTIFICATION = 'notification';
    const FIELD_ANDROID = 'android';
    const FIELD_WEBPUSH = 'webpush';
    const FIELD_APNS = 'apns';
    const FIELD_TOKEN = 'token';
    const FIELD_TOPIC = 'topic';
    const FIELD_CONDITION = 'condition';

    const KEY_FIELD_MESSAGE = 'message';

    /**
     * @var string The identifier of the message sent.
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Message.FIELDS.name
     */
    protected $name;
    /**
     * @var array Map (key: string, value: string)
     * Arbitrary key/value payload.
     * An object containing a list of "key": value pairs. Example: { "name": "wrench", "mass": "1.3kg", "count": "3" }.
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Message.FIELDS.data
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
     * @var string Registration token to send a message to.
     */
    protected $token;
    /**
     * @var string Topic name to send a message to, e.g. "weather". Note: "/topics/" prefix should not be provided.
     */
    protected $topic;
    /**
     * @var string Condition to send a message to, e.g. "'foo' in topics && 'bar' in topics".
     */
    protected $condition;
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

        $target = $this->getTargetData();
        $jsonData = array_merge($jsonData, $target);

        $jsonDataToReturn = [self::KEY_FIELD_MESSAGE => $jsonData];

        return $jsonDataToReturn;
    }

    /**
     * Gets initialized Target data.
     *
     * @return array Map (key: string, value: string)
     *
     * @throws EmptyValueException
     */
    protected function getTargetData()
    {
        if (!empty($this->token)) {
            $this->target = FCMFacade::createTargetToken($this->token);
        } elseif (!empty($this->topic)) {
            $this->target = FCMFacade::createTargetTopic($this->topic);
        } elseif (!empty($this->condition)) {
            $this->target = FCMFacade::createTargetCondition($this->condition);
        } elseif ($this->target === null) {
            throw new EmptyValueException('Field target can not be null');
        }

        $targetData = $this->target->getTargetKeyValue();

        return $targetData;
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
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param Notification $notification
     * @return Message
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * @param AndroidConfig $androidConfig
     * @return Message
     */
    public function setAndroidConfig(AndroidConfig $androidConfig)
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    /**
     * @param WebpushConfig $webpushConfig
     * @return Message
     */
    public function setWebpushConfig(WebpushConfig $webpushConfig)
    {
        $this->webpushConfig = $webpushConfig;

        return $this;
    }

    /**
     * @param ApnsConfig $apnsConfig
     * @return Message
     */
    public function setApnsConfig(ApnsConfig $apnsConfig)
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }

    /**
     * @param Target $target
     * @return Message
     */
    public function setTarget(Target $target)
    {
        $this->target = $target;

        return $this;
    }
}
