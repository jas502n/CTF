<?php session_start();
include_once 'lib/clean.php';
include_once 'lib/database.php';
?>
<html>
<head>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['username'])) { ?>
            <form class="form-signin" action="login.php?action=login" method="post">
                <h2 class="form-signin-heading">Please sign in</h2>
                <label for="inputUsername" class="sr-only">username</label>
                <input maxlength="20" type="text" name="username" id="inputUsername" class="form-control" placeholder="Username"
                       required autofocus>
                <p></p>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <?php if (isset($_SESSION['error'])) { ?>
                    <p></p><p style="color:red;"><?= $_SESSION['error'] ?></p>
                <? } ?>
            </form>
        <?php } else { ?>
            <div class="jumbotron text-center">
                <h2>
                    Hello <?= $_SESSION['username'] ?>
                    <p></p>
                    <span>ip addr:<?= getip()?></span>
                    <p></p>
                    <a class="btn btn-danger" href="login.php?action=logout">logout</a>
                </h2>
            </div>
            <form action="upload.php" class="form-signin" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <input type="file" class="form-control" name="upfile">
                </div>
                <button class="btn btn-primary pull-right">upload</button>
            </form>
            <div class="jumbotron form-signin">
                <p>this is your files:</p>
                <?php
                $db = new Database();
                $pics = $db->getRow($_SESSION['username']);
                foreach ($pics as $pic) {
                    if ($len = strlen($pic) >= 10) {
                        $pic = substr($pic, 0, 10) . '....';
                    }
                    echo "<p>$pic</p>";
                }
                ?>
            </div>
        <?php } ?>
    </div>
</body>
<script src="/assets/js/bootstrap.min.js"></script>
</html>