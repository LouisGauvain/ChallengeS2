<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ma super page</title>
    <meta name="description" content="Ceci est ma super page">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <h1>Template de back</h1>

    <?php include $this->view; ?>

    <a href="disconnect?controller=security&task=logout">Déconnexion</a>

</body>

</html>