<?php
namespace AppointmentTest\Controller;

use Appointment\Controller\AppointmentController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use AppointmentTest\Bootstrap;
use PHPUnit\Framework\TestCase;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;

class AppointmentControllerTest extends TestCase
{
   
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp():void
    {
        
    }


    public function testAddActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'add');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'edit');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(302, $response->getStatusCode());
    }

   public function testEditActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'edit');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
}