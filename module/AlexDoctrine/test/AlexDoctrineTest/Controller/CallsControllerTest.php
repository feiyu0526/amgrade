<?php

namespace AlexDoctrineTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Http\Request;
use Zend\Http\Headers;

class CallsControllerTest extends AbstractHttpControllerTestCase
{
    public $request;
    public $routeMatch;
    public $event;


    public function setUp()
    {
        $this->setApplicationConfig(
            include 'config\application.config.php'
        );
//        $this->_controller = new UserTokenController;
        $this->request = new Request();
//        $this->_routeMatch = new RouteMatch(array('controller' => 'user'));
//        $this->_event = new MvcEvent();
//        $this->_event->setRouteMatch($this->_routeMatch);
//        $this->_controller->setEvent($this->_event);

        parent::setUp();
    }


    public function testIndexActionCanBeAccessed()
    {
        $rightUserAuthCredentials = md5('alex:alexdoctrine:alex');
        $wrongUserAuthCredentials = md5('alex:alexdoctrine:alex123');

        $headers = new Headers();
        $headers->addHeaderLine('Authorization', 'Basic '.$rightUserAuthCredentials );


        $this->dispatch('/calls');
        //$this->assertHeader('Www-Authenticate');

        $this->assertResponseStatusCode(401);
//
//        $this->assertModuleName('Album');
//        $this->assertControllerName('Album\Controller\Album');
//        $this->assertControllerClass('AlbumController');
//        $this->assertMatchedRouteName('album');
}


}