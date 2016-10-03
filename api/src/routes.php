<?php
// Routes

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/test', function (Request $request, Response $response) {
    $data = [
        'status' => 200,
        'data'   => 'this is some test',
        'error'  => false,
    ];
    header('Content-Type: application/json');

    $response->withJson($data, 200);

    return $response;
});