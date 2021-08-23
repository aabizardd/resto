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
<table class="table table-striped">
    <thead>
        <th>#</th>
        <th>Nota</th>
        <th>Penjualan</th>
        <th>Diskon Total</th>
        <th>Pajak</th>
        <th>Lain-Lain</th>
        <th>DP</th>
        <th>Tunai</th>
        <th>Voucher</th>
        <th>Card</th>
        <th>Kredit</th>
    </thead>
    <tbody>

        <?php if ($datane->num_rows()>0): 
            $n=1;


$total = 0;
$diskon_total = 0;
$pajak_angka = 0;
$service_fee_angka = 0;
$dp = 0;
$tunai = 0;
$voucher = 0;
$card = 0;
$kredit = 0;
            ?>
          
          <?php foreach ($datane->result() as $d ): 

$total += $d->total ;
$diskon_total += $d->diskon_total ;
$pajak_angka += $d->pajak_angka ;
$service_fee_angka += $d->service_fee_angka ;
$dp += $d->dp ;
$tunai += $d->tunai ;
$voucher += $d->voucher ;
$card += $d->card ;
$kredit += $d->kredit ;
            ?>
                
        <tr>
            <td><?php echo $n++ ?></td>
            <td><?php echo $d->id_transaksi_penjualan; ?></td>
            <td><?php echo $d->total ?></td>
            <td><?php echo $d->diskon_total; ?></td>
            <td><?php echo $d->pajak_angka; ?></td>
            <td><?php echo $d->service_fee_angka; ?></td>
            <td><?php echo $d->dp; ?></td>
            <td><?php echo $d->tunai; ?></td>
            <td><?php echo $d->voucher; ?></td>
            <td><?php echo $d->card; ?></td>
            <td><?php echo $d->kredit; ?></td>

        </tr>
          <?php endforeach ?>

             <?php endif ?>
<tr>
    <td colspan="2">
        <b>Total</b>
    </td>
<td><?php echo @$total ; ?></td>
<td><?php echo @$diskon_total ; ?></td>
<td><?php echo @$pajak_angka ; ?></td>
<td><?php echo @$service_fee_angka ; ?></td>
<td><?php echo @$dp ; ?></td>
<td><?php echo @$tunai ; ?></td>
<td><?php echo @$voucher ; ?></td>
<td><?php echo @$card ; ?></td>
<td><?php echo @$kredit ; ?></td>
</tr>
    </tbody>
</table>
</div>
</div>