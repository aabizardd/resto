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

<br><br>
	<table style="width: 100%;border: 1">
		<thead>
		<th>No.</th>
		<th>Kode/Nama Produk</th>
<!-- 		<th>Satuan</th> -->
		<th>Jumlah</th>
		<th>Penjualan</th>
		<th>HPP</th>
		<th>Profit</th>
	</thead>
	<tbody>
		
   <?php 
   $totale =0;

    $sss = '';
   foreach ($kat as $k ): ?>
                    <?php if (!empty($k['data'])): ?>

<tr  style="background-color: #eee;font-size: 20px;">
	<td colspan="6">Kelompok: <b><?php echo $k['produk_kategori'] ?></b></td>
</tr>
	<?php $no=1;
    $subtotal=0;

   ?>

                    <?php foreach ($k['data'] as $x ): 
                    	$subtotal += $x['total_transaksi'];
                       $sss .= "+".$x['total_transaksi'];

                 $sb =empty($subtotal)? 0:$subtotal;

                    	?>
                     <tr>
                     	<td><?php echo $no++ ?></td>
                     	<td><?php echo $x['nama_produk'] ?></td>
                     	<td style="text-align: right;"><?php echo $x['jumlah_transaksi'] ?></td>
                     	<td style="text-align: right;"><?php echo $x['total_transaksi'] ?></td>
                     </tr>

                     <?php endforeach ?>
                     <tr>
                     	<td colspan="3">Subtotal</td>
                     	<td style="text-align: right;"><?php echo $subtotal; ?></td>
                     </tr>
                 <?php endif;
                  
  $totale += empty($subtotal)? 0:$subtotal;

                  ?>

   <?php endforeach;



   ?>

   		<tr>
   			<td>Total</td>
   			<td colspan="3" style="text-align: right;"><?php echo $totale; ?>
        
<!--         <?php echo $sss ?>  
 -->        </td>
   		</tr>
   		
	</tbody>
	</table>
   


   <div style="display: none;">
   	<?php foreach ($kat as $k ): ?>
            <h3><?php echo $k['produk_kategori'] ?></h2>
          	<div style="width: 50%;">
          		  <table class="table table-striped" border="1" style="width: 100%;">
                <thead>
                    <th style="width: 50%;">Produk</th>
                    <th style="width: 20%;">Jumlah Penjualan</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php if (!empty($k['data'])): ?>

   	<?php 
   	$subtotal=0;
   	 ?>
                    <?php foreach ($k['data'] as $x ):
                    	$subtotal += $x['total_transaksi'];
                     ?>
                        
                    <tr>
                        <td style="width: 20%;"><?php echo $x['nama_produk'] ?></td>
                        <td style="width: 20%;"><?php echo $x['jumlah_transaksi'] ?></td>
                        <td><?php print_r($x['total_transaksi']) ?></td>
                    </tr>
                    <?php endforeach ?>
                    <tr>
                    	<td>Subtotal</td>
                    	<td><?php echo $subtotal ?></td>
                    </tr>

                    <?php else: ?>
                    <tr>
                        <td colspan="3" style="width: 40%;"><center>Tidak Ada Data</center></td>
                    </tr> 
                    <?php endif ?>

                </tbody>
            </table>
          	</div>
        <?php endforeach ?>
   </div>
</body>
</html>