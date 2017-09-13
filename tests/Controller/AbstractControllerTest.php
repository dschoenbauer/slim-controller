<?php
namespace DSchoenbauer\Controller;

use PHPUnit_Framework_TestCase;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Description of AbstractControllerTest
 *
 * @author David
 */
class AbstractControllerTest extends PHPUnit_Framework_TestCase
{
    /* @var $_mock AbstractController */

    private $_mock;

    protected function setUp()
    {
        $this->_mock = $this->getMockForAbstractClass(AbstractController::class);
    }

    public function testData()
    {
        $data = ['test' => 'value'];
        $this->assertEquals($data, $this->_mock->setData($data)->getData());
    }

    public function testGetMethods()
    {
        $data = ['GET'];
        $this->assertEquals($data, $this->_mock->getMethods());
    }

    public function testApp()
    {
        $mock = $this->getMockBuilder(App::class)->getMock();
        $this->assertSame($mock, $this->_mock->setApp($mock)->getApp());
    }

    public function testHandleRoute()
    {
        $requestMock = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $responseMock = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $responseNew = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $this->_mock->expects($this->once())->method('render')->willReturn($responseNew);
        $this->assertSame($responseNew, $this->_mock->handleRoute($requestMock, $responseMock));
    }

    public function testVisitApp()
    {
        $appMock = $this->getMockBuilder(App::class)->disableOriginalConstructor()->getMock();

        $appMock->expects($this->once())->method('map')->willReturnCallback(function($methods, $route, $callback) {
            $this->assertEquals($this->_mock->getMethods(), $methods);
            $this->assertEquals($this->_mock->getRoute(), $route);
            $this->assertEquals([$this->_mock, 'handleRoute'], $callback);
        });
        $this->_mock->visitApp($appMock);
    }
}
