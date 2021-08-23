<div class="box">
    <!-- /.box-header -->
    <div class="box-body table-responsive">
    <a href="<?php echo base_url("$this->url1/$this->url2/tambah"); ?>" class="btn btn-primary">Tambah Data</a>
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

    <?php echo validation_errors(); ?>

      <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO.</th>
          <th>Username</th>
          <th>ID Karyawan</th>
          <th>Nama Karyawan</th>
          <th>Status</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>No.</td>
          <td>Username</td>
          <td>ID Karyawan</td>
          <td>Nama Karyawan</td>
          <td>Status</td>
          <td>Level</td>
        </tr>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  