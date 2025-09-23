<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Kategori</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#add"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger alert-dismissible"><h4><i class="icon fa fa-ban" aria-hidden="true"></i> Ada Kesalahan!</h4><ul>';
                    foreach ($errors as $error) {
                        echo '<li>' . esc($error) . '</li>';
                    }
                    echo '</ul></div>';
                }

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
                            <th>Kategori</th>
                            <th class="text-center" width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kategori as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_kategori']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-info" data-target="#edit<?= $value['id_kategori']; ?>" data-toggle="modal"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_kategori']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
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

<!-- Modal Add Kategori -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addKategoriLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addKategoriLabel">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('kategori/add') ?>
                <div class="form-group">
                    <label for="nama_kategori_add">Kategori</label>
                    <input id="nama_kategori_add" class="form-control" name="nama_kategori" placeholder="Masukan Nama Kategori">
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

<!-- Modal Edit Kategori -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="editKategoriLabel<?= $value['id_kategori']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editKategoriLabel<?= $value['id_kategori']; ?>">Edit Kategori</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('kategori/update/' . $value['id_kategori']) ?>
                    <div class="form-group">
                        <label for="nama_kategori_edit<?= $value['id_kategori']; ?>">Kategori</label>
                        <input id="nama_kategori_edit<?= $value['id_kategori']; ?>" class="form-control" name="nama_kategori" placeholder="Masukan Nama Kategori" value="<?= $value['nama_kategori']; ?>">
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

<!-- Modal Hapus Kategori -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteKategoriLabel<?= $value['id_kategori']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteKategoriLabel<?= $value['id_kategori']; ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori <strong><?= $value['nama_kategori']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('kategori/delete/' . $value['id_kategori']); ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- end modal hapus -->
<?php } ?>

<script>
    $(function () {
        $('#example1').DataTable()
    })
</script>