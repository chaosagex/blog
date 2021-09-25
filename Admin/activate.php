<?php

require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/logic/auth.php');
if (!isset($_REQUEST['id'])) {
    header('Location:users.php');
    die();
}
$id = $_REQUEST['id'];
activate($id);
header('Location:users.php');
die();
