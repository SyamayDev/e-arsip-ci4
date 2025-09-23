<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?= base_url('foto/' . $user['foto']) ?>" alt="User profile picture">
                <h3 class="profile-username text-center"><?= $user['nama_user'] ?></h3>
                <p class="text-muted text-center"><?= $user['nama_dep'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Profil</h3>
            </div>
            <div class="box-body">
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <?php echo form_open_multipart('profile/update'); ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input name="nama_user" class="form-control" value="<?= $user['nama_user'] ?>">
                </div>
                <div class="form-group">
                    <label>Departemen</label>
                    <select name="id_dep" class="form-control">
                        <option value="">--Pilih Departemen--</option>
                        <?php foreach ($bagian as $key => $value) { ?>
                            <option value="<?= $value['id_bagian'] ?>" <?= ($user['id_bagian'] == $value['id_bagian']) ? 'selected' : '' ?>><?= $value['nama_bagian'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" name="old_password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                </div>
                <div class="form-group">
                    <label>Ganti Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('arsip'); ?>" class="btn btn-default">Kembali</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
