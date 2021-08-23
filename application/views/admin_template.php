<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $web->nama_web; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel='icon' type='image/x-icon' href="<?php echo base_url('assets/images/logo/' . $web->logo_web); ?>">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.min.css'); ?>">
        <!-- Datepicker -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
        <!-- <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css"/> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet"
            href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

        <style>
        /* Probably doesn't need all these prefixes but oh well */
        table.dataTable th,
        table.dataTable td {
            white-space: nowrap;
        }

        .disable-animations,
        .disable-animations * {
            /* CSS transitions */
            -o-transition-property: none !important;
            -moz-transition-property: none !important;
            -webkit-transition-property: none !important;
            transition-property: none !important;
            /* CSS transforms */
            -o-transform: none !important;
            -moz-transform: none !important;
            -webkit-transform: none !important;
            transform: none !important;
            /* CSS animations */
            -webkit-animation: none !important;
            -moz-animation: none !important;
            -o-animation: none !important;
            animation: none !important;
        }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <?php
$link = $this->inilogin->level;
$link_kecil = strtolower($link);
?>
                <a href="<?php echo base_url("" . $link_kecil . "/dashboard"); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="<?php echo base_url('assets/images/logo/' . $web->logo_web); ?>"
                            width="35px;"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><?php echo $web->nama_web; ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Admin') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Koki') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo @$this->datalogin->foto_karyawan;}?>"
                                        class="user-image" alt="User Image">
                                    <span
                                        class="hidden-xs"><?php if ($this->datalogin->level == 'Admin') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Koki') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo $this->datalogin->nama_karyawan;}?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Admin') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Koki') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo @$this->datalogin->foto_karyawan;}?>"
                                            class="img-circle" alt="<?php echo $this->datalogin->nama_karyawan; ?>">
                                        <p>
                                            <?php if ($this->datalogin->level == 'Admin') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Koki') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo $this->datalogin->nama_karyawan;}?>
                                            -
                                            <?php if ($this->datalogin->level == 'Admin') {echo $this->datalogin->level;} else if ($this->datalogin->level == 'Pelayan') {echo $this->datalogin->level;} else if ($this->datalogin->level == 'Koki') {echo $this->datalogin->level;} else if ($this->datalogin->level == 'Kasir') {echo $this->datalogin->level;}?>
                                        </p>
                                    </li>


                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url("" . $link_kecil . "/profil"); ?>"
                                                class="btn btn-default btn-flat">Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url('auth/logout'); ?>"
                                                class="btn btn-default btn-flat">Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('assets/images/profil/'); ?><?php if ($this->datalogin->level == 'Admin') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Koki') {echo @$this->datalogin->foto_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo @$this->datalogin->foto_karyawan;}?>"
                                class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php if ($this->datalogin->level == 'Admin') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Pelayan') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Koki') {echo $this->datalogin->nama_karyawan;} else if ($this->datalogin->level == 'Kasir') {echo $this->datalogin->nama_karyawan;}?>
                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">Menu Utama</li>
                        <?php
