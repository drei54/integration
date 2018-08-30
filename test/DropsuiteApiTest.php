<?php

require_once('src/DropsuiteApi.php');

class DropsuiteApiTest extends \PHPUnit\Framework\TestCase
{
    private $dropsuiteApi;

    public function __construct() {
        parent::__construct();
        $this->dropsuiteApi = new DropsuiteApi();
    }

    public function setUp() {
        $this->dropsuiteApi = new DropsuiteApi();
    }

    public function tearDown() {
        unset($this->dropsuiteApi);
    }

    public function testGetAuthDs()
    {
        $sessionId = 'aad8ce79-10c7-4784-930b-67222e8f8449';

        //mock
        $http = $this->createMock(DropsuiteApi::class);
        $http->method('getAuthDs')
             ->will($this->returnValue($sessionId));
        $result = $http->getAuthDs();

        // original method ! command this line if mock server is down
        $result = $this->dropsuiteApi->getAuthDs();

        $this->assertEquals($sessionId,$result);
    }

    public function testAddAccount()
    {
        $http = $this->createMock(DropsuiteApi::class);
        $http->expects($this->any())
            ->method('addAccount')
            ->will($this->returnValue('Account created' ));
        $result = $http->addAccount();

        // original method ! command this line if mock server is down
        $result = $this->dropsuiteApi->addAccount();

        $this->assertEquals('Account created',$result);
    }
}
