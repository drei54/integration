<?php
require_once('src/CpanelApi.php');

class CpanelApiTest extends \PHPUnit\Framework\TestCase
{
    private $CpanelApi;

    public function __construct() {
        parent::__construct();
        $this->CpanelApi = new WhmcsApi();
    }

    public function setUp() {
        $this->CpanelApi = new CpanelApi();
    }

    public function tearDown() {
        unset($this->CpanelApi);
    }

    public function testGetListPop()
    {
        // mock
        $http = $this->createMock(CpanelApi::class);
        $http->method('listPop')
             ->will($this->returnValue(
                '{"metadata":{"transformed":1},"warnings":null,"errors":null,"messages":null,"data":[{"email":"dropsuite1@demopersonal.com","suspended_incoming":0,"login":"dropsuite1@demopersonal.com","suspended_login":0},{"suspended_login":0,"login":"gamabunta@demopersonal.com","suspended_incoming":0,"email":"gamabunta@demopersonal.com"},{"suspended_login":0,"login":"gamakichi@demopersonal.com","suspended_incoming":0,"email":"gamakichi@demopersonal.com"},{"email":"gamatatsu@demopersonal.com","suspended_incoming":0,"login":"gamatatsu@demopersonal.com","suspended_login":0},{"login":"hinata@demopersonal.com","suspended_login":0,"email":"hinata@demopersonal.com","suspended_incoming":0},{"email":"jiraiya@demopersonal.com","suspended_incoming":0,"login":"jiraiya@demopersonal.com","suspended_login":0},{"suspended_incoming":0,"email":"naruto@demopersonal.com","suspended_login":0,"login":"naruto@demopersonal.com"},{"suspended_login":0,"login":"sakura@demopersonal.com","suspended_incoming":0,"email":"sakura@demopersonal.com"},{"email":"sasuke@demopersonal.com","suspended_incoming":0,"login":"sasuke@demopersonal.com","suspended_login":0}],"status":1}'
            ));
        $result = json_decode($http->listPop());
        
        // original method ! command this line if mock server is down
        $result = $this->CpanelApi->listPop();

        $this->assertObjectHasAttribute('data',$result);
    }

    public function testAddPop()
    {
        // mock
        $http = $this->createMock(CpanelApi::class);
        $http->method('addPop')
             ->will($this->returnValue('Email created'));
        $result = $http->addPop();

        // original method ! command this line if mock server is down
        $result = $this->CpanelApi->addPop();

        $this->assertEquals('Email created',$result);
    }
}
