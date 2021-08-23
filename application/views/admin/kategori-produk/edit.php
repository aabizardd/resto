<?php
$id = @$editdata->id_produk_kategori;
if (@$id == "") {
  redirect(base_url('error'));
}
?>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdata->id_produk_kategori),'class="form-horizontal"') ; ?>
      <div class="box-body">
      <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="produk_kategori" class="col-sm-3">Kategori Produk</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="produk_kategori" name="produk_kategori" value="<?php echo $editdata->produk_kategori; ?>" placeholder="Kategori produk" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="produk_kategori_keterangan" class="col-sm-3">Keterangan</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="produk_kategori_keterangan" name="produk_kategori_keterangan" placeholder="Keterangan" required=""><?php echo $editdata->produk_kategori_keterangan; ?></textarea>
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