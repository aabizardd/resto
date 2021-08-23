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

    <?php if ($this->session->flashdata('gagal_upload')) { ?>
      <?php $this->load->view('alert/gagal_upload'); ?>
    <?php } ?>

      <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>ID</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Keterangan</th>
          <th>Diskon</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>No.</td>
          <td>ID</td>
          <td>Nama Produk</td>
          <td>Kategori</td>
          <td>Harga</td>
          <td>Keterangan</td>
          <th>Diskon</th>

          
          <td>Foto</td>
          <td>Aksi</td>
        </tr>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  