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

```
actor: Tester
paths:
  tests: tests
  log: tests/_output
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
enabled: true
remote: true
include:
  - src/*
```


### In Codeception
#### codeception.yml
```
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
    c3_url: 'http://localhost:8888'
```

#### tests/api.suite.yml
```
class_name: ApiTester
modules:
    enabled:
        - REST:
            url: http://localhost:8888
            depends: PhpBrowser
```


## ERRORS!!!
```
[xxx] PHP Notice:  Use of undefined constant C3_CODECOVERAGE_MEDIATE_STORAGE - assumed 'C3_CODECOVERAGE_MEDIATE_STORAGE' in /remotecoverage/api/c3.php on line 42
[xxx] PHP Stack trace:
[xxx] PHP   1. {main}() /remotecoverage/api/public/index.php:0
[xxx] PHP   2. include() /remotecoverage/api/public/index.php:16
[xxx] PHP   3. __c3_error() /remotecoverage/api/c3.php:100
[xxx] PHP Notice:  Undefined index: HTTP_X_CODECEPTION_CODECOVERAGE in /remotecoverage/api/c3.php on line 119
[xxx] PHP Stack trace:
[xxx] PHP   1. {main}() /remotecoverage/api/public/index.php:0
[xxx] PHP   2. include() /remotecoverage/api/public/index.php:16

```