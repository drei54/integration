<?php
require_once('DropsuiteApi.php');
require_once('WhmcsApi.php');
require_once('CpanelApi.php');

class Cli 
{
	public $whmcs;
	public $cpanel;
	public $dropsuite;
	
	public function hitAcceptOrder(){
		$this->whmcs = new WhmcsApi();
		return $this->whmcs->acceptOrder('123123123');
	}

	public function hitListPop(){
		$this->cpanel = new CpanelApi();
		return $this->cpanel->listPop();

	}

	public function hitAddPop(){
		$this->cpanel = new CpanelApi();
		return $this->cpanel->addPop();
	}

	public function hitAddAccount(){
		$this->dropsuite = new DropsuiteApi();
		return $this->dropsuite->addAccount();
	}

}

/*$class = new Cli();
$class->hitAcceptOrder();
$class->hitListPop();
$class->hitAddPop();
$class->hitAddAccount();
*/