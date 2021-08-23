<!DOCTYPE html>
<html>
<head>
	<title>Cetak Kitchen Slip</title>
</head>
<style type="text/css">
	@page {
    margin: 0;
}

@media print {
  html, body {
    width: 80mm;

  }
  .tbb tr td{
  font-size: 12px;
  }
</style>

<style type="text/css">
	@font-face{
		font-family: "Courier";
		src: "assets/fonts/cour.ttf";
	}
</style>

<body style="font-family: Courier;border: 1px solid #000;" onload="window.print()">
	<div style="width: 100%;margin: 0 auto;border: 1px solid #000;">
		<?php 

		 ?>
<center>
	<h1 style="padding: 0;margin: 0;font-size: 13px;"><?php echo $detailtransaksi->nama_meja ?></h1>
</center>
<br>

<style type="text/css">
	.tbb tr td{
		text-align: center;
		border-right: 1px solid #000;
	}
	.tbbb tr td{
		font-size: 13px;
	}
</style>
<table style="width: 100%;" class="tbbb">
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
				<td><center><?php echo $dx['jumlah_transaksi'] ?></center></td>
				<td><?php echo '['.$dx['id_produk'].'] ' .$dx['nama_produk'] ?></td>
			</tr>
		<?php endforeach ?>
	<?php endif ?>

</table>
<div style="padding: 5px;">
	
<span style="font-size: 12px;">Itm: <?php echo @$item ?></span> <br>
<span  style="font-size: 12px;">Qty: <?php echo @$qty ?></span>

</div>

	</div>
</body>

</html>