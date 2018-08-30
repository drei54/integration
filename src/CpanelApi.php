<?php
require_once('WhmcsApi.php');

class CpanelApi extends WhmcsApi
{
    const URL_ENDPOINT_LIST     = "cpsess3545027313/execute/Email/list_pops";
    const URL_ENDPOINT_ADDPOP   = "cpsess3545027313/execute/Email/add_pop";
    const USERNAME              = "master";
    const PASSWORD              = "masterPassw0rd??";
    const DOMAIN                = "demopersonal.com";

    const EMAIL_PARAM           = 'email';
    const PASSWORD_PARAM        = 'password';
    const DOMAIN_PARAM          = 'domain';

    protected $popUsername;
    protected $popPassword;
    protected $domain;

    public function listPop()
    {
        echo "\r\n-- start cpanel listpop --\r\n";
        WhmcsApi::getAuth();
        /*if(is_array(WhmcsApi::getAuth()))
        {
            return false;
        }*/

        $url =  WhmcsApi::SERVER_URL.self::URL_ENDPOINT_LIST;
        echo "url[".$url."]\r\n";
        $result = WhmcsApi::getData($url);
        echo "result[".json_encode($result)."]\r\n";
        echo "-- end cpanel listpop --\r\n";

        return $result;
    }

    public function addPop()
    {
        echo "-- start cpanel addpop --\r\n";
        WhmcsApi::getAuth();
        /*if(is_array(WhmcsApi::getAuth()))
        {
            return false;
        }*/

        $this->setCpanelCredential();

        $params = '?'.self::EMAIL_PARAM.'='.$this->getPopUsername();
        $params .= '&'.self::PASSWORD_PARAM.'='.$this->getPopPassword();
        $params .= '&'.self::DOMAIN_PARAM.'='.$this->getDomain();
        // echo "username[".$this->getPopUsername()."] password[".$this->getPopPassword()."] domain[".$this->getDomain()."] \r\n";

        $url =  WhmcsApi::SERVER_URL.self::URL_ENDPOINT_ADDPOP.$params;
        echo "url[".$url."]\r\n";
        $result = WhmcsApi::getData($url);
        echo "result[".json_encode($result)."]\r\n";
        echo "-- end cpanel addpop --\r\n";

        return $result->message;
    }

    public function setCpanelCredential()
    {
        $this->setPopUsername(self::USERNAME);
        $this->setPopPassword(self::PASSWORD);
        $this->setDomain(self::DOMAIN);
    }

    public function setPopUsername($popUsername)
    {
        $this->popUsername = $popUsername;
    }

    public function getPopUsername()
    {
        return $this->popUsername;
    }

    public function setPopPassword($popPassword)
    {
        $this->popPassword = $popPassword;
    }

    public function getPopPassword()
    {
        return $this->popPassword;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
    }

}

// $class = new CpanelApi();
// $class->addPop();
// $class->listPop();