<?php

namespace autoxloo\fcm;

use autoxloo\fcm\message\android\AndroidConfig;
use autoxloo\fcm\message\android\AndroidNotification;
use autoxloo\fcm\message\apns\ApnsConfig;
use autoxloo\fcm\message\Message;
use autoxloo\fcm\message\Notification;
use autoxloo\fcm\message\target\TargetCondition;
use autoxloo\fcm\message\target\TargetToken;
use autoxloo\fcm\message\target\TargetTopic;
use autoxloo\fcm\message\web\WebpushConfig;
use autoxloo\fcm\message\web\WebpushFcmOptions;

/**
 * Class FCMFasade Facade helps to create [[Message]] instance and it object fields.
 */
class FCMFacade
{
    /**
     * Creates new instance of Message. If `$messageConfig` is not empty it will be use to configure Message.
     * @see Message
     *
     * @param array $messageConfig Message config array. Default `[]` (empty array).
     * Example:
     *
     * ```
     * [
     *      // required one of: token, topic or condition
     *      Message::FIELD_TOKEN => $token, // or Message::FIELD_TOPIC => $topic or Message::FIELD_CONDITION => $condition
     *
     *      // not required values:
     *      Message::FIELD_NAME => $name,
     *      Message::FIELD_DATA => $data,
     *      Message::FIELD_NOTIFICATION => FCMFacade::createNotification($title, $body),
     *      Message::FIELD_ANDROID => FCMFacade::createAndroidConfig([
     *          AndroidConfig::FIELD_PRIORITY => AndroidConfig::PRIORITY_HIGH
     *      ]),
     * ]
     * ```
     *
     * @return Message New instance of Message.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    public static function createMessage(array $messageConfig = [])
    {
        $message = new Message();

        if (!empty($messageConfig)) {
            $message->setFields($messageConfig);
        }

        return $message;
    }

    /**
     * Creates new Notification instance.
     *
     * @param string $title Notification title.
     * @param string $body Notification body.
     *
     * @return Notification New initialized instance.
     * @see Notification
     */
    public static function createNotification($title, $body)
    {
        return new Notification($title, $body);
    }

    /**
     * Creates object of `$objectClass`, configures by calling `[[\autoxloo\fcm\traits\FieldKeys::setFields()]]` method,
     * sets to `$config[$notificationConfig]` new configured object of `$configClass`.
     * @see \autoxloo\fcm\traits\FieldKeys::setFields()
     *
     * @param string $objectClass Class name.
     * @param array $config Config of `$objectClass`.
     * @param string $configClass Notification class name.
     * @param string $configClassKey Key to be used like `$config[$notificationKey] = $notification`.
     * @param array $configClassConfig Config of `$configClass`.
     *
     * @return object|mixed Returns new configured object of `$objectClass`.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    protected static function createObjectFromConfigAndNotification(
        $objectClass,
        array $config,
        $configClass,
        $configClassKey,
        array $configClassConfig
    ) {
        $configObjcet = new $configClass();
        $configObjcet->setFields($configClassConfig);
        $config[$configClassKey] = $configObjcet;

        return static::createObjectFromConfig($objectClass, $config);
    }

    /**
     * Creates new configured object of `$objectClass`.
     * Configures by calling `[[\autoxloo\fcm\traits\FieldKeys::setFields()]]` method.
     * @see \autoxloo\fcm\traits\FieldKeys::setFields()
     *
     * @param string $objectClass Class name.
     * @param array $config Config of `$objectClass`.
     *
     * @return object|mixed Returns new configured object of `$objectClass`.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    protected static function createObjectFromConfig($objectClass, array $config)
    {
        $object = new $objectClass();
        $object->setFields($config);

        return $object;
    }

    /**
     * Creates new AndroidConfig instance and sets it fields.
     *
     * @param array $androidConfig Key value of AndroidConfig fields.
     * >Note: Keys are constant starting on AndroidConfig::FIELD_.
     * @see AndroidConfig
     * @param array $androidNotificationConfig Key value of AndroidNotification fields.
     * >Note: Keys are constant starting on AndroidNotification::FIELD_.
     * @see AndroidNotification
     *
     * @return AndroidConfig New initialized instance.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    public static function createAndroidConfig(array $androidConfig, array $androidNotificationConfig = [])
    {
        return static::createObjectFromConfigAndNotification(
            AndroidConfig::class,
            $androidConfig,
            AndroidNotification::class,
            AndroidConfig::FIELD_NOTIFICATION,
            $androidNotificationConfig
        );
    }

    /**
     * Creates new WebpushConfig instance and sets it fields.
     *
     * @param array $webpushConfig Key value of WebpushConfig fields.
     * >Note: Keys are constant starting on WebpushConfig::FIELD_.
     * @see WebpushConfig
     * @param array $webpushFcmOptionsConf Key value of WebpushFcmOptions fields.
     * >Note: Keys are constant starting on WebpushFcmOptions::FIELD_.
     * @see WebpushFcmOptions
     *
     * @return WebpushConfig New initialized instance.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    public static function createWebpushConfig(array $webpushConfig, array $webpushFcmOptionsConf = [])
    {
        return static::createObjectFromConfigAndNotification(
            WebpushConfig::class,
            $webpushConfig,
            WebpushConfig::FILED_FCM_OPTIONS,
            WebpushFcmOptions::class,
            $webpushFcmOptionsConf
        );
    }

    /**
     * Creates new ApnsConfig instance and sets it fields.
     *
     * @param array $apnsConfig Key value of ApnsConfig fields. Keys are constant starting on FIELD_.
     * @see ApnsConfig
     *
     * @return ApnsConfig New initialized instance.
     *
     * @throws \ReflectionException
     * @throws exceptions\InvalidKeyException
     */
    public static function createApnsConfig(array $apnsConfig)
    {
        return static::createObjectFromConfig(ApnsConfig::class, $apnsConfig);
    }

    /**
     * Creates new initialized TargetToken.
     *
     * @param string $token
     *
     * @return TargetToken New initialized instance.
     */
    public static function createTargetToken($token)
    {
        return new TargetToken($token);
    }

    /**
     * Creates new initialized TargetTopic().
     *
     * @param string $topic Topic name to send a message to.
     *
     * @return TargetTopic() New initialized instance.
     */
    public static function createTargetTopic($topic)
    {
        return new TargetTopic($topic);
    }

    /**
     * Creates new initialized TargetCondition().
     *
     * @param string $condition Condition to send a message to.
     *
     * @return TargetCondition() New initialized instance.
     */
    public static function createTargetCondition($condition)
    {
        return new TargetCondition($condition);
    }
}