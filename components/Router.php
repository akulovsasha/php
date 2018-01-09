<?php

namespace components;

use helpers\Arrays;
use helpers\Request;
use helpers\Strings;

/**
 * Class Router
 * @package components
 */
class Router
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * Router constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = Request::clearUrl($url);
    }

    /**
     * @return string
     */
    public function dispatch()
    {
        $parts = array_filter(explode('/', $this->url));
        $controller = $this->prepareController(Arrays::getValue(0, $parts, 'index'));
        $action = $this->prepareAction(Arrays::getValue(1, $parts, 'index'), $controller);

        return $controller->{$action}();
    }

    /**
     * @param string $urlPart
     * @return Controller
     * @throws \Exception
     */
    private function prepareController($urlPart)
    {
        $controllersNamespace = Registry::get('config')->get('controllersNamespace');
        $controllerClass = "{$controllersNamespace}\\" . Strings::camelize($urlPart) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new \Exception('Requested class is not exists');
        }

        $controllerObject = new $controllerClass;
        if (!$controllerObject instanceof Controller) {
            throw new \Exception('Requested class is invalid');
        }

        return $controllerObject;
    }

    /**
     * @param string $urlPart
     * @param Controller $controller
     * @return string
     * @throws \Exception
     */
    private function prepareAction($urlPart, Controller $controller)
    {
        $action = 'action' . Strings::camelize($urlPart);
        if (!method_exists($controller, $action)) {
            throw new \Exception('Requested action is not exists');
        }

        return $action;
    }
}
