<?php
$id = @$editdata->id_karyawan;
if (@$id == "") {
  redirect(base_url('error'));
}
?>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdata->id_karyawan),'class="form-horizontal"') ; ?>
      <div class="box-body">
       <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="nama_karyawan" class="col-sm-3">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Nama karyawan"  value="<?php echo $editdata->nama_karyawan; ?>" required="">
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
        <div class="form-group">
          <label for="alamat_karyawan" class="col-sm-3">Alamat</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="alamat_karyawan" name="alamat_karyawan" placeholder="Alamat karyawan" required=""><?php echo $editdata->alamat_karyawan; ?></textarea>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
                <input type="submit" name="submit" class="btn btn-primary" value="Perbaharui">
                <a href="<?php echo base_url("$this->url1/$this->url2"); ?>" class="btn btn-danger">Batal</a>
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    <?php echo form_close(); ?>
    <!-- /.box-body -->
</div>
<!-- /.box -->