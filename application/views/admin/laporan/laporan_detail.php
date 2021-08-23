<div class="box">
    <!-- /.box-header -->
    <div class="box-body table-responsive">
    	<form action="<?php echo base_url(uri_string()) ?>">
    	<div class="row">
    		<div class="col-lg-3">
    			<div class="form-group">
    				<label>Tanggal Mulai</label>
    			<input type="date" name="dari" class="form-control" value="<?php echo @$this->input->get('dari') ?>">

    			</div>
    		</div>
    		<div class="col-lg-3">
    			<div class="form-group">
    				<label>Tanggal Berakhir</label>
    			<input type="date" name="sampai" class="form-control" value="<?php echo @$this->input->get('sampai') ?>">

    			</div>
    		</div>
    		<div class="col-lg-3">
    			
                <div class="form-group">
                    <label>Kasir</label>

                    <?php if ($this->datalogin->level=='Kasir'): ?>

                        <input type="hidden" name="kasir" value="<?php echo $this->session->userdata('id_user') ?>">
                            <select class="form-control" name="" disabled="">
                        <option value="">Pilih Kasir</option>
                        <?php if ($kasir->num_rows()>0): ?>
                                <?php foreach ($kasir->result() as $k): ?>
                                    <option <?php echo $this->session->userdata('id_user') == $k->id_user ? 'selected':'' ?> value="<?php echo $k->id_user ?>"><?php echo $k->id_user ?></option>
                                <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <?php else: ?>
                            <select class="form-control" name="kasir">
                        <option value="">Pilih Kasir</option>
                        <?php if ($kasir->num_rows()>0): ?>
                                <?php foreach ($kasir->result() as $k): ?>
                                    <option <?php echo $this->input->get('kasir') == $k->id_user ? 'selected':'' ?> value="<?php echo $k->id_user ?>"><?php echo $k->id_user ?></option>
                                <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <?php endif ?>
                
                </div>
    		</div>
    		<div class="col-lg-3">
    			<div class="form-group">
    				<br>
    				    			<button class="btn btn-primary btn-block">Cari</button>
                                    <a target="_blank" class="btn btn-info btn-block" href="<?php echo current_url().'?print=true' ?>">Cetak</a>

    			</div>
    		</div>
    	</div>
    	</form>
    </div>
</div>


<div class="box">
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <?php foreach ($kat as $k ): ?>
            <h3><?php echo $k['produk_kategori'] ?></h2>
            <table class="table table-striped">
                <thead>
                    <th style="width: 20%;">Produk</th>
                    <th style="width: 20%;">Jumlah Penjualan</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php if (!empty($k['data'])): ?>
                    <?php foreach ($k['data'] as $x ): ?>
                        
                    <tr>
                        <td style="width: 20%;"><?php echo $x['nama_produk'] ?></td>
                        <td style="width: 20%;"><?php echo $x['jumlah_transaksi'] ?></td>
                        <td><?php print_r($x['total_transaksi']) ?></td>
                    </tr>
                    <?php endforeach ?>

                    <?php else: ?>
                    <tr>
                        <td colspan="2" style="width: 40%;"><center>Tidak Ada Data</center></td>
                    </tr> 
                    <?php endif ?>

                </tbody>
            </table>
        <?php endforeach ?>
 </div>
 </div>

