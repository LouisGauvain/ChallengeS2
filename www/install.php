<?php

if (!file_exists($envFilePath)) {
    header("Location: /");
    exit;
}
?>

<div id="header"></div>
<div id="root"></div>
<div id="root2"></div>

<script type="module">
    import {
        generateStructure,
        render
    } from "/public/js/framework/src/index.js"
    import Compteur from "/public/js/framework/src/components/Compteur.js"
    import Install from "/public/js/framework/src/components/Install.js"

    render(Compteur({
        count: 0
    }), document.getElementById("root"));

    render(Install({
        step: 1
    }), document.getElementById("root2"))
</script>