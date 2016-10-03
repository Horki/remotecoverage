<?php
error_reporting(E_ALL);
ini_set('memory_limit', '1024M');
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
# https://github.com/Codeception/c3#setup
include __DIR__ . '/../c3.php';


// Instantiate the app
$app = new \Slim\App;

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
