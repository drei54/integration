<?php

use PHPUnit\Framework\TestCase;
require_once('src/WhmcsApi.php');

class WhmcsApiTest extends TestCase
{
    private $WhmcsApi;

    public function __construct() {
        parent::__construct();
        $this->WhmcsApi = new WhmcsApi();
    }

    public function testGetAuth()
    {
        $username   = 'dropsuite';
        $password   = 'DrOpsuiteR0cks!!';
        $sessionId  = '14532371-661c-4375-8db7-09d36b1e79c3';

        // mock
        $http = $this->createMock(WhmcsApi::class);
        $http->method('getAuth')
             ->willReturn($sessionId);
        $result = $http->getAuth($username,$password);

        // original method ! command this line if mock server is down
        $result = $this->WhmcsApi->getAuth($username,$password);

        $this->assertEquals($sessionId,$result);
    }

    public function testAcceptOrder()
    {
        $orderId = '123123123';

        // mock
        $http = $this->createMock(WhmcsApi::class);
        $http->method('acceptOrder')
             ->willReturn('Order accepted');
        $result = $http->acceptOrder($orderId);

        // original method ! command this line if mock server is down
        $result = $this->WhmcsApi->acceptOrder($orderId);

        $this->assertEquals('Order accepted',$result);
    }


    public function testGetData()
    {
        $url =  'http://localhost/integration/mock_server/public/cpsess3545027313/execute/Email/add_pop?email=master&password=masterPassw0rd??&domain=demopersonal.com';
        echo "url[".$url."]\r\n";
        
        // mock
        $http = $this->createMock(WhmcsApi::class);
        $http->method('getData')
             ->willReturn('Email created');
        $result = $http->getData($url);

        // original method ! command this line if mock server is down
        $result = $this->WhmcsApi->getData($url, null, null)->message;

        $this->assertEquals('Email created',$result);
    }


}

