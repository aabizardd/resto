<!DOCTYPE html>
<html>
<head>
	<title>Cetak Nota Penjualan</title>
</head>
<style type="text/css">
	@page {
    margin: 0;
}
</style>


<style type="text/css">
	@font-face{
		font-family: "Courier";
		src: "assets/fonts/cour.ttf";
	}

@media print {
  html, body {
    width: 80mm;

  }
  .tbb tr td{
  font-size: 12px;
  }
  	.tbbx tr td{
		font-size: 12px;
	}
  /* ... the rest of the rules ... */

</style>
<?php 

	$pembayaran = $pembayaran_detail->row();
 ?>
<body style="font-family: Courier;border: 1px solid #000;" onload="window.print()">
	<div style="width: 90%;margin: 0 auto;border: 1px solid #fff;overflow: hidden;">
		
<center>
	<h3 style="padding: 0;margin: 0;"><?php echo $web->nama_web ?></h3>
	<h4 style="padding: 0;margin: 0;"><?php echo $web->alamat_web ?></h4>
	<h5 style="padding: 0;margin: 0;"><?php echo $web->kabupaten_web ?></h5>
</center>
<br>

<div style="width: 70%;float: left;">
	<center><span style="font-size: 12px">Nota Penjualan</span></center>
</div>

<div style="width: 30%;float: left;">
<center>	<span style="font-size: 12px;"><?php echo $detailtransaksi->nama_meja ?> <br><span></span></span>
</center>
</div>
<style type="text/css">
	.tbb tr td{
		text-align: center;
		border-right: 1px solid #000;
	}
</style>
<table style="width: 100%;" class="tbb" >
	<tr>
		<td><?php echo $pembayaran->id_penjualan ?></td><td><?php echo $pembayaran->created_at ?></td><td><?php echo $detailtransaksi->nama_karyawan ?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
<table style="width: 100%;" class="tbbx">
	<?php if ($datadetailtransaksi->num_rows()>0): 
		$totale = 0;
		$item= 0;
		$qty = 0;
		?>

		<?php foreach ($datadetailtransaksi->result_array() as $dx): 
		$totale += $dx['total_transaksi'];
		$item +=1;

		$qty+=$dx['jumlah_transaksi'];
		// print_r($dx);
			?>
			<tr>
				<td><?php echo $dx['nama_produk'] ?></td>
				<td><?php echo $dx['total_transaksi'] ?></td>
			</tr>
		<?php endforeach ?>
	<?php endif ?>
</table>
<div style="width: 100%;">
	<div style="width: 60%;float: left;">
		<span style="font-size: 12px;">Itm: <?php echo @$item ?></span><br>

		<span style="font-size: 12px;">Qty: <?php echo @$qty ?></span>
	</div>
	<style type="text/css">
		.tbbb{
			padding: 5px;
		}
		.tbbb tr td{
	font-size: 10px;
		}
	</style>
	<?php 

	// print_r($pembayaran);
	$cari_service = @$totale *($pembayaran->service_fee_persen/100);
	$cari_pajak = @$totale *($pembayaran->pajak_persen/100);

	$totalsemua = @$totale + $cari_service + $cari_pajak;
	// echo $cari_service;

	// print_r($detailtransaksi);
	 ?>
	<div style="width: 30%;float: left;">
		<table style="width: 100%;" class="tbbb">
			<tr>
				<td>SubTotal</td><td style="text-align: right;"><?php echo @$totale ?></td>
			</tr>
			<tr>
				<td>Service Fee</td><td style="text-align: right;"><?php echo $cari_service ?></td>
			</tr>
			<tr>
				<td>Pajak</td><td  style="text-align: right;"><?php echo $cari_pajak ?></td>
			</tr>
			<tr>
				<td></td>
				<td style="border-top: 1px solid #000;text-align: right;">
					<?php echo number_format($totalsemua,0,'.',',') ?>
				</td>
			</tr>
			<tr>
				<td>Tunai</td><td style="text-align: right;"><?php echo number_format($pembayaran->tunai,0,'.',',') ?></td>
			</tr>
			<tr>
				<td>Kembalian</td><td style="text-align: right;"><?php echo number_format($totalsemua- $pembayaran->tunai,0,'.',',') ?></td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<center>Terima Kasih Atas Kunjungan Anda</center>
</div>
	</div>
</body>
</html>