<div id="header"></div>
<div id="root"></div>

<script type="module">
    import { generateStructure, render } from "/public/js/framework/src/index.js"
    import { BrowserLink, BrowserRouter } from "/public/js/framework/src/components/BrowserRouter.js"

    render(<?= $page["content"] ?>, document.getElementById("root"));
     render(BrowserRouter
        ([
            <?php
            foreach ($allUsersPages as $page) {
                echo "{title: \"" . $page["title"] . "\", link: \"" . $page["url_page"] . "\"},";
            }
            ?>
            ],
        document.getElementById("header")),
        document.getElementById("header")
    ) 
</script>