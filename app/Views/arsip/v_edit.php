<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Arsip</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if ($errors = session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <h4><i class="icon fa fa-exclamation-triangle"></i> Ada Kesalahan!</h4>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php 
                echo form_open_multipart('arsip/update/' . $arsip['id_arsip']);
                ?>
                <div class="form-group">
                    <label>No Arsip</label>
                    <input class="form-control" value="<?= $arsip['no_arsip']; ?>" name="no_arsip" readonly>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="id_kategori">
                        <option value="<?= $arsip['id_kategori']; ?>"><?= $arsip['nama_kategori']; ?></option>
                        <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Arsip</label>
                    <input class="form-control" value="<?= $arsip['nama_arsip']; ?>" name="nama_arsip" placeholder="Masukkan Nama Arsip">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= $arsip['deskripsi'] ?? '' ?></textarea>
                </div> 
                <div class="form-group">
                    <label>Ganti File</label>
                    <input type="file" name="file_arsip" class="form-control">
                    <label class="text-danger">*File Harus Format .PDF</label>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('arsip'); ?>" class="btn btn-default pull-left">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-3"></div>
</div>