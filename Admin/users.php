<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/logic/auth.php');
require_once(BASE_PATH . '/layout/header.php');
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$page_size = 10;
$order_field = isset($_REQUEST['order_field']) ? $_REQUEST['order_field'] : 'id';
$order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : 'asc';
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
function getUrl($page, $q, $order_field, $order_by)
{
    return "index.php?page=$page&q=$q&order_field=$order_field&order_by=$order_by";
}
function getSortingUrl($field, $oldOrderField, $oldOrderBy, $q)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "index.php?page=1&q=$q&order_field=$field&order_by=desc";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "index.php?page=1&q=$q";
    }
    return  "index.php?page=1&q=$q&order_field=$field&order_by=asc";
}

function getSortFlag($field, $oldOrderField, $oldOrderBy)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "<i class='fa fa-sort-up'></i>";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "<i class='fa fa-sort-down'></i>";
    }
    return  "";
}

$users = getUsers($page_size, $page, $q, $order_field, $order_by);
$page_count = ceil($users['count'] / $page_size);
/*
$users = ['data'=>[],'count'=>100,'order_field'=>'title','order_by'=>'asc']
*/

?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <?php
                            require_once(BASE_PATH . '/layout/adminHeader.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-users">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="sidebar-item search">
                                <form id="search_form" name="gs" method="GET" action="">
                                    <input type="text" class="form-control" value="<?= isset($_REQUEST['q']) ? $_REQUEST['q'] : '' ?>" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                                </form>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><a href="<?= getSortingUrl('name', $order_field, $order_by, $q) ?>">Name <?= getSortFlag('name', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('username', $order_field, $order_by, $q) ?>">User Name <?= getSortFlag('username', $order_field, $order_by) ?></a></th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th><a href="<?= getSortingUrl('type', $order_field, $order_by, $q) ?>">Type <?= getSortFlag('type', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('active', $order_field, $order_by, $q) ?>">Active <?= getSortFlag('active', $order_field, $order_by) ?></a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = ($page - 1) * $page_size + 1;
                                foreach ($users['data'] as $user) {
                                    $tableRow= "<tr>
                                    <td>$i</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['username']}</td>
                                    <td>{$user['email']}</td>
                                    <td>{$user['phone']}</td>
                                    <td>{$user['type']}</td>
                                    <td>{$user['active']}</td>
                                    <td>";
                                    if ($user['active'])
                                        $tableRow.="<a href='deactivate.php?id={$user['id']}' class='btn btn-danger'>Deactivate</a>";
                                    else
                                        $tableRow.="<a href='activate.php?id={$user['id']}' class='btn btn-success'>Activate</a>";
                                    $tableRow.="<a onclick='return confirm(\"Are you sure ?\")' href='deleteUser.php?id={$user['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
                                    </tr>";
                                    echo $tableRow;
                                    $i++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <ul class="page-numbers">
                            <?php
                            $prevUrl = getUrl($page - 1, $q, $order_field, $order_by);
                            $nxtUrl = getUrl($page + 1, $q, $order_field, $order_by);

                            if ($page > 1) echo "<li><a href='{$prevUrl}'><i class='fa fa-angle-double-left'></i></a></li>";

                            for ($i = 1; $i <= $page_count; $i++) {
                                $url = getUrl($i, $q, $order_field, $order_by);
                                echo "<li class=" . ($i == $page ? "active" : "") . "><a href='{$url}'>{$i}</a></li>";
                            }

                            if ($page < $page_count) echo "<li><a href='{$nxtUrl}'><i class='fa fa-angle-double-right'></i></a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>