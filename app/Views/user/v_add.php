<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah User</h3>
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
                <?php echo form_open_multipart('user/insert'); ?>

                <div class="form-group">
                    <label>Nama User</label>
                    <input class="form-control" name="nama_user" value="<?= esc(old('nama_user')); ?>" placeholder="Masukan Nama User">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" value="<?= esc(old('email')); ?>" placeholder="Masukan Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="<?= esc(old('password')); ?>" placeholder="Masukan Password">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select class="form-control" name="level">
                        <option value="">Pilih Level</option>
                        <option value="1" <?= old('level') == '1' ? 'selected' : ''; ?>>Admin</option>
                        <option value="2" <?= old('level') == '2' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Departemen</label>
                    <select class="form-control" name="id_dep">
                        <option value="">Pilih Departemen</option>
                        <?php foreach ($dep as $value): ?>
                            <option value="<?= $value['id_dep']; ?>" <?= old('id_dep') == $value['id_dep'] ? 'selected' : ''; ?>><?= esc($value['nama_dep']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png">
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('user'); ?>" class="btn btn-default pull-left">Kembali</a>
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