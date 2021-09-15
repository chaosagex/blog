<?php
require_once(BASE_PATH . '/dal/basic_dal.php');

function getPosts($page_size, $page = 1, $category_id = null, $tag_id = null, $user_id = null, $q = null)
{
    $sql = "SELECT p.*,c.name AS category_name,u.name AS user_name FROM posts p
    INNER JOIN categories c ON c.id=p.category_id
    INNER JOIN users u ON u.id=p.user_id
    WHERE 1=1";
    if ($category_id != null) {
        $sql .= " AND category_id=$category_id";
    }
    if ($user_id != null) {
        $sql .= " AND user_id=$user_id";
    }
    if ($tag_id != null) {
        $sql .= " AND p.id IN (SELECT post_id FROM post_tags WHERE tag_id=$tag_id)";
    }
    if ($q != null) {
        $sql .= " AND (title like '%$q%' OR content like '%$q%')";
    }
    $offset = ($page - 1) * $page_size;
    $sql .= " ORDER BY publish_date desc limit $offset,$page_size";
    $posts =  getRows($sql);
    for ($i = 0; $i < count($posts); $i++) {
        $posts[$i]['comments'] = getPostCommentsCount($posts[$i]['id']);
        $posts[$i]['tags'] = getPostTags($posts[$i]['id']);
    }
    return $posts;
}


function getPostCommentsCount($postId)
{
    $sql = "SELECT COUNT(0) as cnt FROM comments WHERE post_id=$postId";
    $result = getRow($sql);
    if ($result == null) return 0;
    return $result['cnt'];
}

function getPostTags($postId)
{
    $sql = "SELECT t.id,t.name FROM post_tags pt
    INNER JOIN tags t ON t.id=pt.tag_id
    WHERE post_id=$postId";
    return getRows($sql);
}
function getCountPosts($category_id = null, $tag_id = null, $user_id = null, $q = null){
    $sql = "SELECT COUNT(0) as cnt,p.*,c.name AS category_name,u.name AS user_name FROM posts p
    INNER JOIN categories c ON c.id=p.category_id
    INNER JOIN users u ON u.id=p.user_id
    WHERE 1=1";
    if ($category_id != null) {
        $sql .= " AND category_id=$category_id";
    }
    if ($user_id != null) {
        $sql .= " AND user_id=$user_id";
    }
    if ($tag_id != null) {
        $sql .= " AND p.id IN (SELECT post_id FROM post_tags WHERE tag_id=$tag_id)";
    }
    if ($q != null) {
        $sql .= " AND (title like '%$q%' OR content like '%$q%')";
    }
    $result= getRow($sql);
    if ($result == null) return 0;
    return $result['cnt'];
}
function getPage($page=1,$category_id = null, $tag_id = null, $user_id = null, $q = null,$pageNum =1){
    $href=BASE_URL."/posts.php?";
    $first=true;
    if($category_id!=null){
        if($first){
            $href.=("category_id=".$category_id);
            $first=false;
        }
        else
            $href.=("&category_id=".$category_id);
    }
    if($user_id!=null){
        if($first){
                $href.=("user_id=".$user_id);
                $first=false;
            }
        else
            $href.=("&user_id=".$user_id);
    }
    if($tag_id!=null){
        if($first){
            $href.=("tag_id=".$tag_id);
            $first=false;
        }
        else
            $href.=("&tag_id=".$tag_id);
    }
    if($q!=null){
        if($first){
            $href.=("q=".$q);
            $first=false;
        }
        else
        $href.=("&q=".$q);
    }
    if($first){
        if($page<=1)
        $href.="page=1";
    else if($page>=$pageNum)
        $href.="page=$pageNum";
    else
        $href.="page=$page";
    }
    else{
        if($page<=1)
        $href.="&page=1";
    else if($page>=$pageNum)
        $href.="&page=$pageNum";
    else
        $href.="&page=$page";
    }
    
    return $href;
}