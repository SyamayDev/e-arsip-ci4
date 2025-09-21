<!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if (session()->get('level') == 1) { ?>
              <li class="<?php if($title == 'Home'){echo 'active';} ?>"><a href="<?= base_url('home') ?>">Home</a></li>
              <li class="<?php if($title == 'Kategori'){echo 'active';} ?>"><a href="<?= base_url('kategori') ?>">Kategori</a></li>
              <li class="<?php if($title == 'Departemen'){echo 'active';} ?>"><a href="<?= base_url('dep') ?>">Departemen</a></li>
              <li class="<?php if($title == 'Arsip'){echo 'active';} ?>"><a href="<?= base_url('arsip') ?>">Arsip</a></li>
              <li class="<?php if($title == 'User'){echo 'active';} ?>"><a href="<?= base_url('user') ?>">User</a></li>
            <?php } else { ?>
              <li class="<?php if($title == 'Arsip'){echo 'active';} ?>"><a href="<?= base_url('arsip') ?>">Arsip</a></li>
            <?php } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?= base_url('foto/' . session()->get('foto')) ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= session()->get('nama_user') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= base_url('foto/' . session()->get('foto')) ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= session()->get('nama_user') ?> - <?php if (session()->get('level') == '1') : ?>Admin<?php else : ?>User<?php endif; ?>
                    <small>
                        <?php
                        $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                        $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
                        $namaHari = $hari[date('l')];
                        $tanggal  = date('d');
                        $namaBulan = $bulan[date('F')];
                        $tahun   = date('Y');
                        echo "{$namaHari}, {$tanggal} {$namaBulan} {$tahun}";
                        ?>
                        <span id="realtime-clock"></span>
                    </small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $title ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> E-Arsip</a></li>
          <li class="active"><?= $title ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
<script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = ' - ' + hours + ':' + minutes + ':' + seconds;
        document.getElementById('realtime-clock').textContent = timeString;
    }
    setInterval(updateClock, 1000);
    updateClock(); // initial call
</script>