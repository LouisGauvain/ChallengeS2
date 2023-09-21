<div class="container">
    <h2>Les catégories</h2>
    <ul class="list-group">
        <?php
        foreach ($categories as $category) {
            echo "<button class='list-group-item' onclick=\"window.location.href='/?category=" . $category["name"] . "'\">" . $category["name"] . "</button>";
        }
        ?>
        <button class='list-group-item' onclick="window.location.href='/'">Toutes les pages</button>
    </ul>
    <h2>Les Pages <?php  
    //si on a une catégorie dans l'url on affiche le nom de la catégorie
    if(isset($_GET['category'])){
        echo "de la catégorie " . $_GET['category'];
    }
    ?></h2>
    <ul class="list-group">
        <?php
        foreach ($pages as $page) {
            echo "<li class='list-group-item'><a href='" . $page['url_page'] . "'>" . $page['title'] . "</a></li>";
        }
        ?>
    </ul>
</div>