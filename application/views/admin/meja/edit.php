<?php
$id = @$editdata->id_meja;
if (@$id == "") {
  redirect(base_url('error'));
}
?>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdata->id_meja),'class="form-horizontal"') ; ?>
      <div class="box-body">
      <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="nama_meja" class="col-sm-3">Nama Meja</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_meja" name="nama_meja" value="<?php echo $editdata->nama_meja; ?>" placeholder="Nama Meja" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="keterangan_meja" class="col-sm-3">Keterangan Meja</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="keterangan_meja" name="keterangan_meja" placeholder="Keterangan Meja" required=""><?php echo $editdata->keterangan_meja; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="status_meja" class="col-sm-3">Status Meja</label>
          <div class="col-sm-9">
            <select class="form-control" name="status_meja" required="">
              <option value="<?php echo $editdata->status_meja; ?>">-- <?php echo $editdata->status_meja; ?> --</option>
              <option value="Tersedia">Tersedia</option>
              <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
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