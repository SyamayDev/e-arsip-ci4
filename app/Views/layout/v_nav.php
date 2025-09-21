<!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
            // Definisikan link navigasi dalam bentuk array
            $nav_links = [
                ['title' => 'Home', 'url' => 'home'],
                ['title' => 'Kategori', 'url' => 'kategori'],
                ['title' => 'Departemen', 'url' => 'dep'],
                ['title' => 'Arsip', 'url' => 'arsip'],
                ['title' => 'User', 'url' => 'user'],
            ];

            // Loop melalui array dan buat link navigasi
            foreach ($nav_links as $link) {
                // Cek apakah link saat ini adalah halaman yang aktif
                $active_class = ($title == $link['title']) ? 'active' : '';
                echo '<li class="' . $active_class . '"><a href="' . base_url($link['url']) . '">' . $link['title'] . '</a></li>';
            }
            ?>
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