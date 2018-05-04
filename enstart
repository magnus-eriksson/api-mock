#!/usr/bin/env php
<?php

// include the composer autoloader
$enstart = require_once __DIR__ . '/boot.php';

// set to run indefinitely if needed
set_time_limit(0);

// import the Symfony Console Application
use Symfony\Component\Console\Application;

$app = new Application();

// Register the configured commands
foreach ($enstart->config->get('commands', []) as $command) {
    $app->add(
        $enstart->container->make($command)
    );
}

$app->run();
