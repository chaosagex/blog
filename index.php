<?php require_once('layout/header.php'); ?>
  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        <div class="item">
          <img src="assets/images/banner-item-01.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html">
                <h4>Morbi dapibus condimentum</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 12, 2020</a></li>
                <li><a href="#">12 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-02.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html">
                <h4>Donec porttitor augue at velit</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 14, 2020</a></li>
                <li><a href="#">24 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-03.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html">
                <h4>Best HTML Templates on TemplateMo</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 16, 2020</a></li>
                <li><a href="#">36 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-04.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Fashion</span>
              </div>
              <a href="post-details.html">
                <h4>Responsive and Mobile Ready Layouts</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 18, 2020</a></li>
                <li><a href="#">48 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-05.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Nature</span>
              </div>
              <a href="post-details.html">
                <h4>Cras congue sed augue id ullamcorper</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 24, 2020</a></li>
                <li><a href="#">64 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="assets/images/banner-item-06.jpg" alt="">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>Lifestyle</span>
              </div>
              <a href="post-details.html">
                <h4>Suspendisse nec aliquet ligula</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">Admin</a></li>
                <li><a href="#">May 26, 2020</a></li>
                <li><a href="#">72 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->
  <section class="blog-posts">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="all-blog-posts">
          <div class="row">
 <?php
              //start of posts
$conn = mysqli_connect('localhost', 'root', '', 'blog');
if ($conn) {
  $SQL = "SELECT posts.content,\n"

    . "posts.title,\n"

    . "posts.publish_date,\n"

    . "posts.created_at,\n"

    . "posts.updated_at,\n"

    . "categories.name as Category,\n"

    . "users.name as User\n"

    . "FROM `posts` \n"

    . "join categories \n"

    . "on \n"

    . "categories.id=posts.category_id  \n"

    . "join users\n"

    . "on\n"

    . "posts.user_id = users.id\n"


    . "order by `created_at`\n"

    . "LIMIT 3;";
  $query = mysqli_query($conn, $SQL);
  $success = false;
  mysqli_close($conn);
  while (($row = mysqli_fetch_assoc($query)) != null) {
    $postTitle = $row['title'];
    $postContent = $row['content'];
    $postAuthor = $row['User'];
    $postPublishDate = $row['publish_date'];
    $postCategory = $row['Category'];

    echo '<div class="col-lg-12">';
    echo '<div class="blog-post">';
    echo '<div class="down-content">';
    echo "<span>$postCategory</span>";
    echo '<a href="post-details.html">';
    echo "<h4>$postTitle</h4>";
    echo '</a>';
    echo '<ul class="post-info">';
    echo "<li><a href=\"#\">$postAuthor</a></li>";
    echo "<li><a href=\"#\">$postPublishDate</a></li>";
    echo '<li><a href="#">12 Comments</a></li>';
    echo '</ul>';
    echo "<p>$postContent</p>";
    echo '<div class="post-options">';
    echo '<div class="row">';
    echo '<div class="col-6">';
    echo '<ul class="post-tags">';
    echo '<li><i class="fa fa-tags"></i></li>';
    echo '<li><a href="#">Beauty</a>,</li>';
    echo '<li><a href="#">Nature</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

  }
}
?>
<div class="col-lg-12">
                  <div class="main-button">
                    <a href="blog.html">View All Posts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <li><a href="#">- Nature Lifestyle</a></li>
                        <li><a href="#">- Awesome Layouts</a></li>
                        <li><a href="#">- Creative Ideas</a></li>
                        <li><a href="#">- Responsive Templates</a></li>
                        <li><a href="#">- HTML5 / CSS3 Templates</a></li>
                        <li><a href="#">- Creative &amp; Unique</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Tag Clouds</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <li><a href="#">Lifestyle</a></li>
                        <li><a href="#">Creative</a></li>
                        <li><a href="#">HTML5</a></li>
                        <li><a href="#">Inspiration</a></li>
                        <li><a href="#">Motivation</a></li>
                        <li><a href="#">PSD</a></li>
                        <li><a href="#">Responsive</a></li>
                      </ul>
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