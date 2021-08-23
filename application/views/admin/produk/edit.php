<?php
$id = @$editdata->id_produk;
if (@$id == "") {
  redirect(base_url('error'));
}
?>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open(base_url("$this->url1/$this->url2/edit/".$editdata->id_produk),'class="form-horizontal"') ; ?>
      <div class="box-body">
      <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="nama_produk" class="col-sm-3">Nama Produk</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $editdata->nama_produk; ?>" placeholder="Nama Produk" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="id_produk_kategori" class="col-sm-3">Kategori Produk</label>
          <div class="col-sm-9">
            <select class="form-control" name="id_produk_kategori" required="">
              <option value="<?php echo $editdata->id_produk_kategori; ?>" selected>-- <?php echo $editdata->id_produk_kategori; ?> - <?php echo $editdata->produk_kategori; ?> --</option>
              <?php foreach ($dataprodukkategori as $value) { ?>
              <option value="<?php echo $value['id_produk_kategori'] ; ?>" <?php echo set_select('id_produk_kategori', $value['id_produk_kategori'], False); ?> ><?php echo $value['id_produk_kategori'] ; ?> -   <?php echo $value['produk_kategori'] ; ?> </option> 
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="harga_produk" class="col-sm-3">Harga Produk</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $editdata->harga_produk; ?>" placeholder="Harga Produk" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="harga_produk" class="col-sm-3">Diskon(%)</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="dikson" name="diskon" value="<?php echo $editdata->diskon; ?>" placeholder="Diskon Produk" required="">
          </div>
        </div>
        <div class="form-group">
          <label for="keterangan_produk" class="col-sm-3">Keterangan Produk</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="keterangan_produk" name="keterangan_produk" placeholder="Keterangan Produk"><?php echo $editdata->keterangan_produk; ?></textarea>
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
</div>

<h3>Foto Foto Produk</h3>
<div class="box">
    <!-- /.box-header -->
    <?php echo form_open_multipart(base_url("$this->url1/$this->url2/edit/".$editdata->id_produk),'class="form-horizontal"') ; ?>
      <div class="box-body">
      <?php echo validation_errors(); ?>
        <div class="form-group">
          <label for="nama_produk" class="col-sm-3">Nama Produk</label>
          <div class="col-sm-9">
            <img src="<?php echo base_url('assets/images/produk/'.$editdata->foto_produk); ?>" class="img-thumbnail" width="400px">
          </div>
        </div>
        <div class="form-group">
          <label for="foto_produk" class="col-sm-3">Foto Produk</label>
          <div class="col-sm-9">
            <input type="file" class="form-control" id="foto_produk" name="foto_produk" placeholder="Foto Produk" required="">
          </div>
        </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
                <input type="submit" name="updatefotoproduk" class="btn btn-primary" value="Simpan">
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
</div>