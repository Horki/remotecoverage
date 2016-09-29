# Remote code coverage with Codeception C3 - not working

## Start
* run `./install.sh` to install all composer dependencies

### First: Run API
* inside `/api`
* `./start.sh` -> http://localhost:8888


### Codeception Code Coverage
* inside `/codeception`
* `./run.sh` -> runs codeception with remote coverage

## Local setup
### PHP 5.6.10

| xdebug support | enabled       |
| :------------- |:--------------|
| Version        | 2.2.7         |


| Directive            | Local Value   | Master Value  |
| -------------------- |:--------------| :-------------|
| xdebug.remote_enable | On            | On            |


### In API
#### codeception.yml

```yml
actor: Tester
paths:
    tests: tests
    log: tests/_output
    data: tests/_data
    support: tests/_support
    envs: tests/_envs
settings:
    bootstrap: _bootstrap.php
    colors: true
    memory_limit: 1024M
extensions:
    enabled:
        - Codeception\Extension\RunFailed
# as in https://github.com/Codeception/c3
coverage:
  enabled: true
  remote: true
  include:
    - src/*
```


### In Codeception
#### codeception.yml
```yml
actor: Tester
paths:
    tests: tests
    log: tests/_output
    data: tests/_data
    support: tests/_support
    envs: tests/_envs
settings:
    bootstrap: _bootstrap.php
    colors: true
    memory_limit: 1024M
extensions:
    enabled:
        - Codeception\Extension\RunFailed
coverage:
    # url of file which includes c3 router.
    # As in http://codeception.com/docs/11-Codecoverage#Local-Server
    enabled: true
    c3_url: 'http://localhost:8888'
```

#### tests/api.suite.yml
```yml
class_name: ApiTester
modules:
    enabled:
        - REST:
            url: http://localhost:8888
            depends: PhpBrowser
```


## ERRORS!!!
```
  Rebuilding ApiTester...

Api Tests (1) --------------------------------------------------------------------------------------------------------------------------------------------------------------------
Modules: REST, PhpBrowser
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


  [PHPUnit_Framework_Exception (2)]
  file_get_contents(http://localhost:8888/c3/report/clear): failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
  
  Exception trace:
   () at /vendor/codeception/codeception/src/Codeception/Subscriber/ErrorHandler.php:65
   Codeception\Subscriber\ErrorHandler->errorHandler() at n/a:n/a
   file_get_contents() at /vendor/codeception/codeception/src/Codeception/Coverage/Subscriber/LocalServer.php:132
   Codeception\Coverage\Subscriber\LocalServer->c3Request() at /vendor/codeception/codeception/src/Codeception/Coverage/Subscriber/LocalServer.php:71
   Codeception\Coverage\Subscriber\LocalServer->beforeSuite() at n/a:n/a
   call_user_func() at /vendor/symfony/event-dispatcher/EventDispatcher.php:174
   Symfony\Component\EventDispatcher\EventDispatcher->doDispatch() at /vendor/symfony/event-dispatcher/EventDispatcher.php:43
   Symfony\Component\EventDispatcher\EventDispatcher->dispatch() at /vendor/codeception/codeception/src/Codeception/SuiteManager.php:161
   Codeception\SuiteManager->run() at /vendor/codeception/codeception/src/Codeception/Codecept.php:209
   Codeception\Codecept->runSuite() at /vendor/codeception/codeception/src/Codeception/Codecept.php:178
   Codeception\Codecept->run() at /vendor/codeception/codeception/src/Codeception/Command/Run.php:329
   Codeception\Command\Run->runSuites() at /vendor/codeception/codeception/src/Codeception/Command/Run.php:256
   Codeception\Command\Run->execute() at /vendor/symfony/console/Command/Command.php:256
   Symfony\Component\Console\Command\Command->run() at /vendor/symfony/console/Application.php:818
   Symfony\Component\Console\Application->doRunCommand() at /vendor/symfony/console/Application.php:186
   Symfony\Component\Console\Application->doRun() at /vendor/symfony/console/Application.php:117
   Symfony\Component\Console\Application->run() at /vendor/codeception/codeception/src/Codeception/Application.php:103
   Codeception\Application->run() at /vendor/codeception/codeception/codecept:33
  
  run [--report] [--html [HTML]] [--xml [XML]] [--tap [TAP]] [--json [JSON]] [--colors] [--no-colors] [--silent] [--steps] [-d|--debug] [--coverage [COVERAGE]] [--coverage-html [COVERAGE-HTML]] [--coverage-xml [COVERAGE-XML]] [--coverage-text [COVERAGE-TEXT]] [--no-exit] [-g|--group GROUP] [-s|--skip SKIP] [-x|--skip-group SKIP-GROUP] [--env ENV] [-f|--fail-fast] [--no-rebuild] [--] [<suite>] [<test>]

```