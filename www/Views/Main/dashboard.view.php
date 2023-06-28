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
if($user['role_id'] == 1 && isset($users)){
    ?>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Email verified</th>
            <th>Date inserted</th>
            <th>Date updated</th>
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
                        <a <?php if ( $user['role_id'] === 1) echo 'class="disabled"' ?> href="edit.php?id=<?= $user['id'] ?>">Modifier</a> |
                        <a <?php if ( $user['role_id'] === 1) echo 'class="disabled"' ?> href="delete.php?id=<?= $user['id'] ?>">Supprimer</a>
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
