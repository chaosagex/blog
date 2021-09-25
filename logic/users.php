<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getuserz(
    $page_size,
    $page = 1,
    $q = null,
    $order_field = "id",
    $order_by = "desc"
) {

    $offset = ($page - 1) * $page_size;

    $sql = "SELECT * FROM users
    WHERE 1=1";

    $types = '';
    $vals = [];
    $sql = addWhereCondition($sql, $q, $types, $vals);
    $sql .= " ORDER BY $order_field $order_by limit $offset,$page_size";

    $users =  getRows($sql, $types, $vals);

    return $users;
}
function getUsers($page_size, $page, $q, $order_field, $order_by)
{
    return [
        'data' => getUserz($page_size, $page, $q, $order_field, $order_by),
        'count' => getusersCount( $q)
    ];
}
function addWhereCondition($sql, $q = null, &$types, &$vals)
{
    if ($q != null) {
        $types .= 'ss';
        array_push($vals, '%' . $q . '%');
        array_push($vals, '%' . $q . '%');
        $sql .= " AND (title like ? OR content like ?)";
    }
    return $sql;
}
function getUsersCount( $q = null)
{
    $sql = "SELECT count(0) as cnt FROM users
    WHERE 1=1";
    $types = '';
    $vals = [];
    $sql = addWhereCondition($sql, $category_id, $tag_id, $user_id, $q, $types, $vals);
    return  getRow($sql, $types, $vals)['cnt'];
}
function deActivate($id)
{
    $types = 'ii';
    $vals = [0,$id];
    $sql = "UPDATE users SET active=?";
    $sql .= " WHERE id=?";
    if (editData($sql, $types, $vals)) 
        return true;
    return false;
}
function activate($id)
{
    $types = 'ii';
    $vals = [1,$id];
    $sql = "UPDATE users SET active=?";
    $sql .= " WHERE id=?";
    if (editData($sql, $types, $vals)) 
        return true;
    return false;
}
function deleteUser($id)
{
    $sql = "DELETE FROM users WHERE id=?";
    execute($sql, 'i', [$id]);
}