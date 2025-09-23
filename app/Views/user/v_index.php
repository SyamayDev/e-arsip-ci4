<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data User</h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('user/add'); ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
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
                            <th width="50px">No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Bagian</th>
                            <th>Foto</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($user as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_user']; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['password']; ?></td>
                                <td>
                                    <?php if ($value['level'] == '1') { ?>
                                        Admin
                                    <?php } else { ?>
                                        User
                                    <?php } ?>
                                </td>
                                <td><?= $value['nama_bagian']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#fotoModal<?= $value['id_user']; ?>" aria-label="Lihat foto <?= $value['nama_user']; ?>">
                                        <img src="<?= base_url('foto/' . $value['foto']); ?>" width="50" height="50" alt="Foto Profil <?= $value['nama_user']; ?>" loading="lazy">
                                    </button>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('user/edit/' . $value['id_user']); ?>" class="btn btn-xs btn-info"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_user']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="delete<?= $value['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $value['id_user']; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="deleteModalLabel<?= $value['id_user']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus user <strong><?= $value['nama_user']; ?></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                            <a href="<?= base_url('user/delete/' . $value['id_user']); ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->

                            <div class="modal fade" id="fotoModal<?= $value['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel<?= $value['id_user']; ?>">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bg-transparent border-0 shadow-none">
                                        <div class="modal-body p-0 text-center">
                                            <img src="<?= base_url('foto/' . $value['foto']); ?>"
                                                class="img-fluid rounded img-responsive-modal"
                                                alt="Foto Profil <?= $value['nama_user']; ?>"
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