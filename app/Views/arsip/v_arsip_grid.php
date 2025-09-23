<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <?php if (!empty($arsip)) : ?>
                <?php foreach ($arsip as $ra) : ?>
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
                    <p>Belum ada arsip yang cocok dengan kriteria ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
