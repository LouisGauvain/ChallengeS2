<?php

use App\Core\Utils;

$user = $_SESSION['user']; ?>
<div class="container">
    <h2>Vos Pages</h2>
    <div>
        <a href="choice_template_page" class="btn btn-primary">Ajouter une page</a>
        <?php if ($user['role_id'] == 1) { ?>
            <a href="add_template_page" class="btn btn-primary">Ajouter un template</a>
        <?php } ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>URL</th>
                <th>Template</th>
                <?php 
                if (Utils::isAdmin() == true) { ?>
                    <th>Actions</th>
                <?php }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pages as $page) {
                for($i = 0; $i < count($templates); $i++){
                    if($page['used_template'] == $templates[$i]['id']){
                        $page['used_template'] = $templates[$i]['name'];
                    }
                }
                echo "<tr>";
                echo "<td><a href='" . $page['url_page'] . "'>" . $page['title'] . "</a></td>";
                echo "<td>" . $page['url_page'] . "</td>";
                echo "<td>" . $page['used_template'] . "</td>";
            ?>
                <?php if (Utils::isAdmin() == true) { ?>
                    <td>

                        <a href="<?= $page['url_page'] ?>">Voir</a> |
                        <a href="admin/delete_page?id=<?= $page['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet page ?')">Supprimer</a>
                    </td>
                <?php } ?>
            <?php
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>