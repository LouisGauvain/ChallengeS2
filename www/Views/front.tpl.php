<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TNL</title>
    <meta name="description" content="TNL">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="public/js/js_input_create_template.js" defer></script>
    <script src="public/js/js_input_radio_only_one.js" defer></script>
    <script src="public/js/js_input_file.js" defer></script>
</head>

<body>
    <h1>Template de front</h1>

    <?php include $this->view; ?>

    <a href="disconnect?controller=security&task=logout">Déconnexion</a>


</body>

</html>