if ($this->datalogin->level == 'Admin') {
    ?>
                        <li <?php if ($this->uri->segment('2') == 'dashboard') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'meja') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('admin/meja'); ?>">
                                <i class="fa fa-square-o"></i> <span>Data Meja</span>
                            </a>
                        </li>
                        <li
                            <?php if ($this->uri->segment('2') == 'kategori-produk') {echo 'class="active"';} else if ($this->uri->segment('2') == 'produk') {echo 'class="active"';}?>>
                            <a href="#">
                                <i class="fa fa-coffee"></i> <span>Data Produk</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if ($this->uri->segment('2') == 'kategori-produk') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/kategori-produk'); ?>"><i
                                            class="fa fa-angle-right"></i> Kategori</a>
                                </li>
                                <li class="<?php if ($this->uri->segment('2') == 'produk') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/produk'); ?>"><i class="fa fa-angle-right"></i>
                                        Produk</a>
                                </li>
                            </ul>
                        </li>
                        <li
                            <?php if ($this->uri->segment('2') == 'karyawan') {echo 'class="active"';} else if ($this->uri->segment('2') == 'pkaryawan') {echo 'class="active"';}?>>
                            <a href="#">
                                <i class="fa fa-users"></i> <span>Data Karyawan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if ($this->uri->segment('2') == 'karyawan') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/karyawan'); ?>"><i
                                            class="fa fa-angle-right"></i> Data Karyawan</a>
                                </li>
                                <li class="<?php if ($this->uri->segment('2') == 'pkaryawan') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/pkaryawan'); ?>"><i
                                            class="fa fa-angle-right"></i> Data Pengguna</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'pengaturan') {echo 'class="active"';}?>>
                            <a href="#">
                                <i class="fa fa-database"></i> <span>Data Aplikasi</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if ($this->uri->segment('2') == 'printer') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/printer'); ?>"><i class="fa fa-angle-right"></i>
                                        Printer Thermal</a>
                                </li>
                                <li class="<?php if ($this->uri->segment('2') == 'pengaturan') {echo 'active';}?>">
                                    <a href="<?php echo base_url('admin/pengaturan'); ?>"><i
                                            class="fa fa-angle-right"></i> Pengaturan</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'transaksi') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/transaksi'); ?>"><i class="fa fa-shopping-cart"></i>
                                <span>Transaksi Pemesanan</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'konfirmasi-koki') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/konfirmasi-koki'); ?>"><i
                                    class="fa  fa-check-circle"></i> <span>Konfirmasi Koki</span></a>
                        </li>

                        <li <?php if ($this->uri->segment('2') == 'transaksi') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('kasir/transaksi'); ?>">
                                <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'pemesanan') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('koki/pemesanan'); ?>">
                                <i class="fa fa-shopping-cart"></i> <span>Pemesanan</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('1') == 'about') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('about'); ?>">
                                <i class="fa fa-connectdevelop"></i> <span>About</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'profil') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('admin/profil'); ?>">
                                <i class="fa fa-user"></i> <span>Profil</span>
                            </a>
                        </li>


                        <li <?php if ($this->uri->segment('2') == 'laporan') {echo 'class="active"';}?>>
                            <a href="#">
                                <i class="fa fa-database"></i> <span>Laporan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-ringkasan") ?>">Laporan
                                        Ringkasan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-penjualan") ?>">Laporan
                                        Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-detail") ?>">Laporan Detail</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/dashboard/setting'); ?>">
                                <i class="fa fa-lock"></i> <span>Pengaturan</span>
                            </a>
                        <li>
                            <a href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fa fa-lock"></i> <span>Keluar</span>
                            </a>
                        </li>

                        <?php
} else if ($this->datalogin->level == 'Pelayan') {
    ?>
                        <li <?php if ($this->uri->segment('2') == 'dashboard') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/dashboard'); ?>"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'transaksi') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/transaksi'); ?>"><i class="fa fa-shopping-cart"></i>
                                <span>Transaksi Pemesanan</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'konfirmasi-koki') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/konfirmasi-koki'); ?>"><i
                                    class="fa  fa-check-circle"></i> <span>Konfirmasi Koki</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('1') == 'about') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('about'); ?>">
                                <i class="fa fa-connectdevelop"></i> <span>About</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'profil') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/profil'); ?>">
                                <i class="fa fa-user"></i> <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fa fa-lock"></i> <span>Keluar</span>
                            </a>
                        </li>
                        <?php
} else if ($this->datalogin->level == 'Koki') {
    ?>
                        <li <?php if ($this->uri->segment('2') == 'dashboard') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('koki/dashboard'); ?>"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'pemesanan') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('koki/pemesanan'); ?>">
                                <i class="fa fa-shopping-cart"></i> <span>Pemesanan</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('1') == 'about') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('about'); ?>">
                                <i class="fa fa-connectdevelop"></i> <span>About</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'profil') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('koki/profil'); ?>">
                                <i class="fa fa-user"></i> <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fa fa-lock"></i> <span>Keluar</span>
                            </a>
                        </li>
                        <?php
} else if ($this->datalogin->level == 'Kasir') {
    ?>
                        <li <?php if ($this->uri->segment('2') == 'dashboard') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('kasir/dashboard'); ?>"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'transaksi') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('kasir/transaksi'); ?>">
                                <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('1') == 'about') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('about'); ?>">
                                <i class="fa fa-connectdevelop"></i> <span>About</span>
                            </a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'profil') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('kasir/profil'); ?>">
                                <i class="fa fa-user"></i> <span>Profil</span>
                            </a>
                        </li>

                        <li <?php if ($this->uri->segment('2') == 'transaksi') {echo 'class="active" ';}?>>
                            <a href="<?php echo base_url('pelayan/transaksi'); ?>"><i class="fa fa-shopping-cart"></i>
                                <span>Transaksi Pemesanan</span></a>
                        </li>
                        <li <?php if ($this->uri->segment('2') == 'laporan') {echo 'class="active"';}?>>
                            <a href="#">
                                <i class="fa fa-database"></i> <span>Laporan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-ringkasan") ?>">Laporan
                                        Ringkasan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-penjualan") ?>">Laporan
                                        Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("admin/laporan/laporan-detail") ?>">Laporan Detail</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fa fa-lock"></i> <span>Keluar</span>
                            </a>
                        </li>
                        <?php }?>





                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $judul; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a
                                href="<?php echo base_url($this->uri->segment('1')); ?>"><?php echo $this->uri->segment('1'); ?></a>
                        </li>
                        <li><a
                                href="<?php echo base_url($this->uri->segment('1') . '/' . $this->uri->segment('2')); ?>"><?php echo $this->uri->segment('2'); ?></a>
                        </li>
                        <li><a href="#"><?php echo $this->uri->segment('3'); ?></a></li>
                    </ol>
                </section>


                <!-- Main content -->
                <section class="content">
                    <?php $this->load->view($admincontent);?>
                </section>
                <!-- /.content -->
                <?php $this->load->view('modal/modal_hapus');?>
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">

            </footer>


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab"></div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">

                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>

        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <!-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script> -->
        <!-- Datepicker -->
        <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js'); ?>"></script>
        <!-- CK Editor -->
        <script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>">
        </script>
        <!-- Mask Money -->
        <script src="<?php echo base_url('assets/plugins/maskMoney/jquery.maskMoney.min.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
        <!-- page script -->



        <script type="text/javascript">
        var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
        var segment_array = segment_str.split('/');
        var last_segment = segment_array[segment_array.length - 2];
        // alert(last_segment); // alerts segment4
        var urlku = last_segment;

        var segment_str2 = window.location.pathname;
        var segment_array2 = segment_str2.split('/');
        var last_segment2 = segment_array2[segment_array2.length - 1];
        var urlku2 = last_segment2;

        var segment_str3 = window.location.pathname;
        var segment_array3 = segment_str3.split('/');
        var last_segment3 = segment_array3[segment_array3.length - 1];
        var urlku3 = last_segment3;

        // ini baru saja di tambahkan

        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "responsive": true,
                "autoWidth": false,
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    <?php if ($this->url1 == "pelayan" and $this->url2 == "transaksi" and $this->url3 == "tambah") {?> "url": "<?php echo base_url('pelayan/transaksi/produk_data_json'); ?>",
                    "type": "POST"
                    <?php } else {?> "url": "<?php echo base_url('"+urlku+"/"+urlku2+"/data_json'); ?>",
                    "type": "POST"
                    <?php }?>
                },


                "language": {
                    "emptyTable": "<h3 class='text-center'>Data Tidak Tersedia !</h3>",
                    "zeroRecords": "<h3 class='text-center'>Pencarian Tidak di Temukan !</h3>",
                    "lengthMenu": "_MENU_ Data Perhalaman",
                    "info": "Menampilkan _PAGE_ dari _PAGES_ Data",
                    "oPaginate": {
                        "sFirst": "Halaman Pertama", // This is the link to the first page
                        "sPrevious": "Halaman Sebelumnya", // This is the link to the previous page
                        "sNext": "Halaman Selanjutnya", // This is the link to the next page
                        "sLast": "Halaman Terakhir", // This is the link to the last page
                        "sSearch": "Cari: "
                    }
                },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": -1, //first column / numbering column
                    "orderable": true, //set not orderable
                    <?php if ($this->url1 == "pelayan" and $this->url2 == "transaksi" and $this->url3 == "tambah") {?> "defaultContent": "<a id='pilih' class='btn btn-xs btn-info idProduk' title='Pilih Data'>Pilih</a> "
                    <?php } else if ($this->url1 == "pelayan" and $this->url2 == "transaksi") {?> "render": function(
                        data, type, full) {
                        if (full[6] == 'Sudah Bayar') {
                            return "<a id='detailTransaksi' class='btn btn-primary btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a>";
                        } else {
                            return "<a id='detailTransaksi' class='btn btn-primary btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a> <a id='edit' class='btn btn-warning btn-xs' title='Edit Data'><i class='fa fa-pencil'/></i></a>";
                        }
                    }
                    <?php } else if ($this->url1 == "pelayan" and $this->url2 == "konfirmasi-koki") {?> "render": function(
                        data, type, full) {
                        if (full[4] == 'Belum Konfirmasi') {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a>";
                        } else {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a> <a id='detailPrintKoki' class='btn btn-info btn-xs' title='Print Struk'><i class='fa fa-print'/></i></a>";
                        }
                    }
                    <?php } else if ($this->url1 == "koki" and $this->url2 == "pemesanan") {?> "render": function(
                        data, type, full) {
                        if (full[4] == 'Belum Konfirmasi') {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Konfirmasi Data'><i class='fa fa-list-ul'/></i></a>";
                        } else if (full[4] == 'Konfirmasi' && full[5] == 'Belum Bayar') {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Konfirmasi Data'><i class='fa fa-list-ul'/></i></a> <a id='detailPrintKoki' class='btn btn-info btn-xs' title='Print Struk'><i class='fa fa-print'/></i></a>";
                        } else if (full[4] == 'Konfirmasi' && full[5] == 'Sudah Bayar') {
                            return "<a id='detailPemesananTampil' class='btn btn-success btn-xs' title='Detail Data'><i class='fa fa-eye'/></i></a> <a id='detailPrintKoki' class='btn btn-info btn-xs' title='Print Struk'><i class='fa fa-print'/></i></a>";
                        }
                    }
                    <?php } else if ($this->url1 == "kasir" and $this->url2 == "transaksi") {?> "render": function(
                        data, type, full) {
                        if (full[4] == 'Belum Konfirmasi') {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a>";
                        } else if (full[5] == 'Sudah Bayar') {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a> <a id='printStruk' class='btn btn-info btn-xs' title='Print Data'><i class='fa fa-print'/></i></a>";
                        } else {
                            return "<a id='detailPemesanan' class='btn btn-warning btn-xs' title='Detail Data'><i class='fa fa-list-ul'/></i></a> <a id='bayarPemesanan' class='btn btn-success btn-xs' title='Bayar Pemesanan'> <i class='fa fa-money'/></i> </a>";
                        }
                    }
                    <?php } else {?> "defaultContent": "<a id='edit' class='btn btn-warning btn-xs' title='Edit Data'><i class='fa fa-pencil'/></i></a> <a data-toggle='modal' id='hapus' class='btn btn-danger btn-xs' title='Hapus Data'><i class='fa fa-trash'/></i></a>"
                    <?php }?>,
                }, ],

            });

        });

        $('#table tbody').on('click', '#edit', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"/edit/'); ?>" + data[1];
        });

        $('#table tbody').on('click', '#detailTransaksi', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"/detail/'); ?>" + data[1];
        });

        $('#table tbody').on('click', '#detailPemesanan', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"/detail/'); ?>" + data[1];
        });

        $('#table tbody').on('click', '#detailPemesananTampil', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"/detail-data/'); ?>" + data[1];
        });


        $('#table tbody').on('click', '#bayarPemesanan', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"/bayar/'); ?>" + data[1];
        });

        $('#table tbody').on('click', '#printStruk', function() {
            var data = table.row($(this).parents('tr')).data();
            window.open("<?php echo base_url('"+urlku+"/"+urlku2+"/printstruk/'); ?>" + data[1]);
        });


        $('#table tbody').on('click', '#detailPrintKoki', function() {
            var data = table.row($(this).parents('tr')).data();
            window.open("<?php echo base_url('"+urlku+"/"+urlku2+"/printstruk/'); ?>" + data[1]);
        });

        $('#table tbody').on('click', '#hapus', function() {
            var data = table.row($(this).parents('tr')).data();
            var dataku = data[1];
            $("#idhapus").val(dataku);
            $("#myModal").modal("show");

        });
        $("#konfirmasi").click(function() {
            var dataku = $("#idhapus").val();

            $.ajax({
                url: "<?php echo base_url('"+urlku+"/"+urlku2+"/hapus'); ?>",
                type: "POST",
                data: "dataku=" + dataku,
                cache: false,
                success: function(html) {
                    location.href = "<?php echo base_url('"+urlku+"/"+urlku2+"'); ?>";
                }
            });
        });

        $(document).on("click", ".idProduk", function() {
            var myIdProduk = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('pelayan/transaksi/produk_json'); ?>",
                data: "id_produk=" + myIdProduk,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#id_produk').val(obj.id_produk);
                $('#nama_produk').val(obj.nama_produk);
                $('#diskon_produk').val(obj.diskon_produk);
                $('#harga_produk').val(convertToRupiah(obj.harga_produk));
                $('#jumlah_transaksi').val("");
                $('#total_transaksi').val("");
                $('#reset').hide();
                return;
            });
        });


        function hitungKurang(v) {
            var tunai = $("#tunai").val();
            var dp = $("#dp").val();
            var voucher = $("#voucher").val();
            var card = $("#card").val();
            var kredit = $("#kredit").val();


            var total = parseInt(toInt($("#totale").text()));

            // return total-parseInt(v);
            // console.log(v);
            if (v.length == 0) {
                v = 0;
            }


            if (v < total) {
                $(".bayarr").attr('disabled', 'disabled');
            } else {
                $(".bayarr").removeAttr('disabled');

            }
            $("#kurang").text(total - parseInt(v));

            $("#kurangane").val(total - parseInt(v));
            // var kurang =toInt($("#kurang").text());

        }

        function toInt(angka) {


            return angka.replace(".", "").replace(".", "");
        }

        function subTotal(jumlah_transaksi) {

            var harga = $('#harga_produk').val().replace(".", "").replace(".", "");
            var diskon = parseInt($("#diskon_produk").val());
            var totalSemua;

            if (diskon != 0) {
                var hitung = harga - harga * (diskon / 100);
                var totalDiskon = (harga * (diskon / 100)) * jumlah_transaksi;



            } else {
                var hitung = harga;
                var totalDiskon = 0;

            }

            totalSemua = harga * jumlah_transaksi;

            var htg = hitung * jumlah_transaksi;
            // console.log(hitung);
            $("#total_diskon").val(totalDiskon);
            $("#diskon_angka").val(hitung);

            $("#total_semua").val(totalSemua);

            $('#total_transaksi').val(convertToRupiah(htg));
        }

        function convertToRupiah(angka) {

            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');

            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';

            return rupiah.split('', rupiah.length - 1).reverse().join('');

        }

        $('.bayar').maskMoney({
            thousands: '.',
            decimal: ',',
            precision: 0
        });

        function hitungKembalian(str) {
            var total = $('#total_transaksi').val().replace(".", "").replace(".", "");
            var bayar = str.replace(".", "").replace(".", "");
            var kembali = bayar - total;

            $('#kembalian_transaksi').val(convertToRupiah(kembali));

        }

        //Date picker
        $('#tanggal').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });


        $(document).on("click", '.menuiteme', function() {

            var href = $(this).attr('data-href');

            $.get(href, function(res) {
                $(".tab-pane").html(res);
            });
        });

        $(document).on("click", '.btn-modal', function() {
            var href = $(this).attr('data-href');
            var title = $(this).attr("data-title");

            $(".modal-title").text(title);
            $.get(href, function(res) {
                $('#tanggal').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy'
                });
                $("#mdl-bdy").html(res);
            })
        })

        $(document).on("click", ".btn-save-bayar", function() {
            var type = $(this).attr('data-type');
            // alert(type);

            if ($("#id_meja").val().length == 0) {

                console.log($("#id_meja option:selected").val().length);
                alert("Silahkan Pilih Meja Terlebih Dahulu")
            } else {

                if ($("#pelanggan").val().length == 0) {
                    alert("Isikan nama Pelanggan");

                } else {


                    if ($("#tunai").val().length == 0) {
                        alert("Masukan Nilai Tunai Terlebih Dahulu");
                    } else {

                        $("#type").val(type);
                        var form = $("#form").serialize();
                        var action = $("#form").attr('action');
                        $.ajax({
                            url: action,
                            method: $("#form").attr('method'),
                            data: form,
                            dataType: "JSON",
                            success: function(res) {
                                // console.log(res)
                                if (res.status == 1) {

                                    if (res.statuse == "bayar") {
                                        $("#wrappp").show();


                                    } else {
                                        $("#myModal").modal('hide');
                                        location.reload();
                                        // window.location.href="<?php echo base_url("pelayan/transaksi") ?>";
                                    }

                                } else {
                                    alert('gagal');
                                }
                            }
                        })
                    }
                }


            }

        });

        $(document).on("click", ".btn-close", function() {

            if (confirm("Hapus Data Pemesanan Sementara?")) {

                $.ajax({
                    url: "<?php echo base_url("pelayan/transaksi/tutup") ?>",
                    method: "POST",
                    success: function() {
                        location.reload();
                    }
                })
            }

        });

        $(document).on("keyup", "#tunaine", function() {
            var total_transaksi = parseInt($("#total_transaksine").text());

            var val = parseInt($(this).val());

            // alert(val);

            if (val < total_transaksi) {
                $(".btn-bayaran").attr('disabled', 'disabled');
            } else {
                $(".btn-bayaran").removeAttr('disabled');

            }
            $("#kurangane").val(total_transaksi - val);
            $("#kembaliane").text(total_transaksi - val);
        })
        </script>

        <script>
        $(function($) {
            var $body = $('body');
            // On click, capture state and save it in localStorage
            $($.AdminLTE.options.sidebarToggleSelector).click(function() {
                localStorage.setItem('sidebar', $body.hasClass('sidebar-collapse') ? 1 : 0);
            });

            // On ready, read the set state and collapse if needed
            if (localStorage.getItem('sidebar') === '0') {
                $body.addClass('disable-animations sidebar-collapse');
                requestAnimationFrame(function() {
                    $body.removeClass('disable-animations');
                });
            }
        });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($graph_food_fav as $a): ?> 'Bulan <?=$a->bulan?> (<?=$a->nama_produk?>)',
                    <?php endforeach?>
                ],
                datasets: [{
                    label: 'Test',
                    data: [<?php foreach ($graph_food_fav as $b): ?> <?=$b->max?>, <?php endforeach?>],
                    backgroundColor: [

                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [

                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>

        <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($graph_food_ct as $c): ?> '<?=$c->nama_produk?>',
                    <?php endforeach?>
                ],
                datasets: [{
                    label: 'Test',
                    data: [<?php foreach ($graph_food_ct as $d): ?> <?=$d->ct?>, <?php endforeach?>],
                    backgroundColor: [

                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [

                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>


</html>