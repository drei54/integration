<?php

interface HttpRequest
{
    public function setOption($name, $value);
    public function execute();
    public function getInfo($name);
    public function close();
}


class WhmcsApi implements HttpRequest
{
    const SERVER_URL       = 'http://localhost/integration/mock_server/public/';
	const USERNAME_HEADER  = "user";
	const PASSWORD_HEADER  = "password";
	const SESSION_HEADER   = "session";
    const ORDER_ID_PARAM   = 'orderid';

	const USERNAME_APP     = "dropsuite";
	const PASSWORD_APP     = "DrOpsuiteR0cks!!";
    const ORDER_ID         = '123123123';

    private $handle = null;
    public static $username;
    public static $password;
    public static $orderId;
    public static $session;
    public static $curlOptions = array();

    public function acceptOrder($order_id = ORDER_ID)
    {
        echo "\r\n-- start whcms acceptOrder --\r\n";
        $response = 'Order failed';
        self::$orderId = $order_id;
        echo "orderId[".self::$orderId."] \r\n";

        self::$session = $this->getAuth();
        echo "session[".self::$session."] \r\n";

        if(isset(self::$session) && isset($order_id))
        {

            $header = array(
              self::SESSION_HEADER.": ".self::$session,
            );

            $data = array(self::ORDER_ID_PARAM => self::$orderId);

            $url = self::SERVER_URL."whmcs/AcceptOrder";
            echo "url[".$url."] \r\n";

            $result = self::postData($url,$data,$header);
            echo "result[".json_encode($result)."] \r\n";
            echo "-- end whcms acceptOrder --\r\n";
            $response = $result->message;
        }
        return $response;
    }

    public function getAuth($user = 'dropsuite', $pass = 'DrOpsuiteR0cks!!')
    {
        echo "\r\n-- start whcms auth --\r\n";
        $response = null;
        self::$username = $user;
        self::$password = $pass;

        $header = array(
            self::USERNAME_HEADER.': '.self::$username,
            self::PASSWORD_HEADER.': '.self::$password,
            );

        echo "user[".$user."] \r\n";
        echo "password[".$pass."] \r\n";
        $url = self::SERVER_URL."whmcs/auth";
        $result = self::postData($url,null,$header);
        echo "result[".json_encode($result)."] \r\n";
        echo "-- end whcms auth --\r\n";

        if(isset($result->session))
        {
            $response = $result->session;
        }
        return $response;

    }

    public function call($url, $data_hash = null, $post = true, $headerAdditional)
    {
        $this->setHandle($url);

        $header = array(
            'Content-Type: application/json',
            'Accept: application/json',
        );

        if(!is_null($headerAdditional))
        {
            $header = array_merge($header,$headerAdditional);
        }

        $this->setOption(CURLOPT_URL,$url);
        $this->setOption(CURLOPT_HTTPHEADER,$header);
        $this->setOption(CURLOPT_RETURNTRANSFER,1);


        if ($post) {
            $this->setOption(CURLOPT_POST,1);

            if ($data_hash) {
                $body = json_encode($data_hash);
                $this->setOption(CURLOPT_POSTFIELDS,$body);
            } else {
                $this->setOption(CURLOPT_POSTFIELDS,'');
            }
        }

        $result = $this->execute();

        $this->getInfo();

        $this->close();

        return $result_array = json_decode($result);
    }

    public function setHandle($url)
    {
        $this->handle = curl_init($url);
    }

    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }

    public function execute() {
        return curl_exec($this->handle);
    }

    public function getInfo($name=null) {
        return curl_getinfo($this->handle, $name);
    }

    public function close() {
        curl_close($this->handle);
    }

    public function getData($url,$data_hash = null,$header = null)
    {
        return self::call($url, $data_hash,false,$header);
    }

    public function postData($url,$data_hash,$header = null)
    {
        return self::call($url, $data_hash,true,$header);
    }

}

// $class = new WhmcsApi();
// $class->acceptOrder('123123123');