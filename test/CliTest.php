<?php
require_once('src/Cli.php');

class CpanelApiTest extends \PHPUnit\Framework\TestCase
{
    private $Cli;

    public function __construct() {
        parent::__construct();
        $this->Cli = new Cli();
    }

    public function setUp() {
        $this->Cli = new Cli();
    }

    public function tearDown() {
        unset($this->Cli);
    }

    public function testHitAcceptOrder()
    {
        // mock
        $http = $this->createMock(Cli::class);
        $http->method('hitAcceptOrder')
             ->will($this->returnValue('Order accepted'));
        $result = $http->hitAcceptOrder();
        
        // original method ! command this line if mock server is down
        $result = $this->Cli->hitAcceptOrder();

        $this->assertEquals('Order accepted',$result);
    }

    public function testHitListPop()
    {
        // mock
        $http = $this->createMock(Cli::class);
        $http->method('hitListPop')
             ->will($this->returnValue(
                '{"metadata":{"transformed":1},"warnings":null,"errors":null,"messages":null,"data":[{"email":"dropsuite1@demopersonal.com","suspended_incoming":0,"login":"dropsuite1@demopersonal.com","suspended_login":0},{"suspended_login":0,"login":"gamabunta@demopersonal.com","suspended_incoming":0,"email":"gamabunta@demopersonal.com"},{"suspended_login":0,"login":"gamakichi@demopersonal.com","suspended_incoming":0,"email":"gamakichi@demopersonal.com"},{"email":"gamatatsu@demopersonal.com","suspended_incoming":0,"login":"gamatatsu@demopersonal.com","suspended_login":0},{"login":"hinata@demopersonal.com","suspended_login":0,"email":"hinata@demopersonal.com","suspended_incoming":0},{"email":"jiraiya@demopersonal.com","suspended_incoming":0,"login":"jiraiya@demopersonal.com","suspended_login":0},{"suspended_incoming":0,"email":"naruto@demopersonal.com","suspended_login":0,"login":"naruto@demopersonal.com"},{"suspended_login":0,"login":"sakura@demopersonal.com","suspended_incoming":0,"email":"sakura@demopersonal.com"},{"email":"sasuke@demopersonal.com","suspended_incoming":0,"login":"sasuke@demopersonal.com","suspended_login":0}],"status":1}'
            ));
        $result = json_decode($http->hitListPop());
        
        // original method ! command this line if mock server is down
        $result = $this->Cli->hitListPop();

        $this->assertObjectHasAttribute('data',$result);
    }

    public function testHitAddPop()
    {
        // mock
        $http = $this->createMock(Cli::class);
        $http->method('hitAddPop')
             ->will($this->returnValue('Email created'));
        $result = $http->hitAddPop();

        // original method ! command this line if mock server is down
        $result = $this->Cli->hitAddPop();

        $this->assertEquals('Email created',$result);
    }


    public function testHitAddAccount()
    {
        $http = $this->createMock(Cli::class);
        $http->method('hitAddAccount')
            ->will($this->returnValue('Account created' ));
        $result = $http->hitAddAccount();

        // original method ! command this line if mock server is down
        $result = $this->Cli->hitAddAccount();

        $this->assertEquals('Account created',$result);
    }

}
