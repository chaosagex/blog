<<?php
require_once('config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/auth.php');
require_once(BASE_PATH . '/layout/header.php');
if (!isset($_REQUEST['id'])) {
  header('Location:index.php');
  die();
}
if (isset($_REQUEST['comment'])) {


  $_REQUEST['comment'] = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);

  $temp = addNewComment($_REQUEST, getUserId(), date("Y-m-d"));

  if ($temp) {
    header('Location: ' . BASE_URL . '/post-details.php?id=' . $_REQUEST['id']);
    die();
  } else {
    $generic_error = "Error while adding the comment";
  }

}
$post = getPostDetailsById($_REQUEST['id'], getUserId());
?>
    <!-- Page Content -->
    <?php include(BASE_PATH . '/views/post-details-view.php') ?>


    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                
                 
                <div class="col-lg-12">
                  <div class="sidebar-item comments">
                    <div class="sidebar-heading">
                      <h2><?= count($post['comments']) ?> comments</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php
                        foreach ($post['comments'] as $comment) {

                          ?>
                        <li>
                          <div class="right-content">
                            <h4><?= $comment['author'] ?><span><?= $comment['comment_date'] ?></span></h4>
                            <p><?= $comment['comment'] ?></p>
                            <div class="col-md-6">
                <span id="likes_count_comment_<?= $comment['id'] ?>"><?= $comment['likes_count']; ?></span> Likes
                    </div>
                            <div class="col-md-6">
                <button id="likes_btn_comment_<?= $comment['id'] ?>" class="btn" type="button" onclick="likeComment(<?= $comment['id']; ?>)" style="display:<?= !$comment['liked_by_me'] ? "block" : "none" ?>">Like</button>
                <button id="unlikes_btn_comment_<?= $comment['id'] ?>" class="btn" type="button" onclick="unLikeComment(<?= $comment['id']; ?>)" style="display:<?= !$comment['liked_by_me'] ? "none" : "block" ?>">UnLike</button>
                <a  href='delete.php?id=<?=$comment['id']?>' class='btn btn-danger'>Delete</a>
            </div>
                          </div>
                        </li>
                      
                      <?php

                    }
                    ?>
                    </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2>Your comment</h2>
                    </div>
                    <div class="col-sm-12">
          <form method="POST" action="post-details.php">
            <div class="row">
            <input type="hidden" id="id" name="id" value=<?= $_REQUEST['id'] ?>>
              <label class="col-md-12">comment:</label> <input placeholder="Comment" name="comment" type="text" required class=" form-control" />
              <button class="btn btn-success btn-block">submit</button>
          </form>
        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <?php require_once('layout/footer.php') ?>
