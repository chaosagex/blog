<?php
function getConnection()
{
    $conn = mysqli_connect('localhost', 'root', '', 'blog');
    mysqli_query($conn, "SET CHARACTER SET utf-8");
    return $conn;
}

function getRows($sql, $types = null, $vals = null)
{
    $results = [];
    $conn = getConnection();
    if ($conn) {
        if ($types && $vals) {
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, $types, ...$vals);
            mysqli_stmt_execute($stmt);
            $query = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $query = mysqli_query($conn, $sql);
        }
        mysqli_close($conn);
        while (($row = mysqli_fetch_assoc($query)) != null) {
            array_push($results, $row);
        }
    }
    return $results;
}

function getRow($sql, $types = null, $vals = null)
{
    $results = getRows($sql, $types, $vals);
    if (count($results) > 0)
        return $results[0];
    return null;
}

function addData($sql, $types, $vals)
{
    $conn = getConnection();
    if ($conn) {
        if ($types && $vals) {
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, $types, ...$vals);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            mysqli_query($conn, $sql);
        }
    }
    $rowAffected = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $rowAffected;
}

function editData($sql, $types, $vals)
{
    $conn = getConnection();
    if ($conn) {
        if ($types && $vals) {
            // var_export($sql);
            // die();
            $stmt = mysqli_prepare($conn, $sql);
            // var_export($stmt);
            // die();
            mysqli_stmt_bind_param($stmt, $types, ...$vals);
            $updated=mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            mysqli_query($conn, $sql);
        }
    }
    mysqli_close($conn);
    return $updated;
}

function deleteData($sql,$types,$vals)
{
    return addData($sql,$types,$vals);
}
