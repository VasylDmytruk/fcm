<?php

namespace autoxloo\fcm\message;

use autoxloo\fcm\exceptions\InvalidKeyException;
use autoxloo\fcm\helpers\ReflectionHelper;

/**
 * Class BaseFieldKeysObject Main purpose is to set class fields. To set class fields class should has constants
 * which starts on FIELD_ with values of names of class field to use in [[BaseFieldKeysObject::setFields()]]
 * and in [[BaseFieldKeysObject::getFieldsMap()]].
 * @see BaseFieldKeysObject::setFields()
 * @see BaseFieldKeysObject::getFieldsMap()
 *
 * Example:
 *
 * ```
 * class Notification extends BaseFieldKeysObject implements \JsonSerializable
 * {
 *       const FIELD_TITLE = 'title';
 *       const FIELD_BODY = 'body';
 *
 *       protected $title;
 *       protected $body;
 *       protected $empty;   // this field will not be set and return in FieldKeys::getFieldsMap()
 *
 *
 *       public function jsonSerialize()
 *       {
 *              // get only not empty fields
 *              return $this->getFieldsMap();
 *       }
 * }
 *
 * $notification = new Notification();
 *
 * $notification->setFields([
 *      'title' => 'Some title',
 *      'body' => 'Some body',
 * ]);
 *
 * var_dump(json_encode($notification));
 * ```
 *
 * Result of var_dump:
 *
 * ```
 * "{"title":"Some title", "body":"Some body"}"
 * ```
 * @since 1.0.1
 */
abstract class BaseFieldKeysObject
{
    /**
     * @var array Stores allowed keys
     */
    private $_allowedFieldKeys = [];


    /**
     * Sets class fields.
     *
     * @param array $fieldKeyValues Field keys with values to set.
     *
     * @throws InvalidKeyException
     * @throws \ReflectionException
     */
    public function setFields(array $fieldKeyValues)
    {
        $allowedKeys = $this->getAllowedFieldKeys();

        foreach ($fieldKeyValues as $fieldKey => $fieldValue) {
            if (!in_array($fieldKey, $allowedKeys, true)) {
                throw new InvalidKeyException("$fieldKey is not allowed, only: " . implode(', ', $allowedKeys));
            }

            if (property_exists($this, $fieldKey)) {
                $this->$fieldKey = $fieldValue;
            }
        }
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function getAllowedFieldKeys()
    {
        if (!$this->_allowedFieldKeys) {
            $this->_allowedFieldKeys = ReflectionHelper::getConsts(static::class, 'FIELD_');
        }

        return $this->_allowedFieldKeys;
    }

    /**
     * Gets array of fields with not empty value.
     *
     * @return array Array of fields with not empty value.
     * @throws \ReflectionException
     */
    protected function getFieldsMap()
    {
        $notEmptyFields = [];
        $allowedFieldKeys = $this->getAllowedFieldKeys();

        foreach ($allowedFieldKeys as $allowedFieldKey) {
            if (!empty($this->$allowedFieldKey)) {
                $notEmptyFields[$allowedFieldKey] = $this->$allowedFieldKey;
            }
        }

        $jsonData = !empty($notEmptyFields) ? $notEmptyFields : null;   // it's important to be null here if no values

        return $jsonData;
    }
}