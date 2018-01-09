<?php

namespace components;

use helpers\Arrays;

/**
 * Class Config
 * @package components
 */
class Config
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private static $instance = null;

    /**
     * @return Config|null
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @param array $attributes
     * @return Config
     */
    public function addAttributes(array $attributes = [])
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return Arrays::getValue($key, $this->attributes, $default);
    }
}