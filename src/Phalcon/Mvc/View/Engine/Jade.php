<?php

namespace Phalcon\Mvc\View\Engine;

use Phalcon\Mvc\View\Engine;
use Phalcon\Mvc\View\EngineInterface;

class Jade extends Engine implements EngineInterface
{
    protected $jade;

    /**
     * Adapter constructor
     *
     * @param \Phalcon\Mvc\View $view
     * @param \Phalcon\DI $di
     * @param array $options
     */
    public function __construct($view, $di, $options = array())
    {
        //Initialize here the adapter
        parent::__construct($view, $di);
        $className = class_exists('Pug\\Pug') ? 'Pug\\Pug' : 'Jade\\Jade';
        $this->jade = new $className($options);
    }

    /**
     * Renders a view using the template engine
     *
     * @param string $path
     * @param array $params
     */
    public function render($path, $params, $mustClean = false)
    {
        $method = method_exists($this->jade, 'renderFile')
            ? array($this->jade, 'renderFile')
            : array($this->jade, 'render');
        $content = call_user_func($method, $path, $params);
        if($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }

}
