<?php
$app = require __DIR__ . '/../boot.php';

require $app->path('app') . '/filters.php';
require $app->path('app') . '/routes.php';

$app->start();
