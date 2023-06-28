<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TNL</title>
    <meta name="description" content="TNL">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <h1>Template de front</h1>

    <?php include $this->view; ?>

    <a href="disconnect?controller=security&task=logout">Déconnexion</a>


</body>

</html>