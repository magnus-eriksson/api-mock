<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?= $this->asset('/static/main.css') ?>" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

    <header id="header">Backend mock for Nationalmuseums app</header>

    <div id="layout">

        <div id="sidebar">

            <ul>
            <li><a href="<?= $this->route('admin.resources.create') ?>">+ Create new resource</a></li>
            <li><a href="<?= $this->route('admin.home') ?>">Show all resources</a></li>
            </ul>

        </div>

        <div id="content">

            <?= $this->section('content') ?>

        </div>

    </div>
    <script src="<?= $this->asset('/static/main.js') ?>"></script>
    <script src="<?= $this->asset('/static/form.js') ?>"></script>
</body>
</html>