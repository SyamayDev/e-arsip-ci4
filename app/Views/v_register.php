<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Arsip | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page"
      style="background: url('<?= base_url('background/bg-login-register.jpg') ?>') no-repeat center center fixed;
             background-size: cover;">

<div class="register-box"
     style="backdrop-filter: blur(8px) brightness(0.6);
            -webkit-backdrop-filter: blur(8px) brightness(0.6);
            background-color: rgba(0,0,0,0.3);
            border-radius: 10px;
            padding: 20px;">
  <div class="register-logo">
    <a href="<?= base_url() ?>"><b style="color:white;">E - Arsip</b></a>
  </div>

  <div class="register-box-body" style="background: transparent; color:white;">
    <p class="login-box-msg">Register Akun Baru</p>
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
    <?php echo form_open('auth/save_register') ?>
      <div class="form-group has-feedback">
        <label for="nama_user" class="sr-only">Nama User</label>
        <input id="nama_user" name="nama_user" class="form-control" placeholder="Nama User">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="repassword" class="sr-only">Retype password</label>
        <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group">
        <label for="id_dep">Departemen</label>
        <select id="id_dep" name="id_dep" class="form-control">
            <option value="">--Pilih Departemen--</option>
            <?php foreach ($dep as $key => $value) { ?>
                <option value="<?= $value['id_bagian'] ?>"><?= $value['nama_bagian'] ?></option>
            <?php } ?>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="<?= base_url('auth') ?>" class="text-center">Sudah Punya Akun? Login</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close() ?>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>/template/bower_components/jquery/dist/jquery.min.js" defer></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>/template/bower_components/bootstrap/dist/js/bootstrap.min.js" defer></script>
<!-- iCheck -->
<script src="<?= base_url() ?>/template/plugins/iCheck/icheck.min.js" defer></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
