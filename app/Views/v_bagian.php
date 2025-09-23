<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Bagian</h3>

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
                            <th>Bagian</th>
                            <th class="text-center" width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($bagian as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_bagian']; ?></td>
                                <td>
                                    <button type="button"
                                        class="btn btn-xs btn-info"
                                        data-toggle="modal"
                                        data-target="#edit<?= $value['id_bagian']; ?>"
                                        aria-label="Edit Bagian <?= $value['nama_bagian']; ?>">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                    </button>

                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_bagian']; ?>" aria-label="Hapus Bagian <?= $value['nama_bagian']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
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

<!-- Modal Add bagian -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addBagianLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addBagianLabel">Tambah Bagian</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('bagian/add') ?>
                <div class="form-group">
                    <label for="nama_bagian_add">Bagian</label>
                    <input id="nama_bagian_add" class="form-control" name="nama_bagian" placeholder="Masukan Nama Bagian">
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

<!-- Modal Edit bagian -->
<?php foreach ($bagian as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_bagian']; ?>" tabindex="-1" role="dialog" aria-labelledby="editBagianLabel<?= $value['id_bagian']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editBagianLabel<?= $value['id_bagian']; ?>">Edit Bagian</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('bagian/edit/' . $value['id_bagian']) ?>
                    <div class="form-group">
                        <label for="nama_bagian_edit<?= $value['id_bagian']; ?>">Bagian</label>
                        <input id="nama_bagian_edit<?= $value['id_bagian']; ?>" class="form-control" name="nama_bagian" placeholder="Masukan Nama Bagian" value="<?= $value['nama_bagian']; ?>">
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

<!-- Modal Hapus bagian -->
<?php foreach ($bagian as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_bagian']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBagianLabel<?= $value['id_bagian']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteBagianLabel<?= $value['id_bagian']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus bagian <strong><?= $value['nama_bagian']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('bagian/delete/' . $value['id_bagian']); ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- end modal hapus -->
<?php } ?>