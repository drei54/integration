<?php

include('CpanelApi.php');

class DropsuiteApi extends CpanelApi
{
    const URL_ENDPOINT_AUTH             = "dropsuite/auth";
    const URL_ENDPOINT_ADDACCOUNT       = "dropsuite/account";
    const SHARED_EMAIL                  = "gamatatsu";
    const TYPE                          = 'cpanel';

    const TOKEN_PARAM                   = "token";
    const SHARED_PARAM                  = "shared_email";
    const TYPE_PARAM                    = "type";

    protected $shared;
    protected $type;
    protected $token;

    public function __construct()
    {
        $this->setCpanelCredential();
    }

    public function addAccount()
    {
        echo "\r\n-- start addAccount --\r\n";
        $token = $this->getAuthDs();
        echo "token[".$token."]\r\n";
        $this->setParam();

        $data = array(
            CpanelApi::EMAIL_PARAM => $this->getPopUsername(),
            CpanelApi::PASSWORD_PARAM => $this->getPopPassword(),
            self::SHARED_PARAM => $this->getShared(),
            self::TYPE_PARAM => $this->getType(),
            self::DOMAIN_PARAM => $this->getDomain(),
        );

        $header = array(
            self::TOKEN_PARAM.": ".$token
        );

        $url = WhmcsApi::SERVER_URL.self::URL_ENDPOINT_ADDACCOUNT;
        echo "url[".$url."]\r\n";
        $result = WhmcsApi::postData($url,$data,$header);
        echo "result[".json_encode($result)."]\r\n";
        echo "-- end addAccount --\r\n";

        return $result->message;

    }

    public function setParam()
    {
        $this->setShared(self::SHARED_EMAIL);
        $this->setType(self::TYPE);
    }

    public function getAuthDs()
    {
        echo "\r\n-- start ds auth --\r\n";
        $token = '';
        WhmcsApi::getAuth();

        $header = array(
            self::USERNAME_HEADER.": ".WhmcsApi::$username,
            self::PASSWORD_HEADER.": ".WhmcsApi::$password,
        );

        $url = self::SERVER_URL.self::URL_ENDPOINT_AUTH;
        $result = self::postData($url,null,$header);
        echo "result[".json_encode($result)."] \r\n";
        echo "-- end ds auth --\r\n";
        if(!is_null($result))
        {
            $token =  $result->token;
        }
        return $token;
    }

    public function setShared($shared)
    {
        $this->shared = $shared;
    }

    public function getShared()
    {
        return  $this->shared;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

}
$class = new DropsuiteApi();
$class->addAccount();