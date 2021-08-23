<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <?php echo $web->nama_web; ?>
            <small class="pull-right">Tanggal Transaksi : <?php echo $detailtransaksi->tanggal_transaksi; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Karyawan :</b>
          <address>
            <strong><?php echo $detailtransaksi->nama_karyawan; ?></strong><br>
            <?php echo $detailtransaksi->alamat_karyawan; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Meja :</b>
          <address>
            <strong>ID Meja : <?php echo $detailtransaksi->id_meja; ?></strong><br>
            Nama Meja : <?php echo $detailtransaksi->nama_meja; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Faktur</b><br>
          <b>No. Transaksi:</b> <?php echo $detailtransaksi->id_transaksi_penjualan; ?><br>
          <b>Tanggal Transaksi:</b> <?php echo $detailtransaksi->tanggal_transaksi; ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                
                <th>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>

                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
              </tr>
            </thead>
                      
              <?php
              $no = 1;
              $totalsemua = 0;
              $totaldiskon = 0;
              foreach ($datadetailtransaksi as $value) { 
                $totalsemua += $value['total_semua'];
                $totaldiskon += $value['diskon_angka'];
                ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['id_produk']; ?></td>
                <td><?php echo $value['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($value['harga_transaksi'], 0, ',', '.'); ?>,00</td>
                                <td><?php echo $value['jumlah_transaksi']; ?></td>

                <td>Rp. <?php echo number_format($value['diskon_angka'], 0, ',', '.'); ?>,00</td>
                <td>Rp. <?php echo number_format($value['total_transaksi'], 0, ',', '.'); ?>,00</td>
              </tr>
              <?php
              $no++;
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                  <td colspan="6"><b>Total Harga Pemesanan</b></td>
                  <td colspan="2">
                    <b>Rp. <?php echo number_format($datatotaltransaksisementara, 0, ',', '.') ; ?>,00</b>
                  </td>
                </tr>
            </tfoot>
          </table>

           <?php if ($pembayaran_detail->num_rows()>0): ?>
            <h3>Rincian </h3>
            <?php 
            $pembayaran = $pembayaran_detail->row();
             ?>
            <div class="row">
                <div class="col-lg-6">
                  <table class="table table-striped">
                    <tr>
                      <td>Total Semua (Belum Diskon & Lain)</td><td><?php echo $totalsemua ?></td>
                    </tr>
                    <tr>
                      <td>Total Diskon</td><td><?php echo '- '.$totaldiskon ?></td>
                    </tr>
                    <tr>
                      <td></td><td><?php echo $totalsemua-$totaldiskon ?></td>
                    </tr>
                    <tr>

                      <?php 

                      $totals = $totalsemua-$totaldiskon;
                      $service_fee_angka = $totals * ($pembayaran->service_fee_persen/100);
                      $pajak_angka = $totals * ($pembayaran->pajak_persen/100);

                      $semuanya = $totals + $service_fee_angka +$pajak_angka;
                       ?>
                      <td>Service Fee (<b><?php echo $pembayaran->service_fee_persen.'%' ?></b>)</td>
                      <td><?php echo '+ '.$service_fee_angka ?></td>
                    </tr>
                    <tr>
                      <td>Pajak (<b><?php echo $pembayaran->pajak_persen.'%' ?></b>)</td>
                      <td><?php echo '+ '.$pajak_angka ?></td>
                    </tr>
                    <tr>
                      <td><span style="font-size: 20px;">Total Transaksi</span></td>
                      <td><span style="font-size: 25px;font-weight: bold"><?php echo $semuanya ?></span></td>
                    </tr>
                  </table>
                </div>
            </div>
          <?php endif ?>


<div class="pull-right">
  <a class="btn btn-default" href="<?php echo base_url('kasir/transaksi/cetak-nota/'.$detailtransaksi->id_transaksi_penjualan) ?>">Cetak Nota Penjualan</a>
  <a class="btn btn-default"  href="<?php echo base_url('kasir/transaksi/billing-note/'.$detailtransaksi->id_transaksi_penjualan) ?>">Bill</a>
  <a  href="<?php echo base_url('kasir/transaksi/kitchen-slip/'.$detailtransaksi->id_transaksi_penjualan) ?>" class="btn btn-default">Kitchen Slip</a>
</div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <!-- <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary pull-right">
            <i class="fa fa-file"></i> Simpan PDF
          </button>
          <button type="button" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Cetak</button>
        </div>
      </div> -->
    </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->  