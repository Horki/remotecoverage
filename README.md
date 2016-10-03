# Remote code coverage with Codeception C3 - working

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

#### tests/api.suite.yml
```yml
class_name: ApiTester
modules:
    enabled:
        - REST:
            url: http://localhost:8888
            depends: PhpBrowser
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
    remote: true
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