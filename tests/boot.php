<?php
/**
 * This file boots up the app, just like the "real" boot does.
 * The only difference is currently that this boot also laods
 * the test config. Feel free to modify this in any way you want/need.
 */
$app = new Enstart\App;

$app->config->load([
    __DIR__ . '/../config.global.php',
    __DIR__ . '/../config.local.php',
    __DIR__ . '/../config.test.php'
]);

$app->addPath([
    'root'   => realpath(__DIR__ . '/..'),
    'app'    => realpath(__DIR__ . '/../app'),
    'public' => realpath(__DIR__ . '/../public'),
]);

date_default_timezone_set(
    $app->config->get('datetime.timezone', 'UTC')
);

foreach ($app->config->get('providers', []) as $provider) {
    $app->serviceProvider($provider);
}

return $app;
