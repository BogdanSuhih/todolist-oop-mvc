<?php
namespace Project\Views;

class View
{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }


    public function renderTemplate(string $templateName, array $vars, int $per = 200)
    {
        http_response_code($per);
        extract($vars);
        ob_start();
        include $this->templatesPath . $templateName;
        $bufer = ob_get_contents();
        ob_clean();
        echo $bufer;
    }
}
