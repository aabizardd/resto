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

      <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>ID</th>
          <th>Nama Meja</th>
          <th>Keterangan Meja</th>
          <th>Status Meja</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>No.</td>
          <td>ID</td>
          <td>Nama Meja</td>
          <td>Keterangan Meja</td>
          <th>Status Meja</th>
          <td>Aksi</td>
        </tr>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  