<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $this->data['page_title'] ?></title>
    <meta name="description" content="Ceci est ma super page">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="public/js/js_input_create_template.js" defer></script>
    <script src="public/js/js_input_radio_only_one.js" defer></script>
    <script src="public/js/js_input_file.js" defer></script>
    <!-- <script src="public/js/js_input_texte.js" defer></script> -->
    <!-- <script src="tinymce/js/tinymce/tinymce.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        header {
            background-color: lightgrey;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            margin-left: 10px;
        }
    </style>
    </head>

<body class="backend">
    <div id="root">
        <?php
    if (!empty($_SESSION['user'])) {
        ?><header>
        <a href="/" class="btn btn-primary">Voir le site</a>
        <a href="/disconnect" class="btn btn-danger">Déconnexion</a>
    </header>
        <?php
    }
    ?>
        <?php include __DIR__ . '/Components/navbar.view.php'; ?>
        
        <?php include $this->view; ?>
        
        <a href="disconnect?controller=security&task=logout">Déconnexion</a>
    </div>
</body>

</html>