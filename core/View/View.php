<?php
namespace Core\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    private $twig;

    private $layout = 'base';

    private $template = 'default';

    private $module = '';

    /**
     * View constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $tempPath = TEMPLATES_DIR . '/' . $this->template . '/';

        if(!file_exists($tempPath))
            throw new \Exception("File ". $tempPath . " Not exists!");

        $cachePath = CACHE_DIR . '/views';

        $loader = new FilesystemLoader($tempPath);

        $twig = new Environment($loader, [
            'cache' => false,
            'auto_reload' => true,
        ]);
        //$twig->addExtension(new TwigExtension());
        $this->twig = $twig;
    }

    /**
     * @return Environment
     */
    public function getView()
    {
        return $this->twig;
    }
    /**
     * @param $name
     */
    public function setLayout( $name ) {
        $this->layout = $name;
    }
    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }
    /**
     * @param $name
     */
    public function setTemplate($name)
    {
        $this->template = $name;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
