<?php

namespace DSchoenbauer\Controller;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Description of ControllerAbstract
 *
 * @author David
 */
abstract class AbstractController implements VisitorInterface
{

    private $app;
    private $data;
    
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    public function visitApp(App $app)
    {
        $this->setApp($app)->getApp()->map($this->getMethods(), $this->getRoute(), [$this, 'handleRoute']);
    }

    public function handleRoute(Request $request, Response $response)
    {
        $this->render($request, $response);
        return $response;
    }

    abstract public function getRoute();

    abstract public function render(Request $request, Response $response);

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

    public function getMethods()
    {
        return ['GET'];
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
