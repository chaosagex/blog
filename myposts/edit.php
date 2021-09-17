<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');
function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}

$tags = getTags();
$categories = getCategories();
$post=null;
$postTags=null;
if (isset($_REQUEST['id'])) {
    $errors = validatePostEdit($_REQUEST);
    if (count($errors) == 0) {
        $post=getPost($_REQUEST['id']);
        $postTags=getPostTags($_REQUEST['id']);
        if(isset($_REQUEST['pid'])){
            // var_export($_REQUEST);
            // die();
        if (EditPost($_REQUEST, getUploadedImage($_FILES))) {
            header('Location:index.php');
            die();
        } else {
            $generic_error = "Error while adding the post";
        }
    }}
}

require_once(BASE_PATH . '/layout/header.php');
?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Add Post</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="POST" enctype="multipart/form-data">
                                <input name="title"  value=<?=$post['title']?> class="form-control" />
                                <?= isset($errors['title']) ? "<span class='text-danger'>" . $errors['title'] . "</span>" : "" ?>
                                <textarea name="content" class="form-control"><?=$post['content']?></textarea>
                                <?= isset($errors['content']) ? "<span class='text-danger'>" . $errors['content'] . "</span>" : "" ?>
                                <label>Upload Image<input type="file"  name="image" /></label><br />
                                <?= isset($errors['image']) ? "<span class='text-danger'>" . $errors['image'] . "</span>" : "" ?>
                                <label>Publish date<input type="date" name="publish_date" value=<?=date('Y-m-d H:i:s')?> class="form-control"></label>
                                <?= isset($errors['publish_date']) ? "<span class='text-danger'>" . $errors['publish_date'] . "</span>" : "" ?>
                                <select name="category_id" class="form-control">
                                    <option value="">Select category</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        
                                        echo $category['id']==$post['category_id']?"<option value='{$category['id']}' selected='selected'>{$category['name']}</option>":"<option value='{$category['id']}'>{$category['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['category_id']) ? "<span class='text-danger'>" . $errors['category_id'] . "</span>" : "" ?>
                                <select name="tags[]" multiple class="form-control">
                                    <?php
                                    $uniqueTags=[];
                                    foreach ($tags as $tag) {
                                        if(!empty($postTags)){
                                            
                                                foreach($postTags as $postTag){
                                                if(!in_array($tag['id'],$uniqueTags)){
                                                    echo $tag['id']==$postTag['id']? "<option value='{$tag['id']}' selected='selected'>{$tag['name']}</option>":"<option value='{$tag['id']}'>{$tag['name']}</option>";
                                                    array_push($uniqueTags,$tag['id']);
                                                }
                                            }
                                        }
                                        else
                                            echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['tags']) ? "<span class='text-danger'>" . $errors['tags'] . "</span>" : "" ?>
                                <input type="hidden" name="pid" value=<?=$_REQUEST['id']?>>
                                <button class="btn btn-success">Update Post</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>