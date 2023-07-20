<?php $user = $_SESSION['user']; ?>
<div class="container">
    <h3>Welcome <?= $user['firstname'] ?> <?= $user['lastname'] ?> ! </h3>
    <h4> un récapitulatif de vos informations : </h4>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['email'] ?></td>
            </tr>
    </table>
    <?php
    if ($user['role_id'] == 1 && isset($users)) {
        // Pagination configuration
        $itemsPerPage = 20;
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
        <h4>La liste des users</h4>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="<?= getSortClass('id') ?>">
                        <a href="?sort=id&order=<?= getSortOrder('id') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Id <?= getSortArrow('id') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('firstname') ?>">
                        <a href="?sort=firstname&order=<?= getSortOrder('firstname') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Firstname <?= getSortArrow('firstname') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('lastname') ?>">
                        <a href="?sort=lastname&order=<?= getSortOrder('lastname') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Lastname <?= getSortArrow('lastname') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('email') ?>">
                        <a href="?sort=email&order=<?= getSortOrder('email') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Email <?= getSortArrow('email') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('role_id') ?>">
                        <a href="?sort=role_id&order=<?= getSortOrder('role_id') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Role <?= getSortArrow('role_id') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('email_verified') ?>">
                        <a href="?sort=email_verified&order=<?= getSortOrder('email_verified') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Email verified <?= getSortArrow('email_verified') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('date_inserted') ?>">
                        <a href="?sort=date_inserted&order=<?= getSortOrder('date_inserted') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Date inserted <?= getSortArrow('date_inserted') ?>
                        </a>
                    </th>
                    <th class="<?= getSortClass('date_updated') ?>">
                        <a href="?sort=date_updated&order=<?= getSortOrder('date_updated') ?>&page=<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
                            Date updated <?= getSortArrow('date_updated') ?>
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($paginatedUsers as $user) { ?>
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
                                <a href="admin/edit_user?id=<?= $user['id'] ?>">Modifier</a> |
                                <a href="admin/delete_user?id=<?= $user['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            $queryParams = $_GET;
            unset($queryParams['page']);

            $queryString = http_build_query($queryParams);

            for ($page = 1; $page <= $totalPages; $page++) {
                $isActive = $page === $currentPage;
                $pageLink = '?page=' . $page . ($queryString ? '&' . $queryString : '');
            ?>
                <a href="<?= $pageLink ?>" <?= $isActive ? 'class="active"' : '' ?>>
                    <?= $page ?>
                </a>
            <?php } ?>
        </div>
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
    function buildQuery(...$params)
    {
        $queryParams = $_GET;
        foreach ($params as $index => $param) {
            if ($index % 2 === 0 && isset($_GET[$param]) && isset($params[$index + 1])) {
                $queryParams[$param] = $params[$index + 1];
            }
        }
        return http_build_query($queryParams);
    }

?>