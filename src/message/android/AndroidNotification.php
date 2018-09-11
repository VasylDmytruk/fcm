<?php

namespace autoxloo\fcm\message\android;

use autoxloo\fcm\message\BaseFieldKeysObject;

/**
 * Class AndroidNotification Represents object AndroidNotification of FCM AndroidConfig.
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#AndroidNotification
 * @since 1.0.1
 */
class AndroidNotification extends BaseFieldKeysObject implements \JsonSerializable
{
    const FIELD_TITLE = 'title';
    const FIELD_BODY = 'body';
    const FIELD_ICON = 'icon';
    const FIELD_COLOR = 'color';
    const FIELD_SOUND = 'sound';
    const FIELD_TAG = 'tag';
    const FIELD_CLICK_ACTION = 'click_action';
    const FIELD_BODY_LOC_KEY = 'body_loc_key';
    const FIELD_BODY_LOC_ARGS = 'body_loc_args';
    const FIELD_TITLE_LOC_KEY = 'title_loc_key';
    const FIELD_TITLE_LOC_ARGS = 'title_loc_args';

    /**
     * @var string The notification's title. If present, it will override [[\autoxloo\fcm\message\Notification::title]]
     * @see \autoxloo\fcm\message\Notification::$title
     */
    protected $title;
    /**
     * @var string The notification's body text. If present,
     * it will override [[\autoxloo\fcm\message\Notification::title]]
     * @see \autoxloo\fcm\message\Notification::$title
     */
    protected $body;
    /**
     * @var string The notification's icon. Sets the notification icon to myicon for drawable resource myicon.
     * If you don't send this key in the request, FCM displays the launcher icon specified in your app manifest.
     */
    protected $icon;
    /**
     * @var string The notification's icon color, expressed in #rrggbb format.
     */
    protected $color;
    /**
     * @var string The sound to play when the device receives the notification.
     * Supports "default" or the filename of a sound resource bundled in the app. Sound files must reside in /res/raw/.
     */
    protected $sound;
    /**
     * @var string Identifier used to replace existing notifications in the notification drawer.
     * If not specified, each request creates a new notification.
     * If specified and a notification with the same tag is already being shown,
     * the new notification replaces the existing one in the notification drawer.
     */
    protected $tag;
    /**
     * @var string The action associated with a user click on the notification.
     * If specified, an activity with a matching intent filter is launched when a user clicks on the notification.
     */
    protected $click_action;
    /**
     * @var string The key to the body string in the app's string resources to use to localize the
     * body text to the user's current localization.
     * @see https://goo.gl/NdFZGI
     */
    protected $body_loc_key;
    /**
     * @var array Variable string values to be used in place of the format specifiers
     * in body_loc_key to use to localize the body text to the user's current localization.
     * @see https://goo.gl/MalYE3
     */
    protected $body_loc_args = [];
    /**
     * @var string The key to the title string in the app's string resources to use to localize
     * the title text to the user's current localization.
     * @see https://goo.gl/NdFZGI
     */
    protected $title_loc_key;
    /**
     * @var array Variable string values to be used in place of the format specifiers
     * in title_loc_key to use to localize the title text to the user's current localization.
     * @see https://goo.gl/MalYE3
     */
    protected $title_loc_args = [];


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
