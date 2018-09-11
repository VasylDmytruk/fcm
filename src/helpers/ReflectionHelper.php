<?php

namespace autoxloo\fcm\helpers;

/**
 * Class ReflectionHelper Helps to search constants in a class.
 * @since 1.0.1
 */
class ReflectionHelper
{
    /**
     * Constant search in a class
     *
     * @param string $class
     * @param null|string $prefix
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function getConsts($class, $prefix = null)
    {
        $reflection = new \ReflectionClass($class);
        $returnData = $reflection->getConstants();
        if (null !== $prefix) {
            $arrMask = [];
            foreach ($returnData as $key => $value) {
                if (strpos($key, $prefix) === 0) {
                    $arrMask[$key] = $value;
                }
            }
            $returnData = $arrMask;
        }

        return $returnData;
    }
}
