<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->post('whmcs/auth', 'WhmcsController@auth');
$router->post('whmcs/AcceptOrder', 'WhmcsController@acceptOrder');
$router->get('cpsess3545027313/execute/Email/list_pops', 'CpanelController@listPops');
$router->get('cpsess3545027313/execute/Email/add_pop', 'CpanelController@addPop');
$router->post('dropsuite/auth', 'DropsuiteController@auth');
$router->post('dropsuite/account', 'DropsuiteController@addAccount');