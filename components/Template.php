<?php

namespace components;

/**
 * Class Template
 * @package components
 */
class Template
{
    /**
     * @var string
     */
    private $layout;

    /**
     * @var string
     */
    private $templatesDir;

    /**
     * Template constructor.
     * @param string $templatesDir
     * @param string $layout
     */
    public function __construct($templatesDir, $layout = 'layouts/main')
    {
        $this->layout = $layout;
        $this->templatesDir = $templatesDir;
    }

    /**
     * @param string $template
     * @param array $variables
     * @return string
     */
    public function render($template, array $variables = [])
    {
        extract($variables);

        ob_start();
        require_once $this->getTemplateFile($template);
        $content = ob_get_clean();

        ob_start();
        require_once $this->getTemplateFile($this->layout);
        return ob_get_clean();
    }

    /**
     * @param string $template
     * @return string
     * @throws \Exception
     */
    private function getTemplateFile($template)
    {
        $file = "{$this->templatesDir}/{$template}.php";
        if (!file_exists($file)) {
            throw new \Exception("View {$template} can not be loaded");
        }

        return $file;
    }
}
