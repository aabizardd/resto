<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/tambah"),'class="form-horizontal"') ; ?>
      <div class="box-body">
       <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="nama_karyawan" class="col-sm-3">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_Karyawan" name="nama_karyawan"  value="<?php echo set_value('nama_Karyawan'); ?>"  placeholder="Nama Karyawan">
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_kelamin_karyawan" class="col-sm-3">Jenis Kelamin</label>
          <div class="col-sm-9">
            <div class="radio">
                <label>
                  <input type="radio" name="jenis_kelamin_karyawan" id="jenis_kelamin_karyawan" value="Pria" <?php if(set_value('jenis_kelamin_karyawan')=='Pria') { ?> checked=checked <?php } ?>>
                  Pria
                </label>
            </div>
            <div class="radio">
                <label>
                  <input type="radio" name="jenis_kelamin_karyawan" id="jenis_kelamin_karyawan" value="Wanita" <?php if(set_value('jenis_kelamin_karyawan')=='Wanita') { ?> checked=checked <?php } ?>>
                  Wanita
                </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="tempat_lahir_Karyawan" class="col-sm-3">Tempat Lahir</label>
          <div class="col-sm-9"> 
            <input type="text" class="form-control" id="tempat_lahir_Karyawan" name="tempat_lahir_karyawan" value="<?php echo set_value('tempat_lahir_Karyawan'); ?>" placeholder="Tempat Lahir Karyawan">
          </div>
        </div> 
        <div class="form-group">
          <label for="tgl_lahir_Karyawan" class="col-sm-3">Tanggal Lahir</label>
          <div class="col-sm-9"> 
            <input type="date" class="form-control" id="tgl_lahir_Karyawan" name="tgl_lahir_karyawan" value="<?php echo set_value('tgl_lahir_Karyawan'); ?>" placeholder="Tanggal Lahir Karyawan">
          </div>
        </div>
        <div class="form-group">
          <label for="agama_Karyawan" class="col-sm-3">Agama</label>
          <div class="col-sm-9">
            <select class="form-control" name="agama_karyawan">
              <option value="" selected>-- Pilih Agama --</option>
              <option value="Islam"> Islam </option>
              <option value="Kristen"> Kristen </option>
              <option value="Katholik"> Katholik </option>
              <option value="Hindu"> Hindu </option>
              <option value="Budha"> Budha </option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat_Karyawan" class="col-sm-3">Alamat</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="alamat_Karyawan" name="alamat_karyawan" placeholder="Alamat Karyawan"><?php echo set_value('alamat_Karyawan'); ?></textarea>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                <input type="reset" name="submit" class="btn btn-warning" value="Hapus">
                <a href="<?php echo base_url("$this->url1/$this->url2"); ?>" class="btn btn-danger">Batal</a>
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
    <?php echo form_close(); ?>
    <!-- /.box-body -->
</div>
<!-- /.box -->