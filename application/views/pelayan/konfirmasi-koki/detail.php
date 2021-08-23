<?php
$idku = @$detailtransaksi->id_transaksi_penjualan;
if (@$idku == "") {
  redirect(base_url('error'));
}
?>
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <!-- Main content -->
      <?php if ($this->session->flashdata('berhasil_simpan')) { ?>
        <?php $this->load->view('alert/berhasil_simpan'); ?>
      <?php } ?>

      <?php if ($this->session->flashdata('berhasil_edit')) { ?>
        <?php $this->load->view('alert/berhasil_edit'); ?>
      <?php } ?>

      <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
        <?php $this->load->view('alert/berhasil_hapus'); ?>
      <?php } ?>

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <?php echo $web->nama_web; ?>
            <small class="pull-right">Tanggal Transaksi : <?php echo $detailtransaksi->tanggal_transaksi; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Karyawan :</b>
          <address>
            <strong><?php echo $detailtransaksi->nama_karyawan; ?></strong><br>
            <?php echo $detailtransaksi->alamat_karyawan; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Meja :</b>
          <address>
            <strong>ID Meja : <?php echo $detailtransaksi->id_meja; ?></strong><br>
            Nama Meja : <?php echo $detailtransaksi->nama_meja; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Faktur</b><br>
          <b>No. Transaksi:</b> <?php echo $detailtransaksi->id_transaksi_penjualan; ?><br>
          <b>Tanggal Transaksi:</b> <?php echo $detailtransaksi->tanggal_transaksi; ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php echo form_open_multipart(base_url("$this->url1/$this->url2/updatestatus/".$id_detail)); ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($datadetailtransaksi as $value) { ?>
              <tr>
                <input type="hidden" name="id_transaksi_penjualan_detail<?=$no ?>" value="<?php echo $value['id_transaksi_penjualan_detail'] ?>" class="form-control">
                <td><?php echo $no; ?></td>
                <td><?php echo $value['id_produk']; ?></td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td><?php echo $value['jumlah_transaksi']; ?></td>
                <td><?php echo $value['status_transaksi'] ?></td>
                <td><?php echo $value['catatan_status_detail']; ?></td>
              </tr>
              <?php
              $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <?php form_close(); ?>
    </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->  