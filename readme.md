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


