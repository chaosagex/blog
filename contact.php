
<?php
require_once('config.php');
require_once(BASE_PATH . '/layout/header.php');
if(isset($_REQUEST['msg'])){
    $to_email = "blogMessages81@gmail.com";
    $subject = $_REQUEST['subject'];
    $body = $_REQUEST['msg'];
    $headers = "From: sender\'s email";
    if (mail($to_email, $subject, $body, $headers)) {
         "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
}

?>

<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Contact USt</h4>
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
    <input name="subject" placeholder="subject" class="form-control" />
        <textarea name="msg" placeholder="Message" class="form-control"></textarea>
        <button class="btn btn-success">Create Post</button>
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('layout/footer.php') ?>