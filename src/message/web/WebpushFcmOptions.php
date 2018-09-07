<?php

namespace autoxloo\fcm\message\web;

use autoxloo\fcm\traits\FieldKeys;

/**
 * Class WebpushFcmOptions
 */
class WebpushFcmOptions implements \JsonSerializable
{
    use FieldKeys;

    const FIELD_LINK = 'link';

    /**
     * @var string The link to open when the user clicks on the notification. For all URL values, HTTPS is required.
     */
    protected $link;


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
