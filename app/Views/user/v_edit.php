<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
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
                <?php echo form_open_multipart('user/update/' . $user['id_user']); ?>

                <div class="form-group">
                    <label>Nama User</label>
                    <input class="form-control" value="<?= esc(old('nama_user', $user['nama_user'])); ?>" name="nama_user" placeholder="Masukan Nama User">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" value="<?= esc($user['email']); ?>" name="email" placeholder="Masukan Email" readonly>
                </div>
                <div class="form-group">
                    <label>Password <small>(Kosongkan jika tidak ingin mengubah)</small></label>
                    <input class="form-control" name="password" value="<?= esc(old('password')); ?>" placeholder="Masukan Password Baru">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select class="form-control" name="level">
                        <option value="1" <?= old('level', $user['level']) == '1' ? 'selected' : ''; ?>>Admin</option>
                        <option value="2" <?= old('level', $user['level']) == '2' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>bagianartemen</label>
                    <select class="form-control" name="id_bagian">
                        <option value="<?= $user['id_bagian']; ?>" <?= old('id_bagian', $user['id_bagian']) == $user['id_bagian'] ? 'selected' : ''; ?>><?= esc($user['nama_bagian']); ?></option>
                        <?php foreach ($bagian as $value): ?>
                            <?php if ($value['id_bagian'] != $user['id_bagian']): ?>
                                <option value="<?= $value['id_bagian']; ?>" <?= old('id_bagian') == $value['id_bagian'] ? 'selected' : ''; ?>><?= esc($value['nama_bagian']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label>Foto Sekarang</label>
                        <img src="<?= base_url('foto/' . esc($user['foto'])); ?>" width="80" height="80" alt="Current Photo">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('user'); ?>" class="btn btn-default pull-left">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-3"></div>
</div>