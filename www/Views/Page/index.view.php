<div id="header"></div>
<div id="root"></div>
<div id="categories" style="margin: 40px auto 0; width: 80%; border-radius: 20px; padding: 20px; background: #f2f2f2;">
    <p style="text-align: center;">Liste des tags de la page</p>
    <ul class="list-group">
        <?php
        foreach ($categories as $category) {
            echo "<button class='list-group-item' onclick=\"window.location.href='/?category=" . $category["name"] . "'\">" . $category["name"] . "</button>";
        }
        ?>
    </ul>
</div>
<div id="comment"></div>

<div class="div_input">
    <div class="container">
        <?php $this->modal("form", $form); ?>
    </div>
</div>

<script type="module">
    import {
        generateStructure,
        render
    } from "/public/js/framework/src/index.js"
    import {
        BrowserLink,
        BrowserRouter
    } from "/public/js/framework/src/components/BrowserRouter.js"
    import Comments from "/public/js/framework/src/components/Comments.js"

    render(<?= $page["content"] ?>, document.getElementById("root"));
    render(Comments('<?php echo json_encode($commentsTree) ?>'), document.getElementById("comment"));
    render(BrowserRouter([
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