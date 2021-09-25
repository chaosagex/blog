<nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2 style="color:white">Admin</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?= ($current_page == 'Posts' ? "active" : "") ?>">
                            <a style="color:white" class="nav-link" href="<?= BASE_URL . '/Admin' ?>">Posts
                                <?= ($current_page == 'Posts' ? "<span class='sr-only'>(current)</span>" : "") ?>
                            </a>
                        </li>
                        <li class="nav-item <?= ($current_page == 'users' ? "active" : "") ?>">
                            <a style="color:white" class="nav-link" href="<?= BASE_URL . '/Admin/users.php' ?>">Users</a>
                            <?= ($current_page == 'users' ? "<span class='sr-only'>(current)</span>" : "") ?>
                        </li>   
                        </ul>                     
                </div>
            </div>
        </nav>