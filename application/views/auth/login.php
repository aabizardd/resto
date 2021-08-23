<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $web->nama_web; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('assets/images/logo/'.$web->logo_web); ?>" type="image/x-icon">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><img width="100px" src="<?php echo base_url('assets/images/logo/'.$web->logo_web); ?>"></a>
    <br>
    <b>Smart-Resto Raul Gonzalez</b>
  </div>
    <p class="login-box-msg">Aplikasi Smart-Resto</p>
    <?php if ($this->session->flashdata('gagal_login')) { ?>
      <?php $this->load->view('alert/gagal_login'); ?>
    <?php } ?>
    <?php echo form_open(base_url('auth/verification')); ?>
      <div class="form-group has-feedback">
        <input type="text" name="id_user" class="form-control" placeholder="ID Pengguna" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <a href="#" class="pull-right" data-toggle="modal" data-target="#myModal">Lupa ID Pengguna atau Kata Sandi ?</a>
      <br>
      <br>
      <div class="row">
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <div class="col-xs-6">
          <button type="reset" class="btn btn-danger btn-block btn-flat">Hapus</button>
        </div>
      </div>
    <?php echo form_close(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div class="modal modal-info fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Informasi</h4>
      </div>
      <div class="modal-body">
          <h4>Jika lupa silahkan untuk menghubungi Administrator <?php echo $web->slogan_web; ?>  </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Tutup</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>


</body>

</html>