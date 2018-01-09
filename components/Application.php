<?php

namespace components;

/**
 * Class Application
 * @package components
 */
class Application
{
    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        Registry::set('config', Config::getInstance()->addAttributes($config));
        Registry::set('db', $this->prepareDbConnection());
        Registry::set('template', $this->prepareTemplate());
    }

    public function run()
    {
        $router = new Router($_SERVER['REQUEST_URI']);
        return $router->dispatch();
    }

    /**
     * @return Template
     */
    private function prepareTemplate()
    {
        return new Template(Registry::get('config')->get('templates'));
    }

    /**
     * @return Database|null
     */
    private function prepareDbConnection()
    {
        $db = Database::getInstance();
        $db->setConnection(
            Config::getInstance()->get('db.host'),
            Config::getInstance()->get('db.user'),
            Config::getInstance()->get('db.password'),
            Config::getInstance()->get('db.database')
        );

        return $db;
    }

}