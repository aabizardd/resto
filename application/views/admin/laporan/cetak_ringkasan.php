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
	<div class="col-lg-6" style="width: 50%;float: left;padding: 5px">
		<div class="box">
			<div class="box-header">
				<div style="background-color: #eee;">
					
				<span style="font-size: 20px;width: 100%;padding: 5px;">				Ringkasan Transaksi</span>

				</div>

			</div>
			<div class="box-body">
				<table class="table table-bordered" style="width: 100%;border: 1;" border="1">
					<tr>
						<td>Jumlah Nota</td><td><?php echo number_format($satu->jumlah_nota,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Nilai Penjualan</td><td style="text-align: right;"><?php echo number_format($satu->nilai_penjualan,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Diskon Total</td><td style="text-align: right;"><?php echo number_format($satu->total_diskon,0,'.','.') ?></td>
					</tr>
					<tr>
						<td></td><td style="text-align: right;"><?php echo number_format($satu->nilai_penjualan- $satu->total_diskon,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Service Fee</td><td style="text-align: right;"><?php echo number_format($satu->service_fee,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Pajak</td><td style="text-align: right;"><?php echo number_format($satu->service_fee,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Penerimaan</td><td style="text-align: right;"><?php echo number_format($satu->total,0,'.','.') ?></td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>

		<div class="col-lg-6" style="width: 50%;float: right;padding: 5px;">
<div style="background-color: #eee;">
					
				<span style="font-size: 20px;width: 100%;padding: 5px;">				Ringkasan Penerimaan</span>

				</div>	
<table class="table table-bordered" border="1" style="width: 100%;">
					<tr>
						<td>Tunai</td><td style="text-align: right;"><?php echo number_format($satu->tunai,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>DP</td><td style="text-align: right;"><?php echo number_format($satu->dp,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Kredit</td><td style="text-align: right;"><?php echo number_format($satu->kredit,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Card</td><td style="text-align: right;"><?php echo number_format($satu->card,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Voucher</td><td style="text-align: right;"><?php echo number_format($satu->voucher,0,'.','.') ?></td>
					</tr>
					<tr>
						<td>Total</td><td style="text-align: right;"><?php echo number_format($satu->totalsemua,0,'.','.') ?></td>
					</tr>

					<tr>
						<td>Kembalian</td><td  style="text-align: right;"><?php echo $satu->kembali ?></td>
					</tr>
					<tr>
						<td>Total uang</td><td  style="text-align: right;"><?php echo $satu->totalsemua-$satu->kembali ?></td>
					</tr>


				</table>

		</div>
	

</body>
</html>