<?php

namespace components;

use helpers\Arrays;

/**
 * Class Registry
 * @package components
 */
class Registry
{
    /**
     * @var array
     */
    private static $storage = [];

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        self::$storage[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        return Arrays::getValue($key, self::$storage, $default);
    }
}
