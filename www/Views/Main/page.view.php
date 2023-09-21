<div class="container">
    <h2>Les catagories</h2>
    <ul class="list-group">
        <?php
        foreach ($categories as $category) {
            echo "<button class='list-group-item' onclick=window.location.href='/?category=" . $category["name"] . "'>" . $category["name"] . "</button>";
        }
        ?>
    </ul>
    <h2>Vos Pages</h2>
    <ul class="list-group">
        <?php
        foreach ($pages as $page) {
            echo "<li class='list-group-item'><a href='" . $page['url_page'] . "'>" . $page['title'] . "</a></li>";
        }
        ?>
    </ul>
</div>