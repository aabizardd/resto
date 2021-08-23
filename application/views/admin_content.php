<?php if ($this->datalogin->level == 'Admin') {?>


<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Transaksi Hari Ini</span>
                <span class="info-box-number">Rp . <?php echo number_format($total_transaksi); ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrows-h"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pengunjung</span>
                <span class="info-box-number"><?php echo $struk ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total menu</span>
                <span class="info-box-number"><?php echo $menu ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Karyawan</span>
                <span class="info-box-number"><?php echo $jumlahkaryawan ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row">

    <div class="col-lg-6">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <center>Detail Transaksi Hari Ini</center>
                <table class="table table-striped">
                    <thead>
                        <th>No Nota</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                    </thead>
                    <tbody>

                        <?php if ($trx->num_rows() > 0): ?>
                        <?php foreach ($trx->result() as $t):

    ?>
                        <tr>
                            <td><?php echo $t->id_transaksi_penjualan ?></td>
                            <td><?php echo $t->pelanggan ?></td>
                            <td style="text-align: right;"><?php echo $t->total_transaksi ?></td>

                        </tr>
                        <?php
?>

                        <?php endforeach?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3">
                                <center>Data Tidak Ditemukan</center>
                            </td>
                        </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <center>Detail Menu Yang Terjual </center>
                <table class="table table-striped">
                    <thead>
                        <th>Menu</th>
                        <th>Banyaknya</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php if ($menune->num_rows() > 0): ?>
                        <?php foreach ($menune->result() as $mn): ?>
                        <tr>
                            <td><?php echo $mn->nama_produk ?></td>
                            <td><?php echo $mn->jml ?></td>
                            <td><?php echo $mn->total ?></td>
                        </tr>
                        <?php endforeach?>

                        <?php else: ?>
                        <tr>
                            <td colspan="3">
                                <center>Data Tidak Ditemukan</center>
                            </td>
                        </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <center>Makanan Terlaris Setiap Bulan (Tahun <?=date('Y')?>)</center>
                <div>
                    <canvas id="myChart" width="400" height="200"></canvas>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <center>Jumlah Makanan Dipesan (Bulan <?=date('F')?>)</center>
                <div>
                    <canvas id="myChart2" width="400" height="200"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="display: none;">
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
                <div class="widget-user-image">
                    <img class="img-circle"
                        src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Admin') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'karyawan') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Siswa') {echo @$this->datalogin->foto_siswa;}?>"
                        alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $this->datalogin->nama_karyawan; ?></h3>
                <h5 class="widget-user-desc"><?php echo $this->datalogin->level; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Jenis Kelamin <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->jenis_kelamin_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tempat Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tempat_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tanggal Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tgl_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Agama <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->agama_karyawan; ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
    <div class="col-md-8" style="display: none;">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Instansi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>Nama Web Site</td>
                            <td>: <?php echo $web->nama_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Web Site</td>
                            <td>: <?php echo base_url(); ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Deskripsi</td>
                            <td>: <?php echo $web->slogan_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Alamat</td>
                            <td>: <?php echo $web->alamat_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Telepon</td>
                            <td>: <?php echo $web->telp_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Fax</td>
                            <td>: <?php echo $web->fax_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Email</td>
                            <td>: <?php echo $web->email_web; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>



<?php }if ($this->datalogin->level == 'Pelayan') {?>

<div class="row">
    <div class="col-md-4">


        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
                <div class="widget-user-image">
                    <img class="img-circle"
                        src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Pelayan') {echo @$this->datalogin->foto_karyawan;}?>"
                        alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $this->datalogin->nama_karyawan; ?></h3>
                <h5 class="widget-user-desc"><?php echo $this->datalogin->level; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Jenis Kelamin <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->jenis_kelamin_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tempat Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tempat_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tanggal Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tgl_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Agama <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->agama_karyawan; ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Instansi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>Nama Web Site</td>
                            <td>: <?php echo $web->nama_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Web Site</td>
                            <td>: <?php echo base_url(); ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Deskripsi</td>
                            <td>: <?php echo $web->slogan_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Alamat</td>
                            <td>: <?php echo $web->alamat_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Telepon</td>
                            <td>: <?php echo $web->telp_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Fax</td>
                            <td>: <?php echo $web->fax_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Email</td>
                            <td>: <?php echo $web->email_web; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php }if ($this->datalogin->level == 'Koki') {?>

<div class="row">
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
                <div class="widget-user-image">
                    <img class="img-circle"
                        src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Koki') {echo @$this->datalogin->foto_karyawan;}?>"
                        alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $this->datalogin->nama_karyawan; ?></h3>
                <h5 class="widget-user-desc"><?php echo $this->datalogin->level; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Jenis Kelamin <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->jenis_kelamin_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tempat Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tempat_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tanggal Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tgl_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Agama <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->agama_karyawan; ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Restoran / Kafe</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>Nama Web Site</td>
                            <td>: <?php echo $web->nama_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Web Site</td>
                            <td>: <?php echo base_url(); ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Deskripsi</td>
                            <td>: <?php echo $web->slogan_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Alamat</td>
                            <td>: <?php echo $web->alamat_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Telepon</td>
                            <td>: <?php echo $web->telp_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Fax</td>
                            <td>: <?php echo $web->fax_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Email</td>
                            <td>: <?php echo $web->email_web; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php }if ($this->datalogin->level == 'Kasir') {?>

<div class="row">
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
                <div class="widget-user-image">
                    <img class="img-circle"
                        src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Kasir') {echo @$this->datalogin->foto_karyawan;}?>"
                        alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $this->datalogin->nama_karyawan; ?></h3>
                <h5 class="widget-user-desc"><?php echo $this->datalogin->level; ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Jenis Kelamin <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->jenis_kelamin_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tempat Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tempat_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Tanggal Lahir <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->tgl_lahir_karyawan; ?></span></a>
                    </li>
                    <li><a href="#">Agama <span
                                class="pull-right badge bg-green"><?php echo $this->datalogin->agama_karyawan; ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Restoran / Kafe</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>Nama Web Site</td>
                            <td>: <?php echo $web->nama_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Web Site</td>
                            <td>: <?php echo base_url(); ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Deskripsi</td>
                            <td>: <?php echo $web->slogan_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Alamat</td>
                            <td>: <?php echo $web->alamat_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Telepon</td>
                            <td>: <?php echo $web->telp_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Fax</td>
                            <td>: <?php echo $web->fax_web; ?></td>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Email</td>
                            <td>: <?php echo $web->email_web; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php }?>