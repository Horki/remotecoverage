<?php
// Routes

$app->get('/test', function () use ($app) {
    $app->render(200, [
        'status' => 200,
        'data'   => 'this is some test',
    ]);
});
