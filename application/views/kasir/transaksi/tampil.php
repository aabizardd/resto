<div class="box">
    <!-- /.box-header -->
    <div class="box-body table-responsive">
    <a href="<?php echo base_url("$this->url1/$this->url2"); ?>" class="btn btn-primary">Perbaharui Data</a>
    <br>
    <br>
    <?php if ($this->session->flashdata('berhasil_simpan')) { ?>
      <?php $this->load->view('alert/berhasil_simpan'); ?>
    <?php } ?>

    <?php if ($this->session->flashdata('berhasil_edit')) { ?>
      <?php $this->load->view('alert/berhasil_edit'); ?>
    <?php } ?>

    <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
      <?php $this->load->view('alert/berhasil_hapus'); ?>
    <?php } ?>

      <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>ID</th>
          <th>Tanggal</th>
          <th>Meja</th>
          <th>Konfirmasi Koki</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>No.</td>
          <td>ID</td>
          <td>Tanggal</td>
          <td>Meja</td>
          <td>Konfirmasi Koki</td>
          <td>Aksi</td>
        </tr>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  