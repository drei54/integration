-------------------------
Workflow
--------------------------
1. Hit /whmcs/AcceptOrder to accept the order. Let say this is the trigger. When order is accepted, continue process.
2. Hit /cpsess3545027313/execute/Email/list_pops to retrieve list email from cPanel. We want to backup those email into dropsuite system. 
   Unfortunately we can't get the password of each email account.
3. Hit /cpsess3545027313/execute/Email/add_pop?email=master&password=masterPassw0rd??&domain=demopersonal.com to create a new master account. 
   We will use master account credentials to do backup, because it has extra capabilities.
4. Hit /dropsuite/account by giving specific params to create new backup account on dropsuite system.

-------------------------
Tasks
-------------------------
1. Create 3 PHP class to interact with each endpoint (whmcs, cpanel & dropsuite), for example WhmcsApi.php and so on. Put this class on directory src.
2. Each classes must have a unit test and code coverage report, aim for > 80%. Put this test & coverage report on directory test.
3. Create a PHP CLI Application to glue those classes above and this application need to have test as well.
4. We want you to running the unit testing & code coverage report without having to turn on the mock server.
5. Write the documentation how to run the test and the cli application on docs directory.

-------------------------
Unit Testing
-------------------------
1. Install phpunit:
	composer require --dev phpunit/phpunit
	composer require phpunit/php-code-coverage
2. Run test:
	C:\xampp\htdocs\integration>vendor\bin\phpunit.bat test\WhmcsApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit.bat test\CpanelApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit.bat test\DropsuiteApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit.bat test\CliTest.php

-------------------------
Code coverage
-------------------------
1. Install Xdebug
	Download Xdebug for:

	PHP 7.0.x: https://xdebug.org/files/php_xdebug-2.5.5-7.0-vc14.dll
	PHP 7.1.x: https://xdebug.org/files/php_xdebug-2.5.5-7.1-vc14.dll
	PHP 7.2.x: https://xdebug.org/files/php_xdebug-2.6.0-7.2-vc15.dll
	Copy the file php_xdebug-2.6.0-7.2-vc15.dll to: C:\xampp\php\ext

	Open the file C:\xampp\php\php.ini with Notepad++

	Disable output buffering: output_buffering = Off

	Scroll down to the [XDebug] section (or create it) and copy this lines:

	[XDebug]
	zend_extension = "c:\xampp\php\ext\php_xdebug-2.6.0-7.2-vc15.dll"
	xdebug.remote_autostart = 1
	xdebug.profiler_append = 0
	xdebug.profiler_enable = 0
	xdebug.profiler_enable_trigger = 0
	xdebug.profiler_output_dir = "c:\xampp\tmp"
	;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
	xdebug.remote_enable = 1
	xdebug.remote_handler = "dbgp"
	xdebug.remote_host = "127.0.0.1"
	xdebug.remote_log = "c:\xampp\tmp\xdebug.txt"
	xdebug.remote_port = 9000
	xdebug.trace_output_dir = "c:\xampp\tmp"
	;36000 = 10h
	xdebug.remote_cookie_expire_time = 36000
	Stop/Start Apache

2. Run code coverage
	C:\xampp\htdocs\integration>vendor\bin\phpunit --coverage-html=docs\whmcs test\WhmcsApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit --coverage-html=docs\cpanel test\CpanelApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit --coverage-html=docs\dropsuite test\DropsuiteApiTest.php
	C:\xampp\htdocs\integration>vendor\bin\phpunit --coverage-html=docs\cli test\CliTest.php


