<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Departemen</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#add"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check" aria-hidden="true"></i> Success! - ';
                    echo session()->getFlashdata('pesan');
                    echo '</h4></div>';
                }
                ?>
                <table class="table table-hover table-striped table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Departemen</th>
                            <th class="text-center" width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dep as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_dep']; ?></td>
                                <td>
                                    <a href="<?= base_url('departemen/edit/' . $value['id_dep']); ?>" class="btn btn-xs btn-info" data-target="#edit<?= $value['id_dep']; ?>" data-toggle="modal" aria-label="Edit Departemen <?= $value['nama_dep']; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_dep']; ?>" aria-label="Hapus Departemen <?= $value['nama_dep']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
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

<!-- Modal Add dep -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addDepartemenLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addDepartemenLabel">Tambah Departemen</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('dep/add') ?>
                <div class="form-group">
                    <label for="nama_dep_add">Departemen</label>
                    <input id="nama_dep_add" class="form-control" name="nama_dep" placeholder="Masukan Nama Departemen">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end modal add -->

<!-- Modal Edit dep -->
<?php foreach ($dep as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_dep']; ?>" tabindex="-1" role="dialog" aria-labelledby="editDepartemenLabel<?= $value['id_dep']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editDepartemenLabel<?= $value['id_dep']; ?>">Edit Departemen</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('dep/edit/' . $value['id_dep']) ?>
                    <div class="form-group">
                        <label for="nama_dep_edit<?= $value['id_dep']; ?>">Departemen</label>
                        <input id="nama_dep_edit<?= $value['id_dep']; ?>" class="form-control" name="nama_dep" placeholder="Masukan Nama Departemen" value="<?= $value['nama_dep']; ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- end modal edit -->
<?php } ?>

<!-- Modal Hapus dep -->
<?php foreach ($dep as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_dep']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteDepartemenLabel<?= $value['id_dep']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteDepartemenLabel<?= $value['id_dep']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus departemen <strong><?= $value['nama_dep']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('dep/delete/' . $value['id_dep']); ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- end modal hapus -->
<?php } ?>