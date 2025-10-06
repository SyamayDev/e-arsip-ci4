<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Kwitansi</h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('kwitansi/add') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah Kwitansi</a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <table id="example1" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>No. Kwitansi</th>
                            <th>Tanggal</th>
                            <th>Diterima Dari</th>
                            <th>Keperluan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kwitansi as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['no_kwitansi']; ?></td>
                                <td><?= date('d M Y', strtotime($value['tanggal'])); ?></td>
                                <td><?= $value['telah_diterima_dari']; ?></td>
                                <td><?= $value['untuk_keperluan']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('kwitansi/print/' . $value['id_kwitansi']) ?>" class="btn btn-xs btn-success" target="_blank" aria-label="Cetak <?= $value['no_kwitansi']; ?>"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="<?= base_url('kwitansi/edit/' . $value['id_kwitansi']) ?>" class="btn btn-xs btn-info" aria-label="Edit <?= $value['no_kwitansi']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_kwitansi']; ?>" aria-label="Hapus <?= $value['no_kwitansi']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<!-- Modal Delete -->
<?php foreach ($kwitansi as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value['id_kwitansi']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $value['id_kwitansi']; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="deleteModalLabel<?= $value['id_kwitansi']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kwitansi nomor <strong><?= $value['no_kwitansi']; ?></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="<?= base_url('kwitansi/delete/' . $value['id_kwitansi']); ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    $(function () {
        $('#example1').DataTable()
    })
</script>