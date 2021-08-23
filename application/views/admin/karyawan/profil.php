<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/"),'class="form-horizontal"') ; ?>
      <div class="box-body">
       <?php echo validation_errors(); ?>
       <?php if ($this->session->flashdata('berhasil_edit')) { ?>
          <?php $this->load->view('alert/berhasil_edit'); ?>
       <?php } ?>
       <?php if ($this->session->flashdata('gagal_edit')) { ?>
          <?php $this->load->view('alert/gagal_edit'); ?>
       <?php } ?>
        <div class="form-group">
          <label for="nama_karyawan" class="col-sm-3">Nama</label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" id="id_karyawan" name="id_karyawan" placeholder="ID"  value="<?php echo $editdata->id_karyawan; ?>" required="">
            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Nama"  value="<?php echo $editdata->nama_karyawan; ?>" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_kelamin_karyawan" class="col-sm-3">Jenis Kelamin</label>
          <div class="col-sm-9">
            <div class="radio">
                <label>
                  <input type="radio" name="jenis_kelamin_karyawan" id="jenis_kelamin_karyawan" value="Pria" <?php if($editdata->jenis_kelamin_karyawan=='Pria') { ?> checked=checked <?php } ?>>
                  Pria
                </label>
            </div>
            <div class="radio">
                <label>
                  <input type="radio" name="jenis_kelamin_karyawan" id="jenis_kelamin_karyawan" value="Wanita" <?php if($editdata->jenis_kelamin_karyawan=='Wanita') { ?> checked=checked <?php } ?>>
                  Wanita
                </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="tempat_lahir_karyawan" class="col-sm-3">Tempat Lahir</label>
          <div class="col-sm-9"> 
            <input type="text" class="form-control" id="tempat_lahir_karyawan" name="tempat_lahir_karyawan" value="<?php echo $editdata->tempat_lahir_karyawan; ?>" placeholder="Tempat Lahir karyawan">
          </div>
        </div> 
        <div class="form-group">
          <label for="tgl_lahir_karyawan" class="col-sm-3">Tanggal Lahir</label>
          <div class="col-sm-9"> 
            <input type="date" class="form-control" id="tgl_lahir_karyawan" name="tgl_lahir_karyawan" value="<?php echo $editdata->tgl_lahir_karyawan; ?>" placeholder="Tanggal Lahir karyawan">
          </div>
        </div>
        <div class="form-group">
          <label for="alamat_karyawan" class="col-sm-3">Alamat</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="alamat_karyawan" name="alamat_karyawan" placeholder="Alamat karyawan" required=""><?php echo $editdata->alamat_karyawan; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="agama_karyawan" class="col-sm-3">Agama</label>
          <div class="col-sm-9">
            <select class="form-control" name="agama_karyawan" required="">
              <option value="<?php echo $editdata->agama_karyawan; ?>" selected>-- <?php echo $editdata->agama_karyawan; ?> --</option>
              <option value="Islam"> Islam </option>
              <option value="Kristen"> Kristen </option>
              <option value="Katholik"> Katholik </option>
              <option value="Hindu"> Hindu </option>
              <option value="Budha"> Budha </option>
            </select>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
              <input type="submit" name="submit" class="btn btn-primary" value="Perbaharui">
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    <?php echo form_close(); ?>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<h3><?php echo @$judul2; ?></h3>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open_multipart(base_url("$this->url1/$this->url2/"),'class="form-horizontal"') ; ?>
      <div class="box-body">
       <?php echo validation_errors(); ?>
       <?php if ($this->session->flashdata('gagal_upload')) { ?>
          <?php $this->load->view('alert/gagal_upload'); ?>
       <?php } ?>
       <?php if ($this->session->flashdata('berhasil_upload')) { ?>
          <?php $this->load->view('alert/berhasil_upload'); ?>
       <?php } ?>
      <div class="form-group">
          <label for="foto_karyawan" class="col-sm-3">Foto Profil Sebelumnya</label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" id="id_karyawan" name="id_karyawan" placeholder="ID karyawan"  value="<?php echo $editdata->id_karyawan; ?>" required="">
            <img src="<?php echo base_url('assets/images/profil/'.$editdata->foto_karyawan); ?>" width="150px" class="img-responsive">
          </div>
      </div>
      <div class="form-group">
          <label for="foto_karyawan" class="col-sm-3">Foto Profil Baru</label>
          <div class="col-sm-9">
            <input type="file" id="foto_karyawan" name="foto_karyawan" class="form-control">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
              <input type="submit" name="upload" class="btn btn-primary" value="Perbaharui">
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    <?php echo form_close(); ?>
    <!-- /.box-body -->
</div>