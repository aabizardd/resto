<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<style type="text/css">
	@font-face{
		font-family: "Courier";
		src: "assets/fonts/cour.ttf";
	}
</style>
<body style="font-family: Courier;" onload="window.print()">
<body style="font-family: Courier;" >

		<div style="width: 100%;float: left;border-bottom: 3px solid #000;">
		<div style="width: 50%;float: left;">
							<h3 style="padding: 0;margin: 0;"><?php echo $web->nama_web ?></h3>
				<h4 style="padding: 0;margin: 0;"><?php echo $web->alamat_web ?></h4>
		</div>
		<div style="width: 50%;float: left;">
			<div style="float: right;">
				<h3 style="padding: 0;margin: 0;">Laporan Penjualan</h3>
				<h4 style="padding: 0;margin: 0;">[ SUMMARY REPORT ]</h4>
			</div>
		</div>
	</div>

	<div style="width: 100%;float: left;border-bottom: 1px solid #000;padding-top: 5px;">
		<table style="width: 30%;">
			<tr>
				<td>Kasir</td><td>:</td><td><?php echo $kasir ?></td>
			</tr>
			<tr>
				<td>Tanggal</td><td>:</td><td><?php echo $tanggal ?></td>
			</tr>
		</table>
	</div>
<table class="table table-striped" style="width: 100%;" border="1">
    <thead style="font-size: 12px;">
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
$tunai += $d->total ;
$voucher += $d->voucher ;
$card += $d->card ;
$kredit += $d->kredit ;
            ?>
                
        <tr>
            <td style="text-align: right;"><?php echo $n++ ?></td>
            <td style="text-align: right;"><?php echo $d->id_transaksi_penjualan; ?></td>
            <td style="text-align: right;"><?php echo $d->total ?></td>
            <td style="text-align: right;"><?php echo $d->diskon_total; ?></td>
            <td style="text-align: right;"><?php echo $d->pajak_angka; ?></td>
            <td style="text-align: right;"><?php echo $d->service_fee_angka; ?></td>
            <td style="text-align: right;"><?php echo $d->dp; ?></td>
            <td style="text-align: right;"><?php echo $d->total; ?></td>
            <td style="text-align: right;"><?php echo $d->voucher; ?></td>
            <td style="text-align: right;"><?php echo $d->card; ?></td>
            <td style="text-align: right;"><?php echo $d->kredit; ?></td>

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
</body>
</html>