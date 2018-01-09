<?php

namespace components;
use helpers\Request;

/**
 * Class Controller
 * @package components
 */
abstract class Controller
{
    /**
     * @param string $view
     * @param array $variables
     * @return string
     */
    public function render($view, $variables = [])
    {
        return $this->getView()->render($view, $variables);
    }

    /**
     * @return Template
     */
    protected function getView()
    {
        return Registry::get('template');
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return Registry::get('config');
    }

    /**
     * @param string $url
     * @param int $status
     * @param bool $terminate
     */
    protected function redirect($url, $status = 301, $terminate = true)
    {
        Request::redirect($url, $status, $terminate);
    }
}
