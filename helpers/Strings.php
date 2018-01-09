<?php

namespace helpers;

/**
 * Class Strings
 * @package helpers
 */
class Strings
{
    /**
     * @param string $string
     * @return string
     */
    public static function camelize($string)
    {
        $result = '';
        foreach (explode('-', $string) as $part) {
            $result .= ucfirst(strtolower($part));
        }

        return $result;
    }
}
