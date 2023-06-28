<?php

$user = $_SESSION['user'];

?>

Welcome <?= $user['firstname'] ?> <?= $user['lastname'] ?> !

Voici un récapitulatif de vos informations :
<?php
foreach ($user as $key => $value) {
    echo $key . " : " . $value . "<br>";
}
?>

<?php
if ($user['role_id'] == 1 && isset($users)) {
?>
    <table>
        <thead>
            <tr>
                <th><a href="?sort=id">Id</a></th>
                <th><a href="?sort=firstname">Firstname</a></th>
                <th><a href="?sort=lastname">Lastname</a></th>
                <th><a href="?sort=email">Email</a></th>
                <th><a href="?sort=role_id">Role</a></th>
                <th><a href="?sort=email_verified">Email verified</a></th>
                <th><a href="?sort=date_inserted">Date inserted</a></th>
                <th><a href="?sort=date_updated">Date updated</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role_id'] ?></td>
                    <td><?= $user['email_verified'] ?></td>
                    <td><?= $user['date_inserted'] ?></td>
                    <td><?= $user['date_updated'] ?></td>
                    <td>
                        <?php if ($user['role_id'] != 1) { ?>
                            <a href="edit.php?id=<?= $user['id'] ?>">Modifier</a> |
                            <a href="delete.php?id=<?= $user['id'] ?>">Supprimer</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

<?php
}
?>