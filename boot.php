<?php
require __DIR__ . '/vendor/autoload.php';

$app = new Enstart\App;

// Load the config files
$app->config->load([
    __DIR__ . '/config.global.php',
    __DIR__ . '/config.local.php',
]);

// Add the system paths
$app->addPath([
    'root'   => __DIR__,
    'app'    => __DIR__ . '/app',
    'public' => __DIR__ . '/public',
]);

// Set the app timezone
date_default_timezone_set(
    $app->config->get('datetime.timezone', 'UTC')
);

// Register all configured service providers
foreach ($app->config->get('providers', []) as $provider) {
    $app->serviceProvider($provider);
}

return $app;
