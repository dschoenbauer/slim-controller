<?php
namespace DSchoenbauer\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

/**
 * Description of AppDecorator
 *
 * @author David
 */
class AppDecorator implements VisiteeInterface
{

    private $app;

    public function __construct(App $app)
    {
        $this->setApp($app);
    }

    public function __call($method, $args)
    {
        $result = call_user_func_array(array($this->getApp(), $method), $args);
        return $result === $this->getApp() ? $this : $result;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    public function setApp($app)
    {
        $this->app = $app;
        return $this;
    }

    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitApp($this->getApp());
    }
}
