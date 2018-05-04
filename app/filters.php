<?php
$app->router->notFound(function () {
    $json = new Enstart\Entity\JsonResponseEntity;
    return $json->setCode(404)
        ->setMessage('Resource not found');
});

$app->router->methodNotAllowed(function () {
    $json = new Enstart\Entity\JsonResponseEntity;
    return $json->setCode(405)
        ->setMessage('Method not allowed');
});

$app->router->filter('adminAuth', function () use ($app) {
    $auth = $app->container->make('Maer\Auth\AuthInterface');
    if (!$auth->hasCurrentUser()) {
        return $app->routeRedirect('admin.login');
    }
});

$app->router->filter('apiAuth', function () use ($app) {
    $auth   = $app->container->make('Maer\Auth\AuthInterface');
    $token  = $app->config->get('auth.token');
    $header = $app->request->headers('X-API-TOKEN');

    if (!$auth->hasCurrentUser() && $token !== $header) {
        $json = new Enstart\Entity\JsonResponseEntity;
        return $json->setCode(401)
            ->setMessage('Unauthorized request');
    }
});