<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/tambah"),'class="form-horizontal"') ; ?>
      <div class="box-body">
       <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="id_user" class="col-sm-3">ID User</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo set_value('id_user'); ?>" placeholder="ID User" required>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3">Password</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="password"  value="<?php echo set_value('password'); ?>"  placeholder="Password" required>
          </div>
        </div>
        <div class="form-group">
          <label for="id_user_detail_karyawan" class="col-sm-3">ID Karyawan</label>
          <div class="col-sm-9">
            <select class="form-control" name="id_user_detail_karyawan" required="">
              <option value="" selected>-- Pilih Karyawan --</option>
              <?php foreach ($datakaryawan as $value) { ?>
              <option value="<?php echo $value['id_karyawan'] ; ?>" <?php echo set_select('id_user_detail_karyawan', $value['id_karyawan'], False); ?> ><?php echo $value['id_karyawan'] ; ?> - <?php echo $value['nama_karyawan'] ; ?></option> 
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="status" class="col-sm-3">Status</label>
          <div class="col-sm-9">
            <div class="radio">
                <label>
                  <input type="radio" name="status" id="status" value="Aktif" <?php if(set_value('status')=='Aktif') { ?> checked=checked <?php } ?> required="">
                  Aktif
                </label>
            </div>
            <div class="radio">
                <label>
                  <input type="radio" name="status" id="status" value="Tidak Aktif" <?php if(set_value('status')=='Tidak Aktif') { ?> checked=checked <?php } ?> required="">
                  Tidak Aktif
                </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="level" class="col-sm-3">Level</label>
          <div class="col-sm-9">
            <select class="form-control" name="level" required="">
              <option value="">-- Pilih Level --</option>
              <option value="Admin">Admin</option>
              <option value="Kasir">Kasir</option>
              <option value="Pelayan">Pelayan</option>
              <option value="Koki">Koki</option>
            </select>
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