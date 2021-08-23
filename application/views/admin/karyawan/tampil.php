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

    <?php if ($this->session->flashdata('gagal_edit')) { ?>
      <?php $this->load->view('alert/gagal_edit'); ?>
    <?php } ?>

    <?php if ($this->session->flashdata('berhasil_hapus')) { ?>
      <?php $this->load->view('alert/berhasil_hapus'); ?>
    <?php } ?>


       <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO.</th>
          <th>ID</th>
          <th>Nama Karyawan</th>
          <th>Kelamin</th>
          <th>Tempat Lahir</th>
          <th>Tgl Lahir</th>
          <th>Agama</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>No.</td>
          <td>ID</td>
          <td>Nama Karyawan</td>
          <td>Kelamin</td>
          <td>Tempat Lahir</td>
          <td>Tgl Lahir</td>
          <td>Agama</td>
          <td>Alamat</td>
          <td>Aksi</td>
        </tr>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  