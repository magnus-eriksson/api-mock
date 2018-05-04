<!DOCTYPE html>
<html>
<head>
    <title>Log in</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?= $this->asset('/static/login.css') ?>" />
</head>
<body>
<div id="wrapper">

    <h1>Log in</h1>

    <form method="POST" action="<?= $this->route('admin.login.do') ?>">

        <?php if ($loginError) :?>
            <div id="error">Invalid username/password</div>
        <?php endif ?>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" />

        <label for="password">Password</label>
        <input type="password" name="password" />

        <button type="submit">Log in &raquo;</button>

    </form>

</div>
</body>
</html>