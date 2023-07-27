<div id="root"></div>

<script type="module">
    import { generateStructure, render } from "/public/js/framework/src/index.js"

    render(<?= $page["content"] ?>, document.getElementById("root"));
</script>