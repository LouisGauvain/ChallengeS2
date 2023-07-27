<div id="root"></div>

<script type="module">
    import generateStructure from "/public/js/framework/src/index.js"

    const element = generateStructure(<?= $page['content'] ?>);
    console.log(element);

    document.getElementById("root").appendChild(element);
</script>