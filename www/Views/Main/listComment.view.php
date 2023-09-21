<div class="container">
    <h1>Liste des Commentaires non validés</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Content</th>
                <th>Id de la page</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    echo "<tr>";
                    echo "<td>" . $comment['user_name'] . "</td>";
                    echo "<td>" . $comment['content'] . "</td>";
                    echo "<td>" . $comment['page_id'] . "</td>";

            ?>
                    <td>
                        <a href="admin/verify_comment?id=<?= $comment['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir vérifier ce commentaire ?')">Verifier</a> |
                        <a href="admin/delete_comment?id=<?= $comment['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
                    </td>
            <?php
                    echo "</tr>";
                }
            }
            ?>

        </tbody>
    </table>
</div>