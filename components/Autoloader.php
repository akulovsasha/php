<?php

namespace components;

/**
 * Class Autoloader
 * @package components
 */
class Autoloader
{
    /**
     * @var null|string
     */
    private $baseDir = null;

    /**
     * Autoloader constructor.
     * @param string|null $baseDir
     */
    public function __construct($baseDir = null)
    {
        $this->baseDir = rtrim($baseDir," \t\n\r \v/\\" );
        $this->baseDir = $baseDir;

    }

    /**
     * @param string $class
     * @throws \Exception
     */
    public function load($class)
    {
        $baseDir = $this->baseDir ?: __DIR__;
        $file = $baseDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        if (false === file_exists($file)) {
            throw new \Exception("Class {$class} can not be loaded");
        }

        require_once $file;
    }
}
