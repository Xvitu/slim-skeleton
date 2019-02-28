<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Controllers;
use App\Services\Filesystem;

/*****************************  Public routes *****************************/
$app->get('/', function (Request $request, Response $response, array $args) {

    echo "<pre>";
    $result = (new Filesystem())->get('teste/pidgeotoo-slim.txt');
    print_r($result);
    exit();

    return $response->withStatus(403);
});

$app->get('/health', function (Request $request, Response $response, array $args) {
    return $response->withStatus(200);
});
/**************************************************************************/

/*****************************  Api routes ******************************/
$app->group('/api', function () use ($app) {
    $app->group('/email', function () use ($app) {
        $app->post('/send', Controllers\EmailController::class . ":send");
    });
});
/**************************************************************************/

