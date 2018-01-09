<?php

namespace components;

use PDO;
use PDOException;

/**
 * Class Database
 * @package components
 */
class Database
{
    /**
     * @var null|Database
     */
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return Database|null
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @var null|PDO
     */
    private $connection = null;

    /**
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     */
    public function setConnection($host, $user, $pass, $db)
    {
        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return null|PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}