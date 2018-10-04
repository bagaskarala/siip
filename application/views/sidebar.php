<?php 
    $username = ucwords($this->session->userdata('username'));
    $ceklevel = $this->session->userdata('level');
    $level = ucwords(str_replace('_', ' ', $ceklevel));
    $ceklevelasli = $this->session->userdata('level_asli');
?>
<!-- .app-aside -->
  <aside class="app-aside">
    <!-- .aside-content -->
    <div class="aside-content">
      <!-- .aside-header -->
      <header class="aside-header d-block d-md-none">
        <!-- .btn-account -->
        <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
          <span class="user-avatar user-avatar-lg">
            <img src="<?= base_url('assets/images/avatars/profile.jpg') ?>" alt="">
          </span>
          <span class="account-icon">
            <span class="fa fa-caret-down fa-lg"></span>
          </span>
          <span class="account-summary">
            <span class="account-name"><?=$username ?></span>
            <span class="account-description"><?=$level ?></span>
          </span>
        </button>
        <!-- /.btn-account -->
        <!-- .dropdown-aside -->
        <div id="dropdown-aside" class="dropdown-aside collapse">
          <!-- dropdown-items -->
          <div class="pb-3">
            <?php if($ceklevelasli=='author_reviewer'): ?>
                <?php if($ceklevel=='author'): ?>
                  <a class="dropdown-item" href="<?=base_url('login/multilevel/reviewer') ?>">
                    <span class="dropdown-icon fa fa-sign-in-alt"></span> Masuk sebagai Reviewer</a>
                <?php else: ?>
                  <a class="dropdown-item" href="<?=base_url('login/multilevel/author') ?>">
                    <span class="dropdown-icon fa fa-sign-in-alt"></span> Masuk sebagai Author</a>
                <?php endif ?>
                <hr>
              <?php endif ?>
            <a class="dropdown-item" href="user-profile.html">
              <span class="dropdown-icon oi oi-person"></span> Profile</a>
            <a class="dropdown-item" href="auth-signin-v1.html">
              <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
          </div>
          <!-- /dropdown-items -->
        </div>
        <!-- /.dropdown-aside -->
      </header>
      <!-- /.aside-header -->
      <!-- .aside-menu -->
      <section class="aside-menu has-scrollable">
        <!-- .stacked-menu -->
        <nav id="stacked-menu" class="stacked-menu">
          <!-- .menu -->
          <ul class="menu">
            <!-- .menu-item -->
            <li class="menu-item has-active">
              <a href="<?= base_url() ?>" class="menu-link">
                <span class="menu-icon oi oi-dashboard"></span>
                <span class="menu-text">Dashboard</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- .menu-header -->
            <li class="menu-header">Penerbitan </li>
            <!-- /.menu-header -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?= base_url('draft') ?>" class="menu-link">
                <span class="menu-icon fa fa-paperclip"></span>
                <span class="menu-text">Draft Usulan</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?= base_url('book') ?>" class="menu-link">
                <span class="menu-icon fa fa-book"></span>
                <span class="menu-text">Buku</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- jika bukan superadmin / admin penerbitan maka tampil draft sama buku doang -->
            <?php if ($ceklevel == 'superadmin' || $ceklevel == 'admin_penerbitan'): ?>
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?= base_url('author') ?>" class="menu-link">
                <span class="menu-icon fa fa-user-tie"></span>
                <span class="menu-text">Penulis</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?= base_url('reviewer') ?>" class="menu-link">
                <span class="menu-icon fa fa-user-graduate"></span>
                <span class="menu-text">Reviewer</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?= base_url('worksheet') ?>" class="menu-link">
                <span class="menu-icon oi oi-pencil"></span>
                <span class="menu-text">Lembar Kerja</span>
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- .menu-item -->
            <li class="menu-item has-child">
              <a href="#" class="menu-link">
                <span class="menu-icon oi oi-puzzle-piece"></span>
                <span class="menu-text">Data Pendukung</span>
              </a>
              <!-- child menu -->
              <ul class="menu">
                <li class="menu-item">
                  <a href="<?= base_url('category') ?>" class="menu-link">Data Kategori</a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('theme') ?>" class="menu-link">Data Tema</a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('faculty') ?>" class="menu-link">Data Fakultas</a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('work_unit') ?>" class="menu-link">Data Unit Kerja</a>
                </li>
                <li class="menu-item">
                  <a href="<?= base_url('institute') ?>" class="menu-link">Data Institusi</a>
                </li>
              </ul>
              <!-- /child menu -->
            </li>
            <!-- /.menu-item -->
            <!-- .menu-header -->
            <li class="menu-header">LAPORAN </li>
            <!-- /.menu-header -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?=base_url('reporting') ?>" class="menu-link">
                <span class="menu-icon fa fa-chart-bar"></span>
                <span class="menu-text">Laporan</span>    
              </a>
            </li>
            <!-- /.menu-item -->
            <!-- if superadmin halaman user -->
            <?php if ($ceklevel == 'superadmin'): ?>
            <!-- .menu-header -->
            <li class="menu-header">Akun </li>
            <!-- /.menu-header -->
            <!-- .menu-item -->
            <li class="menu-item">
              <a href="<?=base_url('user') ?>" class="menu-link">
                <span class="menu-icon fa fa-users"></span>
                <span class="menu-text">User</span>    
              </a>
            </li>
            <!-- /.menu-item -->
            <?php endif ?>
            <!-- endif superadmin halaman user -->
          <?php endif ?>
          </ul>
          <!-- /.menu -->
        </nav>
        <!-- /.stacked-menu -->
      </section>
      <!-- /.aside-menu -->
    </div>
    <!-- /.aside-content -->
  </aside>
  <!-- /.app-aside -->
