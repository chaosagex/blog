<?php

require_once('config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/auth.php');
if (!isset($_REQUEST['id'])) {
    header('Location:index.php');
    die();
}
$id = $_REQUEST['id'];
$comment = getCommentById($id);
$post=getPostbyComment($id);
if (!checkIfUserCanEditComment($comment)) {
    header('Location:index.php');
    die();
}
deleteComment($id);
header('Location: ' . BASE_URL . '/post-details.php?id=' . $post);
die();
