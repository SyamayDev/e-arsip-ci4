<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data User</h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('user/add'); ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a>
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
                            <th>Departemen</th>
                            <th>Foto</th>
                            <th width="100px">Aksi</th>
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
                                <td><?= $value['nama_dep']; ?></td>
                                <td>
                                    <!-- Foto kecil bisa diklik -->
                                    <a href="#" data-toggle="modal" data-target="#fotoModal<?= $value['id_user']; ?>">
                                        <img src="<?= base_url('foto/' . $value['foto']); ?>" width="50" height="50" alt="Foto Profil">
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('user/edit/' . $value['id_user']); ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_user']; ?>"><i class="fa fa-trash-o"></i> Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="delete<?= $value['id_user']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Konfirmasi Hapus</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus user <strong><?= $value['nama_user']; ?></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                            <a href="<?= base_url('user/delete/' . $value['id_user']); ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- End Modal Hapus -->

                            <div class="modal fade" id="fotoModal<?= $value['id_user']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bg-transparent border-0 shadow-none">
                                        <div class="modal-body p-0 text-center">
                                            <img src="<?= base_url('foto/' . $value['foto']); ?>"
                                                class="img-fluid rounded"
                                                alt="Foto Profil"
                                                style="max-width:90%; height:auto;">
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