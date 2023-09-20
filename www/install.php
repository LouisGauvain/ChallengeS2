<?php

$envFilePath = '.env';
if (file_exists($envFilePath)) {
    header("Location: /");
    exit;
}

if(session_status() == PHP_SESSION_NONE) {
    session_start();
    session_destroy();
}
?>

<div id="header"></div>
<div id="root"></div>

<script type="module">
    import {
        generateStructure,
        render
    } from "/public/js/framework/src/index.js"
    import Install from "/public/js/framework/src/components/Install.js"

    render(Install({
        step: 1
    }), document.getElementById("root"))
    </script>