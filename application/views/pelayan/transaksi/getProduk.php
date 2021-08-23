<?php if ($dataproduk->num_rows()>0): ?>
	
 <div class="row">

              <?php foreach ($dataproduk->result_array() as $value) { ?>
                <div class="col-lg-2 col-sm-3 col-xs-4">
                    <a href="#">
                         <img data-id="<?php echo $value['id_produk']; ?>" src="<?php echo base_url('assets/images/produk/'.$value['foto_produk']); ?>" class="thumbnail img-responsive idProduk" style="position: relative; float: left; width:100px; height: 80px;">
                    </a><br>
                    <center>                    <?php print_r($value['nama_produk']) ?>
</center>
                </div>
                <?php } ?>
              </div>

              <?php else:  ?>

              	<center>Tidak Ada Produk</center>
<?php endif ?>
