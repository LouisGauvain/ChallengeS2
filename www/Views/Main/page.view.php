<div class="container">
    <h2>Vos Pages</h2>
    <ul class="list-group">
        <?php
        foreach ($pages as $page) {
            echo "<li class='list-group-item'><a href='" . $page['url_page'] . "'>" . $page['title'] . "</a></li>";
        }
        ?>
    </ul>
</div>