<div id="header"></div>
<div id="root"></div>
<div id="comment"></div>
<div id="categories">
    <?php
    foreach ($categories as $category) {
        echo "<div class='category';'><a href='/?category=" . $category["name"] . "'>" . $category["name"] . "</a></div>";
    }
    ?>
    </div>

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