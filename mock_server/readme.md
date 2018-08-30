# Dropsuite Integration Test


This test is reflecting how integration works in dropsuite. We have create a simple mock server. 

You can easily understand just by read the code. It is plain lumen application.

Your job is to build integration between whmcs, cpanel & dropsuite.


---

## Workflow


1. Hit `/whmcs/AcceptOrder` to accept the order. Let say this is the trigger. When order is accepted, continue process.
2. Hit `/cpsess3545027313/execute/Email/list_pops` to retrieve list email from cPanel. We want to backup those email into dropsuite system. Unfortunately we can't get the password of each email account.
3. Hit `/cpsess3545027313/execute/Email/add_pop?email=master&password=masterPassw0rd??&domain=demopersonal.com` to create a new **master account**. We will use master account credentials to do backup, because it has extra capabilities.
4. Hit `/dropsuite/account` by giving specific params to create new backup account on dropsuite system.

## Tasks

1. Create 3 PHP class to interact with each endpoint (whmcs, cpanel & dropsuite), for example `WhmcsApi.php` and so on. Put this class on directory `src`.
2. Each classes **must have a unit test and code coverage report**, aim for > 80%. Put this test & coverage report on directory `test`.
3. Create a PHP CLI Application to glue those classes above and this application need to have test as well.
3. We want you to running the unit testing & code coverage report **without having to turn on the mock server**.
4. Write the documentation how to run the test and the cli application on `docs` directory.

## Conditions

1. Re-archive this directory with your commits added. Just use master branch.
2. If you think you need to modify the **mock server**, just modify it.
3. You only have 3 x 24 hours to finish this task after you open the question.
4. If you have any question, send email to fajri@dropsuite.com
