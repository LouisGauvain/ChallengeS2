<div class="container">
    <h1>Liste des Commentaires non validés</h1>
    <ul class="list-group">

    <?php var_dump($nonValidatedComment); ?>

    <?php foreach($nonValidatedComment as $comment)
    {
        echo "<li class='list-group-item'><a href='" . $comment['user_name'] . "'>" . $comment['content'] . "</a></li>";
    }
    ?>

    </ul>
</div>