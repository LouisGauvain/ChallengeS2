<div class="container">
    <h1>Liste des Pages</h1>
    <ul class="list-group">
        <?php 
        foreach($pages as $page){
            echo "<li class='list-group-item'><a href='".$page['url_page']."'>".$page['title']."</a></li>";
        }
        ?>
    </ul>
</div>