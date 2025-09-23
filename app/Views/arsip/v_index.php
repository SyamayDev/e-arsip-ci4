<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Arsip</h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('arsip/add'); ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success! - ';
                    echo session()->getFlashdata('pesan');
                    echo '</h4></div>';
                }
                ?>
                <table class="table table-hover table-striped table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Arsip</th>
                            <th>Nama Arsip</th>
                            <th>Kategori</th>
                            <th>Upload</th>
                            <th>Update</th>
                            <th>Masa Aktif</th>
                            <th>User</th>
                            <th>Bagian</th>
                            <th>File</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($arsip as $key => $value) {
                            $today = date('Y-m-d');
                            $is_expired = ($value['tgl_selesai_aktif'] != null && $value['tgl_selesai_aktif'] < $today);
                            $is_active = ($value['tgl_mulai_aktif'] != null && $value['tgl_selesai_aktif'] != null
                                && $value['tgl_mulai_aktif'] <= $today && $value['tgl_selesai_aktif'] >= $today);

                            $row_class = '';
                            if ($is_expired) {
                                $row_class = 'danger'; // merah expired
                            } elseif ($is_active) {
                                $row_class = 'success'; // hijau aktif
                            }
                        ?>
                            <tr class="<?= $row_class ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $value['no_arsip']; ?></td>
                                <td><?= $value['nama_arsip']; ?></td>
                                <td><?= $value['nama_kategori']; ?></td>
                                <td><?= $value['tgl_upload']; ?></td>
                                <td><?= $value['tgl_update']; ?></td>
                                <td>
                                    <?= $value['tgl_mulai_aktif']; ?> - <?= $value['tgl_selesai_aktif']; ?>
                                    <?php if ($is_expired): ?>
                                        <span class="label label-danger">Expired</span>
                                    <?php elseif ($is_active): ?>
                                        <span class="label label-success">Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['nama_user']; ?></td>
                                <td><?= $value['nama_bagian']; ?></td>
                                <td>
                                    <?php if ($is_expired && session()->get('level') == 2): ?>
                                        <a class="btn btn-sm btn-default disabled" title="Arsip telah melewati masa aktif">
                                            <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('arsip/view_pdf/' . $value['id_arsip']); ?>" class="btn btn-sm btn-danger" aria-label="Lihat PDF <?= $value['nama_arsip']; ?>">
                                            <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?><br>
                                    <?= number_format($value['ukuran_file'] / 1024, 2); ?> KB
                                </td>
                                <td class="text-center">
                                    <?php if ($is_expired && session()->get('level') == 2): ?>
                                        <a class="btn btn-xs btn-info disabled"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <button type="button" class="btn btn-xs btn-danger disabled"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    <?php else: ?>
                                        <a href="<?= base_url('arsip/edit/' . $value['id_arsip']); ?>" class="btn btn-xs btn-info" aria-label="Edit <?= $value['nama_arsip']; ?>">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_arsip']; ?>" aria-label="Hapus <?= $value['nama_arsip']; ?>">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="delete<?= $value['id_arsip']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $value['id_arsip']; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="deleteModalLabel<?= $value['id_arsip']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus arsip <strong><?= $value['nama_arsip']; ?></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                            <a href="<?= base_url('arsip/delete/' . $value['id_arsip']); ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->

                            <!-- Modal Foto -->
                            <div class="modal fade" id="fotoModal<?= $value['id_arsip']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bg-transparent border-0 shadow-none">
                                        <div class="modal-body p-0 text-center">
                                            <img src="<?= base_url('foto/' . $value['foto']); ?>"
                                                class="img-fluid rounded img-responsive-modal"
                                                alt="Foto profil <?= $value['nama_user']; ?>"
                                                loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Foto -->
                        <?php } ?>
                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script>
    $(function () {
        $('#example1').DataTable()
    })
</script>