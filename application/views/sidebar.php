<?php
    $is_login = $this->session->userdata('is_login');
    $level    = $this->session->userdata('level');
?>

<?php if ($is_login): ?>
    <div class="row">
        <div class="col-2">
            <h3>Menu</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-home"><?= anchor(base_url(), 'Home') ?></li>
                    <li id="menu-logout"><?= anchor('login/logout', 'Logout') ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Superadmin -->
    <?php if($level === 'superadmin' || $level === 'admin_penerbitan'): ?>
    <div class="row">
        <div class="col-2">
            <h3>Directory</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-process"><?= anchor('admin/draft_author', 'Draft Author') ?></li>
                    <li id="menu-process"><?= anchor('admin/draft_reviewer', 'Draft Reviewer') ?></li>
                    <li id="menu-draft"><?= anchor('admin/draft', 'Draft') ?></li>
                    <li id="menu-author"><?= anchor('admin/author', 'Author') ?></li>
                    <li id="menu-reviewer"><?= anchor('admin/reviewer', 'Reviewer') ?></li>
                    <li id="menu-worksheet"><?= anchor('admin/worksheet', 'Worksheet') ?></li>
                    <li id="menu-theme"><?= anchor('admin/theme', 'Theme') ?></li>
                    <li id="menu-category"><?= anchor('admin/category', 'Category') ?></li>
                    <li id="menu-book"><?= anchor('admin/book', 'Book') ?></li>                    
                </ul>
            </div>
        </div>
    </div>
    <?php endif ?>

    <?php if($level === 'superadmin'): ?>
    <div class="row">
        <div class="col-2">
            <h3>Menu Admin</h3>
            <div class="sidebar-box">
                <ul>
                        <li id="menu-responsibility"><?= anchor('superadmin/responsibility', 'Responsibility') ?></li>
                        <li id="menu-user"><?= anchor('superadmin/user', 'User') ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif ?>

    <!-- Reviewer -->
    <?php if($level === 'reviewer'): ?>
    <div class="row">
        <div class="col-2">
            <h3>Directory</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-process"><?= anchor('reviewerdraft', 'Reviewer Draft') ?></li>
                    <!-- <li id="menu-process"><?= anchor('draftreviewer', 'Draft Reviewer') ?></li> -->
                    <!-- <li id="menu-draft"><?= anchor('draft', 'Draft') ?></li> -->
                    <!-- <li id="menu-author"><?= anchor('author', 'Author') ?></li> -->
                    <!-- <li id="menu-reviewer"><?= anchor('reviewer', 'Reviewer') ?></li> -->
                    <!-- <li id="menu-worksheet"><?= anchor('worksheet', 'Worksheet') ?></li> -->
                    <!-- <li id="menu-theme"><?= anchor('theme', 'Theme') ?></li> -->
                    <!-- <li id="menu-category"><?= anchor('category', 'Category') ?></li> -->
                    <!-- <li id="menu-book"><?= anchor('book', 'Book') ?></li>                     -->
                </ul>
            </div>
        </div>
    </div>
    <?php endif ?>
<?php else: ?>
    <div class="row">
        <div class="col-2">
            <h3>Menu</h3>
            <div class="sidebar-box">
                <ul>

                    <li id="menu-book"><?= anchor('login/index', 'Login') ?></li>
                </ul>
            </div>
        </div>
    </div>
<?php endif ?>