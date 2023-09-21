<div id="header"></div>
<div id="root"></div>
<div id="categories">
    <?php
    foreach ($categories as $category) {
        echo "<div class='category';'><a href='/?category=" . $category["name"] . "'>" . $category["name"] . "</a></div>";
    }
    ?>
</div>


<?php
function displayComments($comments) {
    foreach ($comments as $comment) {
        if($comment!=NULL){
?>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $comment['user_name'] ?></td>
                        <td><?= $comment['content'] ?></td>
                    </tr>
                </tbody>
            </table>
        
        
        <!--echo '<p>' . htmlentities($comment['content']) . '</p>'; -->
  
<?php
        }
// Affichez les commentaires enfants de manière récursive
        if (!empty($comment['children'])) {
            displayComments($comment['children']);
        }

        echo '</div>';
    }
}

displayComments($commentsTree);
?>

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

    render(<?= $page["content"] ?>, document.getElementById("root"));
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