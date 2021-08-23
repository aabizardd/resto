<!DOCTYPE html>
<html>
<head>
	<title>Halaman Tidak Ditemukan !</title>
	<link rel='icon' type='image/x-icon' href="<?php echo base_url('assets/images/logo/'.$web->logo_web); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css'); ?>">
</head>
<body>
	<div class="container">
      <div class="page-header">
        <h1>Halaman Tidak Ditemukan !</h1>
      </div>
      <p class="lead">Halaman yang Anda cari mungkin telah dihapus namanya berubah atau untuk sementara tidak tersedia,<br>Silakan coba yang berikut ini:</p>
      <ul>
	      <li>Jika Anda mengetikkan alamat halaman di Address bar, pastikan itu dieja dengan benar.</li>
	      <li>Klik <a href="<?php echo base_url(); ?>">di sini</a> untuk kembali ke halaman utama kami.</li>
	      <li>Jika Anda terhubung ke halaman ini, hubungi administrator dan buat mereka mengetahui masalah ini.</li>
	  </ul>
	  <hr>
      <p><a href="<?php echo base_url(); ?>"><?php echo $web->nama_web; ?></a> - <?php echo $web->slogan_web; ?> &copy; <?php echo $web->tahun_web; ?> </p>
    </div>
</body>
</html>