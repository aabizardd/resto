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

<div class="row">
	<div class="col-lg-6">
		<div class="box">
			<div class="box-header">
				<span style="font-size: 20px;">				Ringkasan Transaksi</span>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						<td>Jumlah Nota</td><td><?php echo $satu->jumlah_nota ?></td>
					</tr>
					<tr>
						<td>Nilai Penjualan</td><td><?php echo $satu->nilai_penjualan ?></td>
					</tr>
					<tr>
						<td>Diskon Total</td><td><?php echo $satu->total_diskon ?></td>
					</tr>
					<tr>
						<td></td><td><?php echo $satu->nilai_penjualan- $satu->total_diskon ?></td>
					</tr>
					<tr>
						<td>Service Fee</td><td><?php echo $satu->service_fee ?></td>
					</tr>
					<tr>
						<td>Pajak</td><td><?php echo $satu->service_fee ?></td>
					</tr>
					<tr>
						<td>Penerimaan</td><td><?php echo $satu->total ?></td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="box">
			<div class="box-header">
				<span style="font-size: 20px;">				Ringkasan Penerimaan</span>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr>
						<td>Tunai</td><td><?php echo $satu->tunai ?></td>
					</tr>
					<tr>
						<td>DP</td><td><?php echo $satu->dp ?></td>
					</tr>
					<tr>
						<td>Kredit</td><td><?php echo $satu->kredit ?></td>
					</tr>
					<tr>
						<td>Card</td><td><?php echo $satu->card ?></td>
					</tr>
					<tr>
						<td>Voucher</td><td><?php echo $satu->voucher ?></td>
					</tr>
					<tr>
						<td>Total</td><td><?php echo $satu->totalsemua ?></td>
					</tr>
					<tr>
						<td>Kembalian</td><td><?php echo $satu->kembali ?></td>
					</tr>
					<tr>
						<td>Total uang</td><td><?php echo $satu->totalsemua-$satu->kembali ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
</div>
