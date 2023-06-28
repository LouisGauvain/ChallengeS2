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
    // Pagination configuration
    $itemsPerPage = 1;
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $totalItems = count($users);
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Calculate the index range for the current page
    $startIndex = ($currentPage - 1) * $itemsPerPage;
    $endIndex = $startIndex + $itemsPerPage - 1;
    $endIndex = min($endIndex, $totalItems - 1);

    // Get the slice of users for the current page
    $paginatedUsers = array_slice($users, $startIndex, $itemsPerPage);
?>
    <table>
        <thead>
            <tr>
                <th class="<?= getSortClass('id') ?>">
                    <a href="?sort=id&order=<?= getSortOrder('id') ?>">
                        Id <?= getSortArrow('id') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('firstname') ?>">
                    <a href="?sort=firstname&order=<?= getSortOrder('firstname') ?>">
                        Firstname <?= getSortArrow('firstname') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('lastname') ?>">
                    <a href="?sort=lastname&order=<?= getSortOrder('lastname') ?>">
                        Lastname <?= getSortArrow('lastname') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('email') ?>">
                    <a href="?sort=email&order=<?= getSortOrder('email') ?>">
                        Email <?= getSortArrow('email') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('role_id') ?>">
                    <a href="?sort=role_id&order=<?= getSortOrder('role_id') ?>">
                        Role <?= getSortArrow('role_id') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('email_verified') ?>">
                    <a href="?sort=email_verified&order=<?= getSortOrder('email_verified') ?>">
                        Email verified <?= getSortArrow('email_verified') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('date_inserted') ?>">
                    <a href="?sort=date_inserted&order=<?= getSortOrder('date_inserted') ?>">
                        Date inserted <?= getSortArrow('date_inserted') ?>
                    </a>
                </th>
                <th class="<?= getSortClass('date_updated') ?>">
                    <a href="?sort=date_updated&order=<?= getSortOrder('date_updated') ?>">
                        Date updated <?= getSortArrow('date_updated') ?>
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($paginatedUsers as $user) { ?>
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
    <div class="pagination">
        <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
            <a href="?page=<?= $page ?>" <?= $page === $currentPage ? 'class="active"' : '' ?>>
                <?= $page ?>
            </a>
        <?php } ?>
    </div>
<?php
}

function getSortClass($column)
{
    if (isset($_GET['sort']) && $_GET['sort'] === $column) {
        return 'sorted';
    }
    return '';
}

function getSortOrder($column)
{
    if (isset($_GET['sort']) && $_GET['sort'] === $column && isset($_GET['order'])) {
        return $_GET['order'] === 'asc' ? 'desc' : 'asc';
    }
    return 'asc';
}

function getSortArrow($column)
{
    if (isset($_GET['sort']) && $_GET['sort'] === $column && isset($_GET['order'])) {
        if ($_GET['order'] === 'asc') {
            return '&#9650;'; // Upward arrow
        } else {
            return '&#9660;'; // Downward arrow
        }
    }
    return '';
}
?>