<?php $user = $_SESSION['user']; ?>
<div class="container">
    <h2>Vos Pages</h2>
    <div>
        <a href="admin/add_page" class="btn btn-primary">Ajouter une page</a>
        <a href="admin/add_page" class="btn btn-primary">Ajouter un template</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>URL</th>
                <th>Template</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pages as $page) {
                echo "<tr>";
                echo "<td><a href='" . $page['url_page'] . "'>" . $page['title'] . "</a></td>";
                echo "<td>" . $page['url_page'] . "</td>";
                echo "<td>" . $page['used_template'] . "</td>";
                ?>
                <td>
                    <?php if ($user['role_id'] == 1) { ?>
                        <a href="<?= $page['url_page'] ?>">Voir</a> |
                        <a href="admin/delete_page?id=<?= $page['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet page ?')">Supprimer</a>
                    <?php } ?>
                </td>
                <?php
                echo "</tr>";    

             }
            ?>
        </tbody>
    </table>
</div>
