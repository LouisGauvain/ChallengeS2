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
            <th>
                <a href="?sort=id&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'id' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Id
                </a>
            </th>
            <th>
                <a href="?sort=firstname&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'firstname' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Firstname
                </a>
            </th>
            <th>
                <a href="?sort=lastname&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'lastname' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Lastname
                </a>
            </th>
            <th>
                <a href="?sort=email&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'email' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Email
                </a>
            </th>
            <th>
                <a href="?sort=role_id&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'role_id' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Role
                </a>
            </th>
            <th>
                <a href="?sort=email_verified&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'email_verified' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Email verified
                </a>
            </th>
            <th>
                <a href="?sort=date_inserted&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'date_inserted' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Date inserted
                </a>
            </th>
            <th>
                <a href="?sort=date_updated&order=<?= isset($_GET['sort']) && $_GET['sort'] === 'date_updated' && isset($_GET['order']) && $_GET['order'] === 'asc' ? 'desc' : 'asc' ?>">
                    Date updated
                </a>
            </th>
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