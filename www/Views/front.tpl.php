<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $this->data['page_title'] ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
    <meta name="description" content="TNL">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="/public/js/htmlToJson.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="frontend">
    <div>
        <?php

        use App\Core\Utils;

        if (!empty($_SESSION['user'])) {
        ?>
            <header>
                <a href="/dashboard" class="btn btn-primary">Dashboard</a>
                <a href="/disconnect" class="btn btn-danger">Déconnexion</a>
            </header>
        <?php
        }
        if (empty($_SESSION['user'])) {
            $uri = $_SERVER['REQUEST_URI'];
        ?>
            <header>
                <?php
                if ($uri != '/' && strpos($uri, '/?') !== 0) {
                ?>
                    <a href="/" class="btn btn-primary left">Voir le site</a>
                <?php
                }
                if ($uri != '/login') {
                ?>
                    <a href="/login" class="btn btn-primary">Connexion</a>
                <?php
                }
                ?>
                <?php
                if ($uri != '/register') {
                ?>
                    <a href="/register" class="btn btn-primary">Inscription</a>
                <?php
                }
                ?>
            </header>
        <?php
        }
        ?>
        <?php include $this->view; ?>
    </div>
</body>


</html>