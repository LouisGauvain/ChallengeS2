<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $this->data['page_title'] ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <meta name="description" content="Ceci est ma super page">
    <script src="/public/js/htmlToJson.js"></script>
    <script src="public/js/page.js" defer></script>
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="backend">

    <div id="root">
        <?php

        use App\Core\Utils;

        if (!empty($_SESSION['user'])) {
        ?><div class="sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/page">Page</a>
                    </li>
                    <?php
                    if (Utils::isAdmin() == true) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/add_template_page">Templates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/list_comment">Commentaires</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div> <?php
                }
                    ?>
        <div class="content">
            <?php
            if (!empty($_SESSION['user'])) {
            ?><header>
                    <a href="/" class="btn btn-primary">Voir le site</a>
                    <a href="/disconnect" class="btn btn-danger">Déconnexion</a>
                </header>
            <?php
            }
            ?>
            <div class="info_user">
                <?php include $this->view; ?>
            </div>
        </div>
    </div>
</body>

</html>