<!-- Arsip Terbaru -->
<div class="row">
    <div class="col-lg-3 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $tot_arsip; ?></h3>
                <p>File Arsip</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-pdf-o"></i>
            </div>
            <a href="<?= base_url('arsip') ?>" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $tot_kategori; ?></h3>
                <p>Kategori</p>
            </div>
            <div class="icon">
                <i class="fa fa-folder-open-o"></i>
            </div>
            <a href="<?= base_url('kategori') ?>" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $tot_user; ?></h3>
                <p>User</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?= base_url('user') ?>" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $tot_dep; ?></h3>
                <p>Departemen</p>
            </div>
            <div class="icon">
                <i class="fa fa-building-o"></i>
            </div>
            <a href="<?= base_url('dep') ?>" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">📂 Arsip Terbaru</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php if (!empty($recent_arsip)) : ?>
                        <?php foreach ($recent_arsip as $ra) : ?>
                            <div class="col-md-2 col-sm-3 col-xs-6 text-center mb-3">
                                <div class="file-item" style="border: 1px solid #ddd; border-radius: 4px; overflow: hidden; transition: box-shadow 0.3s; background: #fff;">
                                    <a href="<?= base_url('arsip/view_pdf/' . $ra['id_arsip']) ?>" class="text-decoration-none">
                                        <!-- Pratinjau Sederhana (Placeholder) -->
                                        <div class="file-preview" style="height: 100px; background: #f5f5f5; display: flex; align-items: center; justify-content: center; padding: 10px;">
                                            <i class="fa fa-file-pdf-o fa-3x" style="color: #d81b60;"></i>
                                            <p class="text-muted small mt-1"><?= substr($ra['nama_arsip'], 0, 10) . (strlen($ra['nama_arsip']) > 10 ? '...' : '') ?></p>
                                        </div>
                                        <!-- Nama File -->
                                        <div class="file-name" style="background: #fff; min-height: 60px; padding: 10px;">
                                            <p class="mb-1"><?= substr($ra['nama_arsip'], 0, 15) . (strlen($ra['nama_arsip']) > 15 ? '...' : '') ?></p>
                                            <small class="text-muted"><?= date('d-m-Y', strtotime($ra['tgl_upload'])) ?></small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-md-12 text-center">
                            <p>Belum ada arsip</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Arsip -->
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">📊 Arsip per Bulan</h3>
            </div>
            <div class="box-body">
                <?php foreach ($arsip_bulan as $ab) :
                    $persen = ($tot_arsip > 0) ? round(($ab['total'] / $tot_arsip) * 100, 1) : 0;
                ?>
                    <p><strong><?= $ab['bulan']; ?></strong> (<?= $ab['total']; ?> Arsip)</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: <?= $persen; ?>%">
                            <?= $persen; ?>%
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">🏢 Arsip per Departemen</h3>
            </div>
            <div class="box-body">
                <?php foreach ($arsip_dep as $ad) :
                    $persen = ($tot_arsip > 0) ? round(($ad['total'] / $tot_arsip) * 100, 1) : 0;
                ?>
                    <p><strong><?= $ad['nama_dep']; ?></strong> (<?= $ad['total']; ?> Arsip)</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?= $persen; ?>%">
                            <?= $persen; ?>%
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>